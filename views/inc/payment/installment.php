<?php include('./views/layouts/start.php') ?>

<?php include('./views/inc/base-css.php') ?>
<?php include('./views/layouts/body-start.php') ?>
<?php include('./views/inc/side-bar.php') ?>
<div class="col px-0">
  <div class="container-fluid" id="content-container">
    <div class="row">
      <!--Site Header section start-->
      <div class="col-12 py-3 bg-white" id="site-header">
        <span class="fw-medium ms-4">CLASSROOM MANAGEMENT SYSTEM</span>
      </div>
      <!--Site Header section end-->

      <div class="col-12 pt-4 px-2 px-md-4 d-flex">
        <span class="text-dark ms-md-2">
          <a href="" class="text-decoration-none text-dark me-md-1">Student</a> |
          <a href="" class="text-decoration-none text-dark ms-md-1">Installment</a>
        </span>


      </div>


      <div class="col-12 col-lg-12 pt-4 pb-4 px-md-4" id="monthly-report">
        <div class="d-flex align-items-center">
          <div class="container-fluid">
            <div class="row justify-content-center">
              <div class="col-12 px-0 site-card">
                <div class="card rounded-0 border-0 shadow">
                  <div class="card-body ">
                    <div class="fw-medium  fs-3 text-light px-2" style="background-color: brown;">Installments</div>
                    <!-- student details  -->
                    <div class="container-fluid row ">
                      <div class="col-12 col-md-6">
                        <div class="mb-0  row">
                          <label for="staticEmail" class="col-sm-4 fw-semibold  col-form-label">Name</label>
                          <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" id="name" value="Pasindu Gimhan Rajasinghe">
                          </div>
                        </div>
                        <div class="mb-0 row">
                          <label for="staticEmail" class="col-sm-4 fw-semibold  col-form-label">MIS</label>
                          <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" id="MIS" value="FN/SN/23/23/23">
                          </div>
                        </div>
                        <div class="mb-0  row">
                          <label for="staticEmail" class="col-sm-4 col-form-label fw-semibold ">NIC</label>
                          <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" id="NIC" value="200218103171">
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="mb-0  row">
                          <label for="staticEmail" class="col-sm-4 fw-semibold  col-form-label" id="">Total amount to be paid</label>
                          <div class="col-sm-8">
                            <input type="text" readonly class="form-control-plaintext" id="totalAmountToBePaid" value="Rs. 6000">
                          </div>
                        </div>
                        <div class="mb-0 row">
                          <label for="staticEmail" class="col-sm-4 fw-semibold  col-form-label">Total OutStanding</label>
                          <div class="col-sm-8 ">
                            <input type="text" readonly class="form-control-plaintext" id="totalOutStanding" value="Rs. 6000">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- student details end -->
                    <div class="container-fluid mt-4 ">
                      <!-- information installment start -->
                      <div class="">
                        <div class="col-12 col-sm-4 mb-3 ">
                          <div class="input-group input-group-sm  ">
                            <span class="input-group-text ">Rs.</span>
                            <div class="form-floating">
                              <input type="text" class="form-control " id="installmentAmount" placeholder="Username">
                              <label for="floatingInputGroup1" id="">Installment Amount</label>
                            </div>
                          </div>
                          <div class="invalid-tooltip   position-relative" id="amountToolTip" style="top:1vh">invalid-tooltip </div>
                        </div>

                        <div class="col-12 col-sm-7 mb-3 ">
                          <div class="col-12 col-sm-7">
                            <label for="formFile" class="form-label fw-semibold ">Payment Confirmation
                              Slip</label>
                            <input class="form-control" type="file" id="installmentSlip">
                            
                          </div>
                          <div class="invalid-tooltip  position-relative mt-1" style="top:1vh" id="imageToolTip">invalid-tooltip </div>
                          <div class="form-text ">plz select the correct slip image carefully</div>
                        </div>

                      </div>
                      <!-- installment information end -->
                      <button class="btn btn-primary" id="makeInstallment">Make Installment</button>

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
<script type="module" src="./public/js/installment.js"></script>
<?php include('./views/layouts/end.php') ?>