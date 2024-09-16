<?php include('./views/layouts/start.php') ?>

<?php include('./views/inc/base-css.php') ?>

<link rel='stylesheet' type='text/css' media='screen'
    href='<?php echo getenv('BASE_URL') ?>/public/css/registration/Form.css'>
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
                    2024-SD-01</span>
            </div>
            <!--Site Header section end-->


            <div class="col-12 d-flex pt-4">
                <span class="ms-auto me-md-2" id="content-nav">
                    <a href="/batch/<?php echo $batchId; ?>/applicant"
                        class="btn border-danger rounded-1 mb-2 active">Back to Batch Details</a>
                </span>
            </div>

            <!-- Applicant Detail start-->
            <div class="col-12 pt-4 pb-4 px-md-4 floating-column">
                <div class="d-flex align-items-center floating-scroll">
                    <div class="container-fluid floatin-container">
                        <div class="row justify-content-center">
                            <div class="col-12 px-0 site-card">
                                <div class="card rounded-0 border-0 shadow">
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-12 px-0 px-md-3 align-items-center">
                                                    <form id="applicant_form" name="applicant_form" class="site-form my-3 mx-lg-1">
                                                        <div class="row mx-0">
                                                            <div class="col-12 px-0">
                                                                <h5 class="card-header text-center py-2 cardHead rounded-0">
                                                                    Add Applicant Details
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="row mx-0 px-2 px-lg-4 pt-2 mt-4">
                                                            <div class="col-12 mb-3">
                                                                <label class="text">National
                                                                    Identity Card Number
                                                                    :</label>
                                                                
                                                                <div class="d-flex">
                                                                    <input type="text" class="form-control input me-4" name="nic"
                                                                        id="nic_Applicant" placeholder="NIC">

                                                                    <button type="button" id="searchButton" class="btn btn-danger">Search</button>
                                                                </div>

                                                                <div>
                                                                    <label for="nic_Applicant" id="Labelnic_Applicant"></label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mx-0 px-2 px-lg-4 collapse" id="additional-content">

                                                            <div class="col-12 mb-3">
                                                                <label for="name_Applicant" class="text">Name :</label>
                                                                <input type="text" class="form-control input"
                                                                    name="applicant_name" id="name_Applicant"
                                                                    placeholder="Applicant Name">
                                                                <div>
                                                                    <label for="name_Applicant" id="Labelname_Applicant"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mb-3">
                                                                <label for="address_Applicant" class="text">Address
                                                                    :</label>
                                                                <textarea id="address_Applicant" class="form-control input"
                                                                    name="address" rows="5" cols="21"
                                                                    placeholder="Address"></textarea>
                                                                <div>
                                                                    <label for="address_Applicant" id="Labeladdress_Applicant"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mb-3">
                                                                <label class="text">Telephone
                                                                    Number :</label>
                                                                <input type="text" class="form-control input"
                                                                    name="mobile_no" id="telMobile_Applicant"
                                                                    placeholder="Mobile Number">
                                                                <div>
                                                                    <label for="" id="LabeltelMobile_Applicant"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mb-3">
                                                                <input type="text" class="form-control input"
                                                                    name="whatsapp_no" id="telWhatsapp_Applicant"
                                                                    placeholder="Whatsapp Number">
                                                                <div>
                                                                    <label for="telWhatsapp_Applicant" id="LabeltelWhatsapp_Applicant"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mb-3">
                                                                <input type="text" class="form-control input"
                                                                    name="landline_no" id="telLand_Applicant"
                                                                    placeholder="Land Line Number">
                                                                <div>
                                                                    <label for="telLand_Applicant" id="LabeltelLand_Applicant"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-md-6 mb-3">
                                                                <label class="text">Date of
                                                                    Birth :
                                                                </label>
                                                                <input type="date" class="form-control input" name="dob"
                                                                    id="dobirth_Applicant">
                                                                <div>
                                                                    <label for="dobirth_Applicant" id="Labeldobirth_Applicant"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-md-6 mb-3 ps-md-4">
                                                                <label class="text">
                                                                    Gender :
                                                                </label>
                                                                <div class="py-2">
                                                                    <input class="form-check-input me-2" type="radio"
                                                                        name="gender" id="gender_ApplicantM" value="Male">
                                                                    <label class="me-2">
                                                                        Male
                                                                    </label>
                                                                    <input class="form-check-input me-2" type="radio"
                                                                        name="gender" id="gender_ApplicantF" value="Female">
                                                                    <label class="me-2">
                                                                        Female
                                                                    </label>
                                                                </div>
                                                                <div>
                                                                    <label for="gender_ApplicantF" id="Labelgender_Applicant"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mb-4">
                                                                <label class="text">
                                                                    Guardian's Details :
                                                                </label>
                                                                <div class="border ps-4 pe-4">
                                                                    <br>
                                                                    <label for="GuardianName" class="textB">Name
                                                                        :
                                                                    </label>
                                                                    <input type="text" class="form-control input "
                                                                        name="guardian" id="guardianName_Applicant"
                                                                        placeholder="Guardian's Name">
                                                                    <div>
                                                                        <label for=""
                                                                            id="LabelguardianName_Applicant"></label>
                                                                    </div>
                                                                    <br>
                                                                    <label for="GuardianTelNu" class="textB">Telephone
                                                                        Number :
                                                                    </label>
                                                                    <input type="text" class="form-control input"
                                                                        name="guardian_tpno" id="guardianNumber_Applicant"
                                                                        placeholder="Guardian's Tel. Number">
                                                                    <div>
                                                                        <label for=""
                                                                            id="LabelguardianNumber_Applicant"></label>
                                                                    </div>
                                                                    <br>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mb-4">
                                                                <label class="text">Education
                                                                    Qualification :
                                                                </label>
                                                                <br>
                                                                <input class="form-check-input education-radio"
                                                                    name="highest_educational_qualification" type="radio"
                                                                    value="Up to OL" id="educationqualification_Applicant">
                                                                <label class="me-2"> Up to
                                                                    G.C.E(O/L)
                                                                </label>
                                                                <input class="form-check-input education-radio"
                                                                    name="highest_educational_qualification" type="radio"
                                                                    value="Up to AL" id="educationqualification_Applicant1">
                                                                <label class="me-2"> Up to
                                                                    G.C.E(A/L)</label>
                                                                <input class="form-check-input education-radio"
                                                                    name="highest_educational_qualification" type="radio"
                                                                    value="Up to Grade 9"
                                                                    id="educationqualification_Applicant2">
                                                                <label class="me-2"> Up to Grade
                                                                    09
                                                                </label>
                                                                <div>
                                                                    <label for=""
                                                                        id="Labeleducationqualification_Applicant"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mb-4">
                                                                <button type="button" id="addButton"
                                                                    class="btn btn-danger me-2">
                                                                    Add Applicant
                                                                </button>
                                                                <button type="button" id="updateButton"
                                                                    class="btn btn-danger me-2 d-none">Save
                                                                    Changes
                                                                </button>
                                                                <button type="reset" id="clearButton"
                                                                    class="btn btn-outline-danger me-2">
                                                                    Reset
                                                                </button>
                                                                <button class="btn btn-outline-secondary" type="button"
                                                                    id="backButton">Back
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
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

<script src="<?php echo getenv('BASE_URL') ?>/public/js/registration/addAplicantDetail.js"></script>

<?php include('./views/layouts/end.php') ?>