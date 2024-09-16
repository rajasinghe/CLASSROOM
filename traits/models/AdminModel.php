<?php

trait AdminModel{

    /**
     * Returns details about all centers in the database or a specific center
     * @param int $centerId - the Id of the center
     */
    function getCenters(int $centerId = null) : array
    {

        if($centerId == null){
            $query = "SELECT * FROM center";
        }
        else{
            $query = "SELECT * FROM center WHERE center.id = $centerId";
        }


        return DB::select($query);
    }

    /**
     * Returns details of All courses in the database, courses in a center and a specific center
     * @param int $centerId - the Id of the center
     * @param int $courseId - the course Id of the center
     */
    function getCourses(int $centerId = null,int $courseId = null) : array
    {

        if($centerId !== null && $courseId !== null){
            $query = "SELECT course.* FROM course, center_course 
            WHERE center_course.course_id = course.course_id AND center_course.center_id = $centerId AND center_course.course_id = $courseId";
        }
        else if($centerId !== null){
            $query = "SELECT course.* FROM course, center_course 
            WHERE center_course.course_id = course.course_id AND center_course.center_id = $centerId";
        }
        else if($courseId !== null){
            $query = "SELECT * FROM course WHERE course.course_id = $courseId";
        }


        return DB::select($query);
    }

    /**
     * Inserts a new course to the databse
     * @param array $data - an array containing data of the new course
     */
    function addCourse(array $data) : array
    {
        $query = <<<SQL
        INSERT INTO `course`(`course_code`, `course_name`, `duration`, `fee`, `capacity`, `nvq_level`, `ncs_code`) 
        VALUES ('{$data['course_code']}','{$data['course_name']}','{$data['duration']}',
        '{$data['fee']}','{$data['capacity']}','{$data['nvq_level']}','{$data['ncs_code']}');

        SET @courseId = (SELECT LAST_INSERT_ID());

        INSERT INTO `course_criteria`(`course_id`, `criteria_id`, `marks`) VALUES 
        SQL;

        for($i = 0; $i < count($data['criterias']); $i++){
            $criteria = $data['criterias'][$i];
            $query .=  "(@courseId,{$criteria['criteria_id']},{$criteria['marks']})";
            
            if(($i + 1) !== count($data['criterias'])){
                $query .= ",";
            }
        }

        $response = [ "condition" => 'failed', "errorType" => 'SERVER', "message" => 'Could not add center' ];

        if(DB::multiQuery($query)){
            $response = [ "condition" => 'success', "message" => 'Center added successfully' ];
        }

        return $response;
    }

    /**
     * Inserts a new center to the databse
     * @param array $data - an array containing data of the new center
     */
    function addCenter(array $data) : array
    {
        $query = "INSERT INTO `center`(`center_number`, `center_name`, `address`, `grade`, `tvc_registration_number`) 
        VALUES ('{$data['center_number']}','{$data['center_name']}','{$data['address']}',
        '{$data['grade']}','{$data['tvc_registration_number']}')";

        $conn = DB::getConnection();

        $response = [ "condition" => 'failed', "errorType" => 'SERVER', "message" => 'Server error' ];

        if($conn->query($query)){
            $response = [ "condition" => 'success', "message" => 'Course added successfully' ];
        }

        return $response;
    }

    function updateCenter(array $data) : array
    {
        $query = "INSERT INTO `center`(`center_number`, `center_name`, `address`, `grade`, `tvc_registration_number`) 
        VALUES ('{$data['center_number']}','{$data['center_name']}','{$data['address']}',
        '{$data['grade']}','{$data['tvc_registration_number']}')";

        $conn = DB::getConnection();

        $response = [ "condition" => 'failed', "errorType" => 'SERVER', "message" => 'Server error' ];

        if($conn->query($query)){
            $response = [ "condition" => 'success', "message" => 'Course added successfully' ];
        }

        return $response;
    }
}