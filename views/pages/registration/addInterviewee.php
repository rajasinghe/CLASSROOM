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
                <span class="fw-medium ms-4">
                    Student Details <i class="bi bi-chevron-compact-right"></i>
                    2024-SD-01
                </span>
            </div>

            <div class="col-12 d-flex pt-4">
                <span class="ms-auto me-md-2" id="content-nav">
                    <a href="/batch/<?php echo $batchId; ?>/interview" class="btn border-danger rounded-1 mb-2 active">Back to Batch Details</a>
                </span>
            </div>

            <div class="col-12 pt-4 pb-4 px-md-4">
                <div class="d-flex align-items-center">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-12 px-0 site-card">
                                <div class="card rounded-0 border-0 shadow">
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-12 px-0 px-md-3 align-items-center">
                                                    <form id="interviewee_form" name="form" class="site-form my-3 mx-lg-1">
                                                        <div class="row mx-0">
                                                            <div class="col-12 px-0">
                                                                <h5 class="card-header text-center py-2 cardHead rounded-0">
                                                                    Add Interview Details
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="row mx-0 px-2 pt-4 pb-3">
                                                            <div class="col-12 col-lg-6 mb-3" data-type="student">
                                                                <label for="name_Applicant" class="text">
                                                                    Initials:
                                                                    <span class="text-danger ms-1 fs-5 tooltip-element" data-message="This field is required">*</span>
                                                                </label>
                                                                <input type="text" class="form-control input" name="initials" id="initials_Interview" placeholder="Trainee's Name with initials">
                                                                <div>
                                                                    <label for="initials_interview" id="lNameInt"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-lg-6 mb-3" data-type="student">
                                                                <label for="lastNameField" class="text">
                                                                    Last Name : <span class="text-danger ms-1 fs-5">*</span>
                                                                </label>
                                                                <input type="text" class="form-control input" name="last_name" id="last_name_Interview" placeholder="Last Name">
                                                                <div>
                                                                    <label for="last_name_Interview" id="lastNameError"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mb-3" data-type="student">
                                                                <label for="name_Interview" class="text">
                                                                    First Name : <span class="text-danger ms-1 fs-5">*</span>
                                                                </label>
                                                                <input type="text" class="form-control input" name="first_name" id="first_name_Interview" placeholder="Full name before the last name">
                                                                <div>
                                                                    <label for="first_name_Interview" id="firstNameError"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mb-3" data-type="student">
                                                                <label for="address_Applicant" class="text">
                                                                    Address : <span class="text-danger ms-1 fs-5">*</span>
                                                                </label>
                                                                <textarea id="address_Interview" class="form-control input" name="address" rows="5" cols="21" placeholder="Address"></textarea>
                                                                <div>
                                                                    <label for="address_Interview" id="lAddress"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-lg-6 mb-3" data-type="student">
                                                                <label class="text">
                                                                    Date of Birth : <span class="text-danger ms-1 fs-5">*</span>
                                                                </label>
                                                                <input type="date" class="form-control input" name="dob" id="dobirth_Interview" required>
                                                                <div>
                                                                    <label for="dobirth_Interview" id="lDob"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-lg-6 mb-3" data-type="student">
                                                                <label class="text">
                                                                    Gender : <span class="text-danger ms-1 fs-5">*</span>
                                                                </label>

                                                                <div class="ps-4">
                                                                    <input class="form-check-input ps-2 gender-radio" name="gender" value="Male" type="radio" id="maleRadio">
                                                                    <label class="me-4"> Male </label>

                                                                    <input class="form-check-input ps-2 gender-radio" name="gender" value="Female" type="radio" id="femaleRadio">
                                                                    <label class="me-4"> Female </label>
                                                                    <div>
                                                                        <label for="" id="lGender"></label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mb-3" data-type="student">
                                                                <label class="text">
                                                                    National Identity Card Number : <span class="text-danger ms-1 fs-5">*</span>
                                                                </label>
                                                                <input type="text" class="form-control input" name="nic" id="nic_Interview" placeholder="Example : 802000300V / 200010902284">
                                                                <div>
                                                                    <label for="" id="lID"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mb-3" data-type="student">
                                                                <label class="text">
                                                                    Contact Information :
                                                                </label>
                                                                <input type="text" class="form-control input" name="mobile_no" id="telMobile_Interview" placeholder="Mobile Number">
                                                                <div>
                                                                    <label for="" id="lMobile"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-lg-6 mb-3" data-type="student">
                                                                <input type="text" class="form-control input" name="whatsapp_no" id="telWhatsapp_Interview" placeholder="Whatsapp Number">
                                                                <div>
                                                                    <label for="" id="lWMobile"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-lg-6 mb-3" data-type="student">
                                                                <input type="text" class="form-control input" name="landline_no" id="telLand_Interview" placeholder="Land Line Number">
                                                                <div>
                                                                    <label for="" id="lLand"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mb-3" data-type="student">
                                                                <label class="text">
                                                                    Email Address :
                                                                </label>
                                                                <input type="email" class="form-control input" name="email" id="email_Interview" placeholder="Email Address">
                                                                <div>
                                                                    <label for="" id="lEmail"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mb-3">
                                                                <label class="text">
                                                                    Application Catogary : <span class="text-danger ms-1 fs-5">*</span>
                                                                </label>

                                                                <div class="ps-4">
                                                                    <input class="form-check-input ps-2 category-radio" type="radio" value="General" name="application_catogary">
                                                                    <label class="me-4">
                                                                        Genaral
                                                                    </label>

                                                                    <input class="form-check-input ps-2 category-radio" type="radio" value="Civil Balakaya" name="application_catogary">
                                                                    <label class="me-4">
                                                                        Civil Balakaya
                                                                    </label>

                                                                    <input class="form-check-input ps-2 category-radio" type="radio" value="SL Army" name="application_catogary">
                                                                    <label class="me-4">
                                                                        SL Army
                                                                    </label>

                                                                    <input class="form-check-input ps-2 category-radio" type="radio" value="Youth-Corp" name="application_catogary">
                                                                    <label class="me-4">
                                                                        Youth-Corp
                                                                    </label>

                                                                    <input class="form-check-input ps-2 category-radio" type="radio" value="13 Plus" name="application_catogary">
                                                                    <label class="me-4">
                                                                        13 plus
                                                                    </label>

                                                                    <input class="form-check-input ps-2 category-radio" type="radio" value="Other" name="application_catogary">
                                                                    <label class="me-4">
                                                                        Other
                                                                    </label>
                                                                    <div>
                                                                        <label for="" id="lCategory"></label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mb-3" data-type="student">
                                                                <label class="text">
                                                                    Residence :
                                                                </label>
                                                                <div class="container-fluid">
                                                                    <div class="row border py-3 px-3">
                                                                        <div class="col-12 col-lg-6 mb-2">
                                                                            <label class="textB" for="District">
                                                                                District :
                                                                            </label>
                                                                            <input type="text" class="form-control input" name="district" id="District_Interview" placeholder="District">
                                                                            <div>
                                                                                <label for="District_Interview" id="lDistric"></label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-lg-6 mb-2">
                                                                            <label class="textB" for="District">
                                                                                Divitional Secretariant :
                                                                            </label>
                                                                            <input type="text" class="form-control input " name="divisional_secretariant" id="DivitionalSec_Interview" placeholder="Divitional Secretariant">
                                                                            <div>
                                                                                <label for="lDivition" id="lDivition"></label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <label class="textB" for="District">Grama
                                                                                Sewa Divition :
                                                                            </label>
                                                                            <input type="text" class="form-control input " name="grama_sewa_division" id="GramaSewaDiv_Interview" placeholder="Grama Sewa Divition">
                                                                            <div>
                                                                                <label for="" id="lGramasewa"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Result Selection -->

                                                            <div class="col-12 mb-3">
                                                                <label class="text">
                                                                    Result :
                                                                </label>
                                                                <div class="p-4 border">
                                                                    <label class="textB mb-2">
                                                                        G.C.E.(O/L) Result :
                                                                    </label>

                                                                    <div class="container-fluid">
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <label class="ms-1 me-1">
                                                                                    English
                                                                                </label>
                                                                                <select name="ResultOlevelEng" class="form-control form-select" id="olEnglishField" name="english_ol">
                                                                                    <option value="none">
                                                                                        Result
                                                                                    </option>
                                                                                    <option value="A">
                                                                                        A
                                                                                    </option>
                                                                                    <option value="B">
                                                                                        B
                                                                                    </option>
                                                                                    <option value="C">
                                                                                        C
                                                                                    </option>
                                                                                    <option value="S">
                                                                                        S
                                                                                    </option>
                                                                                    <option value="W">
                                                                                        W
                                                                                    </option>
                                                                                </select>
                                                                                <label for="" id="lEngO"></label>
                                                                            </div>

                                                                            <div class="col">
                                                                                <label class="ms-1 me-1">
                                                                                    Maths
                                                                                </label>
                                                                                <select name="ResultOlevelMaths" class="form-control form-select" id="olMathsField" name="maths_ol">
                                                                                    <option value="none">
                                                                                        Result
                                                                                    </option>
                                                                                    <option value="A">
                                                                                        A
                                                                                    </option>
                                                                                    <option value="B">
                                                                                        B
                                                                                    </option>
                                                                                    <option value="C">
                                                                                        C
                                                                                    </option>
                                                                                    <option value="S">
                                                                                        S
                                                                                    </option>
                                                                                    <option value="W">
                                                                                        W
                                                                                    </option>
                                                                                </select>
                                                                                <label for="" id="lMathsO"></label>
                                                                            </div>

                                                                            <div class="col">
                                                                                <label class="ms-1 me-1">
                                                                                    Science
                                                                                </label>
                                                                                <select name="Result_Interviews" class="form-control form-select" id="olScienceField" name="science_ol">
                                                                                    <option value="none">
                                                                                        Result
                                                                                    </option>
                                                                                    <option value="A">
                                                                                        A
                                                                                    </option>
                                                                                    <option value="B">
                                                                                        B
                                                                                    </option>
                                                                                    <option value="C">
                                                                                        C
                                                                                    </option>
                                                                                    <option value="S">
                                                                                        S
                                                                                    </option>
                                                                                    <option value="W">
                                                                                        W
                                                                                    </option>
                                                                                </select>
                                                                                <label for="" id="lscienOlevel"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <label class="textB mt-4 mb-2">
                                                                        G.C.E. (A/L) Result :
                                                                    </label>

                                                                    <div class="container-fluid">
                                                                        <div class="row mb-3 ">
                                                                            <div class="col-12 col-lg-2 d-flex align-self-center justify-content-center justify-content-lg-start  ">
                                                                                <label for="stream" class="text-end ">Stream &emsp;:</label>
                                                                            </div>
                                                                            <div class="col-12 col-lg-10 d-flex justify-content-center justify-content-lg-start">
                                                                                <select name="stream" id="stream" class="form-control form-select w-25 ">
                                                                                    <option value="none" selected>
                                                                                        Select Stream
                                                                                    </option>
                                                                                    <option value="Maths">
                                                                                        Maths
                                                                                    </option>
                                                                                    <option value="Science">
                                                                                        Science
                                                                                    </option>
                                                                                    <option value="Commerce">
                                                                                        Commerce
                                                                                    </option>
                                                                                    <option value="Technology">
                                                                                        Technology
                                                                                    </option>
                                                                                    <option value="Arts">
                                                                                        Arts
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <input type="text" class="form-control input mb-2" name="subject1_name_al" id="ALSubject01_Interview" placeholder="Subject01">
                                                                                <select name="subject1_result_al" class="form-control form-select" id="ALSubject01Marks_Interview">
                                                                                    <option value="none">
                                                                                        Result
                                                                                    </option>
                                                                                    <option value="A">
                                                                                        A
                                                                                    </option>
                                                                                    <option value="B">
                                                                                        B
                                                                                    </option>
                                                                                    <option value="C">
                                                                                        C
                                                                                    </option>
                                                                                    <option value="S">
                                                                                        S
                                                                                    </option>
                                                                                    <option value="W">
                                                                                        W
                                                                                    </option>
                                                                                </select>
                                                                                <label for="" id="LSubjectOne"></label>
                                                                            </div>

                                                                            <div class="col">
                                                                                <input type="text" class="form-control input mb-2" name="subject2_name_al" id="ALSubject02_Interview" placeholder="Subject02">
                                                                                <select name="subject2_result_al" class="form-control form-select" id="ALSubject02Marks_Interview">
                                                                                    <option value="none">
                                                                                        Result
                                                                                    </option>
                                                                                    <option value="A">
                                                                                        A
                                                                                    </option>
                                                                                    <option value="B">
                                                                                        B
                                                                                    </option>
                                                                                    <option value="C">
                                                                                        C
                                                                                    </option>
                                                                                    <option value="S">
                                                                                        S
                                                                                    </option>
                                                                                    <option value="W">
                                                                                        W
                                                                                    </option>
                                                                                </select>
                                                                                <label for="" id="LSubjectTwo"></label>
                                                                            </div>

                                                                            <div class="col">
                                                                                <input type="text" class="form-control input mb-2" name="subject3_name_al" id="ALSubject03_Interview" placeholder="Subject03">
                                                                                <select name="subject3_result_al" class="form-control form-select" id="ALSubject03Marks_Interview">
                                                                                    <option value="none">
                                                                                        Result
                                                                                    </option>
                                                                                    <option value="A">
                                                                                        A
                                                                                    </option>
                                                                                    <option value="B">
                                                                                        B
                                                                                    </option>
                                                                                    <option value="C">
                                                                                        C
                                                                                    </option>
                                                                                    <option value="S">
                                                                                        S
                                                                                    </option>
                                                                                    <option value="W">
                                                                                        W
                                                                                    </option>
                                                                                </select>
                                                                                <label for="" id="LSubjectThree"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!--Qualifications Section-->

                                                            <div class="col-12 mb-3">
                                                                <label class="text">
                                                                    Qualifications : <span class="text-danger ms-1 fs-5">*</span>
                                                                </label>
                                                                <!-- start -->
                                                                <div class="container-fluid border">

                                                                    <div class="row  pt-4 pb-3">
                                                                        <!-- Basic qualification -->

                                                                        <p class="text ps-4 mb-3">
                                                                            Education Qualification :
                                                                        </p>

                                                                        <div class="row" id="course-criteria-section">
                                                                            <!-- show relevent citerias for the course -->

                                                                            <div class="col-12 col-lg-6 mb-4 text-center  d-lg-flex justify-content-lg-evenly ">
                                                                                <div class="col-12 col-lg-8 align-self-center mb-2 mb-lg-0  ">
                                                                                    <label for="uptoo/l" class="me-2">Criteria 01</label>
                                                                                </div>
                                                                                <div class=" col-12 col-lg-4 align-self-center d-flex justify-content-center ">
                                                                                    <input type="number" min="0" max="60" class=" form-control w-50" placeholder="marks">
                                                                                </div>
                                                                            </div>


                                                                            <div class="col-12 col-lg-6 mb-4 text-center  d-lg-flex justify-content-lg-evenly ">
                                                                                <div class="col-12 col-lg-8 align-self-center mb-2 mb-lg-0  ">
                                                                                    <label for="uptoo/l" class="me-2">col-12 col-lg-4 align-self-center mb-2 mb-lg-0 border col-12 col-lg-4 align-self-center mb-2 mb-lg-0 border </label>
                                                                                </div>
                                                                                <div class=" col-12 col-lg-4 align-self-center d-flex justify-content-center ">
                                                                                    <input type="number" min="0" max="60" class=" form-control w-50" placeholder="marks">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12 col-lg-6 mb-4 text-center  d-lg-flex justify-content-lg-evenly ">
                                                                                <div class="col-12 col-lg-8 align-self-center mb-2 mb-lg-0  ">
                                                                                    <label for="uptoo/l" class="me-2">col-12 col-lg-4 align-self-center mb-2 mb-lg-0 border col-12 col-lg-4 align-self-center mb-2 mb-lg-0 border </label>
                                                                                </div>
                                                                                <div class=" col-12 col-lg-4 align-self-center d-flex justify-content-center ">
                                                                                    <input type="number" min="0" max="60" class=" form-control w-50" placeholder="marks">
                                                                                </div>
                                                                            </div>


                                                                            <div class="col-12 col-lg-6 mb-4 text-center  d-lg-flex justify-content-lg-evenly ">
                                                                                <div class="col-12 col-lg-8 align-self-center mb-2 mb-lg-0  ">
                                                                                    <label for="uptoo/l" class="me-2">Criteria 01</label>
                                                                                </div>
                                                                                <div class=" col-12 col-lg-4 align-self-center d-flex justify-content-center ">
                                                                                    <input type="number" min="0" max="60" class=" form-control w-50" placeholder="marks">
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <!-- Special qualification -->
                                                                        <div class="row">
                                                                            <label class="text ps-4 mb-3">
                                                                                Special Qualification :
                                                                            </label>

                                                                            <div class="col-12 col-lg-6 mb-4 text-center  d-lg-flex justify-content-lg-evenly">
                                                                                <div class="col-12 col-lg-8 align-self-center mb-2 mb-lg-0 ">
                                                                                    <label for="Skill">
                                                                                        Own Skill(20 marks)
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-12 col-lg-4 align-self-center d-flex justify-content-center">
                                                                                    <input type="number" class="form-control input w-50 " name="own_skill" id="Own_Skills" min="0" max="20" placeholder="marks">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12 col-lg-6 mb-4 text-center  d-lg-flex justify-content-lg-evenly">
                                                                                <div class="col-12 col-lg-8 align-self-center mb-2 mb-lg-0 ">
                                                                                    <label for="DurationC1">
                                                                                        Job Enviroment(20 marks)
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-12 col-lg-4 align-self-center d-flex justify-content-center">
                                                                                    <input type="number" class="form-control input w-50 " name="job_environment" id="Job_Field" min="0" max="20" placeholder="marks">
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="row">

                                                                        </div>
                                                                    </div>
                                                                    <!-- Total marks -->
                                                                    <div class="row text-center  d-lg-flex justify-content-lg-evenly">
                                                                        <div class="col-12 col-lg-6 align-self-center ">
                                                                            <p class="text ps-4 mb-3 fs-5 ">
                                                                                Total Marks :
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-12 col-lg-6 d-flex justify-content-center">
                                                                            <p class="form-control fs-4 w-50 border-danger ">s</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end -->

                                                            </div>

                                                            <div class="col-12 mb-3">
                                                                <label class="text mb-2">
                                                                    Job Target :
                                                                </label>
                                                                <div class="ps-4">
                                                                    <input class="form-check-input me-2 job-target-radio" name="job_target" type="radio" value="local">
                                                                    <label class="me-4 "> Local </label>

                                                                    <input class="form-check-input me-2 job-target-radio" name="job_target" type="radio" value="foreign">
                                                                    <label class="me-4"> Foreign </label>

                                                                    <input class="form-check-input me-2 job-target-radio" name="job_target" type="radio" value="self">
                                                                    <label class="me-4"> Self </label>
                                                                </div>
                                                                <div>
                                                                    <label for="" id="ljob"></label>
                                                                </div>
                                                            </div>



                                                            <div class="col-12 col-lg-6 mb-3">
                                                                <label class="text">
                                                                    Course Awareness :
                                                                </label>
                                                                <input type="text" class="form-control input" name="course_awareness" id="CAwareness_Applicant" placeholder="Course Awareness">
                                                                <div>
                                                                    <label for="" id="LabelCAwareness_Applicant"></label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-lg-6 mb-3">
                                                                <label class="text ">
                                                                    Selection : <span class="text-danger ms-1 fs-5">*</span>
                                                                </label>
                                                                <div class="ms-4">
                                                                    <input class="form-check-input me-2 selection-radio" name="selection" value="y" type="radio">
                                                                    <label class="me-4">
                                                                        Yes
                                                                    </label>
                                                                    <input class="form-check-input me-2 selection-radio" name="selection" value="n" type="radio">
                                                                    <label class="me-4">
                                                                        No
                                                                    </label>

                                                                    <div>
                                                                        <label for="" id="lSelection"></label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mb-5">
                                                                <label class="text ">
                                                                    Remark :
                                                                </label>
                                                                <input class="form-control me-2" type="text" name="remarks" id="Remark_Applicant1" placeholder="Remark">
                                                            </div>

                                                            <div class="col-12 mb-3">
                                                                <button type="button" value="Submit" id="addButton" class="btn btn-danger me-2">Add Interviewee</button>
                                                                <button type="button" value="Submit" id="updateButton" class="btn btn-danger me-2 d-none">Save Changes</button>
                                                                <button class="btn btn-outline-danger me-2" type="reset" value="Reset" name="Reset">Reset</button>
                                                                <button class="btn btn-outline-secondary me-2" type="button" value="Back" name="Back">Back</button>
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

<script src="<?php echo getenv('BASE_URL') ?>/public/js/registration/interviewDetail.js"></script>

<?php include('./views/layouts/end.php') ?>