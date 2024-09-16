<?php

trait RegistrationModel
{
    /**
     * Returns a list of all the registered students
     * @param $batchId - the ID of the batch
     */
    public function getRegsiteredStudents($batchId=null,$current=false,$courseId = 1,$isSearch=false,$data=null)
    {
        if($current) {
            /* Queries the batch id of the currently active batch */
            $batchId = DB::select("SELECT batch_id FROM batch WHERE start_date = (SELECT MAX(start_date) FROM batch WHERE course_id = $courseId) AND course_id = $courseId")[0]['batch_id'];
        }

        $query = "SELECT registered_student.batch_id,registered_student.id, student.initials, student.first_name, student.last_name, 
        registered_student.mis, student.address, student.nic, student.mobile_no, student.gender, registered_student.student_status
        FROM student, registered_student
        WHERE student.id = registered_student.student_id
        AND registered_student.batch_id = $batchId";

        /* Build the query for searching students */
        if($isSearch && $data != null){
            $category = $data['category'];
            $statusCondition = ($data['status'] !== 'all')? "AND registered_student.student_status = '{$data['status']}'":"";

            if($data['searchQuery'] == null) // If the search is empty only apply the status filter
            {
                $query .= " " . $statusCondition;
                return DB::multiSelect($query,MYSQLI_ASSOC);
            }
            
            if($category === 'name'){

                $query = <<<SQL
                SET @searchQuery = LOWER('{$data['searchQuery']}') COLLATE utf8mb4_general_ci;
                SELECT * FROM(
                    SELECT COALESCE(CONCAT(student.first_name,' ',student.last_name),student.first_name) AS search_name,
                    registered_student.batch_id,registered_student.id, student.initials, student.first_name, student.last_name, 
                    registered_student.mis, student.address, student.nic, student.mobile_no, student.gender, registered_student.student_status
                    FROM student, registered_student
                    WHERE student.id = registered_student.student_id
                    AND registered_student.batch_id = {$batchId}
                    {$statusCondition}
                    AND COALESCE(CONCAT(student.first_name,' ',student.last_name),student.first_name) LIKE CONCAT('%',@searchQuery,'%')
                )
                AS search_table ORDER BY
                CASE WHEN search_name LIKE @searchQuery THEN 0
                WHEN search_name LIKE CONCAT(@searchQuery,'%') THEN 1
                WHEN search_name LIKE CONCAT('%',@searchQuery) THEN 3
                ELSE 2 END,CASE WHEN first_name LIKE @searchQuery THEN 4
                WHEN first_name LIKE CONCAT(@searchQuery,'%') THEN 5
                WHEN first_name LIKE CONCAT('%',@searchQuery) THEN 7
                ELSE 6 END,CASE WHEN last_name LIKE @searchQuery THEN 8
                WHEN last_name LIKE CONCAT(@searchQuery,'%') THEN 9
                WHEN last_name LIKE CONCAT('%',@searchQuery) THEN 11
                ELSE 10 END,LENGTH(SUBSTRING_INDEX(LOWER(search_name),@searchQuery, 1));
                SQL;
            }
            else{
                $query = <<<SQL
                SET @searchQuery = LOWER('{$data['searchQuery']}') COLLATE utf8mb4_general_ci;
                SELECT 
                registered_student.batch_id,registered_student.id, student.initials, student.first_name, student.last_name, 
                registered_student.mis, student.address, student.nic, student.mobile_no, student.gender, registered_student.student_status
                FROM student, registered_student
                WHERE student.id = registered_student.student_id
                AND registered_student.batch_id = {$batchId}
                {$statusCondition}
                AND {$category} LIKE CONCAT('%',@searchQuery,'%') ORDER BY 
                CASE WHEN {$category} LIKE @searchQuery THEN 0
                WHEN {$category} LIKE CONCAT(@searchQuery,'%') THEN 1
                WHEN {$category} LIKE CONCAT('%',@searchQuery) THEN 3
                ELSE 2 END,LENGTH(SUBSTRING_INDEX({$category},@searchQuery, 1));
                SQL;
            }
        }

        return DB::multiSelect($query,MYSQLI_ASSOC);
    }

    /**
     * Returns data of a single registered student
     * @param $studentId - the ID of the student
     */
    public function getStudentProfile($studentId)
    {
        $query = "SELECT registered_student.id, registered_student.mis, student.nic, student.first_name,
        student.last_name,student.initials,registered_student.student_status,registered_student.profile_img_url,
        student.dob,student.gender,student.address,student.mobile_no,student.whatsapp_no,student.landline_no,
        student.email,student.guardian,student.district,student.divisional_secretariant,
        student.grama_sewa_division,batch.batch_name
        FROM registered_student,student,batch
        WHERE student.id = registered_student.student_id AND registered_student.batch_id = batch.batch_id
        AND registered_student.id = $studentId;";

        $results = DB::select($query);

        return $results;
    }

    /**
     * Adds a new registered student or updates an existing one
     * @param $data - an array containing the new student's data
     */
    public function addRegisteredStudent(array $data,bool $update = false) : bool
    {

        $query = <<<SQL
        UPDATE `registered_student` SET `profile_img_url`='{$data['profile_img_url']}', `mis`='{$data['mis']}',
        `student_status`='{$data['student_status']}',`registered_date`='{$data['registered_date']}'
        WHERE registered_student.id = {$data['id']};
        SQL;

        try{
            $status = DB::multiQuery($query);
        }
        catch(Exception $e){
            $status = false;
        }

        return $status;
    }

    /**
     * Returns a list of all the applicants
     * @param $batchId - the ID of the batch
     */
    public function getApplicants($batchId,$courseId = 1) : array
    {
        $query = "SELECT application.id, COALESCE(CONCAT(student.first_name,' ',student.last_name),student.first_name) AS applicant_name, `address`,
        `nic`, `mobile_no`, `whatsapp_no`, `highest_educational_qualification` 
        FROM application,student 
        WHERE application.batch_id = $batchId
        AND application.student_id = student.id;";

        $results = DB::select($query);
        return $results;
    }

    /**
     * Returns details of a single applicant
     * @param $applicantId - the ID of the applicant
     */
    public function getApplicant($applicantId,$nicNo = null,$batchId = null) : array
    {
        if($nicNo === null){
            $query = <<<SQL
            SELECT CONCAT('{"application_number": ',application.id,',
                "applicant_name": "',COALESCE(CONCAT(student.first_name,' ',student.last_name),student.first_name),'",
                "address": "',address,'",
                "nic": "',nic,'", 
                "mobile_no": "',mobile_no,'",
                "dob": "',dob,'", 
                "whatsapp_no": "',whatsapp_no,'",
                "landline_no": "',landline_no,'",
                "gender": "',gender,'",
                "guardian": "',guardian,'",
                "guardian_tpno": "',COALESCE(guardian_tpno,""),'",
                "highest_educational_qualification": "',highest_educational_qualification,'"}') AS result
            FROM application,student
            WHERE application.student_id = student.id AND application.id = {$applicantId};
            SQL;
        }else{

            $query = <<<SQL
            IF (SELECT COUNT(*) FROM student WHERE student.nic = '{$nicNo}') < 1 THEN
                SELECT '{}';
            ELSE
                SELECT CONCAT('{"application_number": ',COALESCE(application.id,"null"),',
                    "applicant_name": "',CONCAT(student.first_name,' ',COALESCE(student.last_name,"")),'",
                    "address": "',address,'",
                    "nic": "',nic,'", 
                    "mobile_no": "',mobile_no,'",
                    "dob": "',dob,'", 
                    "whatsapp_no": "',whatsapp_no,'",
                    "landline_no": "',landline_no,'",
                    "gender": "',gender,'",
                    "guardian": "',guardian,'",
                    "guardian_tpno": "',COALESCE(guardian_tpno,"null"),'",
                    "highest_educational_qualification": ',COALESCE(CONCAT('"',highest_educational_qualification,'"'),"null"),'}') AS result
                FROM student LEFT JOIN application ON application.student_id = student.id AND application.batch_id = $batchId
                WHERE student.nic = '{$nicNo}';
            END IF;
            SQL;
        }

        $results = DB::multiSelect($query,MYSQLI_NUM);
        return (empty($results))? []:json_decode($results[0][0],true);
    }

    /**
     * Adds a new appicant or updates an existing one
     * @param $data - an array containing the applicant's data
     */
    public function addApplicant(array $data,bool $update = false) : bool
    {

        if(!$update){
            $query = <<<SQL
            SET @studentId = null;
            IF (SELECT COUNT(*) FROM student WHERE student.nic = '{$data['nic']}') < 1 THEN
                INSERT INTO `student`(`nic`, `first_name`, `gender`, `dob`, `address`, 
                `mobile_no`, `whatsapp_no`, `landline_no`, `guardian`, `guardian_tpno`)
                VALUES ('{$data['nic']}','{$data['applicant_name']}','{$data['gender']}',
                '{$data['dob']}','{$data['address']}','{$data['mobile_no']}',
                '{$data['whatsapp_no']}','{$data['landline_no']}','{$data['guardian']}',
                '{$data['guardian_tpno']}');

                SET @studentId = (SELECT LAST_INSERT_ID());
            ELSE
                SET @studentId = (SELECT student.id FROM student WHERE student.nic = '{$data['nic']}');
            END IF;

            IF (SELECT COUNT(*) FROM application WHERE application.student_id = @studentId 
                AND application.batch_id = 2) < 1 THEN

                INSERT INTO application(`student_id`, `batch_id`, `highest_educational_qualification`) 
                VALUES (@studentId,{$data['batch_id']},'{$data['highest_educational_qualification']}');
            END IF;
            SQL;
        }else{
            $query = <<<SQL
            UPDATE application
            SET `date` = '{$data['date']}',`highest_educational_qualification` = '{$data['highest_educational_qualification']}'
            WHERE application.id = {$data['application_number']};
            SQL;
        }

        DB::multiQuery($query);
        $status =  true;
        

        return $status;
    }

    /**
     * Returns a list of all the interviewees
     * @param $batchId - the ID of the batch
     */
    public function getInterviewees($batchId, bool $isSearch=false,array $data = null)
    {
        if( $isSearch && $data !== null && $data['searchQuery'] !== null ){ // Build the search query
            $category = $data['category'];

            if($category == 'name'){
                $query = <<<SQL
                SET @searchQuery = LOWER('{$data['searchQuery']}') COLLATE utf8mb4_general_ci;
                SELECT * FROM (
                    SELECT COALESCE(CONCAT(student.first_name,' ',student.last_name),student.first_name) AS search_name,
                    registered_student.id,interview.interview_no,interview.application_number, student.initials, student.first_name, 
                    student.last_name, student.address, student.nic, student.mobile_no, student.dob, student.email, student.gender
                    FROM student LEFT JOIN registered_student ON registered_student.student_id = student.id,application,interview 
                    WHERE application.id = interview.application_number AND student.id = application.student_id AND application.batch_id = {$batchId}
                    AND COALESCE(CONCAT(student.first_name,' ',student.last_name),student.first_name) LIKE CONCAT('%',@searchQuery,'%')
                ) AS search_table ORDER BY
                CASE WHEN search_name LIKE @searchQuery THEN 0
                WHEN search_name LIKE CONCAT(@searchQuery,'%') THEN 1
                WHEN search_name LIKE CONCAT('%',@searchQuery) THEN 3
                ELSE 2 END,CASE WHEN first_name LIKE @searchQuery THEN 4
                WHEN first_name LIKE CONCAT(@searchQuery,'%') THEN 5
                WHEN first_name LIKE CONCAT('%',@searchQuery) THEN 7
                ELSE 6 END,CASE WHEN last_name LIKE @searchQuery THEN 8
                WHEN last_name LIKE CONCAT(@searchQuery,'%') THEN 9
                WHEN last_name LIKE CONCAT('%',@searchQuery) THEN 11
                ELSE 10 END,LENGTH(SUBSTRING_INDEX(LOWER(search_name),@searchQuery, 1));
                SQL;
            }
            else{
                $query = <<<SQL
                SET @searchQuery = LOWER('{$data['searchQuery']}') COLLATE utf8mb4_general_ci;
                SELECT registered_student.id,interview.interview_no,interview.application_number, student.initials, student.first_name, 
                student.last_name, student.address, student.nic, student.mobile_no, student.dob, student.email, student.gender
                FROM student LEFT JOIN registered_student ON registered_student.student_id = student.id,application,interview 
                WHERE application.id = interview.application_number AND student.id = application.student_id AND application.batch_id = 2
                AND $category LIKE CONCAT('%',@searchQuery,'%') ORDER BY
                CASE WHEN $category LIKE @searchQuery THEN 0
                WHEN $category LIKE CONCAT(@searchQuery,'%') THEN 1
                WHEN $category LIKE CONCAT('%',@searchQuery) THEN 3
                ELSE 2 END,LENGTH(SUBSTRING_INDEX($category,@searchQuery, 1));
                SQL;
            }
        }
        else{
            $query = "SELECT registered_student.id,interview.interview_no,interview.application_number, student.initials, student.first_name, 
            student.last_name, student.address, student.nic, student.mobile_no, student.dob, student.email, student.gender
            FROM student LEFT JOIN registered_student ON registered_student.student_id = student.id,application,interview 
            WHERE application.id = interview.application_number AND student.id = application.student_id AND application.batch_id = $batchId;";
        }

        return DB::multiSelect($query,MYSQLI_ASSOC);
    }

    /**
     * Returns details of a single interviewee
     * @param $batchId - the ID of the batch
     */
    public function getInterviewee($applicantId,$intervieweeId = null,$batchId = 1)
    {
        if($intervieweeId !== null){

            $query = <<<SQL
            IF (SELECT COUNT(*) FROM registered_student,application,interview 
            WHERE registered_student.student_id = application.student_id 
            AND interview.application_number = application.id AND interview.interview_no = {$intervieweeId}) < 1 THEN

                SELECT student.initials,student.first_name,
                student.last_name,student.nic,batch.batch_name,'FALSE' AS is_registered 
                FROM interview,student,application,batch 
                WHERE application.id = interview.application_number
                AND application.student_id = student.id
                AND application.batch_id = batch.batch_id AND interview.interview_no = {$intervieweeId};
            ELSE
                SELECT student.initials,student.first_name,student.last_name,
                student.nic,batch.batch_name,registered_student.profile_img_url,
                registered_student.mis,'TRUE' AS is_registered
                FROM interview,student,application,batch,registered_student
                WHERE interview.application_number = application.id 
                AND application.student_id = student.id
                AND registered_student.student_id = student.id AND application.batch_id = batch.batch_id
                AND interview.interview_no = {$intervieweeId};
            END IF;
            SQL;

        }else{

            $query = <<<SQL
            IF (SELECT COUNT(*) FROM interview WHERE interview.application_number = {$applicantId}) < 1 THEN
                SELECT application.id, CONCAT(student.first_name,' ',student.last_name) AS applicant_name,student.address,student.dob,student.nic,
                student.mobile_no,student.whatsapp_no,student.landline_no,student.gender,student.guardian,
                student.guardian_tpno,application.highest_educational_qualification, 'FALSE' AS is_selected 
                FROM student,application WHERE student.id = application.student_id AND application.id = {$applicantId};
            ELSE
                SELECT interview.interview_no,student.initials,student.first_name,student.last_name,student.email,
                interview.application_catogary,student.district,student.divisional_secretariant,student.grama_sewa_division,
                student.address,student.dob,student.nic,student.mobile_no,student.whatsapp_no,student.landline_no,student.gender,
                interview.job_target,interview.course_awareness,interview.remarks,interview.english_ol, interview.science_ol, 
                interview.maths_ol,interview.subject1_name_al,interview.subject2_name_al, interview.subject3_name_al,
                interview.subject1_result_al,interview.subject2_result_al,interview.subject3_result_al,
                interview.selection,'TRUE' AS is_selected
                FROM interview, application, student 
                WHERE interview.application_number = application.id
                AND application.student_id = student.id AND interview.application_number = {$applicantId};
            END IF;
            SQL;
        }

        return DB::multiSelect($query,MYSQLI_ASSOC)[0];
    }

    /**
     * Adds a new interviewee or updates an existing one and updates the applicant details of said interviewee
     * @param $data - an array containing the new interviewee's data
     */
    public function addInterviewee(array $data,bool $update = false) : bool
    {

        if(!$update){

            $query = <<<SQL
            SET @studentId = (SELECT application.student_id FROM application WHERE application.id = {$data['application_number']});

            IF (SELECT COUNT(*) FROM interview,application
                WHERE interview.application_number = application.id
                AND application.student_id = @studentId) < 1 THEN

                UPDATE student SET `initials`='{$data['initials']}',`first_name`='{$data['first_name']}',
                `last_name`='{$data['last_name']}',`email`='{$data['email']}',
                `district`='{$data['district']}',`divisional_secretariant`='{$data['divitional_secretariant']}',
                `grama_sewa_division`='{$data['grama_sewa_divition']}' 
                WHERE student.id = @studentId;

            END IF;

            INSERT INTO `interview`(`application_catogary`, `selection`, `job_target`, `remarks`,
                `english_ol`, `science_ol`, `maths_ol`, `subject1_name_al`, `subject2_name_al`, 
                `subject3_name_al`, `subject1_result_al`, `subject2_result_al`, `subject3_result_al`,
                `course_awareness`, `upto_ol`, `ol_pass`,`english`, `maths`, `science`, `al_pass`, 
                `own_skill`,`job_environment`, `desire`, `application_number`, `date`)
            VALUES ('{$data['application_catogary']}','{$data['selection']}','{$data['job_target']}','{$data['remarks']}',
                '{$data['english_ol']}','{$data['science_ol']}','{$data['maths_ol']}','{$data['subject1_name_al']}',
                '{$data['subject2_name_al']}','{$data['subject3_name_al']}','{$data['subject1_result_al']}',
                '{$data['subject2_result_al']}','{$data['subject3_result_al']}','{$data['course_awareness']}',
                '{$data['upto_ol']}','{$data['ol_pass']}','{$data['english']}','{$data['maths']}','{$data['science']}',
                '{$data['al_pass']}','{$data['own_skill']}','{$data['job_environment']}','{$data['desire']}',
                {$data['application_number']},'{$data['interview_date']}');
            SQL;
            
        }else{
            $query = <<<SQL
            SET @studentId = (SELECT application.student_id FROM application WHERE application.id = {$data['application_number']});

            UPDATE student SET last_name=COALESCE(last_name,'{$data['last_name']}'), gender=COALESCE(gender,'{$data['gender']}'),
            dob=COALESCE(dob,'{$data['dob']}'), email=COALESCE(email,'{$data['email']}'),
            mobile_no=COALESCE(mobile_no,'{$data['mobile_no']}'), whatsapp_no=COALESCE(whatsapp_no,'{$data['whatsapp_no']}'),
            landline_no=COALESCE(landline_no,'{$data['landline_no']}'), district=COALESCE(district,'{$data['district']}'),
            divisional_secretariant=COALESCE(divisional_secretariant,'{$data['divisional_secretariant']}'), 
            grama_sewa_division=COALESCE(grama_sewa_division,'{$data['grama_sewa_division']}')
            WHERE student.id = @studentId;

            UPDATE interview SET `selection`='{$data['selection']}',`job_target`='{$data['job_target']}',
            `remarks`='{$data['remarks']}',`english_ol`='{$data['english_ol']}',`science_ol`='{$data['science_ol']}',
            `maths_ol`='{$data['maths_ol']}',`subject1_name_al`='{$data['subject1_name_al']}',
            `subject2_name_al`='{$data['subject2_name_al']}',`subject3_name_al`='{$data['subject3_name_al']}',
            `subject1_result_al`='{$data['subject1_result_al']}',`subject2_result_al`='{$data['subject2_result_al']}',
            `subject3_result_al`='{$data['subject3_result_al']}',`course_awareness`='{$data['course_awareness']}',
            `upto_ol`='{$data['upto_ol']}',`ol_pass`='{$data['ol_pass']}',
            `english`='{$data['english']}',`maths`='{$data['maths']}',`science`='{$data['science']}',
            `al_pass`='{$data['al_pass']}',`own_skill`='{$data['own_skill']}',`job_environment`='{$data['job_environment']}',
            `desire`='{$data['desire']}',`date`='{$data['interview_date']}'
            WHERE interview.interview_no = {$data['interview_no']};
            SQL;
        }

        $conn = DB::getConnection();
        $conn->begin_transaction();

        try{
            $status = DB::multiQuery($query);
            $conn->commit();
        }
        catch(Exception $e){
            $conn->rollback();
            $status = false;

            echo $e->getMessage();
        }

        return $status;
    }

    /**
     * Returns a list of batch details the student has enrolled in
     * @param $studentId - the Id of the student (not the registered student id)
     */
    public function getStudentBatches(int $studentId) : array
    {

        $query = "SElECT batch.batch_id, batch.batch_name, batch.year, course.course_name 
        FROM registered_student,batch,course 
        WHERE batch.batch_id = registered_student.batch_id AND batch.course_id = course.course_id AND registered_student.student_id = $studentId";

        $results = DB::select($query);

        return $results;
    }

    /**
     * Returns a list of batches in a specific course
     * @param $courseId - the ID of the course
     */
    public function getBatches($courseId = 1,$year = null)
    {
        $query = "SELECT * FROM batch WHERE course_id = $courseId ORDER BY start_date DESC";

        if($year !== null){
            $query = "SELECT * FROM batch WHERE year = '$year'";
        }else if($courseId === null){
            $query = "SELECT * FROM batch";
        }

        return DB::select($query);
    }

    /**
     * Returns data of a single batch
     * @param $batchId - the ID of the batch
     */
    public function getBatch($batchId)
    {
        $query = "SELECT * FROM batch WHERE batch_id = $batchId";

        return DB::select($query)[0];
    }

    /**
     * Return the list of interview criterias in a certain course
     * @param int $courseId - the Id of the course
     */
    public function getCourseCriterias(int $courseId){

        $query = "SELECT interview_criteria.id, interview_criteria.criteria_name, course_criteria.marks 
        FROM interview_criteria, course_criteria WHERE interview_criteria.id = course_criteria.criteria_id AND course_criteria.course_id = $courseId";

        return DB::select($query);
    }
}