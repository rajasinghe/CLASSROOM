<h3 class="ms-3 m-3">Kalutara District Courses</h3>

<div class="searchbar d-flex align-items-center">
    <div class="input-group align-items-center">
        <input type="text" class="form-control searchbarfield" aria-label="Text input with segmented dropdown button"
            placeholder="Search..." />
        <button type="button" class="btn btn-dark">
            <i class="bi bi-search"></i>
        </button>
        <button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"
            aria-expanded="false">
            <span class="visually-hidden">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li>
                <a class="dropdown-item" href="#">Another action</a>
            </li>
            <li>
                <a class="dropdown-item" href="#">Something else here</a>
            </li>
            <li>
                <hr class="dropdown-divider" />
            </li>
            <li>
                <a class="dropdown-item" href="#">Separated link</a>
            </li>
        </ul>
    </div>
    <div class="ps-4 iconAdd">
        <button class="btn btn-primary" onclick="document.getElementById('id02').style.display='flex'"
            style="width: auto">
            <i class="bi bi-plus-circle"></i>
        </button>
    </div>
</div>

<!-- Added New Course  popup view section start -->
<div id="id02" class="modal z-3">
    <form class="modal-content animate popup coursePopup site-scrollbar" action="/action_page.php" method="post">
        <div class="popup-inner py-5">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id02').style.display='none'" class="close"
                    title="Close Modal">&times;</span>
            </div>

            <div class="container px-4 px-md-5">
                <h3 class="form-title">ADD NEW COURSE</h3>
                <h5 class="form-title">Course Details Form</h5>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Course
                        Name</label>
                    <input type="text" class="form-control" id="coursename" placeholder="Center Name" />
                    <label for="">error</label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Course
                        Code</label>
                    <input type="text" class="form-control" id="coursecode" placeholder="Course Code" />
                    <label for="">error</label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">NCS
                        Code</label>
                    <input type="text" class="form-control" id="ncscode" placeholder="NCS Code" />
                    <label for="">error</label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">NVQ
                        Level</label>
                    <select name="" id="" class="form-control">
                        <option value="">Select NVQ Level</option>
                        <option value="">NVQ L3</option>
                        <option value="">NVQ L4</option>
                        <option value="">NVQ L5</option>
                        <option value="">NVQ L6</option>
                        <option value="">NVQ L7</option>
                    </select>
                    <label for="">error</label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Duration</label>
                    <input type="number" min="1" class="form-control" id="duration" placeholder="Duration" />
                    <label for="">error</label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Capacity</label>
                    <input type="number" min="1" class="form-control" id="capacity" placeholder="Capacity" />
                    <label for="">error</label>
                </div>
            </div>

            <div class="container px-4 px-md-5">
                <button type="button" onclick="document.getElementById('id03').style.display='none'"
                    class="btn btn-primary">
                    Save & Next
                </button>
            </div>
        </div>
    </form>
</div>
<!-- Added New Course popup view section end-->

<!-- Added Crytririya popup view section start -->
<div id="id03" class="modal z-3">
    <form class="modal-content animate popup coursePopup" action="/action_page.php" method="post">
        <div class="popup-inner py-5">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id03').style.display='none'" class="close"
                    title="Close Modal">&times;</span>
            </div>

            <!-- Crytiriyas Start -->
            <h3 class="form-title">ADD NEW COURSE</h3>
            <h5 class="form-title">Select Interview Crytiriyas</h5>
            <section class="sectioncontainer">
                <div class="input-container">
                    <div class="checkbox-group">
                        <input type="checkbox" name="options" id="option1" class="inputClass"
                            value="This is an inbox layout" />
                        <label for="option1" class="labelClass">Appear for G.C.E. (O/L) or
                            above</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" name="options" id="option2" class="inputClass" value="Check one item" />
                        <label class="labelClass" for="option2">Successful Completion of NVQ
                            Level 03 or 04
                            course in related area Or Pass 03 Subjects in GCE
                            (A/L) Technology Stream or Other relevant
                            stream.</label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" name="options" id="option4" class="inputClass"
                            value="Check a lower item" />
                        <label class="labelClass" for="option4">Pass 06 subjects in
                            G.C.E.(O/L) with credits in
                            English</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" name="options" id="option5" class="inputClass"
                            value="Everything between should also be set to checked" />
                        <label class="labelClass" for="option5">Employed in the trade after
                            completing a basic
                            courses in a Technical Institute or 02 years
                            experience in a reputed institution as a
                            Forman/Asst. Forman/ Work supervisor in a
                            Technical Trade</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" name="options" id="option6" class="inputClass"
                            value="Try to do it without any libraries" />
                        <label class="labelClass" for="option6">Pass 03 Subjects in G.C.E.
                            (A/L)</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" name="options" id="option7" class="inputClass"
                            value="Just regular JavaScript" />
                        <label class="labelClass" for="option7">Pass 06 Subjects in G.C.E.
                            (O/L) or above</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" name="options" id="option8" class="inputClass" value="Good Luck!" />
                        <label class="labelClass" for="option8">From Year 9 to appear for
                            G.C.E. (A/L)</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" name="options" class="inputClass" id="option9" value="Don" />
                        <label class="labelClass" for="option9">Pass G.C.E. (A/L) or
                            above</label>
                    </div>
                </div>
            </section>
            <!-- Crytiriyas End -->

            <div class="container px-4 px-md-5">
                <button type="button" onclick="document.getElementById('id03').style.display='none'"
                    class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </form>
</div>

<div class="col-12 mt-3">
    <div class="d-flex align-items-center">
        <div class="container-fluid">
            <div class="centers-table site-scrollbar overflow-y-auto">
                <table class="table mb-0">
                    <tr class="sticky-top zindex">
                        <th>Course Name</th>
                        <th>Course Code</th>
                        <th>NCS Code</th>
                        <th>NVQ Level</th>
                        <th>Duration</th>
                        <th>Capacity</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>Software Developer</td>
                        <td>SD/FN/2023</td>
                        <td>
                            K72S014
                        </td>
                        <td>L4</td>
                        <td>One Year</td>
                        <td>22</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-outline-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-outline-danger ms-1">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Software Developer</td>
                        <td>SD/FN/2023</td>
                        <td>
                            K72S014
                        </td>
                        <td>L4</td>
                        <td>One Year</td>
                        <td>22</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-outline-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-outline-danger ms-1">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Software Developer</td>
                        <td>SD/FN/2023</td>
                        <td>
                            K72S014
                        </td>
                        <td>L4</td>
                        <td>One Year</td>
                        <td>22</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-outline-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-outline-danger ms-1">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Software Developer</td>
                        <td>SD/FN/2023</td>
                        <td>
                            K72S014
                        </td>
                        <td>L4</td>
                        <td>One Year</td>
                        <td>22</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-outline-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-outline-danger ms-1">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Software Developer</td>
                        <td>SD/FN/2023</td>
                        <td>
                            K72S014
                        </td>
                        <td>L4</td>
                        <td>One Year</td>
                        <td>22</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-outline-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-outline-danger ms-1">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>