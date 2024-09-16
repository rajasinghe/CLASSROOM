<!--Site Header section start-->
<div class="col-12 py-3 bg-white" id="site-header">
    <span class="fw-medium ms-4">STUDENT DETAILS</span>
</div>
<!--Site Header section end-->

<div class="row">
    <div class="col-12 d-flex pt-4">
        <span class="text-dark ms-md-2" id="nav-direction-section">
            <a href="<?php echo getenv('BASE_URL') ?>/batch/student"
                class="text-decoration-none text-dark me-md-1">Student</a>
            <i class="bi bi-caret-right-fill text-dark"></i>
            <a href="<?php echo getenv('BASE_URL') ?>/batch"
                class="text-decoration-none text-dark ms-md-1">Batch</a>
        </span>

        <span class="ms-auto me-md-2" id="content-nav">
            <a href="/batch/{{ batch_id }}/applicant" class="btn border-danger rounded-1 mb-2 active"
                id="applicant-link">
                Applicant Details
            </a>
            <a href="/batch/{{ batch_id }}/interview" class="btn border-danger rounded-1 mb-2" id="interview-link">
                Interview Selected
            </a>
            <a href="/batch/{{ batch_id }}/registeredStudent" class="btn border-danger rounded-1 mb-2"
                id="student-link">
                Registered Student
            </a>
        </span>
    </div>

    <div class="app-content-actions px-3 pt-2">
        <input class="search-bar" placeholder="Search..." type="text" id="search-field">
        <div class="app-content-actions-wrapper">
            <div class="filter-button-wrapper">
                <button class="action-button filter jsFilter ms-0 ms-md-1">
                    <span>Filter</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-filter">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                    </svg>
                </button>
                <form class="filter-menu" id="filter-menu">
                    <label for="category-select">Category</label>
                    <select name="category" id="category-select">
                        <option value="mis">MIS</option>
                        <option value="nic">ID</option>
                        <option value="name">Name</option>
                    </select>
                    <label for="status-select">Status</label>
                    <select name="status" id="status-select">
                        <option value="all">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="dropout">Drop Out</option>
                    </select>
                    <div class="filter-menu-buttons">
                        <button class="filter-button reset" type="button" id="clear-button">
                            Reset
                        </button>
                        <button class="filter-button apply" type="button" id="apply-button">
                            Apply
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <Span class="me-auto ms-md-auto me-md-0 mb-2" id="options-link-container">
            <a href="sdfsd" class="btn rounded-1" id="batch-options-link">
                dfsdf
            </a>
        </Span>
    </div>
</div>

<!-- table start -->
<section id="batch-content-container">

</section>