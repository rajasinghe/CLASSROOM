<?php include('./views/layouts/start.php') ?>

<?php include('./views/inc/base-css.php') ?>
<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/admin/addButtonStyle.css'>
<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/admin/coursesStyle.css'>
<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/admin/searchStyle.css'>
<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/admin/TOpageStyle.css'>
<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/admin/popup.css'>
<!-- <link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/admin/course.css'> -->
<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/admin/centers.css'>
<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/admin/checkbox.css'>
<?php include('./views/layouts/body-start.php') ?>
<?php include('./views/inc/side-bar.php') ?>

<!-- Main Content Starts Here-->
<div class="col px-0">
    <div class="container-fluid" id="content-container">
        <div class="row">
            <!--Site Header section start-->
            <div class="col-12 py-3 bg-white" id="site-header">
                <span class="fw-medium ms-4">CLASSROOM MANAGEMENT SYSTEM</span>
            </div>
            <!--Site Header section end-->

            <div class="col-12 pt-4 px-2 px-md-4 d-flex">
                <span class="text-dark ms-md-2" id="nav-direction-section">
                    <a href="<?php echo getenv('BASE_URL') ?>/admin" class="text-decoration-none text-dark me-md-1">Home</a>
                    <i class="bi bi-caret-right-fill text-dark"></i>
                    <a href="<?php echo getenv('BASE_URL') ?>/admin" class="text-decoration-none text-dark ms-md-1 ">Overview</a>
                </span>

                <span class="ms-auto me-md-2" id="content-nav">
                    <a href="<?php echo getenv('BASE_URL') ?>/admin" class="btn border-danger rounded-1 active" id="overview-link">Overview</a>
                    <a href="<?php echo getenv('BASE_URL') ?>/admin/center" class="btn border-danger rounded-1" id="control-link">Controls</a>
                </span>
            </div>

            <div class="col-12" id="page-content">
                
            </div>

        </div>
    </div>
</div>
<!-- Main Content Ends Here-->

<?php include('./views/layouts/body-end.php') ?>
<script src='<?php echo getenv('BASE_URL') ?>/public/js/admin/adminRouter.js' type="module"></script>

<?php include('./views/layouts/end.php') ?>