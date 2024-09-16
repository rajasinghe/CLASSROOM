<?php include('./views/layouts/start.php') ?>

<?php include('./views/inc/base-css.php') ?>
<!--CSS File links go here-->
<link rel="stylesheet" href="<?php echo getenv('BASE_URL') ?>/public/css/homePage.css">
</head>
<body>

<!-- header -->
<div class="header ">
    <div class="head ">
      <div class=" d-flex justify-content-center ">
        <div class="mt-2">
          <img src="/public/images/national-logo.png" alt="" class="nationallogo">
        </div>
        
        <p class="headr">Vocational Training Authority of Sri Lanka<br> <span class="centername">Vocational Training Center Kalutara - North</span></p>
      </div>
    </div>
  </div>
  <!-- navbar -->
    <div class="sticky-lg-top ">
      <nav class="navbar navbar-expand-lg bg-body-secondary">
        <div class="container-fluid">
          <img src="/public/images/2019Logo-full-1.png" alt="" class="logo ms-1">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 navbar_content">
              <li class="nav-item">
                <a class="nav-link active navbar-brand " aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link navbar-brand " href="#course_sectrion">Courses</a>
              </li>
              <li class="nav-item">
                <a class="nav-link navbar-brand " href="#">Training</a>
              </li>
              <li class="nav-item">
                <a class="nav-link navbar-brand " href="#">About Us</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <a href="/login" class="btn btn-outline-danger ">Login</a>
            </form>
          </div>
        </div>
      </nav>
    </div>
  <!-- Carousal -->
  <div id="carouselExampleCaptions" class="carousel slide mt-3 " data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="/public/images/dami/IMG-20240226-WA0003.jpg" class="d-block w-100 carousalimg" alt="..." id="zoom">
        <div class="carousel-caption d-none d-md-block carouseltext">
          <h5>First slide label</h5>
          <p>Some representative placeholder content for the first slide.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="/public/images/dami/www_nvqsrilanka_online_10_news_sub_image3.jpg" class="d-block w-100 carousalimg" alt="..." id="zoom">
        <div class="carousel-caption d-none d-md-block carouseltext">
          <h5>Second slide label</h5>
          <p>Some representative placeholder content for the second slide.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="/public/images/dami/www_nvqsrilanka_online_261_news_content_image.jpg" class="d-block w-100 carousalimg" alt="..." id="zoom">
        <div class="carousel-caption d-none d-md-block carouseltext">
          <h5>Third slide label</h5>
          <p>Some representative placeholder content for the third slide.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <br>
  <!-- courses section start-->
  <div class="coures" id="course_sectrion">
    <p class="course_title">Course Details</p>
  </div>
  
 <div class="container-fluid ">
  <div class="row ">
    <div class="col-sm-3">
      <div class="card text-bg-dark" id="zoom">
        <img src="/public/images/card/sd.jpg" class="card-img" alt="..." >
        <div class="card-img-overlay">
          <h5 class="card-title"><div class="carouseltext">Softwera Developer</div></h5>
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p class="card-text"><small>Last updated 3 mins ago</small></p>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card text-bg-dark" id="zoom">
        <img src="/public/images/card/multi.jpg" class="card-img" alt="...">
        <div class="card-img-overlay">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p class="card-text"><small>Last updated 3 mins ago</small></p>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card text-bg-dark" id="zoom">
        <img src="/public/images/card/cookary.jpg" class="card-img" alt="...">
        <div class="card-img-overlay">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p class="card-text"><small>Last updated 3 mins ago</small></p>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card text-bg-dark" id="zoom">
        <img src="/public/images/card/beautiy.jpg" class="card-img" alt="...">
        <div class="card-img-overlay">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p class="card-text"><small>Last updated 3 mins ago</small></p>
        </div>
      </div>
    </div>
  </div>
 </div>
 <!-- course section end -->
 <br>
 <!--training section start-->
 <div>
  <div>
    <div class="coures" id="course_sectrion">
      <p class="course_title">Training Details</p>
    </div>
  </div>
  <div>
    <button class="btn">form1</button>
    <button class="btn">form1</button>
  </div>
 </div>
 <!--training section end -->
 <br>
 <!-- footer section start -->
 <footer>
  <p>&copy; Class room Management System</p>
  <div class="container-fluid ">
    <div class="row">
      <div class="col-sm-3 footer_content">
        <p class="footer_content_head">Connect With Us</p>
        <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
          <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
        </svg> VTC Kalutara North Temple Road,<br> Kalutara.</p>
        <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
        </svg> 076-2767955</p>
        <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
          <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671"/>
          <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791"/>
        </svg> vtaKalutharaNorth123@gmail.com</p>
      </div>
      <div class="col-sm ">
        <div class="vl ms-4"></div>
      </div>
      <div class="col-sm-5 ">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.3792511967426!2d79.95548947404643!3d6.5997011222750865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae23706af38306b%3A0x5378ba5a99f85fc5!2sVTC%20Kalutara%20North!5e0!3m2!1sen!2slk!4v1708590735635!5m2!1sen!2slk" 
        width="100%" height="225" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="col-sm">
        <div class="vl"></div>
      </div>
      <div class="col-sm-3 footer_content">
        <p class="footer_content_head">About Us</p>
        <a href="https://www.youtube.com/watch?v=4-GZLogJ-w8" target="_blank" class="footer_link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
          <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
        </svg> Face Book</a><br>
        <a href="https://www.youtube.com/@vtvvocationaltelevision2139" target="_blank" class="footer_link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
          <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/>
        </svg> youtube</a><br>
        <a href="https://course.vta.lk/" target="_blank" class="footer_link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
          <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z"/>
        </svg> google</a>
      </div>
      
    </div>
  </div>
</footer>
<!--footer section end-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src='<?php echo getenv('BASE_URL') ?>/public/js/config.js'></script>

<?php include('./views/layouts/end.php') ?>