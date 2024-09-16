<?php include('./views/layouts/start.php') ?>

<?php include('./views/inc/base-css.php') ?>

<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/registration/Form.css'>
<link rel="stylesheet" href="<?php echo getenv('BASE_URL') ?>/public/css/registration/table.css">
<link rel="stylesheet" href="<?php echo getenv('BASE_URL') ?>/public/css/registration/button.css">

<?php include('./views/layouts/body-start.php') ?>
<?php include('./views/inc/side-bar.php') ?>

    <div class="col px-0">
        <div class="container-fluid" id="content-container">
            <div class="row">
                <!--Site Header section start-->
                <div class="col-12 py-3 bg-white" id="site-header">
                    <span class="fw-medium ms-4">Student Details <i class="bi bi-chevron-compact-right"></i>
                        2024-SD-01
                    </span>
                </div>

                <div class="col-12 d-flex pt-4">
                    <span class="ms-auto me-md-2" id="content-nav">
                        <a href="/batch/<?php echo $batchId; ?>/registeredStudent" class="btn border-danger rounded-1 mb-2 active">Back to Batch Details</a>
                    </span>
                </div>

                <!-- form Section start-->
                <div class="col-12 pt-4 pb-4 px-md-4 floating-column">
                    <div class="d-flex align-items-center floating-scroll">
                        <div class="container-fluid floatin-container">
                            <div class="row justify-content-center">
                                <div class="col-12 px-0 site-card">
                                    <div class="card rounded-0 border-0 shadow">
                                        <div class="card-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-12 d-flex align-items-center ps-0">

                                                        <h4 class="fs-4 my-0">Registed Student Details
                                                        </h4>

                                                    </div>
                                                    <div class="col-12 px-0" id="form-container">
                                                        
                                                    </div>
                                                </div>
                                                <!-- Table end -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--form Section end-->
            </div>
        </div>
    </div>

<?php include('./views/layouts/body-end.php') ?>

<script src="<?php echo getenv('BASE_URL') ?>/public/js/registration/addRegisterStudent.js"></script>

<?php include('./views/layouts/end.php') ?>