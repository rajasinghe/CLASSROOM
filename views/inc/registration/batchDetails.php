<div class="app-content-actions px-2">
    <input class="search-bar" type="text" placeholder="Search...">
    <div class="app-content-actions-wrapper">
        <div class="filter-button-wrapper">
            <div class="filter jsFilterSec">
                <button class="action-button mt-1">
                    <span>Filter</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-filter">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                    </svg>
                </button>
                <div class="filter-menuSec">
                    <label>Category</label>
                    <select>
                        <option>Batch Name</option>
                        <option>Batch Year</option>
                    </select>
                    <div class="filter-menuSec-buttons">
                        <button class="filter-button reset">
                            Reset
                        </button>
                        <button class="filter-button apply">
                            Apply
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- All Batches list start -->
<div class="row" id="batch-container">
    <!-- Batch card (Add new) start -->
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="batch-list new-batch">
            <a href="../form/bactchdd.html">
                <div class="picture newpicture addNewPicture">
                    <img class="img-fluid" src="/public/images/batchDetails/plusCrop.jpg">
                </div>
                <div class="batch-content">
                    <h3 class="batch-name">Add New</h3>
                    <h4 class="batch-title">Batch</h4>
                </div>
                <ul class="social addNewSocial">
                    <li><span class="goAhead">Go Ahead... </span><img src="/public/images/batchDetails/more.png">
                    </li>
                </ul>
            </a>
        </div>
    </div>
    <!-- Batch card (Add new) end -->
</div>
<!-- All Batches list end -->