<h3 class="ms-3 m-3 ">Kalutara District Centers</h3>

<div class="searchbar d-flex ">

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
        <button class="btn btn-primary" 
        onclick="document.getElementById('id01').style.display='flex'" style="width:auto;">
            <i class="bi bi-plus-circle"></i>
        </button>
    </div>
</div>

<!-- centers add popup view section start -->
<div id="id01" class="modal z-3">

    <form class="modal-content animate popup site-scrollbar" action="/action_page.php" method="post">
        <div class="popup-inner py-5">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close"
                    title="Close Modal">&times;</span>

            </div>

            <div class="container px-4 px-md-5">

                <h3 class="form-title">ADD NEW CENTER</h3>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Center
                        Number</label>
                    <input type="text" class="form-control" id="centerNumber" placeholder="Center Number">
                    <label for="">error</label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="Centername" placeholder="Center Number">
                    <label for="">error</label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Address</label>
                    <input type="text" class="form-control" id="centerAddress" placeholder="Center Number">
                    <label for="">error</label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">TVC
                        Registration Number</label>
                    <input type="text" class="form-control" id="tvcNumber" placeholder="Center Number">
                    <label for="">error</label>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Grade</label>
                    <input type="text" class="form-control" id="centerGrade" placeholder="Center Number">
                    <label for="">error</label>
                </div>

            </div>

            <div class="container px-4 px-md-5">
                <button type="button" onclick="document.getElementById('id01').style.display='none'"
                    class="btn btn-primary ">Save</button>

            </div>
        </div>
    </form>
</div>

<div class="col-12 mt-3">

    <div class="d-flex align-items-center">
        <div class="container-fluid">
            <div class="centers-table site-scrollbar overflow-y-auto ">
                <table class="table mb-0">
                    <tr class="sticky-top zindex">
                        <th>
                            Center Number
                        </th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>TVC Registration Number</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td>
                            K72S014.0
                        </td>
                        <td>
                            VTC
                        </td>
                        <td>
                            Vacational Tranning Authority Of Sri Lanka,Kalutara North,Kalutara
                        </td>
                        <td>P03/0082</td>
                        <td>A</td>
                        <td>
                            <div class="d-flex ">
                                <button class="btn btn-outline-warning me-1 "><i
                                        class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-outline-danger ms-1"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            K72S014.0
                        </td>
                        <td>
                            VTC
                        </td>
                        <td>
                            Vacational Tranning Authority Of Sri Lanka,Kalutara North,Kalutara
                        </td>
                        <td>P03/0082</td>
                        <td>A</td>
                        <td>
                            <div class="d-flex ">
                                <button class="btn btn-outline-warning me-1 "><i
                                        class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-outline-danger ms-1"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            K72S014.0
                        </td>
                        <td>
                            VTC
                        </td>
                        <td>
                            Vacational Tranning Authority Of Sri Lanka,Kalutara North,Kalutara
                        </td>
                        <td>P03/0082</td>
                        <td>A</td>
                        <td>
                            <div class="d-flex ">
                                <button class="btn btn-outline-warning me-1 "><i
                                        class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-outline-danger ms-1"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            K72S014.0
                        </td>
                        <td>
                            VTC
                        </td>
                        <td>
                            Vacational Tranning Authority Of Sri Lanka,Kalutara North,Kalutara
                        </td>
                        <td>P03/0082</td>
                        <td>A</td>
                        <td>
                            <div class="d-flex ">
                                <button class="btn btn-outline-warning me-1 "><i
                                        class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-outline-danger ms-1"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            K72S014.0
                        </td>
                        <td>
                            VTC
                        </td>
                        <td>
                            Vacational Tranning Authority Of Sri Lanka,Kalutara North,Kalutara
                        </td>
                        <td>P03/0082</td>
                        <td>A</td>
                        <td>
                            <div class="d-flex ">
                                <button class="btn btn-outline-warning me-1 "><i
                                        class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-outline-danger ms-1"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            K72S014.0
                        </td>
                        <td>
                            VTC
                        </td>
                        <td>
                            Vacational Tranning Authority Of Sri Lanka,Kalutara North,Kalutara
                        </td>
                        <td>P03/0082</td>
                        <td>A</td>
                        <td>
                            <div class="d-flex ">
                                <button class="btn btn-outline-warning me-1 "><i
                                        class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-outline-danger ms-1"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            K72S014.0
                        </td>
                        <td>
                            VTC
                        </td>
                        <td>
                            Vacational Tranning Authority Of Sri Lanka,Kalutara North,Kalutara
                        </td>
                        <td>P03/0082</td>
                        <td>A</td>
                        <td>
                            <div class="d-flex ">
                                <button class="btn btn-outline-warning me-1 "><i
                                        class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-outline-danger ms-1"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            K72S014.0
                        </td>
                        <td>
                            VTC
                        </td>
                        <td>
                            Vacational Tranning Authority Of Sri Lanka,Kalutara North,Kalutara
                        </td>
                        <td>P03/0082</td>
                        <td>A</td>
                        <td>
                            <div class="d-flex ">
                                <button class="btn btn-outline-warning me-1 "><i
                                        class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-outline-danger ms-1"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            K72S014.0
                        </td>
                        <td>
                            VTC
                        </td>
                        <td>
                            Vacational Tranning Authority Of Sri Lanka,Kalutara North,Kalutara
                        </td>
                        <td>P03/0082</td>
                        <td>A</td>
                        <td>
                            <div class="d-flex ">
                                <button class="btn btn-outline-warning me-1 "><i
                                        class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-outline-danger ms-1"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            K72S014.0
                        </td>
                        <td>
                            VTC
                        </td>
                        <td>
                            Vacational Tranning Authority Of Sri Lanka,Kalutara North,Kalutara
                        </td>
                        <td>P03/0082</td>
                        <td>A</td>
                        <td>
                            <div class="d-flex ">
                                <button class="btn btn-outline-warning me-1 "><i
                                        class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-outline-danger ms-1"><i class="bi bi-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>