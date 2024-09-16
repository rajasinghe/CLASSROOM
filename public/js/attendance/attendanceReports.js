const reportsUrl = `${APIURL}/reports`;

let monthlyReportData = null;   // This keeps the data which is used to create the google sheet report 
let annualReportData = null;    // This keeps the data which is used to create the google sheet report
let mon;
let years = [];
let selectedYear = null;
let monthName;

// Element variables
let monthField = null;
let yearField = null;
let mButton = null;
let aButton = null;


function refreshListeners() {
    
    mButton = document.querySelector('#mButton');
    aButton = document.querySelector('#aButton');

    renderMonthlyCard();
    mon = new Date().getMonth() +1;
    selectedYear = years[years.length - 1];

    monthField.value = mon;
    yearField.value = selectedYear;
    getMonthlyReport(mon,selectedYear);

    // Monthly report button action listener
    mButton.addEventListener('click', event => {
        changeActiveButton('monthly');
        renderMonthlyCard();
        monthField.value = mon;
        yearField.value = selectedYear;
        getMonthlyReport(mon,selectedYear);
    });

    // Annual report button action listener
    aButton.addEventListener('click', event => {
        changeActiveButton('annual');
        renderAnnualCard();
        getAnnualReport();
    });
}

function refreshDataFunctions(){

    if(document.querySelector('#report-nav .active') === mButton){
        renderMonthlyCard();
        monthField.value = mon;
        getMonthlyReport(mon,selectedYear);
    }
    else{
        renderAnnualCard();
        getAnnualReport();
    }
}

function getMonthlyReport(month,year) {

    //console.log('monthly report is here');
    fetch(reportsUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            reportType: 'monthly',
            month : month,
            year : year,
            batch_id : window.selectedBatch['batch_id']
        })
    })
        .then(response => {
            return response.json();
        })
        .then(data => {
            //console.log(data);
            data['month'] = month;
            renderMonthlyReport(data);
        })
}

function getAnnualReport() {
    fetch(reportsUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            reportType: 'annual',
            batch_id : window.selectedBatch['batch_id']
        })
    })
        .then(response => {
            return response.json();
        })
        .then(data => {
            console.log(data);
            renderAnnualReport(data['data']);
        })
}

function changeActiveButton(button) {

    if (button === 'annual') {
        mButton.classList.remove('active');
        aButton.classList.add('active');
        return;
    }

    aButton.classList.remove('active');
    mButton.classList.add('active');
}

// Renders and displays the monthly report on the page
function renderMonthlyReport(rData) {
    let tableContainer = document.querySelector('#monthly-report .table-responsive');

    if( rData["data"].length < 1 || !Object.hasOwn(rData["data"], "rows")){

        tableContainer.innerHTML = 
        `<div class="d-flex justify-content-center align-items-center">
            <img src="${APIURL}/public/images/nodata.gif" style="max-height:280px;" class="img-fluid" alt="nothing">
            <div class="ps-2 d-none d-lg-block">
                <h1>Oops No Data Found...</h1>
                <p class="fs-5"> It looks like this report has been removed or 
                    has not yet been generated</p>
            </div>
        </div>`;

        monthlyReportData = null;
        document.querySelector('#report-info').innerHTML = '';
        return;
    }

    let days = numOfDaysInMonth(new Date().getFullYear(), rData['month']);

    // Store data for the google reports
    monthlyReportData = {};
    let reportData = monthlyReportData = rData['data'];
    monthlyReportData.month = monthName;
    monthlyReportData.days = days;
    

    // Generate the table template
    let template =
        `<thead>
    <tr>
        <th scope="col" rowspan="2" class="align-middle text-nowrap">
        MIS
        </th>
        <th scope="col" rowspan="2" class="d-none d-md-table-cell align-middle text-nowrap">NIC</th>
        <th scope="col" rowspan="2" class="align-middle text-nowrap">INITIALS</th>
        <th scope="col" rowspan="2" class="align-middle text-nowrap">LAST NAME</th>
        <th scope="col" colspan="${days}" class="text-center d-none d-md-table-cell">ATTENDANCE</th>
        <th colspan="2" class="text-center">SUMMARY</th>
    </tr><tr>`;

    for (let i=1; i <= days; i++) {
        template += `<th scope="col" class="d-none d-md-table-cell tiny">${i}</th>`;
    }

    template += `<th scope="col" class="tiny"> </th>
        <th scope="col" class="text-center tiny">%</th>
    </tr>
    </thead>
    <tbody>`;

    for (const data of reportData['rows']) {

        // For the template
        template += `<tr>
                <th>
                ${data['mis']}
                </th>
                <td class="d-none d-md-table-cell">${data['nic']}</td>
                <td>${data['initials']}</td>
                <td>${data['last_name']}</td>`;

        let dDate = (data['drop_out_date'] === null)? ['0','3000','20','35'] : /(\d{4})-(\d{2})-(\d{2})/.exec(data['drop_out_date']);

        // Checks if the student has dropped out and shows the droup out status if he/she has

        if( Number.parseInt(dDate[1]) < Number.parseInt(yearField.value) || 
            ( (Number.parseInt(dDate[2]) < Number.parseInt(rData['month'])) && 
            (Number.parseInt(dDate[1]) == Number.parseInt(yearField.value)) ) ) {
            // If the drop out month or the year is before the selected month or year show drop out status for all days

            template += `<td colspan="${days}" class="text-center d-none d-md-table-cell">----- DROP OUT ----</td>`;
        }
        else if(Number.parseInt(dDate[2]) == Number.parseInt(rData['month']) 
            && Number.parseInt(dDate[1]) == Number.parseInt(yearField.value)){
            // If the drop out month and the year is equeal to the selected month and year show drop out status for all days after the
            // drop out date and show attendance for ones before that

            let daysAfterDropOut = 0; // Number of days in the month after the drop out date

            for (let i=1; i <= days; i++) {
                if(Number.parseInt(dDate[3]) <= i){
                    daysAfterDropOut++;
                }
                else if(Object.hasOwn(data['attendance'], i + '')){
                    template += `<td class="d-none d-md-table-cell tiny">${data['attendance'][i]}</td>`;
                }
                else{
                    template += `<td class="d-none d-md-table-cell tiny"> </td>`;
                }
            }

            template += `<td colspan="${daysAfterDropOut}" class="text-center d-none d-md-table-cell">----- DROP OUT ----</td>`;
        }
        else{
            // Show attendance as usual
            for (let i=1; i <= days; i++) {

                if(Object.hasOwn(data['attendance'], i + '')){
                    template += `<td class="d-none d-md-table-cell tiny">${data['attendance'][i]}</td>`;
                }
                else{
                    template += `<td class="d-none d-md-table-cell tiny"> </td>`;
                }
            }
        }

        let cName = 'bad'; // The correct class for styling the percentage cell based on student attendance
        if(data['percentage'] >= 80) cName = 'good';
        else if(data['percentage'] >= 70) cName = 'average';

        template += `<td class="tiny">${data['total']}</td>
                <td class="${cName} text-center tiny">${data['percentage']}%</td>
            </tr>`;

    }

    template += `</tbody>`;

    let monthlyTable = document.createElement('table');

    monthlyTable.id = "monthly-table";
    monthlyTable.className = 'table table-bordered mb-0 monthly-table';
    monthlyTable.innerHTML = template;

    // Generate report info
    document.querySelector('#report-info').innerHTML = 
    `<h6 class="ms-md-3 ">All Days - ${reportData['totalConductedDays']}</h6>
    <h6 class="ms-md-5 ">Present Days - ${reportData['totalAttendance']}</h6>
    <h6 class="ms-md-5 ">Class - ${reportData['totalPercentage']}%</h6>`;

    tableContainer.innerHTML = '';
    tableContainer.appendChild(monthlyTable);

    console.log(monthlyReportData);
}

// Renders and displays the annual report on the page
function renderAnnualReport(reportData) {
    let tableContainer = document.querySelector('#monthly-report .table-responsive');

    if(reportData.length < 1) {

        tableContainer.innerHTML = 
        `<div class="d-flex justify-content-center align-items-center">
            <img src="${APIURL}/public/images/nodata.gif" style="max-height:280px;" class="img-fluid" alt="nothing">
            <div class="ps-2 d-none d-lg-block">
                <h1>Oops No Data Found...</h1>
                <p class="fs-5"> It looks like the <strong>Annual Attendance Report</strong> for this batch <br>has been removed or 
                    has not yet been generated</p>
            </div>
        </div>`;
        return;
    }

    let template =
        `<thead>
            <tr>
                <th scope="col" rowspan="2" class="align-middle">
                    MIS
                </th>
                <th scope="col" rowspan="2" class="align-middle">NIC</th>
                <th scope="col" rowspan="2" class="d-none d-md-table-cell align-middle">INITIALS</th>
                <th scope="col" rowspan="2" class="d-none d-lg-table-cell align-middle">LAST NAME</th>
                <th scope="col" colspan="${reportData['dates'].length}" class="text-center">ATTENDANCE</th>
                <th colspan="4"></th>
            </tr>
            <tr>`;

            for (const day of reportData['dates']) {
                template += `<th scope="col">${day}</th>`;
            }
            
            template +=
            `
                <th scope="col">Total </th>
                <th scope="col">Counducted Days</th>
                <th scope="col" class="text-center">%</th>
                <th>Rank</th>
            </tr>
        </thead><tbody>`;

    for (const data of reportData['students']) {

        template += `<tr>
            <th>
            ${data['mis']}
            </th>
            <td>${data['nic']}</td>
            <td class="d-none d-md-table-cell">${data['initials']}</td>
            <td class="d-none d-lg-table-cell">${data['last_name']}</td>`;
            
            let dDate = (data['drop_out_date'] === null)? ['0','3000','20','35'] : /\d{2}(\d{2})-(\d{2})-(\d{2})/.exec(data['drop_out_date']);
            let monthsAfterDropOut = 0;

            let attData = data['attendance'];
        for (const key in attData) {

            let currentDate = /(\d{2})-(\d{1,2})/.exec(key);

            if( Number.parseInt(dDate[1]) < Number.parseInt(currentDate[1]) || 
                (Number.parseInt(dDate[2]) < Number.parseInt(currentDate[2]) 
                && Number.parseInt(dDate[1]) === Number.parseInt(currentDate[1]))){
                
                monthsAfterDropOut++;
            }
            else{
                template += `<td>${attData[key]}</td>`;
            }
        }

        if(monthsAfterDropOut > 1){
            template += `<td colspan="${monthsAfterDropOut}" class="text-center"> ---- DROP OUT ---- </td>`;
        }

        let cName = 'bad';
        if(data['percentage'] >= 80) cName = 'good';
        else if(data['percentage'] >= 70) cName = 'average';

        template +=
            `<td>${data['total']}</td>
            <td>${data['conducted_days']}</td>
            <td class="${cName} text-center">${data['percentage']}%</td>
            <td>${data['rank']}</td>
            </tr>`;
    }

    template += `</tbody>`;

    let annualTable = document.createElement('table');

    annualReportData = reportData;
    annualTable.className = 'table table-bordered mb-0 annual-table';
    annualTable.innerHTML = template;

    tableContainer.innerHTML = '';
    tableContainer.appendChild(annualTable);
}

function renderMonthlyCard() {

    years = [];
    let sDate = /^\d{4}/.exec(selectedBatch['start_date'])[0]; // Get the year from the start date string
    let eDate = /^\d{4}/.exec(selectedBatch['end_date'])[0]; // Get the year from the end date string

    if(sDate === eDate){
        years.push(sDate); // If course duration is less that 1 year only add one opition to the select element
    }
    else{
        // Else add all years between the two years
        sDate = (sDate != null)? Number.parseInt(sDate) : 0;
        eDate = (eDate != null)? Number.parseInt(eDate) : 0;

        for(let year = sDate; year <= eDate; year++){
            years.push(year);
        }
    }

    let template = 
    `<div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-5 px-0 d-flex align-items-center">
                <h4 class="fs-4 my-0">MONTHLY ATTENDANCE</h4>
            </div>
            <div class="col-12 col-md-7 px-0 pt-3 pt-md-0">
                <form class="container-fluid">
                    <div class="row justify-content-end align-items-center">
                        <div class="col-6 col-md-5 pe-md-2">
                            <select id="yearField" class="form-control form-select">
                                <option value="none">Select Year</option>`;

    for(const year of years){
        template += `<option>${year}</option>`;
    }

    template += 
    `</select>
        </div>
        <div class="col-6 col-md-5 pe-md-2">
            <select id="monthField" class="form-control form-select">
                <option value="none">Select Month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">Octomber</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
        </div>
    </div>
    </form>
    </div>
    <div class="col-12 px-0 ">
    <hr>
    </div>
    </div>
    </div>
    <div class="table-responsive tablescorlbar">
    </div>
    <div class="pt-4 d-flex flex-column flex-md-row" id="report-info">
    </div>
    <div class="d-flex justify-content-end  pe-3">
    <button class="btn site-btn rounded-1" id="saveAttendanceButton">Save as PDF</button>
    </div>`;

    // Add template
    document.querySelector('#monthly-report .card-body').innerHTML = template;

    // Add event listeners
    monthField = document.querySelector('#monthField');
    yearField = document.querySelector('#yearField');

    monthField.addEventListener('change', event => {
        let mon = event.target.value;
        let year = yearField.value;

        if (mon === 'none' || year === 'none') {
            return;
        }

        getMonthlyReport(mon,year);

        let mn = new Date();
        mn.setMonth(mon -1)
        monthName = mn.toLocaleString('en-US', { month: 'long',});
    });

    document.querySelector('#saveAttendanceButton').addEventListener('click', event => {
        //TODO: Save report to the googlesheet
        if(monthlyReportData === null) return;
        generateReport('monthly',monthlyReportData);
    })
}

function renderAnnualCard() {
    // Add template
    document.querySelector('#monthly-report .card-body').innerHTML =
        `<div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-5 px-0 d-flex align-items-center">
                <h4 class="fs-4 my-0">ANNUAL ATTENDANCE</h4>
            </div>
            <div class="col-12 px-0 ">
                <hr>
            </div>
        </div>
    </div>
    <div class="table-responsive tablescorlbar">
    </div>
    <div class="pt-3" id="report-info">
    </div>
    <div class="d-flex justify-content-end pe-3">
        <button class="btn site-btn rounded-1" id="saveAttendanceButton">Save as PDF</button>
    </div>`;

    document.querySelector('#saveAttendanceButton').addEventListener('click', event => {
        //TODO: Save report to the googlesheet
        if(annualReportData === null) return;
        generateReport('annual',annualReportData);
    })
}

function generateReport(reportType,reportData){
    //let html = document.querySelector('#monthly-table').innerHTML;

    fetch(`${APIURL}/reports/save`,{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify({
            reportType,
            values: reportData
        })
    })
    .then( response => {
        console.log(response);
        return response.blob();
    })
    .then( blob => {
        const url = URL.createObjectURL(blob);

        // Use the generated URL as needed (e.g., open in a new tab, download, etc.)
        window.open(url, '_blank');
        //console.log(blob);
    })
}

const numOfDaysInMonth = (y, m) => new Date(y, m, 0).getDate();

export {
    refreshListeners,
    refreshDataFunctions
};