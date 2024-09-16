<?php

    require_once('./controllers/Controller.php');
    require_once('./traits/models/AttendanceModel.php');

    class AttendanceController extends Controller{
        use AttendanceModel;
        
        public function getReport(Request $request){
            $data = $request->getRequestBody();
            
            $reportType = ( isset($data['reportType']))? $data['reportType']: 'none';

            header('Content-Type: application/json');

            switch($reportType){
                
                case 'annual' :
                    $type = ( isset($data['type']) && !empty($data['type']))? $data['type']: null;
                    $batchId = ( isset($data['batch_id']) && !empty($data['batch_id']))? $data['batch_id']: null;
                    $mis = ( isset($data['student_id']) && !empty($data['student_id']))? $data['student_id']: null;

                    if($batchId === null){
                        echo json_encode(["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing one argument for the batch ID"], JSON_PRETTY_PRINT);
                        return;
                    }

                    if($type !== null && $type == 'single' && $mis === null){
                        echo json_encode(["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing one argument for the student ID"], JSON_PRETTY_PRINT);
                        return;
                    }
                    
                    $results = $this->getAnnualAttendance(["type" => $type, "student_id" => $mis, "batch_id" => $batchId]);
                    break;

                case 'monthly' :
                    $year = ( isset($data['year']) && !empty($data['year']))? $data['year']: 'none';
                    $month = ( isset($data['month']) && !empty($data['month']))? $data['month']: 'none';
                    $type = ( isset($data['type']) && !empty($data['type']))? $data['type']: null;
                    $batchId = ( isset($data['batch_id']) && !empty($data['batch_id']))? $data['batch_id']: null;
                    $mis = ( isset($data['student_id']) && !empty($data['student_id']))? $data['student_id']: null;

                    if($batchId === null){
                        echo json_encode(["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing one argument for the batch ID"], JSON_PRETTY_PRINT);
                        return;
                    }

                    if($type !== null && $mis === null){
                        echo json_encode(["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing one argument for the mis"], JSON_PRETTY_PRINT);
                        return;
                    }

                    $results = $this->getMonthlyAttendance($year,$month,["type" => $type, "student_id" => $mis, "batch_id" => $batchId]);
                    break;

                case 'percentage':
                    $batchId = ( isset($data['batch_id']) && !empty($data['batch_id']))? $data['batch_id']: 1;
                    $results = $this->getAnnualAttendancePercentages($batchId);
                    break;
                
                default :
                    $results = [
                        "condition" => 'failed', "errorType" => "data",
                        "message" => "Missing report type parameter arguments"
                        ];
            }

            echo json_encode([
                "condition" => 'success',
                "data" => $results
            ], JSON_PRETTY_PRINT);
        }

        public function viewAttendance(Request $request){
            $data = $request->getRequestBody();

            echo json_encode($this->getAttendance($data),JSON_PRETTY_PRINT);
        }

        public function saveAttendance(Request $request){
            $data = $request->getRequestBody();

            echo json_encode($this->markAttendance($data),JSON_PRETTY_PRINT);
        }

        public function manageCalendar(Request $request){
            $data = $request->getRequestBody();

            echo json_encode($this->manageHolidays($data),JSON_PRETTY_PRINT);
        }

        public function viewHolidays(Request $request){
            $data = $request->getRequestBody();

            echo json_encode($this->getHolidays($data['month']));
        }
        
    }