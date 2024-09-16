<!--Inventory Summry Section start-->
<div class="col-12 col-lg-4 pt-4 px-md-4">
    <div class="d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 px-0">
                    <div class="card rounded-0 border-0 shadow">
                        <div class="card-body">
                            <div class="site-scrollbar" id="all-item-card">
                                <div class="d-flex flex-column  align-items-center ">
                                    <h3>All Items</h3>
                                    <span class="fs-1">2500</span>
                                </div>
                                <p class="d-flex flex-column "><span>Store Item : 625</span>
                                    <span>Inventory Item : 595</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-lg-4 pt-4 px-md-4">
    <div class="d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 px-0">
                    <div class="card rounded-0 border-0 shadow">
                        <div class="card-body">
                            <div class="site-scrollbar" id="removed-item-card">
                                <div class="d-flex flex-column  align-items-center ">
                                    <h3>Removed Items</h3>
                                    <span class="fs-1 ">2500</span>
                                </div>
                                <p class="d-flex flex-column "><span>Store Item : 62</span>
                                    <span>Inventory Item : 95</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-lg-4 pt-4 px-md-4">
    <div class="d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 px-0">


                    <img class="dropshadow" src="<?php echo getenv('BASE_URL') ?>/public/images/inventory/a.png" alt=""
                        height="200px" width="250px">
                </div>
            </div>
        </div>
    </div>
</div>

<!--Inventory Summry Section end-->
<div class="col-12 col-lg-10 pt-4 pb-4 px-md-4 floating-column">
    <div class="d-flex align-items-center floating-scroll">
        <div class="container-fluid floatin-container">
            <div class="row justify-content-center">
                <div class="col-12 px-0 site-card">
                    <div class="card rounded-0 border-0 shadow">
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 col-md-5 px-0 d-flex align-items-center">
                                        <button class="maximize-button  d-none d-md-block">
                                            <i class="fa-solid fa-maximize"></i>
                                        </button>
                                        <h4 class="fs-4 my-0">Item Summery</h4>
                                    </div>
                                    <div class="col-12 px-0">
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive site-scrollbar" id="summary-section">
                                <table class="table table-borderless mb-0" id="item-table">
                                    <thead class="sticky-top">
                                        <tr>
                                            <th scope="col">
                                                ##
                                            </th>
                                            <th scope="col">ITEM</th>
                                            <th scope="col">ITEM CODE</th>
                                            <th scope="col">QUANTITY</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <tr>
                                            <th scope="row">
                                                1
                                            </th>
                                            <td>Pen Drive</td>
                                            <td class="d-none d-md-table-cell">P-23</td>
                                            <td class="d-none d-lg-table-cell">
                                                <div class="progress rounded-pill pro" role="progressbar"
                                                    aria-label="Warning example" aria-valuenow="75" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    <div class="progress-bar rounded-pill" style="width: 95%">95</div>
                                                </div>
                                            </td>
                                        </tr> -->
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

<div class="col-3 col-lg-2 pt-4 px-md-4">
    <div class="d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 px-0">
                    <div class="card rounded-0 border-0 shadow">
                        <div class="card-body">
                            <ul class="charts-css legend legend-rhombus">
                                <li> Label 1 </li>
                                <li> Label 2 </li>
                                <li> Label 3 </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>