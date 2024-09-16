<?php 
trait installmentModel{

    private $installmentFolder='./installments';
   
    function insertInstallment($studentIdentification, $amount, $slip,$isLastPayment): bool {
        $conn = DB::getConnction();
        
        //saving the data in the database
        if($isLastPayment){
            $query=<<<SQL
            SET @id=$studentIdentification;
            SET @amount=$amount;
            INSERT INTO `installment`(`registered_student_id`, `amount`, `slip_path`) VALUES (@id,@amount,'$slip');
            UPDATE `registered_student` SET `payment_status`='PAID' WHERE `student_id`=@id;
            SQL;
        }else{
            $query="INSERT INTO `installment`(`registered_student_id`, `amount`, `slip_path`) VALUES ($studentIdentification,$amount,'$slip');";
        }
        
    
        $conn->begin_transaction();
        if($conn->multi_query($query)){
            do{
                // Fetch and discard result set
                if ($result = $conn->store_result()) {
                    $result->free();
                }
            } while ($conn->more_results() && $conn->next_result());
            // Commit the transaction if all queries succeed
            $conn->commit();
            return true;
        }else{
            // Rollback the transaction if any query fails
            $conn->rollback();
            $conn->autocommit(true);
            return false;
        }
    }

    public function readData($registeredStudentId){
        $conn=DB::getConnction();
        $query="SELECT (SELECT SUM(installment.amount) as total FROM `installment`,registered_student WHERE installment.registered_student_id=registered_student.id AND registered_student.id=$registeredStudentId) as total_installments,(SELECT COUNT(installment.id) FROM `installment`,registered_student WHERE installment.registered_student_id=registered_student.id AND registered_student.id=$registeredStudentId) as installment_count,interview.interview_no,application.id,student.id,registered_student.id,course_fee.course_fee,payment.amount as initial_payment,student.first_name,student.last_name,registered_student.mis,student.nic from interview,application,registered_student,student,payment,course_fee WHERE  registered_student.student_id=student.id AND student.id=application.student_id AND application.id=interview.application_number AND interview.interview_no=payment.interview_no AND registered_student.batch_id=course_fee.batch_id AND registered_student.student_id=$registeredStudentId;";
        return mysqli_fetch_all($conn->query($query),MYSQLI_ASSOC);
    }
 
}

?>