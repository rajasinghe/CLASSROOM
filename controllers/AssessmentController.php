<?php

require_once('./controllers/Controller.php');
require_once('./traits/models/AssessmentModel.php');

class AssessmentController extends Controller
{

    use AssessmentModel;

    /**
     * Handles request for viewing and changing module, task and step details
     */
    public function getModuleOverviewDetails(Request $request)
    {
        $data = $request->getRequestBody();

        header('Content-Type: application/json');

        if (!isset($data['type']) || empty($data['type'])) {
            echo json_encode(["condition" => 'failed', "errorType" => "data",
                "message" => "Missing arguments"], JSON_PRETTY_PRINT);
            return;
        }

        $type = $data['type'];
        $result = [];

        if ($type === 'SAVE') {
            if (
                !isset($data['context']) || empty($data['context']) || !isset($data['operation'])
                || empty($data['operation']) || !isset($data['data']) || empty($data['data'])
            ) {

                echo json_encode(["condition" => 'failed', "errorType" => "data",
                    "message" => "Missing arguments"], JSON_PRETTY_PRINT);
                return;
            }

            switch ($data['context']) {
                case 'MODULE':
                    $result = $this->addModule($data['operation'], $data['data']);
                    break;

                case 'TASK':
                    $result = $this->addTask($data['operation'], $data['data']);
                    break;

                case 'STEP':
                    $result = $this->addStep($data['operation'], $data['data']);
                    break;

                default:
                    $result = ["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing one argument for the context"];
            }
        } 
        else if($type === 'REMOVE') {

            switch ($data['context']) {
                case 'MODULE':
                    $result = $this->removeModule($data['module_id']);
                    break;

                case 'TASK':
                    $result = $this->removeTask($data['task_id']);
                    break;

                case 'STEP':
                    $result = $this->removeStep($data['step_id']);
                    break;

                default:
                    $result = ["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing one argument for the context"];
            }
        }
        else {
            switch ($type) {
                case 'ALL':
                    $result = $this->getAllModulesWithTasks();
                    break;

                case 'MODULE/ALL':
                    $result = $this->getModules();
                    break;

                case 'MODULE/SINGLE':
                    if (!isset($data['module_id']) || empty($data['module_id'])) {
                        $result = ["condition" => 'failed', "errorType" => "data",
                            "message" => "Missing one argument for the module ID"];
                    } else
                        $result = $this->getModule($data['module_id']);
                    break;

                case 'TASK/ALL':
                    if (!isset($data['module_id']) || empty($data['module_id'])) {
                        $result = ["condition" => 'failed', "errorType" => "data",
                            "message" => "Missing one argument for the module ID"];
                    } else
                        $result = $this->getTasks($data['module_id']);
                    break;

                case 'TASK/SINGLE':
                    if (!isset($data['task_id']) || empty($data['task_id'])) {
                        $result = ["condition" => 'failed', "errorType" => "data",
                            "message" => "Missing one argument for the task ID"];
                    } else
                        $result = $this->getTask($data['task_id']);
                    break;

                case 'STEP/ALL':
                    if (!isset($data['task_id']) || empty($data['task_id'])) {
                        $result = ["condition" => 'failed', "errorType" => "data",
                            "message" => "Missing one argument for the task ID"];
                    } else
                        $result = $this->getSteps($data['task_id']);
                    break;

                case 'STEP/SINGLE':
                    if (!isset($data['step_id']) || empty($data['step_id'])) {
                        $result = ["condition" => 'failed', "errorType" => "data",
                            "message" => "Missing one argument for the step ID"];
                    } else
                        $result = $this->getStep($data['step_id']);
                    break;

                default:
                    $result = ["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing one argument for the type"];
            }
        }

        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    /**
     * Handles request for viewing and changing assessment marks,
     * module marks, task marks, step marks and assessment reports
     */
    public function handleAssessmentMarking(Request $request)
    {
        $data = $request->getRequestBody();

        if (!isset($data['type']) || empty($data['type'])) {
            echo json_encode(["condition" => 'failed', "errorType" => "data",
                "message" => "Missing arguments"], JSON_PRETTY_PRINT);
            return;
        }

        switch ($data['type']) {

            // Returns the marking format for steps in a task
            case 'ASSESSMENT/MARK/FORMAT':

                if (!isset($data['batch_id']) || empty($data['batch_id']) || !isset($data['task_id']) || empty($data['task_id'])) {
                    $result = ["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing arguments for task ID or batch ID"];
                } else
                    $result = $this->getAssessmentMarkingFormat($data['task_id'], $data['batch_id']);
                break;

            // Returns the theory assessment marking format for a given task
            case 'ASSESSMENT/THEORY/MARK/FORMAT':

                if (!isset($data['batch_id']) || empty($data['batch_id']) || !isset($data['module_id']) || empty($data['module_id']) || !isset($data['task_id']) || empty($data['task_id'])) {
                    $result = ["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing arguments"];
                } else {
                    $batchId = $data['batch_id'];
                    $moduleId = $data['module_id'];
                    $taskId = ($data['task_id'] === 'all') ? null : $data['task_id'];
                    $result = $this->getTheoryAssessmentMarkingFormat($moduleId, $taskId, $batchId);
                }
                break;

            case 'ASSESSMENT/THEORY/REPORT':

                if (!isset($data['batch_id']) || empty($data['batch_id'])) {
                    $result = ["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing one argument for Batch ID"];
                } else {
                    $result = $this->getTheoryAssessmentReport($data['batch_id']);
                }
                break;

            // Returns the marking format for steps in a task
            case 'ASSESSMENT/SUMMARY':

                if (!isset($data['batch_id']) || empty($data['batch_id'])) {
                    $result = ["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing one argument for Batch ID"];
                } else
                    $result = $this->getAssessmentSummary($data['batch_id']);
                break;

            case 'ASSESSMENT/MARK':

                if (!isset($data['task_id']) || empty($data['task_id']) || !isset($data['module_id']) || empty($data['module_id'])) {
                    $result = ["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing arguments for Task ID or Module ID "];
                } else
                    $result = $this->setAssessmentMarks($data['module_id'], $data['task_id'], $data['studentMarks']);
                break;

            case 'ASSESSMENT/THEORY/MARK':
                
                if (!isset($data['studentMarks']) || empty($data['studentMarks']) || !isset($data['module_id']) || empty($data['module_id']) || !isset($data['task_id']) || empty($data['task_id'])) {
                    $result = ["condition" => 'failed', "errorType" => "data",
                        "message" => "Missing arguments for Student Marks, Task ID or Module ID "];
                } else {
                    $moduleId = $data['module_id'];
                    $taskId = ($data['task_id'] === 'all') ? null : $data['task_id'];
                    $studentMarks = $data['studentMarks'];

                    $result = $this->setTheoryAssessmentMarks($moduleId, $taskId, $studentMarks);
                }
                break;

            default:
                $result = ["condition" => "failed", "errorType" => "data", "message" => "Bad request"];
        }

        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
}