<?php
trait preAssessmentModel
{
    
    function insertPreAssessment($batchId, $date, $asessorName, $asessorRegNo, $arrayString): array|null
    {
        $conn = DB::getConnection();
        /*  $query = <<<SQL
        START TRANSACTION;
        DECLARE EXIT HANDLER FOR SQLEXCEPTION
        BEGIN
            ROLLBACK;
        END;  
        INSERT INTO `preassessment` (`batch_id`, `date`) VALUES ('$batchId', '$date');
        SET @pid=LAST_INSERT_ID();
        IF ROW_COUNT() > 0 THEN 
             INSERT INTO `preasessment_asessor` (`preassesment_id`, `asessor_name`, `assessor_reg_no`) VALUES (@pid, '$asessorName', '$asessorRegNo');
                IF ROW_COUNT() = 0 THEN 
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT='error in second query execution';
                    
                ELSE 
                    COMMIT;
                    SELECT pid AS preAssessmentID;
                END IF;    
        ELSE
            SIGNAL SQLSTATE '45001' MESSAGE_TEXT='error in first query';
        END IF;    
        SQL; 
        */
        $query = "
        SET @p0='$date';
         SET @p1='$asessorName';
          SET @p2='$asessorRegNo';
           SET @p3=$batchId ;
            SET @p4='';SET @p5='$arrayString';
             CALL `initializePreAssessment`(@p0, @p1, @p2, @p3,@p5,@p4);SELECT @p4 as pid;";
        if ($conn->multi_query($query)) {
            // Loop through and consume all results until there are no more
            //$count=0; 
            do {
                //$count=$count+1;
                //echo $count;
                if ($result = $conn->store_result()) {
                    $row = $result->fetch_assoc();
                    $result->free(); // Free the result set
                    return $row; // Assuming this function returns the result
                }
            } while ($conn->more_results() && $conn->next_result());
            return null;
        } else {
            // Handle query execution error
            return null;
        }
    }

    /* function insertpreAsessmentResults(){
       $conn=DB::getConnection();
       $query=""

    } */

    function getStudentsByBatch($batchId)
    {
        $conn = DB::getConnection();
        $query = "SELECT registered_student.id,registered_student.student_id,registered_student.mis,student.first_name,student.last_name,registered_student.batch_id FROM `registered_student`,student WHERE registered_student.student_id=student.id AND batch_id=$batchId;";
        $results = mysqli_fetch_all($conn->query($query), MYSQLI_ASSOC);
        return  $results;
    }

    function getStudentsByBatchForFilter($batchId, $currentBatch)
    {
        $conn = DB::getConnection();

        $query =
            "SELECT registered_student.id,registered_student.student_id,registered_student.mis,student.first_name,student.last_name,registered_student.batch_id FROM 
        `registered_student`,student
        WHERE 
        registered_student.student_id=student.id 
        AND 
        batch_id LIKE '$batchId%'
        AND registered_student.batch_id <> $currentBatch
        ;";
        $results = mysqli_fetch_all($conn->query($query), MYSQLI_ASSOC);
        return  $results;
    }

    function getStudentsByNameForFilter($name, $currentBatch)
    {
        $conn = DB::getConnection();

        $query =
            "SELECT registered_student.id,registered_student.student_id,registered_student.mis,student.first_name,student.last_name,registered_student.batch_id FROM 
            `registered_student`,student
            WHERE 
            registered_student.student_id=student.id 
            AND registered_student.batch_id <> $currentBatch AND (student.first_name LIKE '$name%' OR student.last_name LIKE '$name%');
            ";
        $results = mysqli_fetch_all($conn->query($query), MYSQLI_ASSOC);
        return  $results;
    }

    function getStudentsByMISForFilter($mis, $currentBatch)
    {
        $conn = DB::getConnection();

        $query =
            "SELECT registered_student.id,registered_student.student_id,registered_student.mis,student.first_name,student.last_name,registered_student.batch_id FROM 
        `registered_student`,student
        WHERE 
        registered_student.student_id=student.id 
        AND 
        `mis` LIKE '$mis%'  AND registered_student.batch_id <> $currentBatch;";
        $results = mysqli_fetch_all($conn->query($query), MYSQLI_ASSOC);
        return  $results;
    }

    function getPreassessmentStudents($pid)
    {
        $conn = DB::getConnection();
        $query = "SELECT preasessment_student.student_id,preasessment_student.preassesment_id,registered_student.mis,student.first_name,student.last_name FROM preasessment_student,registered_student,student WHERE 
        preasessment_student.preassesment_id=$pid AND
        preasessment_student.student_id=registered_student.student_id AND
        registered_student.student_id=student.id;";
        $results = mysqli_fetch_all($conn->query($query), MYSQLI_ASSOC);
        return $results;
    }

    function readModules($pid){
        $conn=DB::getConnection();
        $query="SELECT module.module_id,module.module_no,module.module_name,preassessment.preassesment_id FROM preassessment,batch,course,module WHERE preassessment.batch_id=batch.batch_id AND batch.course_id=course.course_id AND module.course_id=course.course_id AND preassessment.preassesment_id=$pid;
        ";
        $results=mysqli_fetch_all($conn->query($query),MYSQLI_ASSOC);
        return $results;
    }

    function update()
    {
    }

    function insertpreAsessmentResults($students,$pid,$finalAssessmentDates){
        $conn = DB::getConnection();
        $conn->begin_transaction();
        try{
            foreach ($finalAssessmentDates as $date){
                $conn->query("INSERT INTO `preasessment_final_asessment_dates`(`preassesment_id`, `date`) VALUES ($pid,$date);");
            }
            foreach($students as $student){
                $registeredStudentId=$student['studentId'];
                $finalAssessmentEligibility=($student['finalAssessmentEligibility']) ? 1:0;
                unset($student['studentId']);
                unset($student['finalAssessmentEligibility']);
                $conn->query("UPDATE `preasessment_student` SET `finalasessment_eligibility`='$finalAssessmentEligibility' WHERE `preassesment_id`=$pid AND `student_id`=$registeredStudentId");
                foreach($student as $module=>$result){
                    $result=$result ? 1:0; //convert to bit value
                    $conn->query("INSERT INTO `preasessment_student_modules`(`module_id`,`preassessment_student_id`,`result`) VALUES ($module,(SELECT preasessment_student.id FROM preasessment_student WHERE preasessment_student.student_id=1 AND preasessment_student.preassesment_id=1),'$result')");
                }
            }
            $conn->commit();
            return true;
        }catch(Exception $e){
            $conn->rollback();
            return false;
        }

    }

}
