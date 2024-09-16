<?php include('./views/layouts/start.php') ?>

<?php include('./views/inc/base-css.php') ?>
<link rel='stylesheet' type='text/css' media='screen' href='<?php echo getenv('BASE_URL') ?>/public/css/sty2.css'>
</head>

<body>
<div class="toast-container start-50 translate-middle-x">
        <div class="toast align-items-center overflow-hidden success" role="alert" aria-live="assertive" aria-atomic="true" id="success-toast">
            <div class="d-flex">
                <div class="toast-body d-flex p-0 align-items-center">
                    <div class="toast-side-bar">

                    </div>
                    <div class="toast-content ps-3 pe-2 py-2 text-wrap w-100">
                        <h5 class="m-0 mb-1 heading">This is the heading</h5>
                        <p class="m-0 text-secondary body">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus, laboriosam ipsum fuga quis obcaecati veniam ab quaerat a nam quae!
                        </p>
                    </div>
                </div>
                <button type="button" class="btn-close me-3 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="toast-container start-50 translate-middle-x">
        <div class="toast align-items-center overflow-hidden failure" role="alert" aria-live="assertive" aria-atomic="true" id="failure-toast">
            <div class="d-flex">
                <div class="toast-body d-flex p-0 align-items-center">
                    <div class="toast-side-bar">

                    </div>
                    <div class="toast-content ps-3 pe-2 py-2 text-wrap w-100">
                        <h5 class="m-0 mb-1 heading">This is the heading</h5>
                        <p class="m-0 text-secondary body">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus, laboriosam ipsum fuga quis obcaecati veniam ab quaerat a nam quae!
                        </p>
                    </div>
                </div>
                <button type="button" class="btn-close me-3 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="login-box">
        <center>
            <img src="/public/images/vta_logo_white.png" alt="" class="vta_logo"><br>
        </center>
        <h2 style="font-size: 35px;letter-spacing: 2px;">Admin Login</h2>
        <form>
            <div class="user-box">
                <input type="text" name="" required="" id="usernameField">
                <label>Username</label>
                <label for="usernameField" id="usernameFieldError" class="text-white errorField pb-4"></label>
            </div>
            <div class="user-box">
                <input type="password" name="" required="" id="passwordField">
                <label>Password</label>
                <label for="passwordField" id="passwordFieldError" class="text-white errorField pb-4"></label>
            </div>
            <button type="button" id="submitBtn">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                submit
            </button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src='<?php echo getenv('BASE_URL') ?>/public/js/config.js'></script>
    <script src="/public/js/login.js"></script>
    <script src='<?php echo getenv('BASE_URL') ?>/public/js/toasts.js'></script>

    <?php include('./views/layouts/end.php') ?>