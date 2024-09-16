<?php include('./views/layouts/start.php') ?>

<?php include('./views/inc/base-css.php') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/jobdetails/base.css'>

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
          <a href="" class="text-decoration-none text-dark me-md-1">Job Details</a> |
          <a href="" class="text-decoration-none text-dark ms-md-1">Overview</a>
        </span>

        <span class="ms-auto me-md-2" id="content-nav">
          <a href="<?php echo getenv('BASE_URL') ?>/jobDetails" class="btn border-danger rounded-1" id="overview-link">Overview</a>
          <a href="<?php echo getenv('BASE_URL') ?>/jobDetails/reports" class="btn border-danger rounded-1" id="reports-link">Reports</a>
        </span>
      </div>
      <!--OVERVIEW SECTION START-->

      <!--Look for the inventory.html File-->

      <div class="col-12" id="page-content">
        <div class="row">

        </div>
      </div>

      <!--OVERVIEW SECTION END-->
    </div>
  </div>
</div>


<?php include('./views/layouts/body-end.php') ?>

<script type="module" src="/public/js/jobdetails/jobRouter.js"></script>

<?php include('./views/layouts/end.php') ?>