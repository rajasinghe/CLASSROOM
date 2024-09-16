<?php include('./views/layouts/start.php') ?>

<?php include('./views/inc/base-css.php') ?>
<link rel='stylesheet' type='text/css' media='screen'
    href='<?php echo getenv('BASE_URL') ?>/public/css/assessment/assessment.css'>
<link rel='stylesheet' type='text/css' media='screen'
    href='<?php echo getenv('BASE_URL') ?>/public/css/preFinalAssessment/preAssessment.css'>
<link rel='stylesheet' type='text/css' media='screen'
    href='<?php echo getenv('BASE_URL') ?>/public/css/assessment/module.css'>
<?php include('./views/layouts/body-start.php') ?>

<!--Modal-->
<div class="modal fade" id="searchStudentsModal" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Search Students</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex">
                    <input type="text" class="form-control search-input" placeholder="Enter the details to search"
                        id="searchField">
                    <span class="input-group-text  bg-transparent  filter-icon">
                        <img src="/public/images/icons8-filter-64.png" alt="Filter Icon">
                        <div class="floating-filter-options">
                            <div class="active-filter search-option" id="nameOption">Name</div>
                            <div class="search-option" id="misOption">MIS</div>
                            <div class="search-option" id="batchIdOption">Batch-ID</div>
                        </div>
                    </span>
                </div>
                <div class="table-responsive site-scrollbar mt-3" id="">
                    <table class="table table-bordered mb-0 d-none " id="searchTable">
                        <thead>
                            <tr>
                                <th>MIS</th>
                                <th>Name</th>
                                <th>Batch</th>
                            </tr>
                        </thead>
                        <tbody id="searchTableBody">
                            <tr class="repeat-row">
                                <td>4564564</td>
                                <td>Pasindu Gimhan</td>
                                <td class="d-flex align-items-center ">
                                    <div>
                                        4564
                                    </div>
                                    <div class="ms-auto repeat-row-batch">
                                        <Button class="btn btn-danger ">
                                            <img class="add-img" src="/public/images/icons8-add-96 (1).png" alt="Icon">
                                        </Button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="repeat-row">
                                <td>4564564</td>
                                <td>Pasindu Gimhan</td>
                                <td class="d-flex align-items-center ">
                                    <div>
                                        4564
                                    </div>
                                    <div class="ms-auto repeat-row-batch">
                                        <Button class="btn btn-danger ">
                                            <img class="add-img" src="/public/images/icons8-minus-96 (1).png"
                                                alt="Icon">
                                        </Button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="repeat-row">
                                <td>4564564</td>
                                <td>Pasindu Gimhan</td>
                                <td class="d-flex align-items-center ">
                                    <div>
                                        4564
                                    </div>
                                    <div class="ms-auto repeat-row-batch">
                                        <Button class="btn btn-danger ">
                                            <img class="add-img" src="/public/images/icons8-add-96 (1).png" alt="Icon">
                                        </Button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="searchloader" class="d-flex align-content-center justify-content-center d-none">
                    <div class="loader"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include('./views/inc/side-bar.php') ?>

<!-- Main Content Starts Here-->
<div class="col px-0">

    <!-- Remove this if not wanted this for the loading progress bar test -->
    <div class="loading-progress-bar d-none"></div>
    <!-- Remove this if not wanted this for the loading progress bar test -->

    <div class="container-fluid" id="content-container">
        <div class="row">
            <!--Site Header section start-->
            <div class="col-12 py-3 bg-white" id="site-header">
                <div class="container-fluid">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-5 px-0">
                            <span class="fw-medium ms-4">ASSESSMENT DETAILS</span>
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

            <div class="col-12 pt-4 px-2 px-md-4 d-flex">
                <span class="text-dark ms-md-2" id="nav-direction-section">
                    <a href="<?php echo getenv('BASE_URL') ?>/assessment"
                        class="text-decoration-none text-dark me-md-1">Assessment</a>
                    <i class="bi bi-caret-right-fill text-dark"></i>
                    <a href="<?php echo getenv('BASE_URL') ?>/assessment"
                        class="text-decoration-none text-dark ms-md-1">Overview</a>
                </span>

                <span class="ms-auto me-md-2" id="content-nav">
                    <a href="<?php echo getenv('BASE_URL') ?>/assessment" class="btn border-danger rounded-1 active"
                        id="overview-link">Overview</a>
                    <a href="<?php echo getenv('BASE_URL') ?>/assessment/module" class="btn border-danger rounded-1"
                        id="modules-link">Modules</a>
                    <a href="<?php echo getenv('BASE_URL') ?>/assessment/reports" class="btn border-danger rounded-1"
                        id="reports-link">Reports</a>
                    <a href="<?php echo getenv('BASE_URL') ?>/assessment/preAssessment"
                        class="btn border-danger rounded-1" id="pre-final-link">Pre/Final Assessment</a>
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
<script type="module" src="<?php echo getenv('BASE_URL') ?>/public/js/assessment/assessmentRouter.js"></script>

<?php include('./views/layouts/end.php') ?>