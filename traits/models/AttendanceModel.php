<?php

trait AttendanceModel
{
    /**
     *  Returns the monthly attendance details of a whole batch or a specific student
     *  @param $month - the desired month
     *  @param $options - an array containing details about the request
     *  @param $options["type"] - specify the scope of the request (single,all)
     *  @param $options["batchId"] - the ID of the batch
     *  @param $options["student_id"] - required only if requesting for attendance of a single student
     */
    function getMonthlyAttendance($year = 'none',$month = 'none', $options = null) : array
    {
        if ($month === 'none' || $year === 'none') {
            return ["condition" => 'failed', "errorType" => "data",
                "message" => "Missing one argument for the month"];
        }

        // Construct the query and update these queries to get reports for each batch
        if (isset($options['type']) && $options['type'] === 'single') {
            $query = <<<SQL
            SET @sql = NULL;
            SELECT GROUP_CONCAT(DISTINCT
            CONCAT(
                'max(case when `date` = ''',
                attendance.date,
                ''' then attendance when registered_student.registered_date > ''',
                attendance.date,
                ''' then \'NOTREGISTERED\' end) `',
                DAY(attendance.date), '`'
            ) ) INTO @sql
            FROM
            attendance
            WHERE MONTH(attendance.date) = '{$month}' AND YEAR(attendance.date) = '{$year}';
            IF @sql IS NOT NULL THEN
                SET @sql = CONCAT('SELECT attendance.student_id, registered_student.mis, student.nic,student.initials,student.last_name,
                    COALESCE(drop_out.drop_out_date,null) AS drop_out_date, ', @sql, 'FROM registered_student LEFT JOIN drop_out ON
                    registered_student.id = drop_out.student_id, attendance, student
                    WHERE student.id = registered_student.student_id AND attendance.student_id = registered_student.id 
                    AND registered_student.batch_id = {$options['batch_id']} AND registered_student.id = {$options['student_id']}');
                PREPARE stmt FROM @sql;
                EXECUTE stmt;
            END IF;
            SQL;
        } else {
            $query = <<<SQL
            SET @sql = NULL;
            SELECT GROUP_CONCAT(DISTINCT
            CONCAT(
                'max(case when `date` = ''',
                attendance.date,
                ''' then attendance when registered_student.registered_date > ''',
                attendance.date,
                ''' then \'NOTREGISTERED\' end) `',
                DAY(attendance.date), '`'
            ) ) INTO @sql
            FROM
            attendance
            WHERE MONTH(attendance.date) = '{$month}' AND YEAR(attendance.date) = '{$year}';
            IF @sql IS NOT NULL THEN
                SET @sql = CONCAT('SELECT attendance.student_id, registered_student.mis, student.nic,student.initials,student.last_name,
                    COALESCE(drop_out.drop_out_date,null) AS drop_out_date, ', @sql, 'FROM registered_student LEFT JOIN drop_out ON
                    registered_student.id = drop_out.student_id, attendance, student
                    WHERE student.id = registered_student.student_id AND attendance.student_id = registered_student.id 
                    AND registered_student.batch_id = {$options['batch_id']} GROUP BY attendance.student_id');
                PREPARE stmt FROM @sql;
                EXECUTE stmt;
            END IF;
            SQL;
        }

        // Store the processed query results in this array
        $results = [];

        $conn = DB::getConnection();
        $conn->multi_query($query);

        $tempResults = [];

        do {
            if ($result = $conn->store_result()) {
                $tempResults = $result->fetch_all(MYSQLI_ASSOC);
                $result->free();
            }
        } while ($conn->next_result());

        if (count($tempResults) < 1) {
            return $results;
        }

        $sumAttendance = 0;
        $results['rows'] = [];

        foreach ($tempResults as $attendance) {
            // Store each attendance array in a temp array whcich will be added to the results['row']
            $tempArray = [];

            $tempArray['mis'] = $attendance['mis'];
            $tempArray['nic'] = $attendance['nic'];
            $tempArray['initials'] = $attendance['initials'];
            $tempArray['last_name'] = $attendance['last_name'];
            $tempArray['drop_out_date'] = $attendance['drop_out_date'];
            $tempArray['attendance'] = [];

            $totalAttendance = 0;
            $daysBeforeRegistration = 0; // Keeps track of the number of marked attendance date before the registration of the student

            foreach ($attendance as $key => $value) {
                if (is_numeric($key)) {
                    if ($value === 'PRESENT') {
                        $tempArray['attendance'][(String) $key] = 1;
                        $totalAttendance++;
                    } 
                    else if($value === 'NOTREGISTERED'){
                        $tempArray['attendance'][(String) $key] = ' ';
                        $daysBeforeRegistration++;
                    }
                    else
                        $tempArray['attendance'][(String) $key] = 0;
                }
            }

            $tempArray['conductedDays'] = count($tempArray['attendance']);
            $tempArray['total'] = $totalAttendance;
            $tempArray['percentage'] = ceil(($totalAttendance / ($tempArray['conductedDays'] - $daysBeforeRegistration)) * 100);

            // Calculate the attendance percentage starting with the students registered date

            $sumAttendance += $totalAttendance;

            array_push($results['rows'], $tempArray);
        }

        $results['totalAttendance'] = $sumAttendance;
        $results['totalConductedDays'] = $results['rows'][0]['conductedDays'] * count($tempResults);
        $results['totalPercentage'] = ceil(($results['totalAttendance'] / $results['totalConductedDays']) * 100);

        return $results;
    }

    /**
     *  Returns the annual attendance details of a whole batch or a specific student
     *  @param $options - an array containing details about the request
     *  @param $options["type"] - specify the scope of the request (single,all)
     *  @param $options["batchId"] - the ID of the batch
     *  @param $options["student_id"] - required only if requesting for attendance of a single student
     */
    function getAnnualAttendance($options = null) : array
    {
        // Construct the query for generating the report and update these queries to get reports for each batch
        if (isset($options['type']) && $options['type'] === 'single') {

            /* $query = <<<SQL
            SELECT batch.start_date INTO @start_date FROM batch WHERE batch.batch_id = {$options['batch_id']};
            SELECT batch.end_date INTO @end_date FROM batch WHERE batch.batch_id = {$options['batch_id']};
            SET @interval = -1;

            CREATE TEMPORARY TABLE batch_dates AS SELECT DATE_ADD(@start_date,INTERVAL (@interval := @interval + 1) MONTH) AS yearMonth FROM
            attendance;

            CREATE TEMPORARY TABLE batch_att AS SELECT DISTINCT YEAR(yearMonth) AS y, MONTH(yearMonth) AS m FROM batch_dates,batch WHERE yearMonth <= @end_date;

            SELECT GROUP_CONCAT(
                CONCAT(
                    'sum(case when ((YEAR(attendance.date) = ',
                    y,
                    ') AND (MONTH(attendance.date) =',m,') AND (attendance.attendance = \'PRESENT\')) then 1 else 0 end) `',
                    RIGHT(y,2), '-', m, '`'
                )
            ) INTO @sql
            FROM
                batch_att;

            SET @sql = CONCAT('SELECT registered_student.mis, student.initials, student.last_name, student.nic,
            drop_out.drop_out_date, ', @sql, ', 
            SUM(CASE WHEN attendance.attendance = \'PRESENT\' THEN 1 ELSE 0 END) AS total,
            SUM(CASE WHEN TRUE THEN 1 ELSE 0 END) AS conducted_days,
            dense_rank() OVER ( partition by YEAR(attendance.date) order by total desc ) 
            AS rank FROM registered_student LEFT JOIN drop_out ON 
            registered_student.id = drop_out.student_id, attendance, student 
            WHERE attendance.student_id = registered_student.id AND student.id = registered_student.student_id 
            AND registered_student.batch_id = {$options['batch_id']} AND attendance.student_id = {$options['student_id']}');
            PREPARE stmnt FROM @sql;
            EXECUTE stmnt;
            SQL; */

            $query = <<<SQL
            SELECT batch.start_date INTO @start_date FROM batch WHERE batch.batch_id = {$options['batch_id']};
            SELECT batch.end_date INTO @end_date FROM batch WHERE batch.batch_id = {$options['batch_id']};
            SET @interval = -1;

            CREATE TEMPORARY TABLE batch_dates AS SELECT DATE_ADD(@start_date,INTERVAL (@interval := @interval + 1) MONTH) AS yearMonth FROM
            attendance;

            CREATE TEMPORARY TABLE batch_att AS SELECT DISTINCT YEAR(yearMonth) AS y, MONTH(yearMonth) AS m FROM batch_dates,batch WHERE yearMonth <= @end_date;
            CREATE TEMPORARY TABLE month_dates AS SELECT DISTINCT attendance.date as attendance_date FROM attendance;

            SELECT GROUP_CONCAT(
                CONCAT(
                    'sum(case when ((YEAR(attendance.date) = ',
                    y,
                    ') AND (MONTH(attendance.date) =',m,') AND (attendance.attendance = \'PRESENT\')) then 1 else 0 end) as `',
                    RIGHT(y,2), '-', m, '`, (SELECT COUNT(*) FROM month_dates WHERE YEAR(attendance_date) = ',
                    y, ' AND MONTH(attendance_date) = ', m, ') AS `',
                    RIGHT(y,2), '-', m,'-conducts`'
                )
            ) INTO @sql
            FROM
                batch_att;

            SET @sql = CONCAT('SELECT registered_student.mis, student.initials, student.last_name, student.nic,
            drop_out.drop_out_date, ', @sql, ', 
            SUM(CASE WHEN attendance.attendance = \'PRESENT\' THEN 1 ELSE 0 END) AS total,
            SUM(CASE WHEN TRUE THEN 1 ELSE 0 END) AS conducted_days,
            dense_rank() OVER ( partition by YEAR(attendance.date) order by total desc ) 
            AS rank FROM registered_student LEFT JOIN drop_out ON 
            registered_student.id = drop_out.student_id, attendance, student 
            WHERE attendance.student_id = registered_student.id AND student.id = registered_student.student_id 
            AND registered_student.batch_id = {$options['batch_id']} AND attendance.student_id = {$options['student_id']}');
            
            PREPARE stmnt FROM @sql;
            EXECUTE stmnt;
            SQL;
            
        } else {

            $query = <<<SQL
            SELECT batch.start_date INTO @start_date FROM batch WHERE batch.batch_id = {$options['batch_id']};
            SELECT batch.end_date INTO @end_date FROM batch WHERE batch.batch_id = {$options['batch_id']};
            SET @interval = -1;

            CREATE TEMPORARY TABLE batch_dates AS SELECT DATE_ADD(@start_date,INTERVAL (@interval := @interval + 1) MONTH) AS yearMonth FROM
            attendance;

            CREATE TEMPORARY TABLE batch_att AS SELECT DISTINCT YEAR(yearMonth) AS y, MONTH(yearMonth) AS m FROM batch_dates,batch WHERE yearMonth <= @end_date;

            SELECT GROUP_CONCAT(
                CONCAT(
                    'sum(case when ((YEAR(attendance.date) = ',
                    y,
                    ') AND (MONTH(attendance.date) =',m,') AND (attendance.attendance = \'PRESENT\')) then 1 else 0 end) `',
                    RIGHT(y,2), '-', m, '`'
                )
            ) INTO @sql
            FROM
                batch_att;

            SET @sql = CONCAT('SELECT registered_student.mis, student.initials, student.last_name, student.nic,
                drop_out.drop_out_date, ', @sql, ', 
                SUM(CASE WHEN attendance.attendance = \'PRESENT\' THEN 1 ELSE 0 END) AS total, 
                SUM(CASE WHEN TRUE THEN 1 ELSE 0 END) AS conducted_days,
                dense_rank() OVER ( partition by YEAR(attendance.date) order by total desc ) 
                AS rank FROM registered_student LEFT JOIN drop_out ON 
                registered_student.id = drop_out.student_id, attendance, student 
                WHERE attendance.student_id = registered_student.id AND student.id = registered_student.student_id 
                AND registered_student.batch_id ={$options['batch_id']} GROUP BY attendance.student_id');
            PREPARE stmnt FROM @sql;
            EXECUTE stmnt;
            SQL;

        }

        // Store the processed query results in this array
        $outputArray = ["dates" => [], "students" => []];
        $results = [];

        // Execute the query and fetch results
        $results = DB::multiSelect($query,MYSQLI_ASSOC);

        if(count($results) < 1) return $results;

        $firstResult = $results[0];
        if($options['type'] === 'single'){
            // The dates object is different for
            $keys = array_keys($firstResult);
            foreach ($firstResult as $key => $value) {
                
                if(preg_match('/^\d{2}-\d{1,2}$/',$key)){
                    $nextKey = $keys[array_search($key,$keys) + 1];
                    $dateObj = [
                        "month" => $key,
                        "conducted_days" => $firstResult[$nextKey]
                    ];
                    array_push($outputArray["dates"],$dateObj);
                }
            }
        }
        else{
            foreach ($firstResult as $key => $value) {
                
                if(preg_match('/^\d{2}-\d{1,2}$/',$key)){
                    array_push($outputArray["dates"],$key);
                }
            }
        }

        for ($index = 0; $index < count($results); $index++) {
            $tempStudent = [];
            $tempStudent['mis'] = $results[$index]['mis'];
            $tempStudent['nic'] = $results[$index]['nic'];
            $tempStudent['initials'] = $results[$index]['initials'];
            $tempStudent['last_name'] = $results[$index]['last_name'];
            $tempStudent['drop_out_date'] = $results[$index]['drop_out_date'];
            $tempStudent['total'] = $results[$index]['total'];
            $tempStudent['conducted_days'] = $results[$index]['conducted_days'];
            $tempStudent['rank'] = (isset($results[$index]['rank']))? $results[$index]['rank']:"0";

            $conductedDays = $results[$index]['conducted_days'];
            $conductedDays = ($conductedDays < 1)? 1 : $conductedDays; // To avoid division by zero
            $tempStudent['percentage'] = ceil(($results[$index]['total'] / $conductedDays) * 100);

            foreach ($results[$index] as $key => $value) {
                
                if(preg_match('/^\d{2}-\d{1,2}$/',$key)){
                    $tempStudent['attendance'][$key] = $value;
                }
            }

            array_push($outputArray["students"],$tempStudent);
        }

        return $outputArray;
    }

    function getAnnualAttendancePercentages($batchId=1) : array
    {
        $query = "SELECT batch.start_date INTO @start_date FROM batch WHERE batch.batch_id = $batchId;
        SELECT batch.end_date INTO @end_date FROM batch WHERE batch.batch_id = $batchId;
        SET @interval = -1;
        
        CREATE TEMPORARY TABLE batch_dates AS SELECT DATE_ADD(@start_date,INTERVAL (@interval := @interval + 1) MONTH) AS yearMonth FROM
        attendance;
        
        CREATE TEMPORARY TABLE batch_att AS SELECT DISTINCT YEAR(yearMonth) AS y, MONTH(yearMonth) AS m FROM batch_dates,batch WHERE yearMonth <= @end_date;
        
        SELECT GROUP_CONCAT(
            CONCAT(
                'sum(case when ((YEAR(attendance.date) = ',
                y,
                ') AND (MONTH(attendance.date) =',m,') AND (attendance.attendance = \'PRESENT\')) then 1 else 0 end) `',
                y, '-', m, '`,
                sum(case when ((YEAR(attendance.date) = ',
                y,
                ') AND (MONTH(attendance.date) =',m,')) then 1 else 0 end) `',
                y, '-', m, ' total`'
            )
        ) INTO @sql
        FROM
            batch_att;
        
        SET @sql = CONCAT('CREATE TEMPORARY TABLE att_percent AS SELECT ', @sql, ', SUM(CASE WHEN attendance.attendance = \'PRESENT\' THEN 1 ELSE 0 END) AS total,
        SUM(CASE WHEN TRUE THEN 1 ELSE 0 END) AS conducted_days FROM attendance WHERE attendance.date >= @start_date AND attendance.date <= @end_date');
        PREPARE stmnt FROM @sql;
        EXECUTE stmnt;
        
        SET @sql = null;
        
        SELECT GROUP_CONCAT(
            CONCAT(
                'CASE WHEN `',y,'-',m,' total` = 0 THEN 0 ELSE ',
                'ROUND((`',y,'-',m,'`','/`',
                y,'-',m,' total`) * 100) END AS `',y,'-',m,'`'
            )
        ) INTO @sql
        FROM
            batch_att;
        SET @sql = CONCAT('SELECT ',@sql,'FROM att_percent');
        PREPARE stmnt FROM @sql;
        EXECUTE stmnt;";

        $results = DB::multiSelect($query,MYSQLI_ASSOC);

        return $results;
    }

    /**
     *  Returns attendance details of a whole batch of a single day
     *  @param $data - an array containing details about the request
     *  @param $data["date"] - the desired date
     *  @param $options["batchId"] - the ID of the batch
     */
    function getAttendance($data = null)
    {
        if ($data === null) {
            return ["condition" => "failed", "message" => "Missing arguments"];
        }

        if (!isset($data['date']) || empty($data['date']) || !isset($data['batch_id']) || empty($data['batch_id']))
            return ["condition" => "failed", "message" => "Missing arguments"];

        if ( (new DateTime($data['date'])) > (new DateTime()) ) {
            return [
                'status' => 'date_ahead',
                'message' => 'Cannot mark or view attendance of dates in the future'
            ];
        }

        $query = "SELECT CASE WHEN (('{$data['date']}' > end_date) OR ('{$data['date']}' < `start_date`)) THEN 'TRUE' ELSE 'FALSE' END AS result FROM batch WHERE batch_id = {$data['batch_id']}";

        if(DB::select($query)[0]['result'] === 'TRUE'){
            return [
                'status' => 'date_ahead',
                'message' => 'Cannot mark or view attendance of dates not in the batch duration'
            ];
        }

        $query= <<<SQL
        SELECT CONCAT('{ "holiday": ',COALESCE((SELECT CONCAT('{"date": "',holidays.date,'","title": "',holidays.title,'"},') 
            FROM holidays WHERE holidays.date = '{$data['date']}'),'null'),
            ',"attendanceData": [',GROUP_CONCAT(CONCAT(CONCAT('{ "student_id":',registered_student.id,',"mis": "',registered_student.mis,'",'), 
            CONCAT('"nic": "',student.nic,'",'), CONCAT('"initials": "',student.initials,'",'), 
            CONCAT('"last_name": "',student.last_name,'",'), 
            CONCAT('"attendance": ',CASE WHEN attendance.attendance = 'PRESENT' THEN TRUE ELSE FALSE END,'}'))),']}')
        FROM registered_student, attendance, student
        WHERE attendance.student_id = registered_student.student_id 
        AND student.id = registered_student.student_id 
        AND registered_student.batch_id = {$data['batch_id']} 
        AND registered_student.id NOT IN (SELECT drop_out.student_id FROM drop_out WHERE drop_out_date <= '{$data['date']}') 
        AND attendance.date = '{$data['date']}';
        SQL;

        $results = json_decode(DB::select($query,MYSQLI_NUM)[0][0],JSON_OBJECT_AS_ARRAY);

        if ($results === null || count($results) < 1)  // If attendance is not marked for the date, select an empty data template
        {
            $query = <<<SQL
            SELECT CONCAT('{ "holiday": ',COALESCE((SELECT CONCAT('{"date": "',holidays.date,'","title": "',holidays.title,'"}') 
                FROM holidays WHERE holidays.date = '{$data['date']}'),'null'),
                ',"attendanceData": [',GROUP_CONCAT(CONCAT(CONCAT('{ "student_id":',registered_student.id,',"mis": "',registered_student.mis,'",'), 
                CONCAT('"nic": "',student.nic,'",'), CONCAT('"initials": "',student.initials,'",'), 
                CONCAT('"last_name": "',student.last_name,'","attendance": 0 }'))),']}')
            FROM registered_student, student 
            WHERE student.id = registered_student.student_id 
            AND registered_student.batch_id = {$data['batch_id']}
            AND registered_student.id NOT IN (SELECT drop_out.student_id FROM drop_out WHERE drop_out_date <= '{$data['date']}');
            SQL;

            $results = json_decode(DB::select($query,MYSQLI_NUM)[0][0],JSON_OBJECT_AS_ARRAY);

            return [
                'status' => 'not_marked',
                'message' => 'Attendance for this date has not been marked',
                'data' => $results
            ];
        } else
            return [
                'status' => 'marked',
                'data' => $results
            ];
    }

    function markAttendance($data = null)
    {
        if (
            $data === null || !isset($data['attendance']) || empty($data['attendance']) ||
            gettype($data['attendance']) !== 'array' || !isset($data['date']) || empty($data['date'])
        )
            return ["condition" => "failed", "message" => "Missing arguments"];

        $requiredValues = ['student_id', 'attendance'];

        foreach ($data['attendance'] as $record) {
            foreach ($requiredValues as $value) {

                // Return an error status if data is missing
                if (!isset($record[$value]) || empty($record[$value]))
                    return ["condition" => "failed", "message" => "Missing arguments"];
            }
        }

        $conn = DB::getConnection();
        $stmt = null;

        // Check if attendance for this date is already marked
        $previousInputs = DB::select("SELECT * FROM attendance WHERE attendance.date = '{$data['date']}'");

        $query = "INSERT INTO `attendance`(`attendance`, `date`, `student_id`) VALUES(?,?,?)";

        if (count($previousInputs) > 0) {
            $query = "UPDATE attendance SET attendance.attendance = ? WHERE `date` = ? AND `student_id` = ?";
        }

        $date = $data['date'];
        $attendance = $mis = null;

        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssi', $attendance, $date, $mis);

        $result = true;

        foreach ($data['attendance'] as $record) {
            $attendance = $record['attendance'];
            $mis = $record['student_id'];

            $r = $stmt->execute();
            $result = $result && ($r == 1);
        }

        $stmt->close();

        if (!$result) {
            return ['condition' => 'failed', 'type' => 'SERVER', 'message' => 'There was a problem with the server'];
        }
        return ['condition' => 'success', 'message' => 'Attendance saved'];
    }

    function manageHolidays($data = null)
    {
        // Validate request
        if (
            $data === null || !isset($data['operation']) || empty($data['operation']) ||
            !isset($data['date']) || empty($data['date'])
        )
            return ["condition" => "failed", "message" => "Missing arguments"];

        $option = $data['operation'];
        $result = 0;

        $conn = DB::getConnection();

        if ($option === 'remove') {
            $query = "DELETE FROM holidays WHERE `date`='{$data['date']}'";
            $result = $conn->query($query);
            if ($result == 1)
                return ['condition' => 'success', 'message' => 'Date removed'];
            else
                return ['condition' => 'failed', 'errorType' => 'SERVER', 'message' => 'There was an erro with the server'];

        }

        $description = (isset($data['description']) && !empty($data['description'])) ? $data['description'] : '';

        // Operation specific validations
        if (!isset($data['title']) || empty($data['title']))
            return ["condition" => "failed", "message" => "Missing arguments"];

        $query = "INSERT INTO holidays(`date`, `title`,`description`) VALUES('{$data['date']}','{$data['title']}','$description')";

        $results = DB::select("SELECT * FROM holidays WHERE `date` = '{$data['date']}'");

        if (count($results) > 0) {
            $query = "UPDATE holidays SET `title`='{$data['title']}', `description`='$description' WHERE `date`='{$data['date']}'";
        }

        $result = $conn->query($query);

        if ($result == 1)
            return ['condition' => 'success', 'message' => 'Holiday added'];
        else
            return ['condition' => 'failed', 'errorType' => 'SERVER', 'message' => 'There was an erro with the server'];
    }

    function getHolidays($month = null)
    {
        if (!isset($month) || empty($month))
            return ['condition' => 'failed', 'message' => 'Missing arguments'];

        $query = "SELECT `date`,`title`,`description` FROM `holidays` WHERE MONTH(`date`) ='$month'";

        $results = DB::select($query);

        return ['condition' => 'success', 'data' => $results];
    }
    
}