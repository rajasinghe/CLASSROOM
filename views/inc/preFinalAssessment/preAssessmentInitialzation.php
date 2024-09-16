
<div class="d-flex align-items-center">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 px-0 site-card">
                <div class="card rounded-0 border-0 shadow">
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 d-flex align-items-center ps-0">
                                    <h4 class="fs-4 my-0">PRE ASSESSMENT FOR THE YEAR 2024</h4>
                                </div>
                                <div class="col-12 ps-0">
                                    Enter the pre assessment details
                                </div>

                                <div class="col-12 px-0 ">

                                    <hr>
                                </div>

                            </div>
                        </div>
                        <!-- basic preassessmnet details -->
                        <div class="row">

                            <div class="mb-3 col-12">
                                <label for="exampleFormControlInput1" class="form-label">Assessor Reg.No</label>
                                <input type="text" class="form-control" id="preAssessmentAssessorRegNo"
                                    placeholder="name@example.com">
                            </div>
                            <div class="mb-3 col-12">
                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                <input type="text" class="form-control" id="preAssessmentAssessorName"
                                    placeholder="name@example.com">
                            </div>
                            <div class="mb-3 col-12">
                                <label for="exampleFormControlInput1" class="form-label">Date</label>
                                <input type="date" class="form-control" id="preAssessmentDate"
                                    placeholder="name@example.com">
                            </div>
                        </div>
                        <!--  -->

                        <!-- student participations -->
                        <div class="mt-4">
                            <h5 class="fs-4 my-0">Current Batch Participation</h5>
                            <div class="ps-0 ">Select the participant from the current batch to pre asssessment
                            </div>
                            <hr>
                            <!-- current batch students -->
                            <div>
                                <div class="table-responsive site-scrollbar" id="attendance-section">
                                    <table class="table table-bordered mb-0" id="attendance-table">
                                        <thead>
                                            <tr>
                                                <th>MIS</th>
                                                <th>Name</th>
                                                <th>Participation</th>
                                            </tr>
                                        </thead>
                                        <tbody id="currentBatchTableBody">
                                            <!--  <tr>
                                                            <td>4564564</td>
                                                            <td>Pasindu Gimhan</td>
                                                            <td><input type="checkbox"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>4564564</td>
                                                            <td>Pasindu Gimhan</td>
                                                            <td><input type="checkbox"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>4564564</td>
                                                            <td>Pasindu Gimhan</td>
                                                            <td><input type="checkbox"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>4564564</td>
                                                            <td>Pasindu Gimhan</td>
                                                            <td><input type="checkbox"></td>
                                                        </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Repeat Students -->
                        <div class="mt-4 ">
                            <h5 class="fs-4 my-0">Repeated Students</h5>
                            <div>Select the repeated Students for the pre assessment</div>
                            <hr>
                            <button type="button" class="btn btn-danger mb-3 " data-bs-toggle="modal"
                                data-bs-target="#searchStudentsModal">Add Students to list</button>
                            <div class=" align-items-center ">
                                <div class="table-responsive site-scrollbar">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>MIS</th>
                                                <th>Name</th>
                                                <th>Batch</th>
                                            </tr>
                                        </thead>
                                        <tbody class="" id="repeatStudentsTableBody">
                                            <!-- <tr class="repeat-row">
                                                            <td>4564564</td>
                                                            <td>Pasindu Gimhan</td>
                                                            <td class="d-flex align-items-center ">
                                                                <div>
                                                                    4564
                                                                </div>
                                                                <div class="ms-auto repeat-row-batch">
                                                                    <Button class="btn btn-danger ">
                                                                        <img src="/public/images/icons8-remove-96 (1).png" alt="Icon">
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
                                                                        <img src="/public/images/icons8-remove-96 (1).png" alt="Icon">
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
                                                                        <img src="/public/images/icons8-remove-96 (1).png" alt="Icon">
                                                                    </Button>
                                                                </div>
                                                            </td>
                                                        </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- end of the preassessment configuration -->
                        <hr>
                        <div class="d-flex mt-4 ">

                            <button class="btn btn-primary ms-auto  " id="continueBtn">Continue</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>