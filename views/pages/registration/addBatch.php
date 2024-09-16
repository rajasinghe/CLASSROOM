<?php include('./views/layouts/start.php') ?>

<?php include('./views/inc/base-css.php') ?>
<link rel="stylesheet" href="<?php echo getenv('BASE_URL') ?>/public/css/registration/ADDbatchdetails.css">

<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image ">
                    <!--Image-->
                    <img src="" alt="">

                </div>

                <div class="col-md-6  right">
                    <form name="form">
                        <div>
                            <header>
                                <h1>Add Batch Details</h1>
                            </header>
                        </div>
                        <div class="input-group">
                            <label for="email">Batch Year</label>
                            <!-- <input type="text" id="year"  name="year" placeholder="Enter the Batch Number" onblur="batchyear()" > -->
                            <select name="year" id="year"></select>
                            <label id="lYear"></label>
                        </div>
                        <div class="input-group">
                            <label for="name">Batch Number</label>
                            <input type="text" id="number" name="number" placeholder="Enter the Batch Name"
                                onblur="batchNumber();">
                            <label id="lyear"></label>
                        </div>
                        <div class="input-group">
                            <label for="date">Start Date</label>
                            <input type="date" id="Sdate" name="date" onblur="startdate()">
                            <label id="lStarDate"></label>
                        </div>
                        <div class="input-group">
                            <label for="date">End Date</label>
                            <input type="date" id="Edate" name="date" onblur="enddate()">
                            <label id="lEndDate"></label>
                        </div>
                        <div class="input-dield">
                            <input type="submit" class="submit ms-3 btn " id="Addbatch" value="ADD BATCH DETAILS"
                                onclick=" return batchNumber() ||  startdate() || enddate() ">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require('./views/inc/base-js.php') ?>
    <script src="<?php echo getenv('BASE_URL') ?>/public/js/registration/yearChooser.js"></script>
    <script src="<?php echo getenv('BASE_URL') ?>/public/js/registration/bachAdd.js"></script>

<?php include('./views/layouts/end.php') ?>