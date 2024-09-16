<?php
trait  paymentModel
{
   
    function initialPayment($studentIdentification, $slip, $amount, $paymentMethod) 
    {
        $conn = DB::getConnction();
        /*  $query = <<<'SQL'
        SET @payment=?;
        SELECT `total` into @total FROM `course fee`,student WHERE `course fee`.`batchId`=student.batchId AND student.studentIdentification=?;
        INSERT INTO `payment`(`student_identification`,`total amount`, `balance`, `payment slip`) VALUES (?,@total,(@total-@payment),?);
        SQL;
        $stmt=$conn->prepare($query);
        $stmt->bind_param('iiis',$amount,$studentIdentification,$studentIdentification,$slip);
        $stmt->execute(); */
        $query = "
        INSERT INTO `payment`(`interview_no`, `amount`, `slip_path`, `type`) VALUES ($studentIdentification,$amount,'$slip','$paymentMethod');
        "; 
        return $conn->query($query);
    }

    function readPaymentData($interviewId){
        $conn=DB::getConnction();
        $query=" SELECT (SELECT COUNT(payment.interview_no) FROM `payment`,interview,application WHERE payment.type='SPECIAL' AND payment.interview_no=interview.interview_no AND interview.application_number=application.id AND application.batch_id=(SELECT batch.batch_id FROM batch,interview,application WHERE interview.application_number=application.id AND application.batch_id=batch.batch_id AND interview_no=$interviewId)) as special_count,(SELECT COUNT(payment.interview_no) FROM `payment`,interview,application WHERE (payment.type='FULL' OR payment.type='INSTALLMENT') AND payment.interview_no=interview.interview_no AND interview.application_number=application.id AND application.batch_id=(SELECT batch.batch_id FROM batch,interview,application WHERE interview.application_number=application.id AND application.batch_id=batch.batch_id AND interview_no=22))as normal_count,student.id AS student_id,student.first_name,student.last_name,student.nic,course.course_name,batch.batch_name,course_fee.course_id,course_fee.course_fee,course_fee.registration_fee, course_fee.examination_fee,course_fee.daily_diary_fee,course_fee.cbt_fee,course_fee.stamp_fee FROM application,interview,course_fee,course,batch,student WHERE interview.application_number=application.id AND application.batch_id=course_fee.batch_id AND interview.interview_no=22 AND application.student_id=student.id AND application.batch_id=batch.batch_id AND batch.course_id=course.course_id;";
        $results=mysqli_fetch_all($conn->query($query),MYSQLI_ASSOC);
        return $results;
    }

   
    }

