<?php

require_once('./controllers/Controller.php');

class PagesController extends Controller
{

    public function index()
    {
        if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'SUPER_ADMIN'){
            header('Location:' . getenv('BASE_URL') .'/admin');
            exit;
        }
        else{
            $this->generateView('./views/pages/dashboard.php', ["currentPage" => "home"]);
        }
    }

    public function admin()
    {
        if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'SUPER_ADMIN'){ // If the logged in user is a super admin
            $this->generateView('./views/pages/admin/dashboard.php', ["currentPage" => "home"]);
        }else{
            echo "Opps page not found.";
        }
    }

    public function home()
    {
        require('./views/pages/home.php');
    }

    public function login()
    {
        require('./views/pages/login.php');
    }

    public function batch()
    {
        // Check if the content type is application/json
        if ((isset($_SERVER['HTTP_CONTENT_TYPE']) && $_SERVER['HTTP_CONTENT_TYPE'] === 'application/json')) {
            return Router::GO_TO_NEXT_ROUTE();
        }

        // If it isn't redirect to this
        $this->generateView('./views/pages/registration/registration.php', ["currentPage" => "student"]);
    }

    public function notifications(){
        $this->generateView('./views/pages/notifications.php',["currentPage" => "notifications"]);
    }

    public function addBatch()
    {
        // Check if the content type is application/json
        if ((isset($_SERVER['HTTP_CONTENT_TYPE']) && $_SERVER['HTTP_CONTENT_TYPE'] === 'application/json')) {
            return Router::GO_TO_NEXT_ROUTE();
        }

        // If it isn't redirect to this
        $this->generateView('./views/pages/registration/addBatch.php', ["currentPage" => "student"]);
    }

    public function addStudent(Request $request)
    {
        // Check if the content type is application/json
        if ((isset($_SERVER['HTTP_CONTENT_TYPE']) && $_SERVER['HTTP_CONTENT_TYPE'] === 'application/json')) {
            return Router::GO_TO_NEXT_ROUTE();
        }

        $batchId = $request->query("batch",0);
        // If it isn't redirect to this
        $this->generateView('./views/pages/registration/registerStudent.php', ["currentPage" => "student",
        "batchId" => $batchId]);
    }

    public function addInterviewee(Request $request)
    {
        // Check if the content type is application/json
        if ((isset($_SERVER['HTTP_CONTENT_TYPE']) && $_SERVER['HTTP_CONTENT_TYPE'] === 'application/json')) {
            return Router::GO_TO_NEXT_ROUTE();
        }

        $batchId = $request->query("batch",0);
        // If it isn't redirect to this
        $this->generateView('./views/pages/registration/addInterviewee.php', ["currentPage" => "student",
        "batchId" => $batchId]);
    }

    public function addApplicant(Request $request)
    {
        // Check if the content type is application/json
        if ((isset($_SERVER['HTTP_CONTENT_TYPE']) && $_SERVER['HTTP_CONTENT_TYPE'] === 'application/json')) {
            return Router::GO_TO_NEXT_ROUTE();
        }

        $batchId = $request->query("batch",0);
        // If it isn't redirect to this
        $this->generateView('./views/pages/registration/addApplicant.php', ["currentPage" => "student",
            "batchId" => $batchId]);
    }

    public function assessment()
    {
        // Check if the content type is application/json
        if ((isset($_SERVER['HTTP_CONTENT_TYPE']) && $_SERVER['HTTP_CONTENT_TYPE'] === 'application/json')) {
            return Router::GO_TO_NEXT_ROUTE();
        }

        // If it isn't redirect to this
        $this->generateView('./views/pages/assessment.php', ["currentPage" => "assessment"]);
    }

    public function attendance()
    {
        // Check if the content type is application/json
        if ((isset($_SERVER['HTTP_CONTENT_TYPE']) && $_SERVER['HTTP_CONTENT_TYPE'] === 'application/json')) {
            return Router::GO_TO_NEXT_ROUTE();
        }

        // If it isn't redirect to this
        $this->generateView('./views/pages/attendance.php', ["currentPage" => "attendance"]);
    }

    public function inventory()
    {
        // Check if the content type is application/json
        if ((isset($_SERVER['HTTP_CONTENT_TYPE']) && $_SERVER['HTTP_CONTENT_TYPE'] === 'application/json')) {
            return Router::GO_TO_NEXT_ROUTE();
        }

        // If it isn't redirect to this
        $this->generateView('./views/pages/inventory/inventory.php', ["currentPage" => "inventory"]);
    }

    public function jobDetails()
    {
        // Check if the content type is application/json
        if ((isset($_SERVER['HTTP_CONTENT_TYPE']) && $_SERVER['HTTP_CONTENT_TYPE'] === 'application/json')) {
            return Router::GO_TO_NEXT_ROUTE();
        }

        // If it isn't redirect to this
        $this->generateView('./views/pages/jobdetails/jobOverview.php', ["currentPage" => "jobDetails"]);
    }

    public function getIncludes(Request $request)
    {
        $data = $request->getRequestBody();
        $component = (isset($data['component'])) ? $data['component'] : 'none';

        $components = [ 'batchDetails' => '/registration/batchDetails.php',
            'batchBase' => '/registration/batchBase.php',
            'studentDetails' => '/registration/studentDetails.php',
            'studentProfile' => '/registration/studentProfile/base.php',
            'profileAttendance' => '/registration/studentProfile/attendance.php',
            'profileAdditional' => '/registration/studentProfile/additionalDetails.php',
            'profileRegistration' => '/registration/studentProfile/registrationDetails.php',
            'profileAssessments' => '/registration/studentProfile/assessment.php',
            'adminOverview' => '/admin/overview.php',
            'adminControls' => '/admin/controls.php',
            'adminCourse' => '/admin/controls/course.php',
            'adminCenter' => '/admin/controls/center.php',
            'adminAccount' => '/admin/controls/account.php',
            'registrationForm' => '/registration/registerStudentForm.php',
            'attendanceOverview' => '/attendance/attendanceOverview.php',
            'attendanceReports' => '/attendance/attendanceReports.php',
            'assessmentOverview' => '/assessment/assessmentOverview.php',
            'assessmentModules' => '/assessment/assessmentModules.php',
            'assessmentReports' => '/assessment/assessmentReports.php',
            'inventoryOverview' => '/inventory/inventoryOverview.php',
            'inventoryReports' => '/inventory/inventoryReports.php',
            'jobOverview' => '/jobdetails/jobOverview.php',
            'jobReports' => '/jobdetails/jobReports.php',
            'preAssessment' => '/PreFinalAssessment/preAssessmentInitialzation.php',
            'markPreAssessment' => '/PreFinalAssessment/preAssessmentMarkResults.php',
            'payment' => '/payment/payment.php',
        ];

        if(! array_key_exists($component,$components)){ // If the component is not present
            header("HTTP/1.1 404 Not Found");
            echo "This resource could not be found.";
            return;
        }

        require("./views/inc{$components[$component]}");
    }
}