// Stores information about the calendar status( example :- corrunt month , year)
let currentDate = new Date();
let calendarSelectedDate = new Date();
let attendanceData = null;
let holidays = [];
let myMonth;
const monthArray = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];

// Element variables
let dateField = null;
let attendanceSection = null;
let holidayField = null;
let holidayTitle = null;
let holidayDescription = null;
let attendanceProgressTables = null;

const dateListener = () => {
    holidayField = document.querySelector('.holiday-form #holidayField');
    holidayTitle = document.querySelector('.holiday-form #titleField');
    holidayDescription = document.querySelector('.holiday-form #descriptionField');

    let listItems = document.querySelectorAll('.calendar-body .body-body li');
    for (const li of listItems) {
        li.addEventListener('click', event => {
            let date = li.innerText;
            date = (Number.parseInt(date) < 10) ? '0' + date : date;

            date = `${calendarSelectedDate.getFullYear()}-${(myMonth < 10) ? '0' + myMonth : myMonth}-${date}`;
            holidayField.value = date;
            holidayTitle.value = '';
            holidayDescription.value = '';

            // Set holiday form field values
            holidays.forEach(holiday => {
                if (holiday['date'] === date) {
                    holidayTitle.value = holiday['title'];
                    holidayDescription.value = holiday['description'];
                }
            });

            // Add styles to the clicked item
            li.classList.add('selected');

            // Remove styles from every other item
            listItems.forEach(element => {
                if (element !== li) {
                    element.classList.remove('selected');
                }
            });
        });
    }
}

function refreshListeners() {
    currentDate = new Date();
    calendarSelectedDate = new Date();
    generateCalendarBody(calendarSelectedDate);
    let m = (myMonth < 10) ? "0" + myMonth : myMonth;
    let d = (currentDate.getDate() < 10) ? "0" + currentDate.getDate() : currentDate.getDate();

    let dateString = currentDate.getFullYear() + "-" + m + '-' + d;

    dateField = document.querySelector('#dateField');
    attendanceSection = document.querySelector('#attendance-section');
    attendanceProgressTables = document.querySelectorAll('.attendance-progress tbody');

    dateField.value = dateString;
    getAttendance({ date: dateString, batch_id: window.selectedBatch['batch_id'] });
    getAttendanceProgress();
    //console.log(dateString);

    // Action Listeners
    dateListener();

    document.querySelector('#next-btn').addEventListener('click', event => {
        calendarSelectedDate.setMonth(calendarSelectedDate.getMonth() + 1);

        generateCalendarBody(calendarSelectedDate);
    });

    document.querySelector('#pre-btn').addEventListener('click', function (event) {
        calendarSelectedDate.setMonth(calendarSelectedDate.getMonth() - 1);

        generateCalendarBody(calendarSelectedDate);
    });

    document.querySelector('.calendar .legend .manage-btn').addEventListener('click', event => {
        document.querySelector('#calendar-container .site-card').classList.toggle('floating');
        document.querySelector('#calendar-container .holiday-form').classList.toggle('d-none');
        event.target.innerText = (event.target.innerText === 'Manage') ? 'Close' : 'Manage';
    });

    dateField.addEventListener('change', event => {
        let date = event.target.value;
        console.log(date);
        getAttendance({ date, batch_id: window.selectedBatch['batch_id'] });
    });

    document.querySelector('#saveAttendanceButton').addEventListener('click', event => {
        saveAttendance();
    });

    document.querySelector('#addHolidayButton').addEventListener('click', event => {
        if (validateHolidayForm()) {
            manageHolidays({
                operation: 'add',
                date: holidayField.value,
                title: holidayTitle.value,
                description: holidayDescription.value
            });
        }
    });

    document.querySelector('#removeHolidayButton').addEventListener('click', event => {
        if (validateHolidayForm()) {
            manageHolidays({
                operation: 'remove',
                date: holidayField.value,
                title: holidayTitle.value,
                description: holidayDescription.value
            });
        }
    });
}

function refreshDataFunctions() {
    getAttendance({ date: dateField.value, batch_id: window.selectedBatch['batch_id'] });
    getAttendanceProgress();
}

async function generateCalendarBody(selectedDate) {

    // Make a request to the back end and get the holidays for this month
    //TODO: put the fetch request to a seperate function and call this function in the then callback
    let y = selectedDate.getFullYear();
    let m = selectedDate.getMonth();

    myMonth = m; // Used to mark the holidays in the calendar
    if (myMonth === 0) myMonth = 1;
    else if (myMonth > 0) myMonth++;

    // Fetch the holidays in the month from the server
    holidays = await getHolidays({ month: myMonth });

    selectedDate.setDate(1);

    let tempDate = new Date(selectedDate);
    tempDate.setMonth((tempDate.getMonth() + 1), 0);
    let numOfDays = tempDate.getDate();

    let dayOfWeek = selectedDate.getDay();
    dayOfWeek = (dayOfWeek < 1) ? 7 : dayOfWeek;

    console.log(y + ' ' + m + ' ' + numOfDays + ' Day of the week' + dayOfWeek);

    // Template for the calendar body
    let template = ``;

    for (let index = 0; index < (dayOfWeek - 1); index++) {
        template += `<li></li>`;
    }

    for (let index = 1; index <= numOfDays; index++) {

        // Generate the current month to check if it is a holiday
        let currentDateString = `${y}-${(myMonth < 10) ? '0' + myMonth : myMonth}-${(index < 10) ? '0' + index : index}`;
        let litem = `<li>${index}</li>`;

        // Change styles if the date is today
        holidays.forEach(holiday => {
            if (holiday['date'] === currentDateString) {
                litem = `<li class="holiday">${index}</li>`;
            }
        });

        // Change styles if it is a holiday
        if (currentDate.getFullYear() === y && currentDate.getMonth() === m && currentDate.getDate() === index) {
            litem = `<li class="today">${index}</li>`;
        }

        template += litem;
    }

    // Set the newly generated calendar body
    document.querySelector('#calendar-dates').innerHTML = template;

    m = selectedDate.toLocaleString('en-US', { month: 'long' });
    document.querySelector('.calendar-title').innerText = m + ' ' + y;
    dateListener();
}

function generateAttendanceTable(data) {
    let template =
        `<table class="table table-borderless mb-0" id="attendance-table">
    <thead>
    <tr>
        <th scope="col" class="text-center">
        MIS
        </th>
        <th scope="col" class="text-center d-none d-md-table-cell">NIC</th>
        <th scope="col" class="text-center d-none d-lg-table-cell">INITIALS</th>
        <th scope="col" class="text-center">LAST NAME</th>
        <th scope="col" class="text-center">ATTENDANCE</th>
    </tr>
    </thead><tbody>`;

    for (const d of data) {
        template +=
            `<tr>
            <th scope="row" class="text-center">
            ${d['mis']}
            </th>
            <td class="d-none d-md-table-cell text-center">${d['nic']}</td>
            <td class="d-none d-lg-table-cell text-center">${d['initials']}</td>
            <td class="text-center">${d['last_name']}</td>
            <td>
            <div class="d-flex justify-content-center bg">
                <input type="checkbox" class="form-check" ${(d['attendance'] == 1) ? 'checked' : ''}>
            </div>
            </td>
        </tr>`;
    }

    template += `</tbody>`;

    attendanceSection.innerHTML = template;
}

async function getAttendance(attendanceObject) {

    let data = await fetch(`${APIURL}/attendance/view`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(attendanceObject)
    })
        .then(response => {
            return response.json();
        }).catch(error => {
            alert(error);
        })

    console.log(data);

    let statusDiv = document.querySelector('#attendance-status');
    let dayNameDiv = document.querySelector('#attendance-dayname');
    let holidayDiv = document.querySelector('#attendance-day-status');

    if (data['status'] === 'date_ahead') {
        attendanceSection.innerHTML =
            `<div class="d-flex justify-content-center align-items-center">
            <img src="${APIURL}/public/images/nodata.gif" style="max-height:280px;" class="img-fluid" alt="nothing">
            <div class="ps-2 d-none d-lg-block">
                <h1>Oops No Data Found...</h1>
                <p class="fs-5">${data['message']}</p>
            </div>
        </div>`;
        statusDiv.innerHTML = '';
        return;
    }

    attendanceData = data['data']['attendanceData'];
    generateAttendanceTable(data['data']['attendanceData']);

    dayNameDiv.innerHTML = new Date(attendanceObject['date']).toLocaleString('en-us', { weekday: 'long' });
    holidayDiv.innerHTML = (data['data']['holiday'] === null) ? '' : 'Holiday';
    console.log(data['data']['holiday']);

    if (data['status'] === 'not_marked') {
        statusDiv.innerHTML = `Not Marked <i class="fa-regular fa-square ms-2"></i>`;
    }
    else {
        statusDiv.innerHTML = `Marked <i class="fa-solid fa-check-to-slot ms-2"></i>`;
    }
}

function saveAttendance() {
    // Format the data
    let checkInputs = document.querySelectorAll('#attendance-table .form-check');

    for (let index = 0; index < attendanceData.length; index++) {
        attendanceData[index]['attendance'] = (checkInputs[index].checked) ? 'PRESENT' : 'ABSENT';
    }

    let dataObject = {
        date: dateField.value,
        attendance: attendanceData
    };

    fetch(`${APIURL}/attendance/save`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dataObject)
    })
        .then(response => {
            return response.json();
        })
        .then(data => {
            if (data['condition'] === 'failed') {
                // Change these to add stylized modals
                alert(data['message']);
                return;
            }

            alert(data['message']);
        }).catch(error => {
            alert(error);
        })
}

function validateHolidayForm() {
    let date = holidayField.value;
    let title = holidayTitle.value;

    if (date === '') {
        document.querySelector('.holiday-form #holidayFieldError').innerHTML = 'Please select a date to make changes';
        return false;
    }

    if (title === '') {
        document.querySelector('.holiday-form #titleFieldError').innerHTML = 'Please give a title to the holiday';
        return false;
    }

    document.querySelector('.holiday-form #holidayFieldError').innerHTML = '';
    document.querySelector('.holiday-form #titleFieldError').innerHTML = '';
    return true;
}

async function manageHolidays(options) {

    let data = await fetch(`${APIURL}/attendance/holiday/add`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(options)
    })
        .then(response => {
            return response.json();
        }).catch(error => {
            alert(error);
        })

    alert(data['message']);
    generateCalendarBody(calendarSelectedDate);
}

async function getHolidays(dataObject) {

    return await fetch(`${APIURL}/attendance/holiday`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dataObject)
    })
        .then(response => {
            return response.json();
        })
        .then(data => {
            if (data['condition'] === 'failed') {
                // Change these to add stylized modals
                alert(data['message']);
                return;
            }

            return data['data'];
        }).catch(error => {
            console.log(error);
        })
}

async function getAttendanceProgress() {

    let data = await fetch(`${APIURL}/reports`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            reportType: 'percentage',
            "batch_id": window.selectedBatch['batch_id']
        })
    })
        .then(response => { return response.json(); })

    //console.log(data);

    let template = ``;

    for (const percentage in data['data'][0]) {
        let m = Number.parseInt(percentage.replace(/^\d{4}-/, ""));
        let value = data['data'][0][percentage];

        let color = (value >= 80) ? '100 210 80' : '224, 193, 92';
        color = (value < 70) ? '210, 80, 80' : color;

        template +=
            `<tr>
            <th scope="row"> ${monthArray[m - 1]} </th>
            <td style="--size: ${0.01 * value}; --color: rgba(${color});"> ${(value > 0) ? value + '%' : ''} </td>
        </tr>`;
    }

    attendanceProgressTables[0].innerHTML = template;
    attendanceProgressTables[1].innerHTML = template;
}

export {
    refreshListeners,
    refreshDataFunctions
};