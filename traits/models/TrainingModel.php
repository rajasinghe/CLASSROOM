<?php

trait TrainingModel
{

    /**
     * Returns all training and job placement related information about a student
     * @param int $registeredStudentId - the registered id of the student
     */
    function getStudentTrainingDetails(int $registeredStudentId) : array | null
    {

        $query = "SELECT student.nic, student.initials, student.first_name, student.last_name, student.address, student.email 
        FROM student,registered_student WHERE registered_student.student_id = student.id AND registered_student.id = $registeredStudentId";
        
        $studentData = DB::select($query);

        if(count($studentData) < 1) null;
        $studentData = $studentData[0];

        $query = "SELECT * FROM training_details WHERE training_details.student_id = $registeredStudentId";
        $studentData['training_details'] = DB::select($query);

        $query = "SELECT * FROM job_places, registered_student 
        WHERE job_places.student_id = registered_student.id AND registered_student.id = $registeredStudentId";
        $jobDetails = DB::select($query);

        $studentData['job_details'] = (count(array_keys($jobDetails)) < 1)? null: $jobDetails[0];

        return $studentData;
    }

    /**
     * Returns data about all batches a student has been registered for
     * @param string $nic - NIC of the student
     */
    function getStudentBatches(string $nic)
    {

        $query = "SELECT registered_student.id,batch.batch_id, batch.batch_name, batch.batch_number FROM registered_student, batch, student 
        WHERE student.id = registered_student.student_id AND batch.batch_id = registered_student.batch_id AND student.nic = '$nic'";

        $studentData = DB::select($query);
        return $studentData;
    }

    /* Get Training Details From Training Detailas and Company Details Tables */
    function getTrainingDetails($data)
    {
        // Store the processed query results in this array
        $results = [];

        $query = "SELECT * FROM `registered_student`, `training_company`, `training_details`, `batch` WHERE `training_details`.company_id=`training_company`.id AND
        `training_details`.student_id=`registered_student`.id AND `registered_student`.batch_id=`batch`.batch_id AND `batch`.batch_id='{$data['batch_id']}';";

        $results = DB::select($query);

        return $results;
    }

    /* Get Batch From Batch Table Temp */
    function getBatchCombo()
    {
        $query = "SELECT batch_name, `year`, `batch`.batch_id FROM `batch`,`training_details`,`registered_student` WHERE 
        `training_details`.student_id=`registered_student`.id and `registered_student`.batch_id=`batch`.batch_id ORDER BY `year` DESC, 
        `batch_id` DESC;";

        $results = DB::select($query);

        return $results;
    }

    /* Get Student List */
    function getStuCard($data)
    {
        $query = "SELECT mis, profile_img_url, initials, last_name, `student`.id, batch_name FROM `registered_student`,`student`,`batch` WHERE
        `registered_student`.student_id=`student`.id and `registered_student`.batch_id=`batch`.batch_id and `batch`.batch_name='{$data['batch_id']}';";
        
        $results = DB::select($query);

        return $results;
    }

    /* Set Training Details */
    function setTrainingDetails($details)
    {
        $conn = DB::getConnection();

        $query = "INSERT INTO `training_details` VALUES( NULL, '{$details['student_id']}', '{$details['begin_date']}', 
        '{$details['end_date']}', '{$details['salary']}', '{$details['codinator_name']}',
         '{$details['codinator_num']}', '{$details['company_id1']}');
      INSERT INTO `training_company` VALUES( NULL, '{$details['company_name']}', 
        '{$details['company_address']}', '{$details['telephone_num']}');";

        $results = $conn->multi_query($query);

        if ($conn->affected_rows > 0) {
            return ["condition" => "success"];
        }

        return ["condition" => "failed"];
    }

    /* Select student Training data using student Id */
    function getStuTrainingDetails($data)
    {
        $query = "SELECT `initials`, `last_name`, `mis`, `begin_date`, `end_date`, `salary`, `company_name`, `company_address`, `telephone_num`, `cordinator_name`, 
        `cordinator_num` FROM `training_details`, `training_company`, `registered_student`, `student` WHERE `training_details`.company_id=`training_company`.id and 
        `training_details`.student_id=`registered_student`.id and `registered_student`.`student_id`=`student`.`id` and 
        `training_details`.student_id = {$data['student_id']} ;";

        $results = DB::select($query);

        return $results;
    }

    /* Select student Job Placement data using student Id */
    function getStuPlacementDetails($data)
    {
        $query = "SELECT `initials`, `last_name`, `mis`, `placement_date`, `company_name`, `company_address`, `position`, `current_salary`, `company_telNum`, 
        `company_faxNum`, `company_email`, `mode_of_employment`, `Engeged_in_trainingReletedWork`, `job_category` FROM `job_places`, `registered_student`, 
        `student` WHERE `job_places`.student_id=`registered_student`.id and `registered_student`.`student_id`=`student`.`id` and 
        `job_places`.student_id = {$data['student_id']} ;";

        $results = DB::select($query);

        return $results;
    }

    function getJobPlacement_Details($data)
    {
        $results = [];
        $query = "SELECT * FROM `registered_student`, `job_places`, `batch` WHERE `job_places`.student_id=`registered_student`.id AND 
        `registered_student`.batch_id=`batch`.batch_id AND `batch`.batch_id = '{$data['batch_id']}';";

        $results = DB::select($query);

        return $results;
    }

 

    function getCompanyNames()
    {
        $results = [];
        $query = "SELECT `company_id`, `company_name` FROM `training_company`;";
        $results = DB::select($query);

        return $results;
    }

    function getCompanyDetails($data)
    {
        $results = [];
        $query = "SELECT `id`, `company_id`, `company_name`, `company_address`, `telephone_num`,
         `cordinator_name`, `cordinator_num`, `timeStamp` FROM `training_company` WHERE 
         `company_id`='{$data['cid']}';";

        $results = DB::select($query);

        return $results;
    }
}
