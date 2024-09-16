<?php

require_once('./controllers/Controller.php');
require_once('./traits/models/UserModel.php');
require_once('./traits/models/ReportModel.php');

use Dompdf\Dompdf;
use Dompdf\Options;

class DataController extends Controller
{

    use UserModel;
    use ReportModel;

    public function authenticateUser(Request $request)
    {

        if ($request->path === '/' || $request->path === '/login')
            return Router::GO_TO_NEXT_ROUTE();

        //Check if the login token is still valid
        if (!(isset($_SESSION['user'])) || !(isset($_COOKIE['token']))) {
            session_unset();     // unset $_SESSION variable for the run-time 
            session_destroy();   // destroy session data in storage
            $this->handleSessionTimeout();
            return;
        }

        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1200)) {
            // last request was more than 20 minutes ago
            session_unset();     // unset $_SESSION variable for the run-time 
            session_destroy();   // destroy session data in storage
            $this->handleSessionTimeout();
            return;
        }

        if ($_SESSION['user']['session_token'] !== $_COOKIE['token']) {
            session_unset();    // unset $_SESSION variable for the run-time 
            session_destroy();  // destroy session data in storage
            $this->handleSessionTimeout();
            return;
        }

        $_SESSION['last_activity'] = time();

        return Router::GO_TO_NEXT_ROUTE();
    }

    public function login(Request $request)
    {
        $data = $request->getRequestBody();

        if (!isset($data['username']) || empty($data['username']) || !isset($data['password']) || empty($data['password']))
            return ['condition' => 'failed', 'errorType' => 'DATA', 'message' => 'Missing arguments for parameters'];

        $user = $this->getLoginCredentials($data['username']);

        if (count($user) < 1) {
            echo json_encode(['condition' => 'failed', 'errorType' => 'USERNAME', 'message' => 'This username doesn\'t exist']);
            return;
        }

        if ($user['password'] !== $data['password']) {
            echo json_encode(['condition' => 'failed', 'errorType' => 'PASSWORD', 'message' => 'Invalid Password']);
            return;
        }

        // Create the session token for the user
        $token = bin2hex(openssl_random_pseudo_bytes(8));

        // Store user details in the session
        $user['session_token'] = $token;

        if (!($this->saveLoginRecord($user))) {
            echo json_encode(['condition' => 'failed', 'errorType' => 'SERVER', 'message' => 'The server ran into an error']);
            return;
        }

        // Store user details in the session
        $_SESSION['user'] = $user;
        $_SESSION['last_activity'] = time();

        // Set user cookies
        setcookie("token", $token, 0);

        echo json_encode([
            'condition' => 'success', 'redirect_to' => '/dashboard',
            'message' => 'login successful'
        ]);
    }

    public function logout()
    {
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
        setcookie("token", "", time() - 3600);

        header("Location: /login");
    }

    public function saveReport(Request $request)
    {
        $data = $request->getRequestBody();

        switch ($data['reportType']) {

            case 'monthly':
                $html = $this->generateMonthlyReport($data['values']);
                $orientation = 'landscape';
                break;

            case 'annual':
                $html = $this->generateAnnualReport($data['values']);
                $orientation = 'landscape';
                break;

            case 'ASSESSMENT/PRACTICAL':
                $html = $this->generatePracticalAssessmentReport($data['values']);
                $orientation = 'landscape';
                break;

            case 'ASSESSMENT/THEORY':
                $html = $this->generateTheoryAssessmentReport($data['values']);
                $orientation = 'landscape';
                break;

            case 'ASSESSMENT/TASK':
                $html = $this->generateAssessmentTaskReport($data['values']);
                $orientation = 'landscape';
                break;

            case 'TRAINING':
                $html = $this->generateTrainingReport();
                $orientation = 'landscape';
                break;

            default:
                return;
        }

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);

        // Set paper size (optional)
        $dompdf->setPaper('A4', $orientation);

        // Render PDF (first pass to get the number of pages)
        $dompdf->render();

        // Stream the file
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="output.pdf"');
        echo $dompdf->output();
    }

    /**
     * Handle all photo uploads to the server through this method
     */
    public function handlePhotoUploads(Request $request){
        $data = $request->getRequestBody();

        if(!isset($data['image_type']) || empty($data['image_type'])){
            echo json_encode(["condition"=>"failed","errorType" => "data","message"=>"Missing one argument for the Image Type"],
                JSON_PRETTY_PRINT);
            return;
        }

        $image = $_FILES['image']; // Retreive the image received from the request
        $filePath = "./some_directory/"; // Change this according to the Image Type

        $response = []; // The response to be sent
        switch($data['image_type']){

            case 'STUDENT/PROFILE':
                // Store the student profile photo
                $filePath = "./public/images/students/student_profile_{$data['interview_no']}." . pathinfo($image['name'], PATHINFO_EXTENSION);
                if (move_uploaded_file($image['tmp_name'], $filePath)) {
                    // File was successfully uploaded
                    $response = ["condition"=>"success","message"=>"Image saved successfully", "directory" => $filePath];
                } else {
                    // Error moving the file
                    $response = ["condition"=>"failed","errorType" => "server","message"=>"Could not save the image."];
                }
                break;
        }

        echo json_encode($response,JSON_PRETTY_PRINT);
    }
}