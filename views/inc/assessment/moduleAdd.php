      <!--module add Section start-->
      <div class="d-flex align-items-center floating-scroll">
        <div class="container-fluid floatin-container">
            <div class="row justify-content-center">
              <div class="col-12 px-0 site-card">
                <div class="card rounded-0 border-0 shadow">
                  <div class="card-body">
                    <div class="container-fluid">

                      <!-- card -->
                      <div class="card mb-3">
                        <div class="row g-0">
                          <div class="col-md-6 d-none d-md-block ">
                            <img src="http://localhost:3000/public/images/module/module.jpg"
                              class="img-fluid rounded-start addimg" alt="...">
                          </div>
                          <div class="col-md-6">
                            <div class="card-body">
                              <div class="">
                                <p class="addpagehead">Add Module</p>
                                <hr class="modulesection">
                              </div>
                              <form id="moduleAdd" method="post">
                                <div class="mb-1 pt-2">
                                  <label for="" class="form-label">Module Number</label>
                                  <input type="text" class="form-control" id="moduleNo" name="moduleNo"
                                    placeholder="Module Number" aria-describedby="">
                                  <label for="">error</label>
                                </div>
                                <div class="mb-1">
                                  <label for="" class="form-label ">Module Name</label>
                                  <input type="text" class="form-control " placeholder="Module Name" id="modulename"
                                    name="modulename">
                                  <label for="">error</label>
                                </div>
                                <div class="mb-1">
                                  <label for="" class="form-label ">Number of Task</label>
                                  <input type="text" class="form-control" id="no_of_task" name="no_of_task"
                                    placeholder="Number of Task" aria-describedby="">
                                  <label for="">error</label>
                                </div>
                                <button type="submit" class="btn btn-success " name="submit" value="add">Submit</button>
                                <button type="reset" class="btn btn-outline-danger ">Clear</button>
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
