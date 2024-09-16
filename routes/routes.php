<?php

require_once('./http/Router.php');
require_once('./http/config/environment.php');

//This is the file where you should set up all your routes

//Setup Routes
/* Router::MIDDLEWARE('/', [DataController::class, 'authenticateUser']);

Router::GET('/',[PagesController::class,'home']);

Router::GET('/login', [PagesController::class, 'login']);

Router::POST('/login', [DataController::class, 'login']);

Router::GET('/logout',[DataController::class, 'logout']); */
//Router::GET('/test',[JobDetailsController::class,'test']);

Router::GET('/dashboard', [PagesController::class, 'index']);

Router::MIDDLEWARE('/batch',[PagesController::class,'batch']);

Router::MIDDLEWARE('/admin',[PagesController::class,'admin']);

Router::MIDDLEWARE('/assessment', [PagesController::class, 'assessment']);

Router::MIDDLEWARE('/attendance', [PagesController::class, 'attendance']);

Router::MIDDLEWARE('/inventory', [PagesController::class, 'inventory']);

Router::MIDDLEWARE('/jobDetails', [PagesController::class, 'jobDetails']);

// Common routes
Router::GET('/notifications', [PagesController::class, 'notifications']);

Router::POST('/includes', [PagesController::class, 'getIncludes']);

Router::POST('/uploads',[DataController::class,'handlePhotoUploads']);

Router::POST('/reports', [AttendanceController::class, 'getReport']);

Router::POST('/reports/save', [DataController::class, 'saveReport']);

// Registration routes
Router::GET('/addBatch', [PagesController::class, 'addBatch']);

Router::GET('/student/add', [PagesController::class, 'addStudent']);

Router::GET('/interviewee/add', [PagesController::class, 'addInterviewee']);

Router::GET('/applicant/add', [PagesController::class, 'addApplicant']);

Router::POST('/batch',[RegistrationController::class, 'getBatchDetails']);

Router::POST('/student', [RegistrationController::class, 'handleStudentData']);

// Assessment routes
Router::POST('/assessment/modules', [AssessmentController::class, 'getModuleOverviewDetails']);

Router::POST('/assessment/marks', [AssessmentController::class, 'handleAssessmentMarking']);

// Attendance routes
Router::POST('/attendance/view',[AttendanceController::class, 'viewAttendance']);

Router::POST('/attendance/save',[AttendanceController::class, 'saveAttendance']);

Router::POST('/attendance/holiday',[AttendanceController::class, 'viewHolidays']);

Router::POST('/attendance/holiday/add',[AttendanceController::class, 'manageCalendar']);

// Assessment routes
Router::POST('/inventory',[InventoryController::class, 'getReports']);

// Job training and placement routes
Router::POST('/tainingData',[JobDetailsController::class, 'getTrainingData']);

Router::GET('/reports/ojtReport',[PagesController::class, 'jobTrainingDetailsReports']);

Router::GET('/ojtgetform',[PagesController::class, 'jobgetDetailsForm']);

Router::GET('/ojtform',[PagesController::class, 'jobDetailsForm']);

Router::POST('/misdata',[JobDetailsController::class, 'getmisData']);

Router::GET('/comname',[JobDetailsController::class, 'getComNames']); // Company details route

Router::POST('/comdetails',[JobDetailsController::class, 'getCompanyDetail']);

Router::POST('/tainingDataSet',[JobDetailsController::class, 'setTrainingData']); // Route for Training Report End

Router::POST('/jobplacement',[JobDetailsController::class,'getJobPlacementData']); // Route for Placement Report Start

Router::GET('/reports/jobPlacementReport',[PagesController::class, 'jobPlacementDetailsReports']); // Route for Placement Report End

Router::GET('/tempBatch',[JobDetailsController::class, 'getBatchData',]); // Route for Job Overview Start

Router::POST('/tempstu',[JobDetailsController::class, 'getStuData']);

Router::POST('/tempTraistu',[JobDetailsController::class, 'getStuTrainingData']);

Router::POST('/tempPlacementstu',[JobDetailsController::class, 'getStuPlacementData']);