<?php
require_once('./controllers/Controller.php');
require('./traits/models/preAsessmentModel.php');
class PreAssessmentController extends Controller
{
    use preAssessmentModel;

    public function createPreAsssessment(Request $request)
    {
        $results = "";
        $data = $request->getRequestBody();
        if (isset($data['batchId']) & isset($data['assessorName']) & isset($data['assessorRegNo']) & isset($data['date']) & isset($data['students'])) {
            $batchId = $data['batchId'];
            $asessorName = $data['assessorName'];
            $asessorRegNo = $data['assessorRegNo'];
            $date = $data['date'];
            $preAssessmentStudents = $data['students'];
            $results = $this->insertPreAssessment($batchId, $date, $asessorName, $asessorRegNo, $preAssessmentStudents);
        } else {
            $results = ["error" => "data not set"];
        }
        echo json_encode($results);
    }

    public function getStudents(Request $request)
    {
        $data = $request->getRequestBody();
        $results = [];
        if (isset($data['batchId'])) {
            $batch = $data['batchId'];
            $results = $this->getStudentsByBatch($batch);
        } else if (isset($data['pid'])) {
            $pid = $request->getRequestBody()['pid'];
            $results = $this->getPreassessmentStudents($pid);
        }
        echo json_encode($results);
    }

    public function getModules(Request $request)
    {
        $data = $request->getRequestBody();
        $results = [];
        if (isset($data['pid'])) {
            $results = $this->readModules($data['pid']);
        } else {
            $results = ['error' => "pid not set"];
        }
        echo json_encode($results);
    }

    public function searchStudents(Request $request)
    {

        $data = $request->getRequestBody();
        $type = $data['type'];
        $results = [];
        $keyword = $data['keyword'];
        $currentBatch = $data['currentBatch'];
        switch ($type) {
            case  'name':
                $results = $this->getStudentsByNameForFilter($keyword, $currentBatch);
                break;
            case 'mis':
                $results = $this->getStudentsByMISForFilter($keyword, $currentBatch);
                break;
            case 'batchId':
                $results = $this->getStudentsByBatchForFilter($keyword, $currentBatch);
                break;
        }
        echo json_encode($results);
    }

    public function markPreAsessmentResults(Request $request){
        $data=$request->getRequestBody();
        $results=[];
        if(isset($data['students']) && isset($data['pid']) && isset($data['dates'])){
            if($this->insertpreAsessmentResults($data['students'],$data['pid'],$data['dates'])){
                $results=["success"=>"successfully added the records"];
            }else{
                $results=['error'=>"failed to add the recods"];
            }
        }else{
            $results=['error'=>"data not set"];
        }
        echo json_encode($results);
    }


}
