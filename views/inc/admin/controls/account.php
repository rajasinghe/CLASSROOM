<h3 class="ms-3 m-3 ">Kalutara District Acconts</h3>

<div class="searchbar d-flex">

    <div class="input-group align-items-center ">
        <input type="text" class="form-control searchbarfield" aria-label="Text input with segmented dropdown button"
            placeholder="Search...">
        <button type="button" class="btn btn-dark "><i class="bi bi-search"></i></button>
        <button type="button" class="btn btn-dark   dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"
            aria-expanded="false">
            <span class="visually-hidden">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Separated link</a></li>
        </ul>
    </div>
    <div class="ps-4 iconAdd ">
        <button class="btn btn-primary" onclick="document.getElementById('id02').style.display='flex'"
            style="width:auto;"><i class="bi bi-plus-circle"></i></button>
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

                <h3 class="form-title">ADD NEW Accounts</h3>
                <h5 class="form-title">Accounts Details Form</h5>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">User
                        Name</label>
                    <input type="text" class="form-control" id="username" placeholder="User Name">
                    <label for="">error</label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                    <input type="text" class="form-control" id="password" placeholder="Password">
                    <label for="">error</label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Admin
                        Name</label>
                    <input type="text" class="form-control" id="adminName" placeholder="Admin Name">
                    <label for="">error</label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Center</label>
                    <select name="" id="center" class="form-control">
                        <option value="">Choose Center</option>
                        <option value="">Kalutara North</option>
                        <option value="">Horana Dvte</option>
                        <option value="">Horana VTC</option>
                        <option value="">Kandevihara</option>
                        <option value="">Panadura Walana</option>
                    </select>
                    <label for="">error</label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Center</label>
                    <select name="" id="course" class="form-control">
                        <option value="">Choose Course</option>
                        <option value="">Software Developer</option>
                        <option value="">Multimedia Design</option>
                        <option value="">Haire Dreseer</option>
                        <option value="">Profetional Cokery</option>
                        <option value="">Pulmping</option>
                    </select>
                    <label for="">error</label>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Profile
                        Image</label>
                    <input type="file" min="1" class="form-control" id="profileImage" placeholder="Profile Image">
                    <label for="">error</label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Employee
                        Number</label>
                    <input type="number" min="1" class="form-control" id="employeNumber" placeholder="Employee Number">
                    <label for="">error</label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">NIC
                        Number</label>
                    <input type="text" min="1" class="form-control" id="nicNumber" placeholder="NIC Number">
                    <label for="">error</label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Designation</label>
                    <input type="text" min="1" class="form-control" id="designation" placeholder="Designation">
                    <label for="">error</label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">User
                        Type</label>
                    <input type="text" min="1" class="form-control" id="userType" placeholder="User Type">
                    <label for="">error</label>
                </div>

            </div>

            <div class="container px-4 px-md-5">
                <button type="button" onclick="document.getElementById('id03').style.display='none'"
                    class="btn btn-primary ">Save</button>
            </div>
        </div>
    </form>
</div>
<!-- Added New Course popup view section end-->

<div class="col-12 mt-3">

    <div class="d-flex align-items-center">
        <div class="container-fluid">
            <div class="centers-table site-scrollbar overflow-y-auto text-nowrap ">
                <table class="table mb-0">
                    <tr class="sticky-top zindex">

                        <th>User Name</th>
                        <th>Password</th>
                        <th>Admin Name</th>
                        <th>Profile Image</th>
                        <th>Employee Number</th>
                        <th>NIC Number</th>
                        <th>Designation</th>
                        <th>User Type</th>

                        <th>Action</th>

                    </tr>
                    <tr>

                        <td>
                            vta.application.test@gmail.com
                        </td>
                        <td>
                            vtaK2023
                        </td>
                        <td>testUser</td>
                        <td>admin.png</td>
                        <td>11111</td>
                        <td>200029897865</td>
                        <td>System Disgnostic</td>
                        <td>Super Admin</td>
                        <td>
                            <div class="d-flex ">
                                <button class="btn btn-outline-danger ms-1"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>