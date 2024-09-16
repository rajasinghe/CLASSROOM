<?php include('./views/layouts/start.php') ?>

<?php include('./views/inc/base-css.php') ?>

<link rel='stylesheet' type='text/css' media='screen'
    href='<?php echo getenv('BASE_URL') ?>/public/css/registration/Form.css'>
<link rel='stylesheet' type='text/css' media='screen'
    href='<?php echo getenv('BASE_URL') ?>/public/css/registration/profileImage.css'>
<link rel="stylesheet" href="<?php echo getenv('BASE_URL') ?>/public/css/registration/button.css">
<link rel="stylesheet" href="<?php echo getenv('BASE_URL') ?>/public/css/registration/changeStatusForm.css">
<link rel="stylesheet" href="<?php echo getenv('BASE_URL') ?>/public/css/registration/changeStatusButton.css">
<link rel="stylesheet" href="<?php echo getenv('BASE_URL') ?>/public/css/registration/subButtonGroup.css">

<?php include('./views/layouts/body-start.php') ?>
<?php include('./views/inc/side-bar.php') ?>

<div class="col px-0">
    <div class="container-fluid" id="content-container">
        <div class="row">
            <div class="col-12 py-3 ">
                <span class="fw-medium ms-4 h6 ">
                    Student Details <i class="bi bi-chevron-compact-right"></i> 2024-SD-01
                </span>
            </div>

            <div class="col-12 pt-4 pb-4 px-0 px-md-4" id="profile-container">
                <div class="d-flex align-items-center">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-12 px-0 site-card">
                                <div class="card rounded-0 border-0 shadow">
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-12 d-flex align-items-center ps-0">
                                                    <h4 class="fs-4 my-0">
                                                        STUDENT DETAILS
                                                    </h4>
                                                </div>
                                                <div class="col-12 px-0 ">
                                                    <hr>
                                                </div>

                                                <div class="col-12 container-fluid px-0">
                                                    <div class="row">
                                                        <div class="col-lg-5 center">
                                                            <img src="<?php echo getenv('BASE_URL') ?>/{{ profile_img_url }}"
                                                                alt="Profile picture"
                                                                class="proPic card-body shadow mt-3 ">
                                                        </div>
                                                        <div class="col-lg-7 p-4 pb-0 ">

                                                            <div class="row mb-3 ">
                                                                <div class="col-3">
                                                                    <span class="bold">Name</span>
                                                                </div>
                                                                <div class="col-1">
                                                                    :</div>
                                                                <div class="col-lg-8">
                                                                    {{ initials }} {{ last_name }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <span class="bold">NIC</span>
                                                                </div>
                                                                <div class="col-1">
                                                                    :</div>
                                                                <div class="col-lg-8">
                                                                    {{ nic }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <span class="bold">Status</span>
                                                                </div>
                                                                <div class="col-1">
                                                                    :</div>
                                                                <div class="col-sm-8">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            {{ student_status }}
                                                                        </div>
                                                                        <div class="col">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="" style="right:30px">
                                                                                <button
                                                                                    class="sts-chng-btn border-0  rounded-1 text-nowrap"
                                                                                    onclick="document.getElementById('id01').style.display='block'"
                                                                                    style="width:auto;">Change
                                                                                    Status
                                                                                </button>

                                                                                <!-- Add change status form -->
                                                                                <div id="id01" class="modal">
                                                                                    <form class="modal-content animate">
                                                                                        <span
                                                                                            onclick="document.getElementById('id01').style.display='none'"
                                                                                            class="close"
                                                                                            title="Close Modal">&times;
                                                                                        </span>
                                                                                        <label for="uname">
                                                                                            <span
                                                                                                class="text-nowrap bold">
                                                                                                <center>
                                                                                                    Status
                                                                                                </center>
                                                                                            </span>
                                                                                        </label>
                                                                                        <div class="container">
                                                                                            <select id="status">
                                                                                                <option value="Active">
                                                                                                    Active
                                                                                                </option>
                                                                                                <option
                                                                                                    value="Inactive">
                                                                                                    Inactive
                                                                                                </option>
                                                                                                <option value="Dropout">
                                                                                                    Dropout
                                                                                                </option>
                                                                                            </select>
                                                                                            <div id="dropout-reason"
                                                                                                class="dropout-status d-none">
                                                                                                <label for="">Dropout
                                                                                                    Date
                                                                                                </label>
                                                                                                <input type="date">
                                                                                                <label for="">Reason
                                                                                                </label>
                                                                                                <input type="text">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="container"
                                                                                            style="background-color:#f1f1f1">
                                                                                            <center>
                                                                                                <button
                                                                                                    class="changeFormBtn"
                                                                                                    type="button">Update</button>
                                                                                                <button
                                                                                                    class="cancelbtn"
                                                                                                    type="button"
                                                                                                    onclick="document.getElementById('id01').style.display='none'">
                                                                                                    Cancel
                                                                                                </button>
                                                                                            </center>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <!-- end of the Status form -->

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <span class="bold">MIS</span>
                                                                </div>
                                                                <div class="col-1">
                                                                    :</div>
                                                                <div class="col-sm-8">
                                                                    {{ mis }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-3">
                                                                    <span class="bold">Batch</span>
                                                                </div>
                                                                <div class="col-1">
                                                                    :</div>
                                                                <div class="col-sm-8">
                                                                    {{ batch_name }}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Extra Details Section Start -->
                                                <div class="col-12 container-fluid" id="profile-content-container">
                                                    
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

<?php include('./views/layouts/body-end.php') ?>

<script type="module" src="<?php echo getenv('BASE_URL') ?>/public/js/registration/registrationRouter.js"></script>

<?php include('./views/layouts/end.php') ?>