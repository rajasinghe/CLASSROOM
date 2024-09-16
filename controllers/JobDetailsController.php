<?php

require_once('./controllers/Controller.php');
require_once('./traits/models/TrainingModel.php');

class JobDetailsController extends Controller{
    use TrainingModel;

    public function test(){
        header("Content-Type:application/json");
        $response = $this->getStudentBatches('200312273');
        echo json_encode($response,JSON_PRETTY_PRINT);
    }

    /* Get Training Details From Training Detailas and Company Details Tables */
    public function getTrainingData(Request $request)
    {

        $data = $request->getRequestBody();
        $data = $this->getTrainingDetails($data);

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /* Get Batch From Batch Table Temp */
    public function getBatchData(){

        $data = $this->getBatchCombo();

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /* Get Student List */
    public function getStuData(Request $request){

        $data = $request->getRequestBody();

        $data = $this->getStuCard($data);

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /* Get Student Training Details */
    public function getStuTrainingData(Request $request)
    {
        $data = $request->getRequestBody();
        $data = $this->getStuTrainingDetails($data);

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /* Get Student Job Placement Details */
    public function getStuPlacementData(Request $request)
    {
        $data = $request->getRequestBody();
        $data = $this->getStuPlacementDetails($data);

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /* Get Job Placement Details */
    public function getJobPlacementData(Request $request)
    {
        $data = $request->getRequestBody();
        $data = $this->getJobPlacement_Details($data);

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /* Set Training Details */
    public function setTrainingData(Request $request)
    {
        $data = $request->getRequestBody();
        $data = $this->setTrainingDetails($data);

        echo json_encode($data);

        /* if (isset ($data['begin_date']) && isset ($data['end_date']) && isset ($data['salary']) && isset ($data['salary'])) {
                $data = $this->setTrainingDetails($data);
                return ["condition" => "success"];
            }else{
                return ["condition" => "no data"];
            } */
    }


    /* Get Company Names For Dropdown */
    public function getComNames(){

        $data = $this->getCompanyNames();
        header('Content-Type: application/json');
        echo json_encode($data);

    }

    public function getCompanyDetail(Request $request){

        $data = $request->getRequestBody();

        $data = $this->getCompanyDetails($data);

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}