<?php include('./views/layouts/start.php') ?>

<?php include('./views/inc/base-css.php') ?>
<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/main.css'>
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
                    <a href="" class="text-decoration-none text-dark ms-md-1">Dashboard</a>
                  </span>
                </div>
                <!--OVERVIEW SECTION START-->

                <!--Attendance Section start-->
                <div class="col-12 col-lg-7 pt-4 px-md-4">
                    <div class="d-flex align-items-center">
                        <div class="container">
                            <div class="row justify-content-center">
                              <div class="col-12 px-0">
                                <div class="card rounded-0 border-0 shadow">
                                  <div class="card-body">
                                    <div class="attendance-details">
                                        <h5 class=""><a href="/attendance" class="fs-4 text-decoration-none text-dark">MARK ATTENDANCE</a></h5>
                                        <hr>
                                    </div>
                                    <div class="table-responsive site-scrollbar" id="attendance-section">
                                      <table class="table table-borderless mb-0" id="attendance-table">
                                        <thead>
                                          <tr>
                                            <th scope="col">
                                              MIS
                                            </th>
                                            <th scope="col">STUDENT NAME</th>
                                            <th scope="col" class="d-none d-md-table-cell">NIC</th>
                                            <th scope="col" class="d-none d-lg-table-cell">AGE</th>
                                            <th scope="col" class="d-none d-lg-table-cell">ADDRESS</th>
                                            <th scope="col">Attendance</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <th scope="row">
                                              1
                                            </th>
                                            <td>Tiger Nixon</td>
                                            <td class="d-none d-md-table-cell">System Architect</td>
                                            <td class="d-none d-lg-table-cell">61</td>
                                            <td class="d-none d-lg-table-cell">Edinburgh</td>
                                            <td>
                                              <div class="d-flex justify-content-center bg">
                                                <input type="checkbox" class="form-check" checked>
                                              </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <th scope="row">
                                              2
                                            </th>
                                            <td>Sonya Frost</td>
                                            <td class="d-none d-md-table-cell">Software Engineer</td>
                                            <td class="d-none d-lg-table-cell">23</td>
                                            <td class="d-none d-lg-table-cell">Edinburgh</td>
                                            <td>
                                                <div class="d-flex justify-content-center bg">
                                                  <input type="checkbox" class="form-check" >
                                                </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <th scope="row">
                                              3
                                            </th>
                                            <td>Jena Gaines</td>
                                            <td class="d-none d-md-table-cell">Office Manager</td>
                                            <td class="d-none d-lg-table-cell">30</td>
                                            <td class="d-none d-lg-table-cell">London</td>
                                            <td>
                                                <div class="d-flex justify-content-center bg">
                                                  <input type="checkbox" class="form-check" checked>
                                                </div>
                                            </td>
                                          </tr>
                                          <tr>
                                            <th scope="row">
                                              4
                                            </th>
                                            <td>Quinn Flynn</td>
                                            <td class="d-none d-md-table-cell">Support Lead</td>
                                            <td class="d-none d-lg-table-cell">22</td>
                                            <td class="d-none d-lg-table-cell">Edinburgh</td>
                                            <td>
                                                <div class="d-flex justify-content-center bg">
                                                  <input type="checkbox" class="form-check" >
                                                </div>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Attendance Section end-->

                <!--Shortcuts Section start-->
                <div class="col-12 col-md-6 col-lg-5 pt-4 ps-lg-0">
                    <div class="container-fluid" id="shortcuts">
                        <div class="row">
                            <div class="col-6 mb-3 ps-0 pe-1 ps-md-3 pe-lg-3">
                              <a class="d-flex flex-column justify-content-center align-items-center shortcut px-2 red shadow c-a">
                                <i class="fa-solid fa-book-open-reader fs-3"></i>
                                <span class="text-center fw-medium mt-2">
                                  Continuous Assessments Summary
                                </span>
                              </a>
                            </div>
                            <div class="col-6 mb-3 ps-1 pe-0 ps-md-2 ps-lg-1 pe-lg-4 ">
                              <a class="d-flex flex-column justify-content-center align-items-center shortcut px-2 green shadow c-a">
                                <i class="fa-solid fa-book-open-reader fs-3"></i>
                                <span class="text-center fw-medium mt-2">
                                  Continuous Assessments Summary
                                </span>
                              </a>
                            </div>
                            <div class="col-6 ps-0 pe-1 ps-md-3 pe-lg-3">
                              <a class="d-flex flex-column justify-content-center align-items-center shortcut px-4 blue shadow i-b">
                                <i class="fa-solid fa-cart-flatbed fs-3"></i>
                                <span class="text-center fw-medium mt-2">
                                  Inventory Book Summary
                                </span>
                              </a>
                            </div>
                            <div class="col-6 ps-0 ps-1 pe-0 ps-md-2 ps-lg-1 pe-lg-4">
                              <a href="/attendance/reports" class="d-flex flex-column justify-content-center align-items-center shortcut px-4 yellow shadow m-a">
                                <i class="fa-solid fa-square-poll-vertical fs-3"></i>
                                <span class="text-center fw-medium mt-2">
                                  Monthy Attendance Summary
                                </span>
                              </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Shortcuts Section end-->

                <!--Notification Section start-->
                <div class="col-md-6 col-lg-4 pt-md-4 pe-md-4 pb-4 pb-md-0 ps-lg-4 pe-lg-2 order-1 order-md-0">
                    <div class="card rounded-0 border-0 shadow">
                        <div class="card-body">
                            <div class="notification-section">
                                <h5 class="fs-4">NOTIFICATIONS</h5>
                                <hr>
                            </div>
                            <div class="notifications site-scrollbar">
                                <div class="card notification-card border-0">
                                    <div class="card-body py-2">
                                        <h6 class="card-title">Unmarked Attendance</h6>
                                        <h6 class="card-subtitle mb-2 text-body-secondary">10 January, 2024</h6>
                                        <p class="card-text mb-1 f">
                                        Some quick example text to build on the card title and make up the bulk.....
                                        </p>
                                    </div>
                                </div>
                                <div class="card notification-card border-0">
                                    <div class="card-body py-2">
                                        <h6 class="card-title">Unmarked Attendance</h6>
                                        <h6 class="card-subtitle mb-2 text-body-secondary">10 January, 2024</h6>
                                        <p class="card-text mb-1">
                                            Some quick example text to build on the card title and make up the bulk.....
                                        </p>
                                    </div>
                                </div>
                                <div class="card notification-card border-0">
                                    <div class="card-body py-2">
                                        <h6 class="card-title">Unmarked Attendance</h6>
                                        <h6 class="card-subtitle mb-2 text-body-secondary">10 January, 2024</h6>
                                        <p class="card-text mb-1">
                                            Some quick example text to build on the card title and make up the bulk.....
                                        </p>
                                    </div>
                                </div>
                            </div>
                      </div>
                    </div>
                </div>
                <!--Notification Section end-->

                <!--Student List Section start-->
                <div class="col-lg-8 pt-4 pb-4 ps-md-3 pe-md-4">
                    <div class="card rounded-0 border-0 shadow">
                      <div class="card-body">
                        <div class="student-details">
                            <h5 class="fs-4">STUDENT LIST - SD/2023</h5>
                            <hr>
                        </div>
                        <div class="table-responsive site-scrollbar" id="student-section">
                          <table class="table table-borderless mb-0" id="student-table">
                            <thead>
                              <tr>
                                <th scope="col">
                                  ##
                                </th>
                                <th scope="col">STUDENT NAME</th>
                                <th scope="col" class="d-none d-md-table-cell">NIC</th>
                                <th scope="col" class="d-none d-md-table-cell">AGE</th>
                                <th scope="col" class="d-none d-md-table-cell">ADDRESS</th>
                                <th scope="col">STATUS</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">
                                  <div class="student-img">
                                    <img src="../img/students/p (1).png" class="img-fluid w-100 rounded-circle" alt="">
                                  </div>
                                </th>
                                <td class="align-middle">Tiger Nixon</td>
                                <td class="d-none d-md-table-cell align-middle">System Architect</td>
                                <td class="d-none d-md-table-cell align-middle">61</td>
                                <td class="d-none d-md-table-cell align-middle">Edinburgh</td>
                                <td class="align-middle">
                                  <div class="d-flex">
                                    <span class="status disabled">Deactive</span>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <th scope="row">
                                  <div class="student-img">
                                    <img src="../img/students/p1.jpg" class="img-fluid w-100 rounded-circle" alt="">
                                  </div>
                                </th>
                                <td class="align-middle">Sonya Frost</td>
                                <td class="d-none d-md-table-cell align-middle">Software Engineer</td>
                                <td class="d-none d-md-table-cell align-middle">23</td>
                                <td class="d-none d-md-table-cell align-middle">Edinburgh</td>
                                <td class="align-middle">
                                    <div class="d-flex">
                                      <span class="status active">Active</span>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                <th scope="row">
                                  <div class="student-img">
                                    <img src="../img/students/p (3).jpg" class="img-fluid w-100 rounded-circle" alt="">
                                  </div>
                                </th>
                                <td class="align-middle">Jena Gaines</td>
                                <td class="d-none d-md-table-cell align-middle">Office Manager</td>
                                <td class="d-none d-md-table-cell align-middle">30</td>
                                <td class="d-none d-md-table-cell align-middle">London</td>
                                <td class="align-middle">
                                    <div class="d-flex">
                                      <span class="status active">Active</span>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                <th scope="row">
                                  <div class="student-img">
                                    <img src="../img/students/p (2).jpg" class="img-fluid w-100 rounded-circle" alt="">
                                  </div>
                                </th>
                                <td class="align-middle">Quinn Flynn</td>
                                <td class="d-none d-md-table-cell align-middle">Support Lead</td>
                                <td class="d-none d-md-table-cell align-middle">22</td>
                                <td class="d-none d-md-table-cell align-middle">Edinburgh</td>
                                <td class="align-middle">
                                    <div class="d-flex">
                                      <span class="status active">Active</span>
                                    </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                </div>
                <!--Student List Section end-->

                <!--OVERVIEW SECTION END-->
            </div>
        </div>
    </div>
<!-- Main Content Ends Here-->

<?php include('./views/layouts/body-end.php') ?>
<script src='<?php echo getenv('BASE_URL') ?>/public/js/dashboard.js'></script>

<?php include('./views/layouts/end.php') ?>