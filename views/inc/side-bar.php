<div class="col-4 col-md-3 col-lg-2 px-0 
<?php if(isset($_COOKIE['sideBarHidden']) && $_COOKIE['sideBarHidden'] == 'true') echo 'hide'; ?>" id="sidebar-container">
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header mb-4">
            <div class="app-icon">
                <img src="/public/images/appLogo.png" alt="App Logo">
            </div>
            <button class="btn text-white py-0 px-1 fs-5" id="side-toggle-btn">
                <i class="bi bi-arrow-left-square-fill"></i>
            </button>
        </div>
        <ul class="sidebar-list">
            <li class="sidebar-list-item <?php if ($currentPage === 'home')
                echo 'active'; ?>">
                <a href="/dashboard">
                    <i class="fa-solid fa-house me-3"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="sidebar-list-item <?php if ($currentPage === 'student') echo 'active'; ?>">
                <a href="/batch/student">
                    <i class="fa-solid fa-user-graduate me-3"></i>
                    <span>Student </span>
                </a>
            </li>
            <li class="sidebar-list-item <?php if ($currentPage === 'attendance')
                echo 'active'; ?>">
                <a href="/attendance">
                    <i class="fa-solid fa-calendar-days me-3"></i>
                    <span>Attendance </span>
                </a>
            </li>
            <li class="sidebar-list-item <?php if ($currentPage === 'assessment')
                echo 'active'; ?>">
                <a href="/assessment">
                    <i class="fa-solid fa-graduation-cap me-3"></i>
                    <span>Assesment</span>
                </a>
            </li>
            <li class="sidebar-list-item <?php if ($currentPage === 'inventory')
                echo 'active'; ?>">
                <a href="/inventory">
                    <i class="fa-solid fa-boxes-stacked me-3"></i>
                    <span>Inventory</span>
                </a>
            </li>
            <li class="sidebar-list-item <?php if ($currentPage === 'jobDetails')
                echo 'active'; ?>">
                <a href="/jobDetails">
                    <i class="bi bi-ticket-detailed me-3"></i>
                    <span>Job Details </span>
                </a>
            </li>
            <li class="sidebar-list-item <?php if ($currentPage === 'notifications')
                echo 'active'; ?>">
                <a href="/notifications">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-bell">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                        <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                    </svg>
                    <span>Notifications</span>
                </a>
            </li>
        </ul>
        <div class="account-info dropup">
            <div class="account-info-picture">
                <?php if (isset($_SESSION['user'])) { ?>
                    <img src="./public/images/<?php echo $_SESSION['user']['profile_img'] ?>" alt="Account">
                <?php } else { ?>
                    <img src="https://images.unsplash.com/photo-1527736947477-2790e28f3443?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTE2fHx3b21hbnxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60"
                        alt="Account">
                <?php } ?>
            </div>
            <div class="account-info-name">
                <?php if (isset($_SESSION['user'])) {

                    echo $_SESSION['user']['name'];

                } else { ?>
                    Monica G.
                <?php } ?>
            </div>
            <button class="account-info-more" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-more-horizontal">
                    <circle cx="12" cy="12" r="1" />
                    <circle cx="19" cy="12" r="1" />
                    <circle cx="5" cy="12" r="1" />
                </svg>
            </button>

            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">View Profile</a></li>
                <li><a class="dropdown-item" href="/">Home Page</a></li>
                <li><a class="dropdown-item" href="/logout">Logout <i class="bi bi-box-arrow-right ms-3"></i></a></li>
            </ul>
        </div>
    </div>
</div>