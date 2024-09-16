<div class="col-12 pt-4 px-2 px-md-4 d-flex">
  <span class="" id="report-nav">
    <button href="" class="btn rounded-1 py-1 active" id="btnTraining">Job Training Details</button>
    <button href="" class="btn rounded-1 py-1" id="btnPlacement">Job Placement Details</button>
  </span>
</div>

<!--Monthly Attendance Report Section start-->
<div class="col-12 col-lg-12 pt-4 pb-4 px-md-4">
  <div class="d-flex align-items-center">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 px-0 site-card">
          <div class="card rounded-0 border-0 shadow">
            <div class="card-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12 col-md-5 px-0 d-flex align-items-center" id="caption">
                  
                  <!-- Caption -->

                  </div>

                  <div class="mt-1 ">

                    <label for="batchDropdown">Select Batch :&nbsp;</label>

                    <select name="batchDropdown" id="batchDropDown" class="dropdown ">
                      <!-- Batch Name From DB -->
                    </select>

                  </div>

                  <div class="col-12 px-0 ">
                    <hr>
                  </div>
                </div>
              </div>
              <div class="table-responsive tablescorlbar">
                <table class="table table-hover table-bordered text-nowrap" >
                  <thead id="tableHead">
                    

                  </thead>
                  <tbody id="tableBody">

                    <!-- Table Data -->

                  </tbody>

                </table>
              </div>
              <div class="d-flex justify-content-end mt-1  pe-3">
                <button class="btn site-btn rounded-1" id="print_Button">Print Details</button>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>