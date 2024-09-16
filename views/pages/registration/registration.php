<?php include('./views/layouts/start.php') ?>

<?php include('./views/inc/base-css.php') ?>

<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/registration/studentlist.css'>
<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/registration/Form.css'>
<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/registration/profileImage.css'>
<link rel="stylesheet" href="<?php echo getenv('BASE_URL') ?>/public/css/registration/table.css">
<link rel="stylesheet" href="<?php echo getenv('BASE_URL') ?>/public/css/registration/tablehover.css">
<link rel="stylesheet" href="<?php echo getenv('BASE_URL') ?>/public/css/registration/button.css">
<link rel="stylesheet" href="<?php echo getenv('BASE_URL') ?>/public/css/registration/changeStatusForm.css">
<link rel="stylesheet" href="<?php echo getenv('BASE_URL') ?>/public/css/registration/changeStatusButton.css">
<link rel="stylesheet" href="<?php echo getenv('BASE_URL') ?>/public/css/registration/subButtonGroup.css">

<?php include('./views/layouts/body-start.php') ?>
<?php include('./views/inc/side-bar.php') ?>

<div class="col px-0">
    <div class="container-fluid" id="content-container">
        <div class="row">
            <!--Site Header section start-->
            <div class="col-12 py-3 bg-white" id="site-header">
                <span class="fw-medium ms-4">STUDENT DETAILS</span>
            </div>
            <!--Site Header section end-->

            <div class="col-12 pt-4 px-2 px-md-4 d-flex">
                <span class="text-dark ms-md-2" id="nav-direction-section">
                    <a href="<?php echo getenv('BASE_URL') ?>/batch/student" class="text-decoration-none text-dark me-md-1">Student</a>
                    <i class="bi bi-caret-right-fill text-dark"></i>
                    <a href="<?php echo getenv('BASE_URL') ?>/batch/student" class="text-decoration-none text-dark ms-md-1">Overview</a>
                </span>

                <span class="ms-auto me-md-2" id="content-nav">
                    <a href="<?php echo getenv('BASE_URL') ?>/batch/student" class="btn border-danger rounded-1 active"
                        id="student-details-link">Student Details</a>
                    <a href="<?php echo getenv('BASE_URL') ?>/batch" class="btn border-danger rounded-1"
                        id="batch-details-link">Batch Details</a>
                </span>
            </div>

            <div class="col-12" id="page-content">

            </div>

        </div>
    </div>
</div>

<?php include('./views/layouts/body-end.php') ?>

<script type="module" src="<?php echo getenv('BASE_URL') ?>/public/js/registration/registrationRouter.js"></script>

<?php include('./views/layouts/end.php') ?>