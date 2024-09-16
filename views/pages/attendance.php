<?php include('./views/layouts/start.php') 
?>

<?php include('./views/inc/base-css.php') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/attendance/attendance.css'>
<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/attendance/calendar.css'>

<?php include('./views/layouts/body-start.php') ?>
<?php include('./views/inc/side-bar.php') ?>

<!-- Main Content Starts Here-->
    <div class="col px-0">
        <div class="container-fluid" id="content-container">
            <div class="row">
                <!--Site Header section start-->
                <div class="col-12 py-3 bg-white" id="site-header">
                    <div class="container-fluid">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-5 px-0">
                                <span class="fw-medium ms-4">CLASSROOM MANAGEMENT SYSTEM</span>
                            </div>
                            <div class="col-4 col-lg-3 px-0 pe-3">
                                <span class="fw-medium ">
                                    <select id="batchField" class="form-control form-select">
                                    </select>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Site Header section end-->

                <div class="col-12 pt-4 px-2 px-md-4 d-flex" id="content-nav">
                        <span class="text-dark ms-md-2">
                            <a href="" class="text-decoration-none text-dark me-md-1">Attendance</a> | 
                            <a href="" class="text-decoration-none text-dark ms-md-1">Overview</a>
                        </span>

                        <span class="ms-auto me-md-2">
                            <a href="/attendance" class="btn border-danger rounded-1" id="overview-link">Overview</a>
                            <a href="/attendance/reports" class="btn border-danger rounded-1" id="reports-link">Reports</a>
                        </span>
                </div>

                <div class="col-12" id="page-content">
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Main Content Ends Here-->

<?php include('./views/layouts/body-end.php') ?>

<script type="module" src="/public/js/attendance/attendanceRouter.js"></script>

<?php include('./views/layouts/end.php') ?>