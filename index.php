<?php
    //This is the original index file of this project
    require_once __DIR__ . '/vendor/autoload.php';
    require('./http/Router.php');
    require_once('./database/DB.php');
    include_once('./controllers/PagesController.php');
    include_once('./controllers/RegistrationController.php');
    include_once('./controllers/AttendanceController.php');
    include_once('./controllers/AssessmentController.php');
    include_once('./controllers/InventoryController.php');
    include_once('./controllers/JobDetailsController.php');
    include_once('./controllers/DataController.php');
    

    //Initialize the Router
    Router::init();

    //Setup databse connections
    DB::connect();

    //Initialize the session
    session_start();

    //$_SESSION['user_type'] = 'SUPER_ADMIN'; // This is only for testing, Remove this after testing.

    Router::listen();
