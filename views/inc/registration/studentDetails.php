<div class="app-content-actions px-2  ">

    <input class="search-bar" placeholder="Search..." type="text">

    <div class="app-content-actions-wrapper">
        <div class="filter-button-wrapper">
            <div class="filter jsFilter">
                <button class="action-button ">
                    <span>Filter</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-filter">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                    </svg></button>
                <div class="filter-menu">
                    <label for="year-select">Year</label>
                    <!-- <input type="number" min="2010" max="2050" step="1" value="2016" /> -->
                    <select name="year" id="year-select">
                        <?php 
                        $currentYear = date("Y");
                        for($i=2015; $i <= $currentYear ;$i++){ ?>

                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

                        <?php } ?>
                    </select>
                    <label for="batch-select">Batch</label>
                    <select name="batch_id" id="batch-select">
                        <option>01</option>
                        <option>02</option>
                    </select>

                    <label for="category-select">Category</label>
                    <select name="category" id="category-select">
                        <option value="mis">MIS</option>
                        <option value="nic">ID</option>
                        <option value="name">Name</option>
                    </select>
                    <div class="filter-menu-buttons">
                        <button class="filter-button reset" type="button" id="clear-button">
                            Reset
                        </button>
                        <button class="filter-button apply" type="button" id="apply-button">
                            Apply
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="batch-container">
    <!-- <table class="table table-hover text-nowrap">
        <thead class=" table-dark">
            <tr>
                <th></th>
                <th>Name</th>
                <th>
                    MIS
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                    </svg>
                </th>
                <th>NIC</th>
                <th>TELEPHONE</th>
                <th>ADDRESS</th>
                <th>Status</th>

            </tr>
        </thead>
        <tbody id="tbody">
            <tr>
                <td>
                    <a href="/batch/student/01" class="btn1 btn">
                        <i class="bi bi-info-circle-fill"></i>
                    </a>
                </td>
                <td>G.DULANKA PROMAODYA</td>
                <td>FN/23/SD/1/0001</td>
                <td>2000111111</td>
                <td>0789999999</td>
                <td>NO 89 KOHEDA DANNE ROAD KALUTHARA SOUTH</td>
                <td><span class="status active">Active</span></td>
            </tr>
            <tr>
                <td>
                    <a href="/batch/student/01" class="btn1 btn">
                        <i class="bi bi-info-circle-fill"></i>
                    </a>
                </td>
                <td>G.DULANKA PROMAODYA</td>
                <td>FN/23/SD/1/0001</td>
                <td>2000111111</td>
                <td>0789999999</td>
                <td>NO 89 KOHEDA DANNE ROAD KALUTHARA SOUTH</td>
                <td><span class="status inactive">Inactive</span></td>
            </tr>
            <tr>
                <td>
                    <a href="/batch/student/01" class="btn1 btn">
                        <i class="bi bi-info-circle-fill"></i>
                    </a>
                </td>
                <td>G.DULANKA PROMAODYA</td>
                <td>FN/23/SD/1/0001</td>
                <td>2000111111</td>
                <td>0789999999</td>
                <td>NO 89 KOHEDA DANNE ROAD KALUTHARA SOUTH</td>
                <td><span class="status disabled">Disabled</span></td>
            </tr>
            <tr>
                <td>
                    <a href="/batch/student/01" class="btn1 btn">
                        <i class="bi bi-info-circle-fill"></i>
                    </a>
                </td>
                <td>G.DULANKA PROMAODYA</td>
                <td>FN/23/SD/1/0001</td>
                <td>2000111111</td>
                <td>0789999999</td>
                <td>NO 89 KOHEDA DANNE ROAD KALUTHARA SOUTH</td>
                <td><span class="status disabled">Disabled</span></td>
            </tr>
            <tr>
                <td>
                    <a href="/batch/student/01" class="btn1 btn">
                        <i class="bi bi-info-circle-fill"></i>
                    </a>
                </td>
                <td>G.DULANKA PROMAODYA</td>
                <td>FN/23/SD/1/0001</td>
                <td>2000111111</td>
                <td>0789999999</td>
                <td>NO 89 KOHEDA DANNE ROAD KALUTHARA SOUTH</td>
                <td><span class="status disabled">Disabled</span></td>
            </tr>
            <tr>
                <td>
                    <a href="/batch/student/01" class="btn1 btn">
                        <i class="bi bi-info-circle-fill"></i>
                    </a>
                </td>
                <td>G.DULANKA PROMAODYA</td>
                <td>FN/23/SD/1/0001</td>
                <td>2000111111</td>
                <td>0789999999</td>
                <td>NO 89 KOHEDA DANNE ROAD KALUTHARA SOUTH</td>
                <td><span class="status disabled">Disabled</span></td>
            </tr>
            <tr>
                <td>
                    <a href="/batch/student/01" class="btn1 btn">
                        <i class="bi bi-info-circle-fill"></i>
                    </a>
                </td>
                <td>G.DULANKA PROMAODYA</td>
                <td>FN/23/SD/1/0001</td>
                <td>2000111111</td>
                <td>0789999999</td>
                <td>NO 89 KOHEDA DANNE ROAD KALUTHARA SOUTH</td>
                <td><span class="status disabled">Disabled</span></td>
            </tr>
            <tr>
                <td>
                    <a href="/batch/student/01" class="btn1 btn">
                        <i class="bi bi-info-circle-fill"></i>
                    </a>
                </td>
                <td>G.DULANKA PROMAODYA</td>
                <td>FN/23/SD/1/0001</td>
                <td>2000111111</td>
                <td>0789999999</td>
                <td>NO 89 KOHEDA DANNE ROAD KALUTHARA SOUTH</td>
                <td><span class="status disabled">Disabled</span></td>
            </tr>
            <tr>
                <td>
                    <a href="/batch/student/01" class="btn1 btn">
                        <i class="bi bi-info-circle-fill"></i>
                    </a>
                </td>
                <td>G.DULANKA PROMAODYA</td>
                <td>FN/23/SD/1/0001</td>
                <td>2000111111</td>
                <td>0789999999</td>
                <td>NO 89 KOHEDA DANNE ROAD KALUTHARA SOUTH</td>
                <td><span class="status disabled">Disabled</span></td>
            </tr>
        </tbody>
    </table> -->
</section>