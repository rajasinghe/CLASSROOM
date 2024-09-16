<?php include('./views/layouts/start.php') ?>

<?php include('./views/inc/base-css.php') ?>
<link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css"
        integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/notifications.css'>
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
                    <a href="" class="text-decoration-none text-dark me-md-1">Home</a>
                    <i class="bi bi-caret-right-fill text-dark"></i>
                    <a href="" class="text-decoration-none text-dark ms-md-1">Notifications</a>
                  </span>
                </div>
                
                <div class="col-12" id="page-content">
                    <div class="d-flex align-items-center">
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col-12 px-0 mt-4 site-card">
                                    <div class="card rounded-0 border-0 shadow">
                                        <div class="card-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                            <div class="col-12 d-flex align-items-center ps-0">
                                                                <h4 class="fs-4 my-0">Notifications</h4>
                                                            </div>
                                                            <div class="col-12 px-0 ">
                                                                <hr>
                                                            </div>
                                                            <!--Student Details section start-->
                                                            <div class="col-12 pt-4 pb-4 px-0">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="container-fluid">
                                                                        <div class="row justify-content-center">
                                                                            <div class="col right">

                                                                                <div
                                                                                    class="box shadow-sm rounded bg-white border border-1 mb-3">
                                                                                    <div
                                                                                        class="box-title border-bottom p-3">
                                                                                        <h6 class="m-0">Recent</h6>
                                                                                    </div>
                                                                                    <div class="box-body p-0">

                                                                                        <!-- Attendents Notification Start -->
                                                                                        <div
                                                                                            class="my-1 p-3 d-flex align-items-center notifi-active-color border-bottom osahan-post-header">
                                                                                            <div
                                                                                                class="dropdown-list-image me-3">
                                                                                                <!-- <img class="rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt /> -->
                                                                                                <img src="attendens.png"
                                                                                                    alt="">
                                                                                            </div>

                                                                                            <div
                                                                                                class="font-weight-bold me-3">
                                                                                                <div class="text-truncate"><b>DAILY RUNDOWN: WEDNESDAY</b></div>
                                                                                                <div class="small">
                                                                                                    Income tax sops on
                                                                                                    the cards, The bias
                                                                                                    in VC funding, and
                                                                                                    other top
                                                                                                    news for you</div>
                                                                                            </div>
                                                                                            <span
                                                                                                class="ms-auto mb-auto">
                                                                                                <div class="btn-group">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn btn-light btn-sm rounded"
                                                                                                        data-toggle="dropdown"
                                                                                                        aria-haspopup="true"
                                                                                                        aria-expanded="false">
                                                                                                        <i
                                                                                                            class="mdi mdi-dots-vertical"></i>
                                                                                                    </button>
                                                                                                    <div
                                                                                                        class="dropdown-menu dropdown-menu-right">
                                                                                                        <button
                                                                                                            class="dropdown-item"
                                                                                                            type="button"><i
                                                                                                                class="mdi mdi-delete"></i>
                                                                                                            Delete</button>
                                                                                                        <button
                                                                                                            class="dropdown-item"
                                                                                                            type="button"><i
                                                                                                                class="mdi mdi-close"></i>
                                                                                                            Turn
                                                                                                            Off</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br />
                                                                                                <div
                                                                                                    class="text-right text-muted pt-1">
                                                                                                    3d</div>
                                                                                            </span>

                                                                                        </div>
                                                                                        <!-- Attendents Notification finish -->

                                                                                        <!-- Training Notification Start -->
                                                                                        <div
                                                                                            class="my-1 p-3 d-flex align-items-center notifi-active-color border-bottom osahan-post-header">
                                                                                            <div
                                                                                                class="dropdown-list-image me-3">
                                                                                                <!-- <img class="rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt /> -->
                                                                                                <img src="training.png"
                                                                                                    alt="">
                                                                                            </div>

                                                                                            <div
                                                                                                class="font-weight-bold me-3">
                                                                                                <div class="text-truncate"><b>DAILY RUNDOWN: WEDNESDAY</b></div>
                                                                                                <div class="small">
                                                                                                    Income tax sops on
                                                                                                    the cards, The bias
                                                                                                    in VC funding, and
                                                                                                    other top
                                                                                                    news for you</div>
                                                                                            </div>
                                                                                            <span
                                                                                                class="ms-auto mb-auto">
                                                                                                <div class="btn-group">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn btn-light btn-sm rounded"
                                                                                                        data-toggle="dropdown"
                                                                                                        aria-haspopup="true"
                                                                                                        aria-expanded="false">
                                                                                                        <i
                                                                                                            class="mdi mdi-dots-vertical"></i>
                                                                                                    </button>
                                                                                                    <div
                                                                                                        class="dropdown-menu dropdown-menu-right">
                                                                                                        <button
                                                                                                            class="dropdown-item"
                                                                                                            type="button"><i
                                                                                                                class="mdi mdi-delete"></i>
                                                                                                            Delete</button>
                                                                                                        <button
                                                                                                            class="dropdown-item"
                                                                                                            type="button"><i
                                                                                                                class="mdi mdi-close"></i>
                                                                                                            Turn
                                                                                                            Off</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br />
                                                                                                <div
                                                                                                    class="text-right text-muted pt-1">
                                                                                                    3d</div>
                                                                                            </span>

                                                                                        </div>
                                                                                        <!-- Training Notification finish -->

                                                                                        <!-- Job Notification Start -->
                                                                                        <div
                                                                                            class="my-1 p-3 d-flex align-items-center bg-light border-bottom osahan-post-header">
                                                                                            <div
                                                                                                class="dropdown-list-image me-3">
                                                                                                <!-- <img class="rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt /> -->
                                                                                                <img src="job.png"
                                                                                                    alt="">
                                                                                            </div>

                                                                                            <div
                                                                                                class="font-weight-bold me-3">
                                                                                                <div class="text-truncate"><b>DAILY RUNDOWN: WEDNESDAY</b></div>
                                                                                                <div class="small">
                                                                                                    Income tax sops on
                                                                                                    the cards, The bias
                                                                                                    in VC funding, and
                                                                                                    other top
                                                                                                    news for you</div>
                                                                                            </div>
                                                                                            <span
                                                                                                class="ms-auto mb-auto">
                                                                                                <div class="btn-group">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn btn-light btn-sm rounded"
                                                                                                        data-toggle="dropdown"
                                                                                                        aria-haspopup="true"
                                                                                                        aria-expanded="false">
                                                                                                        <i
                                                                                                            class="mdi mdi-dots-vertical"></i>
                                                                                                    </button>
                                                                                                    <div
                                                                                                        class="dropdown-menu dropdown-menu-right">
                                                                                                        <button
                                                                                                            class="dropdown-item"
                                                                                                            type="button"><i
                                                                                                                class="mdi mdi-delete"></i>
                                                                                                            Delete</button>
                                                                                                        <button
                                                                                                            class="dropdown-item"
                                                                                                            type="button"><i
                                                                                                                class="mdi mdi-close"></i>
                                                                                                            Turn
                                                                                                            Off</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br />
                                                                                                <div
                                                                                                    class="text-right text-muted pt-1">
                                                                                                    3d</div>
                                                                                            </span>

                                                                                        </div>
                                                                                        <!-- Job Notification finish -->

                                                                                        <!-- Student dropout wait Notification Start -->
                                                                                        <div
                                                                                            class="my-1 p-3 d-flex align-items-center notifi-active-color border-bottom osahan-post-header">
                                                                                            <div
                                                                                                class="dropdown-list-image me-3">
                                                                                                <!-- <img class="rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt /> -->
                                                                                                <img src="dropout-wait.png"
                                                                                                    alt="">
                                                                                            </div>

                                                                                            <div
                                                                                                class="font-weight-bold me-3">
                                                                                                <div class="text-truncate"><b>DAILY RUNDOWN: WEDNESDAY</b></div>
                                                                                                <div class="small">
                                                                                                    Income tax sops on
                                                                                                    the cards, The bias
                                                                                                    in VC funding, and
                                                                                                    other top
                                                                                                    news for you</div>
                                                                                            </div>
                                                                                            <span
                                                                                                class="ms-auto mb-auto">
                                                                                                <div class="btn-group">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn btn-light btn-sm rounded"
                                                                                                        data-toggle="dropdown"
                                                                                                        aria-haspopup="true"
                                                                                                        aria-expanded="false">
                                                                                                        <i
                                                                                                            class="mdi mdi-dots-vertical"></i>
                                                                                                    </button>
                                                                                                    <div
                                                                                                        class="dropdown-menu dropdown-menu-right">
                                                                                                        <button
                                                                                                            class="dropdown-item"
                                                                                                            type="button"><i
                                                                                                                class="mdi mdi-delete"></i>
                                                                                                            Delete</button>
                                                                                                        <button
                                                                                                            class="dropdown-item"
                                                                                                            type="button"><i
                                                                                                                class="mdi mdi-close"></i>Turn
                                                                                                            Off</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br />
                                                                                                <div
                                                                                                    class="text-right text-muted pt-1">
                                                                                                    3d</div>
                                                                                            </span>

                                                                                        </div>
                                                                                        <!-- Student dropout wait Notification finish -->

                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="box shadow-sm rounded bg-white border border-1 mb-3">
                                                                                    <div
                                                                                        class="box-title border-bottom p-3">
                                                                                        <h6 class="m-0">Yesterday</h6>
                                                                                    </div>
                                                                                    <div class="box-body p-0">

                                                                                        <!-- Attendents Notification Start -->
                                                                                        <div
                                                                                            class="my-1 p-3 d-flex align-items-center bg-light border-bottom osahan-post-header">
                                                                                            <div
                                                                                                class="dropdown-list-image me-3">
                                                                                                <!-- <img class="rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt /> -->
                                                                                                <img src="attendens.png"
                                                                                                    alt="">
                                                                                            </div>

                                                                                            <div
                                                                                                class="font-weight-bold me-3">
                                                                                                <div class="text-truncate"><b>DAILY RUNDOWN: WEDNESDAY</b></div>
                                                                                                <div class="small">
                                                                                                    Income tax sops on
                                                                                                    the cards, The bias
                                                                                                    in VC funding, and
                                                                                                    other top
                                                                                                    news for you</div>
                                                                                            </div>
                                                                                            <span
                                                                                                class="ms-auto mb-auto">
                                                                                                <div class="btn-group">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn btn-light btn-sm rounded"
                                                                                                        data-toggle="dropdown"
                                                                                                        aria-haspopup="true"
                                                                                                        aria-expanded="false">
                                                                                                        <i
                                                                                                            class="mdi mdi-dots-vertical"></i>
                                                                                                    </button>
                                                                                                    <div
                                                                                                        class="dropdown-menu dropdown-menu-right">
                                                                                                        <button
                                                                                                            class="dropdown-item"
                                                                                                            type="button"><i
                                                                                                                class="mdi mdi-delete"></i>
                                                                                                            Delete</button>
                                                                                                        <button
                                                                                                            class="dropdown-item"
                                                                                                            type="button"><i
                                                                                                                class="mdi mdi-close"></i>
                                                                                                            Turn
                                                                                                            Off</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br />
                                                                                                <div
                                                                                                    class="text-right text-muted pt-1">
                                                                                                    3d</div>
                                                                                            </span>

                                                                                        </div>
                                                                                        <!-- Attendents Notification finish -->

                                                                                        <!-- Training Notification Start -->
                                                                                        <div
                                                                                            class="my-1 p-3 d-flex align-items-center bg-light border-bottom osahan-post-header">
                                                                                            <div
                                                                                                class="dropdown-list-image me-3">
                                                                                                <!-- <img class="rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt /> -->
                                                                                                <img src="training.png"
                                                                                                    alt="">
                                                                                            </div>

                                                                                            <div
                                                                                                class="font-weight-bold me-3">
                                                                                                <div class="text-truncate"><b>DAILY RUNDOWN: WEDNESDAY</b></div>
                                                                                                <div class="small">
                                                                                                    Income tax sops on
                                                                                                    the cards, The bias
                                                                                                    in VC funding, and
                                                                                                    other top
                                                                                                    news for you</div>
                                                                                            </div>
                                                                                            <span
                                                                                                class="ms-auto mb-auto">
                                                                                                <div class="btn-group">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn btn-light btn-sm rounded"
                                                                                                        data-toggle="dropdown"
                                                                                                        aria-haspopup="true"
                                                                                                        aria-expanded="false">
                                                                                                        <i
                                                                                                            class="mdi mdi-dots-vertical"></i>
                                                                                                    </button>
                                                                                                    <div
                                                                                                        class="dropdown-menu dropdown-menu-right">
                                                                                                        <button
                                                                                                            class="dropdown-item"
                                                                                                            type="button"><i
                                                                                                                class="mdi mdi-delete"></i>
                                                                                                            Delete</button>
                                                                                                        <button
                                                                                                            class="dropdown-item"
                                                                                                            type="button"><i
                                                                                                                class="mdi mdi-close"></i>
                                                                                                            Turn
                                                                                                            Off</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br />
                                                                                                <div
                                                                                                    class="text-right text-muted pt-1">
                                                                                                    3d</div>
                                                                                            </span>

                                                                                        </div>
                                                                                        <!-- Training Notification finish -->

                                                                                        <!-- Job Notification Start -->
                                                                                        <div
                                                                                            class="my-1 p-3 d-flex align-items-center bg-light border-bottom osahan-post-header">
                                                                                            <div
                                                                                                class="dropdown-list-image me-3">
                                                                                                <!-- <img class="rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt /> -->
                                                                                                <img src="job.png"
                                                                                                    alt="">
                                                                                            </div>

                                                                                            <div
                                                                                                class="font-weight-bold me-3">
                                                                                                <div class="text-truncate"><b>DAILY RUNDOWN: WEDNESDAY</b></div>
                                                                                                <div class="small">
                                                                                                    Income tax sops on
                                                                                                    the cards, The bias
                                                                                                    in VC funding, and
                                                                                                    other top
                                                                                                    news for you</div>
                                                                                            </div>
                                                                                            <span
                                                                                                class="ms-auto mb-auto">
                                                                                                <div class="btn-group">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn btn-light btn-sm rounded"
                                                                                                        data-toggle="dropdown"
                                                                                                        aria-haspopup="true"
                                                                                                        aria-expanded="false">
                                                                                                        <i
                                                                                                            class="mdi mdi-dots-vertical"></i>
                                                                                                    </button>
                                                                                                    <div
                                                                                                        class="dropdown-menu dropdown-menu-right">
                                                                                                        <button
                                                                                                            class="dropdown-item"
                                                                                                            type="button"><i
                                                                                                                class="mdi mdi-delete"></i>
                                                                                                            Delete</button>
                                                                                                        <button
                                                                                                            class="dropdown-item"
                                                                                                            type="button"><i
                                                                                                                class="mdi mdi-close"></i>
                                                                                                            Turn
                                                                                                            Off</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br />
                                                                                                <div
                                                                                                    class="text-right text-muted pt-1">
                                                                                                    3d</div>
                                                                                            </span>

                                                                                        </div>
                                                                                        <!-- Job Notification finish -->

                                                                                        <!-- Student dropout wait Notification Start -->
                                                                                        <div
                                                                                            class="my-1 p-3 d-flex align-items-center bg-light border-bottom osahan-post-header">
                                                                                            <div
                                                                                                class="dropdown-list-image me-3">
                                                                                                <!-- <img class="rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt /> -->
                                                                                                <img src="dropout-wait.png"
                                                                                                    alt="">
                                                                                            </div>

                                                                                            <div
                                                                                                class="font-weight-bold me-3">
                                                                                                <div class="text-truncate"><b>DAILY RUNDOWN: WEDNESDAY</b></div>
                                                                                                <div class="small">
                                                                                                    Income tax sops on
                                                                                                    the cards, The bias
                                                                                                    in VC funding, and
                                                                                                    other top
                                                                                                    news for you</div>
                                                                                            </div>
                                                                                            <span
                                                                                                class="ms-auto mb-auto">
                                                                                                <div class="btn-group">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn btn-light btn-sm rounded"
                                                                                                        data-toggle="dropdown"
                                                                                                        aria-haspopup="true"
                                                                                                        aria-expanded="false">
                                                                                                        <i
                                                                                                            class="mdi mdi-dots-vertical"></i>
                                                                                                    </button>
                                                                                                    <div
                                                                                                        class="dropdown-menu dropdown-menu-right">
                                                                                                        <button
                                                                                                            class="dropdown-item"
                                                                                                            type="button"><i
                                                                                                                class="mdi mdi-delete"></i>
                                                                                                            Delete</button>
                                                                                                        <button
                                                                                                            class="dropdown-item"
                                                                                                            type="button"><i
                                                                                                                class="mdi mdi-close"></i>Turn
                                                                                                            Off</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br />
                                                                                                <div
                                                                                                    class="text-right text-muted pt-1">
                                                                                                    3d</div>
                                                                                            </span>

                                                                                        </div>
                                                                                        <!-- Student dropout wait Notification finish -->

                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<!-- Main Content Ends Here-->

<?php include('./views/layouts/body-end.php') ?>
<script src='<?php echo getenv('BASE_URL') ?>/public/js/dashboard.js'></script>

<?php include('./views/layouts/end.php') ?>