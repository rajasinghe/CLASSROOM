<?php

trait AssessmentModel
{

    /**
     * Returns an associative array
     * containing data of modules, tasks in each module and steps in each task
     */
    public function getAllModulesWithTasks()
    {
        $modules = $this->getModules();

        for ($i = 0; $i < count($modules); $i++) {
            $modules[$i]['tasks'] = $this->getTasks($modules[$i]['module_id']);

            for ($j = 0; $j < count($modules[$i]['tasks']); $j++) {
                $modules[$i]['tasks'][$j]['steps'] = $this->getSteps($modules[$i]['tasks'][$j]['task_id']);
            }
        }

        return $modules;
    }

    /**
     * Returns an associative array of
     * all the modules
     */
    public function getModules()
    {
        $query = "SELECT * FROM module";

        return DB::select($query);
    }

    /**
     * Returns data for about a specific module
     * @param $moduleId - the ID of the module
     */
    public function getModule($moduleId)
    {
        $query = "SELECT * FROM module WHERE module_id = $moduleId";

        return DB::select($query);
    }

    public function addModule($operation, $moduleData)
    {
        // Validate data
        $testData = ['module_no', 'module_name', 'no_of_tasks', 'course_id'];

        foreach ($testData as $test) {
            if (!isset($moduleData[$test]) || empty($moduleData[$test])) {
                return ['condition' => 'failed', 'errorType' => 'data', 'message' => 'Missing Arguments'];
            }
        }

        $conn = DB::getConnection();

        if ($operation === 'INSERT') {
            $query = "INSERT INTO module(`module_no`, `module_name`, `no_of_tasks`, `course_id`) VALUES(?,?,?,?)";

            $stmnt = $conn->prepare($query);
            $stmnt->bind_param("ssii", $moduleNo, $moduleName, $noOfTasks, $courseId);
        } else {
            if (!isset($moduleData['module_id']) || empty($moduleData['module_id'])) {
                return ['condition' => 'failed', 'errorType' => 'data', 'message' => 'Missing Arguments'];
            }

            $query = "UPDATE module SET module_no = ?, module_name = ?, no_of_tasks = ?, course_id =? WHERE module_id = ?";

            $stmnt = $conn->prepare($query);
            $stmnt->bind_param("ssiii", $moduleNo, $moduleName, $noOfTasks, $courseId, $moduleId);
        }

        $moduleNo = $moduleData['module_no'];
        $moduleName = $moduleData['module_name'];
        $noOfTasks = $moduleData['no_of_tasks'];
        $courseId = $moduleData['course_id'];
        $moduleId = (isset($moduleData['module_id'])) ? $moduleData['module_id'] : '';

        if (!$stmnt->execute()) {
            return ['condition' => 'failed', 'errorType' => 'server', 'message' => 'Could not insert data'];
        }

        return ['condition' => 'success', 'message' => 'Module added successfully'];
    }

    /**
     *  Removes a module from the data base
     *  @param $moduleId - the ID of the module
     */
    public function removeModule($moduleId){
        $query = "DELETE FROM step WHERE task_id IN (SELECT task_id FROM task WHERE module_id = $moduleId);
        DELETE FROM task WHERE module_id = $moduleId;
        DELETE FROM module WHERE module_id = $moduleId";

        $conn = DB::getConnection();

        if(! $conn->multi_query($query)){
            return ['condition' => 'failed', 'errorType' => 'server', 'message' => 'Could not remove module'];
        }
        
        return ['condition' => 'success', 'message' => 'module removed successfully'];
    }

    /**
     * Returns all the tasks in a specific module
     * @param $moduleId - the ID of the module
     */
    public function getTasks($moduleId)
    {
        $query = "SELECT * FROM task WHERE module_id = $moduleId";

        return DB::select($query);
    }

    /**
     * Returns data about a specific task
     * @param $taskId - the ID of the task
     */
    public function getTask($taskId)
    {
        $query = "SELECT * FROM task WHERE task_id = $taskId";

        return DB::select($query);
    }

    /**
     *  Adds a new task to the database or updates an existing one
     *  @param $operation - the database operation to be performed(INSERT/UPDATE) 
     *  @param $taskData - the ID of the module and details of the task
     */
    public function addTask($operation, $taskData)
    {
        // Validate data
        $testData = ['task_no', 'module_id', 'task_name', 'no_of_steps'];

        foreach ($testData as $test) {
            if (!isset($taskData[$test]) || empty($taskData[$test])) {
                return ['condition' => 'failed', 'errorType' => 'data', 'message' => 'Missing Arguments'];
            }
        }

        $conn = DB::getConnection();

        // Check wether request is for inserting or updating 
        if ($operation === 'INSERT') {
            $query = "INSERT INTO task(`task_no`, `task_name`, `no_of_steps`,`module_id`) VALUES(?,?,?,?)";
            $stmnt = $conn->prepare($query);
            $stmnt->bind_param("ssii", $taskNo, $taskName, $noOfSteps, $moduleId);
        } else {
            if (!isset($taskData['task_id']) || empty($taskData['task_id'])) {
                return ['condition' => 'failed', 'errorType' => 'data', 'message' => 'Missing Arguments'];
            }

            $query = "UPDATE task SET task_no = ?, task_name = ?, no_of_steps = ?, module_id =? WHERE task_id = ?";

            $stmnt = $conn->prepare($query);
            $stmnt->bind_param("ssiii", $taskNo, $taskName, $noOfSteps, $moduleId, $taskId);
        }

        $taskNo = $taskData['task_no'];
        $taskName = $taskData['task_name'];
        $noOfSteps = $taskData['no_of_steps'];
        $moduleId = $taskData['module_id'];
        $taskId = (isset($taskData['task_id'])) ? $taskData['task_id'] : '';

        if (!$stmnt->execute()) {
            return ['condition' => 'failed', 'errorType' => 'server', 'message' => 'Could not insert data'];
        }

        return ['condition' => 'success', 'message' => 'Task added successfully'];
    }

    /**
     *  Removes a task from the data base
     *  @param $taskId - the ID of the task
     */
    public function removeTask($taskId){
        $query = "DELETE FROM step WHERE task_id = $taskId;
        DELETE FROM task WHERE task_id = $taskId";

        $conn = DB::getConnection();

        if(! $conn->multi_query($query)){
            return ['condition' => 'failed', 'errorType' => 'server', 'message' => 'Could not remove task'];
        }
        
        return ['condition' => 'success', 'message' => 'Task removed successfully'];
    }

    /**
     * Returns all the steps in a specific task
     * Arguments - the ID of the task
     */
    public function getSteps($taskId)
    {
        $query = "SELECT * FROM step WHERE task_id = '$taskId'";

        return DB::select($query);
    }

    /**
     * Returns data about a specific step
     * @param $stepId - the ID of the step
     */
    public function getStep($stepId)
    {
        $query = "SELECT step.*, module_id FROM step,task WHERE step_id = $stepId AND step.task_id = task.task_id";

        return DB::select($query);
    }

    /**
     *  Adds a new step to the data base or updates an existing one
     *  @param $operation - the database operation to be performed(INSERT/UPDATE) 
     *  @param $stepData - the ID of the task and details of the step
     */
    public function addStep($operation, $stepData)
    {
        // Validate data
        $testData = ['step_no', 'task_id', 'step_name', 'step_description'];

        foreach ($testData as $test) {
            if (!isset($stepData[$test]) || empty($stepData[$test])) {
                return ['condition' => 'failed', 'errorType' => 'data', 'message' => 'Missing Arguments'];
            }
        }

        $conn = DB::getConnection();

        // Check wether request is for inserting or updating 
        if ($operation === 'INSERT') {
            $query = "INSERT INTO step(`step_no`, `step_name`, `step_description`,`task_id`) VALUES(?,?,?,?)";

            $stmnt = $conn->prepare($query);
            $stmnt->bind_param("issi", $stepNo, $stepName, $stepDescription, $taskId);
        } else {
            if (!isset($stepData['step_id']) || empty($stepData['step_id'])) {
                return ['condition' => 'failed', 'errorType' => 'data', 'message' => 'Missing Arguments'];
            }

            $query = "UPDATE step SET step_no = ?, step_name = ?, step_description = ?, task_id = ? WHERE step_id = ?";

            $stmnt = $conn->prepare($query);
            $stmnt->bind_param("issii", $stepNo, $stepName, $stepDescription, $taskId, $stepId);
        }

        $stepNo = $stepData['step_no'];
        $stepName = $stepData['step_name'];
        $stepDescription = $stepData['step_description'];
        $taskId = $stepData['task_id'];
        $stepId = (isset($stepData['step_id'])) ? $stepData['step_id'] : '';

        if (!$stmnt->execute()) {
            return ['condition' => 'failed', 'errorType' => 'server', 'message' => 'Could not insert data'];
        }

        return ['condition' => 'success', 'message' => 'Step added successfully'];
    }

    /**
     *  Removes a step from the database
     *  @param $stepId - the ID of the step
     */
    public function removeStep($stepId)
    {
        $query = "DELETE FROM step WHERE step_id = $stepId";

        $conn = DB::getConnection();

        if(! $conn->query($query)){
            return ['condition' => 'failed', 'errorType' => 'server', 'message' => 'Could not remove step'];
        }
        
        return ['condition' => 'success', 'message' => 'Step removed successfully'];
    }

    /**
     * Returns a list of steps in a task and the marks of
     * students for each of those tasks
     * @param $taskId - the id of the task
     */
    public function getAssessmentMarkingFormat($taskId, $batchId): array
    {
        $result = [];
        $result['steps'] = $this->getSteps($taskId);

        if (count($result['steps']) < 1)
            return ['steps' => [], 'students' => []];

        $result['students'] = $this->getStudentMarks($taskId, $batchId);

        return $result;
    }

    /**
     * Returns array of students in a specific batch
     * @param $taskId - ID of the task
     * @param $batchId - ID of the batch
     */
    public function getStudentMarks($taskId, $batchId = 1): array
    {
        $query = "SELECT registered_student.id AS student_id, registered_student.mis, 
        student.initials, student.last_name FROM registered_student, student 
        WHERE student.id = registered_student.student_id AND registered_student.batch_id = $batchId;";

        $students = DB::select($query);

        $query = <<<SQL
            SET @sql = NULL;
            SELECT GROUP_CONCAT(DISTINCT
                CONCAT(
                    'max(case when (student_step.step_id = ',
                    step.step_id,
                    ' AND student_step.student_id = registered_student.id) then case when exists (SELECT 1 FROM student_step WHERE student_step.step_id =',
                    step.step_id,
                    ') then true else false end else false end) AS `step',
                    step.step_no, '`'
                ) ) INTO @sql
            FROM
                step
            WHERE step.task_id = {$taskId};

            SET @sql = CONCAT('SELECT registered_student.id, registered_student.mis, 
            (SELECT student_task.completed_date FROM student_task WHERE student_task.task_id = {$taskId} 
            AND student_task.student_id = registered_student.id) AS completed_date, ',@sql,
            ' FROM registered_student LEFT JOIN student_step ON student_step.student_id = registered_student.id 
            WHERE registered_student.batch_id = {$batchId} GROUP BY registered_student.id');
            PREPARE stmnt FROM @sql;
            EXECUTE stmnt;
        SQL;

        $conn = DB::getConnection();
        $conn->multi_query($query);

        do {
            if ($result = $conn->store_result()) {
                $marks = $result->fetch_all();
                $result->free();
            }
        } while ($conn->next_result());

        for ($index = 0; $index < count($marks); $index++) {

            if ($students[$index]['student_id'] === $marks[$index][0]) {
                $students[$index]['completed_date'] = $marks[$index][2];
                $students[$index]['marks'] = array_slice($marks[$index], 3);
            }
        }

        return $students;
    }

    /**
     * Saves marks of students for the steps in a given module and
     * task.
     * @param $moduleId - ID of the module,
     * @param $taskId - ID of the task,
     * @param $studentMarks - marks of students for each step
     */
    public function setAssessmentMarks($moduleId, $taskId, $studentMarks)
    {
        $num_rows = 0;
        $conn = DB::getConnection();

        foreach ($studentMarks as $studentMark) {
            $num_rows_local = 0;

            foreach ($studentMark['marks'] as $key => $value) {
                $status = ($value == 1) ? 'COMPLETE' : 'NOTCOMPLETE';
                $query =
                    <<<SQL
                    IF '{$status}' = 'NOTCOMPLETE' THEN
                        DELETE FROM student_step WHERE student_id = {$studentMark['student_id']} AND step_id = {$key};
                    ELSEIF (SELECT COUNT(*) FROM student_step WHERE student_id = {$studentMark['student_id']} AND step_id = {$key}) < 1 THEN 
                        INSERT INTO student_step(student_id,step_id,status,completed_date) VALUES({$studentMark['student_id']},{$key},'$status','{$studentMark['completed_date']}');
                    ELSE 
                        UPDATE student_step SET status = '{$status}', completed_date = '{$studentMark['completed_date']}' WHERE student_id = {$studentMark['student_id']} AND step_id = {$key}; 
                    END IF;
                    SQL;

                if (! DB::multiQuery($query)) {
                    // Handle error
                    return ["condition" => "failed", "errorType" => "INTERNAL", "message" => "Could not save data." . $conn->error, "affectedRows" => $num_rows];
                }

                $row_count = mysqli_affected_rows($conn);
                $num_rows_local += $row_count;
                $num_rows += $row_count;
            }

            if($num_rows_local < 1){continue;}

            // Check if the student has completed all steps in the task
            $query =<<<SQL
                IF (SELECT COUNT(*) FROM student_task WHERE student_task.student_id = {$studentMark['student_id']} 
                    AND student_task.task_id = {$taskId}) < 1 THEN
                SET @rowexists = 'FALSE'; ELSE SET @rowexists = 'TRUE'; END IF;
                IF (SELECT CASE WHEN (SELECT COUNT(*) FROM step 
                WHERE step.task_id = {$taskId}) = (SELECT COUNT(*) FROM step,student_step 
                WHERE step.step_id = student_step.step_id AND step.task_id = {$taskId} 
                AND student_step.student_id = {$studentMark['student_id']} AND student_step.status = 'COMPLETE')
                THEN 'TRUE' ELSE 'FALSE' END) = 'TRUE' THEN
                    IF @rowexists = 'FALSE' THEN
                        INSERT INTO student_task(student_id,task_id,competence,completed_date) VALUES({$studentMark['student_id']}, {$taskId}, 'C','{$studentMark['completed_date']}');
                    ELSE UPDATE student_task SET competence = 'C', completed_date = '{$studentMark['completed_date']}' WHERE student_task.student_id = {$studentMark['student_id']} AND student_task.task_id = {$taskId}; END IF;
                ELSE 
                    IF @rowexists = 'FALSE' THEN
                        INSERT INTO student_task(student_id,task_id,competence,completed_date) VALUES({$studentMark['student_id']}, {$taskId}, 'NYC','{$studentMark['completed_date']}');
                    ELSE UPDATE student_task SET competence = 'NYC', completed_date = '{$studentMark['completed_date']}' WHERE student_task.student_id = {$studentMark['student_id']} AND student_task.task_id = {$taskId}; END IF;
                END IF;
                SQL;

            if (! DB::multiQuery($query)) {
                // Handle error
                return ["condition" => "failed", "errorType" => "INTERNAL", "message" => "Could not save data." . $conn->error, "affectedRows" => $num_rows];
            }

            if (mysqli_affected_rows($conn) > 0) {
                // Check if the student has completed all tasks in the module
                $query =
                    <<<SQL
                    IF (SELECT CASE WHEN ((SELECT COUNT(*) FROM task WHERE task.module_id = {$moduleId}) = (SELECT COUNT(*) FROM task,student_task 
                    WHERE task.task_id = student_task.task_id AND task.module_id = {$moduleId} AND student_task.student_id = {$studentMark['student_id']} AND student_task.competence = 'C')) 
                    THEN 'TRUE' ELSE 'FALSE' END AS result) = 'TRUE' THEN
                        INSERT INTO student_module(student_id,module_id,competence) VALUES({$studentMark['student_id']}, {$moduleId}, 'C');
                    ELSE DELETE FROM student_module WHERE student_id = {$studentMark['student_id']} AND module_id = {$moduleId}; END IF;
                    SQL;

                if (! DB::multiQuery($query)) {
                    // Handle error
                    return ["condition" => "failed", "errorType" => "INTERNAL", "message" => "Could not save data." . $conn->error, "affectedRows" => $num_rows];
                }
            }
        }

        if ($num_rows < 1) {
            return ["condition" => "failed", "errorType" => "INTERNAL", "message" => "Could not save data.", "affectedRows" => $num_rows];
        }

        return ["condition" => "success", "message" => "Assessment Marks saved successfully", "affectedRows" => $num_rows];
    }

    public function getAssessmentSummary($batchId): array
    {
        $query = <<<SQL
            SET @sql = null;
            SELECT GROUP_CONCAT(
                CONCAT(
                    'MAX(CASE WHEN module_id = ',
                    module_id,' THEN competence ELSE \'NYC\' END) AS `',
                    module_no,'`'
                )
            )INTO @sql
            FROM module;
            
            SET @sql = CONCAT('SELECT registered_student.mis, student.last_name, ',@sql,
            ' FROM registered_student LEFT JOIN student_module 
            ON registered_student.id = student_module.student_id,student 
            WHERE student.id = registered_student.student_id 
            AND registered_student.batch_id = {$batchId} GROUP BY registered_student.id');
            
            PREPARE stmnt FROM @sql;
            EXECUTE stmnt;
            SQL;

        // Get the connection
        $conn = DB::getConnection();
        // Execute the query and fetch results
        $conn->multi_query($query);

        $results = [];

        do {
            if ($result = $conn->store_result()) {
                $tempResults = $result->fetch_all();
                $result->free();
            }
        } while ($conn->next_result());

        $results['modules'] = $this->getModules();
        $results['summary'] = [];

        foreach ($tempResults as $res) {
            $tempSummary = [];
            $tempSummary['mis'] = $res[0];
            $tempSummary['surname'] = $res[1];
            $tempSummary['summary'] = array_slice($res, 2);

            array_push($results['summary'], $tempSummary);
        }

        return $results;
    }

    /**
     * Returns a list of marks of students for a given 
     * theory assessment
     * @param $moduleId - ID of the module, 
     * @param $taskId -ID of the task, can be null if there is only one
     * assessment for the whole module
     */
    public function getTheoryAssessmentMarkingFormat($moduleId, $taskId, $batchId)
    {
        $query = "CREATE TEMPORARY TABLE temp_marks AS SELECT registered_student.id, registered_student.mis, 
        student.nic, student.initials, student.last_name, theory_assessment.marks 
        FROM registered_student LEFT JOIN theory_assessment 
        ON registered_student.id = theory_assessment.student_id, student
        WHERE student.id = registered_student.student_id AND registered_student.batch_id = $batchId 
        AND module_id = $moduleId AND " . (($taskId === null) ? "task_id is null" : "task_id = $taskId") . ";
        IF ((SELECT COUNT(*) FROM temp_marks) < 1) 
        THEN (SELECT registered_student.id, registered_student.mis, student.nic, student.initials, 
        student.last_name, null as marks
        FROM registered_student, student
        WHERE student.id = registered_student.student_id 
        AND registered_student.batch_id = $batchId); ELSE (SELECT * FROM temp_marks); END IF;";

        $conn = DB::getConnection();

        $conn->multi_query($query);

        do {
            if ($result = $conn->store_result()) {
                $results = $result->fetch_all(MYSQLI_ASSOC);
                $result->free();
            }
        } while ($conn->next_result());

        return $results;
    }

    /**
     * Returns an array list of marks students obtained for
     * each theory assessment in each module
     * @param $batchId - the ID of the batch
     */
    public function getTheoryAssessmentReport($batchId)
    {
        $query = <<<SQL
        SET @sql = null;
        SELECT GROUP_CONCAT(
            CONCAT(
                'MIN(CASE WHEN module_id = ',
                module_id,' THEN (SELECT CONCAT(\"[\",GROUP_CONCAT(theory_assessment.marks),\"]\") FROM theory_assessment 
                WHERE theory_assessment.module_id = ', module_id ,
                ' AND theory_assessment.student_id = registered_student.id) ELSE \"[]\" END) AS `',
                module_no,'`'
            )
        )INTO @sql
        FROM module;
        SET @sql = CONCAT('SELECT registered_student.id, registered_student.mis, student.last_name, ',@sql,' 
                    FROM registered_student LEFT JOIN theory_assessment ON 
                    registered_student.id = theory_assessment.student_id, student
                    WHERE student.id = registered_student.student_id 
                    AND registered_student.batch_id = {$batchId} GROUP BY registered_student.id');
        PREPARE stmnt FROM @sql;
        EXECUTE stmnt;
        SQL;

        $results = DB::multiSelect($query);

        $finalReults = ['student_marks' => []];
        $finalReults['modules'] = $this->getModules();
        $finalReults['total'] = 0;

        for ($j = 3; $j < count($results[0]); $j++) {
            $finalReults['total'] += count(json_decode($results[0][$j]));
        }

        for ($index = 0; $index < count($results); $index++) {
            $item = $results[$index];

            $tempObject = [];

            $tempObject['student_id'] = $item[0];
            $tempObject['mis'] = $item[1];
            $tempObject['surname'] = $item[2];

            $tempObject['marks'] = [];
            $tempObject['total'] = 0;

            for ($i = 3; $i < count($item); $i++) {
                $jArray = json_decode($item[$i]);
                array_push($tempObject['marks'], $jArray);
                $tempObject['total'] += array_sum($jArray);
            }

            $subtotal = ($finalReults['total'] === 0)? 1:$finalReults['total'];

            $tempObject['average'] = ceil($tempObject['total'] / $subtotal);

            array_push($finalReults['student_marks'], $tempObject);
        }

        return $finalReults;
    }

    /**
     * Saves the marks of students for a given theory assessment
     * @param $moduleId - ID of the module,
     * @param $taskId - ID of the task, can be null if there is only one
     * assessment for the whole module
     * @param $marks - marks of students for the assessment
     */
    public function setTheoryAssessmentMarks($moduleId, $taskId = null, $marks)
    {
        $query = 
        "IF (SELECT COUNT(*) FROM theory_assessment WHERE student_id = ? AND ". ($taskId === 'ALL')? "task_id is null":"task_id = $taskId" . 
        " AND module_id = $moduleId) < 1 THEN
            INSERT INTO theory_assessment(`student_id`, `module_id`, `task_id`, `marks`) VALUES(?,?,?,?);
        ELSE
            UPDATE theory_assessment SET marks = ? WHERE student_id = ? AND task_id = ?;
        END IF;
        ";

        $conn = DB::getConnection();

        $stmnt = $conn->prepare($query);
        $stmnt->bind_param("iiii", $studentId, $moduleId, $taskId, $mark);

        $result = true;

        foreach ($marks as $data) {
            $studentId = $data['student_id'];
            $mark = $data['marks'];
            $result = $stmnt->execute() && $result;
        }

        if (!$result) {
            return ['condition' => 'failed', 'errorType' => 'SERVER', 'message' => 'Could not save marks'];
        }

        return ['condition' => 'success', 'message' => 'Theory marks successfully saved'];
    }

    /**
     * Returns details
     */
    public function getSingleTheoryAssessmentSummary($registeredStudentId){

        
    }
}
