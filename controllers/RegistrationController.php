<?php

require_once('./controllers/Controller.php');
require_once('./traits/models/RegistrationModel.php');

class RegistrationController extends Controller
{

    use RegistrationModel;

    /**
     * Handles all student related read requests
     */
    public function handleStudentData(Request $request)
    {

        $data = $request->getRequestBody();

        header('Content-Type: application/json');

        if (!isset($data['type']) || empty($data['type']) || !isset($data['context']) || empty($data['context'])) {
            echo json_encode(["condition" => 'failed', "errorType" => "data",
                "message" => "Missing arguments for type or context"], JSON_PRETTY_PRINT);
            return;
        }

        $response = null;

        if ($data['type'] === 'VIEW/STUDENT') {

            switch ($data['context']) {

                case 'STUDENT/PROFILE':
                    if (!isset($data['student_id']) || empty($data['student_id'])) {
                        $response = ["condition" => 'failed', "errorType" => "data",
                            "message" => "Missing one argument for Student ID"];
                    } else
                        $response = $this->getStudentProfile($data['student_id'])[0];
                    break;

                case 'APPLICANTS': case 'APPLICANT/SINGLE':
                    $response = $this->handleApplicantData($data['context'],$data);
                    break;

                case 'INTERVIEW': case 'IW/SEARCH': case 'INTERVIEW/SINGLE':
                    $response = $this->handleInterviewData($data['context'],$data);
                    break;

                case 'REGISTEREDSTUDENTS/CURRENT': case 'RS/SEARCH': case 'REGISTEREDSTUDENTS':
                    $response = $this->handleRegisteredStudentData($data['context'],$data);
                    break;

                case 'STUDENT/COURSE':
                    if(!isset($data['student_id']) || empty($data['student_id'])){
                        $response = ["condition" => 'failed', "errorType" => "data",
                            "message" => "Missing one argument for Student ID"];
                    }
                    else{

                        $response = ["condition" => 'success',"message" => "Request successful",
                            "data" => $this->getStudentBatches($data['student_id'])];
                    }
                    break;

                default:
                    $response = ["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing one argument for the type"];
            }

        } else if ($data['type'] === 'MODIFY/STUDENT') {
            $response = $this->handleStudentModifications($data);

        } else if($data['type'] === 'VIEW/COURSE'){

            switch($data['context']){

                case 'COURSE/CRITERIAS':
                    if(!isset($data['course_id']) || empty($data['course_id'])){
                        $response = ["condition" => 'failed', "errorType" => "data",
                            "message" => "Missing one argument for Course ID"];
                    }
                    else{
                        $response = ["condition" => 'success',"message" => "Request successful",
                            "data" => $this->getCourseCriterias($data['course_id'])];
                    }
                    break;
                
                default:
                    $response = ["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing one argument for the type"];
            }
        }else {
            $response = ["condition" => 'failed', "errorType" => "data",
                "message" => "Missing one argument for the type"];
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    /**
     * Handles all student related write(INSERT/UPDATE) requests
     */
    private function handleStudentModifications(array $data): array
    {

        $response = [];

        switch ($data['context']) {

            case 'INSERT/APPLICANT':
                if (!isset($data['batch_id']) || empty($data['batch_id'])) {

                    $response = ["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing argument for the batch_id"];
                } else {
                    if ($this->addApplicant($data)) {

                        $response = ["condition" => 'success',
                            "message" => "Applicant added successfully"];
                    } else {
                        $response = ["condition" => 'failed', "errorType" => "server",
                            "message" => "Could not add the applicant. Try again later."];
                    }
                }
                break;

            case 'UPDATE/APPLICANT':
                if (
                    !isset($data['batch_id']) || empty($data['batch_id']) ||
                    !isset($data['application_number']) || empty($data['application_number'])
                ) {

                    $response = ["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing arguments for the batch_id or application_number"];
                } else {
                    if ($this->addApplicant($data, true)) {

                        $response = ["condition" => 'success',
                            "message" => "Applicant updated successfully"];
                    } else {
                        $response = ["condition" => 'failed', "errorType" => "server",
                            "message" => "Could not udpate the applicant. Try again later."];
                    }
                }
                break;

            case 'INSERT/INTERVIEWEE':
                if (
                    !isset($data['batch_id']) || empty($data['batch_id']) ||
                    !isset($data['application_number']) || empty($data['application_number'])
                ) {

                    $response = ["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing arguments for the batch_id or application_number"];
                } else {
                    if ($this->addInterviewee($data)) {

                        $response = ["condition" => 'success',
                            "message" => "Interview added successfully"];
                    } else {
                        $response = ["condition" => 'failed', "errorType" => "server",
                            "message" => "Could not add the interviewee. Try again later."];
                    }
                }
                break;

            case 'UPDATE/INTERVIEWEE':
                if (
                    !isset($data['batch_id']) || empty($data['batch_id']) ||
                    !isset($data['interview_no']) || empty($data['interview_no']) ||
                    !isset($data['application_number']) || empty($data['application_number'])
                ) {

                    $response = ["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing arguments for the batch_id or application_number or interview_no"];
                } else {
                    if ($this->addInterviewee($data, true)) {

                        $response = ["condition" => 'success',
                            "message" => "Interview updated successfully"];
                    } else {
                        $response = ["condition" => 'failed', "errorType" => "server",
                            "message" => "Could not udpate the interviewee. Try again later."];
                    }
                }
                break;

            case 'INSERT/STUDENT':
                if (
                    !isset($data['batch_id']) || empty($data['batch_id']) ||
                    !isset($data['interview_no']) || empty($data['interview_no'])
                ) {

                    $response = ["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing arguments for the batch_id or interview_no"];
                } else {
                    if ($this->addRegisteredStudent($data)) {

                        $response = ["condition" => 'success',
                            "message" => "Student added successfully"];
                    } else {
                        $response = ["condition" => 'failed', "errorType" => "server",
                            "message" => "Could not add the student. Try again later."];
                    }
                }
                break;

            case 'UPDATE/STUDENT':
                if (
                    !isset($data['batch_id']) || empty($data['batch_id']) ||
                    !isset($data['interview_no']) || empty($data['interview_no'])
                ) {

                    $response = ["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing arguments for the batch_id or interview_no"];
                } else {
                    if ($this->addRegisteredStudent($data, true)) {

                        $response = ["condition" => 'success',
                            "message" => "Student updated successfully"];
                    } else {
                        $response = ["condition" => 'failed', "errorType" => "server",
                            "message" => "Could not udpate the student. Try again later."];
                    }
                }
                break;

            default:
                $response = ["condition" => 'failed', "errorType" => "request",
                    "message" => "Unrecognized request"];
        }

        return $response;
    }

    private function handleApplicantData($type, $data): array
    {
        if ($type === 'APPLICANTS') {
            if (!isset($data['batch_id']) || empty($data['batch_id'])) {
                $response = ["condition" => 'failed', "errorType" => "data",
                    "message" => "Missing one argument for Batch ID"];
            } else {
                $response = $this->getApplicants($data['batch_id']);
            }
        } else {

            if (isset($data['application_number']) && !empty($data['application_number'])) {

                $applicantData = $this->getApplicant($data['application_number']);
                $response = ["condition" => (count($applicantData) > 0) ? 'success' : 'failed',
                    "data" => $applicantData];
            }
            else if(isset($data['nic']) && !empty($data['nic']) && isset($data['batch_id']) && !empty($data['batch_id'])){

                $applicantData = $this->getApplicant(null,$data['nic'],$data['batch_id']);
                $response = ["condition" => 'success',  "data" => $applicantData];
            }
            else {
                $response = ["condition" => 'failed', "errorType" => "data",
                    "message" => "Missing one argument for Application Number or NIC Number"];
            }
        }

        return $response;
    }

    private function handleInterviewData($type, $data): array
    {
        if ($type === 'INTERVIEW') {
            if (!isset($data['batch_id']) || empty($data['batch_id'])) {
                $response = ["condition" => 'failed', "errorType" => "data",
                    "message" => "Missing one argument for Batch ID"];
            } else
                $response = $this->getInterviewees($data['batch_id']);

        }
        else if ($type === 'IW/SEARCH'){
            if (!isset($data['batch_id']) || empty($data['batch_id']) || !array_key_exists('searchQuery',$data)
            || !isset($data['category']) || empty($data['category'])) {
                $response = ["condition" => 'failed', "errorType" => "data",
                    "message" => "Missing arguments for Batch ID, searchQuery or category"];
            } else
                $response = $this->getInterviewees($data['batch_id'], true, $data);
        }
        else {

            if ((!isset($data['application_number']) || empty($data['application_number'])) &&
                (!isset($data['forContext']) || empty($data['forContext']))) {
            
                $response = ["condition" => 'failed', "errorType" => "data",
                    "message" => "Missing one argument for Application Number"];
                    
            } else if ($data['forContext'] === 'FOR/REGISTRATION') {

                $response = ["condition" => 'success', "data" => $this->getInterviewee(null, $data['interview_no'], $data['batch_id'])];
            } else {

                $response = ["condition" => 'success', "data" => $this->getInterviewee($data['application_number'])];
            }
        }

        return $response;
    }

    private function handleRegisteredStudentData($type, $data): array
    {
        if ($type === 'REGISTEREDSTUDENTS/CURRENT') {
            $response = $this->getRegsiteredStudents(null, true);
        } 
        else if($type === 'RS/SEARCH') {

            if (!isset($data['batch_id']) || empty($data['batch_id']) || !array_key_exists('searchQuery',$data)
            || !isset($data['status']) || empty($data['status']) || !isset($data['category']) || empty($data['category'])) {
                $response = ["condition" => 'failed', "errorType" => "data",
                    "message" => "Missing arguments for Batch ID, searchQuery, status or category"];
            } else
                $response = $this->getRegsiteredStudents($data['batch_id'],false,1,true,$data);
        }
        else{

            if (!isset($data['batch_id']) || empty($data['batch_id'])) {
                $response = ["condition" => 'failed', "errorType" => "data",
                    "message" => "Missing one argument for Batch ID"];
            } else
                $response = $this->getRegsiteredStudents($data['batch_id']);
        }

        return $response;
    }

    public function getBatchDetails(Request $request)
    {
        $data = $request->getRequestBody();

        if (!isset($data['type']) || empty($data['type'])) {
            echo json_encode(["condition" => 'failed', "errorType" => "data",
                "message" => "Missing arguments"], JSON_PRETTY_PRINT);
            return;
        }

        $response = [];

        switch($data['type']) {

            case 'ALL':
                $response = $this->getBatches();
                break;

            case 'BATCH/ALL':
                $response = $this->getBatches(null);
                break;

            default:
                if (!isset($data['batch_id']) || empty($data['batch_id'])) {
                    $response = ["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing arguments"];
                    break;
                }

                $response = $this->getBatch($data['batch_id']);
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}