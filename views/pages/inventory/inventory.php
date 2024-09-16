<?php include('./views/layouts/start.php') ?>

<?php include('./views/inc/base-css.php') ?>
<!--Css Files Here-->
<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/inventory/store.css'>
<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/inventory/inventory-overview.css'>
<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/inventory/inventory-form.css'>
<!-- <link rel="stylesheet" href="../style/inventory.css"> -->
<?php include('./views/layouts/body-start.php') ?>
<?php include('./views/inc/side-bar.php') ?>

    <div class="col px-0">
        <div class="container-fluid" id="content-container">
            <div class="row">

                <!--Site Header section start-->
                <div class="col-12 py-3 bg-white" id="site-header">
                    <span class="fw-medium ms-4">INVENTORY SECTION</span>
                </div>
                <!--Site Header section end-->

                <div class="col-12 pt-4 px-2 px-md-4 d-flex">
                    <span class="text-dark ms-md-2">
                        <a href="" class="text-decoration-none text-dark me-1">Inventory</a> | <a href=""
                            class="text-decoration-none text-dark ms-1">Overview</a>
                    </span>
                    <span class="ms-auto me-md-2" id="content-nav">
                        <a href="/inventory" class="btn border-danger rounded-1 active" id="overview-link">Overview</a>
                        <a href="/inventory/reports" class="btn border-danger rounded-1" id="reports-link">Reports</a>
                    </span>
                </div>

                <div class="col-12" id="page-content">
                    <div class="row">
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>

<?php include('./views/layouts/body-end.php') ?>

    <div class="form-card-body d-none" id="form_div">
        
    </div>

<script type="module" src="<?php echo getenv('BASE_URL') ?>/public/js/inventory/inventoryRouter.js"></script>

<?php include('./views/layouts/end.php') ?>