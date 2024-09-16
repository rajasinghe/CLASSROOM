let studentsTableBody = null;
let studentTableHeader = null;
let pid = 14;
let students = [];
let modules = [];
let preassessmentStudentApi = 'http://localhost:3000/preassessment/student';
let datesCount = 0;
let maxDateCount = 10;
let datesContainer = null;

async function getContent(preAssessmentContainer){
    let options = {
        body: JSON.stringify({
            component: 'markPreAssessment'
        }),
        headers: {
            'Content-Type': 'application/json'
        },
        method: 'post'
    }

    let template = await fetch(`${APIURL}/includes`, options).then(
        response => {
            return response.text()
        }
    );

    preAssessmentContainer.innerHTML = template;
    refreshListeners();
}

function refreshListeners() {
    studentTableHeader = document.getElementById('studentsTableHeader');
    studentsTableBody = document.getElementById('studentsTableBody');
    datesContainer = document.getElementById('datesContainer');
    document.getElementById('addDates').addEventListener('click', (e) => {
        let template = 
        `<div class="d-flex align-items-center mt-2">
            <input type="date" class="form-control w-50 dates">
        </div>`;

        if (datesCount <= maxDateCount) {
            datesContainer.insertAdjacentHTML('beforeend', template);
            datesCount++;
        } else {
            alert("You can't add more than");
        }

    });

    document.getElementById('submitBtn').addEventListener('click', (e) => {
        e.preventDefault();
        insertAssessmentResults();
    });
}

function getModules() {
    return new Promise((resolve, reject) => {
        let data = {
            pid: pid
        }
        let options = {
            headers: {
                'Content-Type': 'application/json'
            },
            method: "POST",
            body: JSON.stringify(data)
        }
        fetch('/course/courseModules', options).then(
            response => response.json()
        ).then(
            data => {
                modules = data;
                createTableStructure();
                resolve(data);
                console.log(data)
            }
        ).catch(
            e => {
                reject("Error in getting modules" + e)
            }
        )
    });

}

function getpreAssessmentStudents() {

    let data = {
        pid: pid
    }
    let options = {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    }

    fetch('/preassessment/student', options).then(
        response => response.json()
    ).then(
        data => {
            console.log(data);
            for (const student of data) {
                let studentObject = {
                    studentId: student['student_id'],
                    finalAssessmentEligibility: false,
                }

                for (const module of modules) {
                    studentObject[module['module_id']] = false;
                }
                console.log(studentObject);
                students.push(studentObject);
                createStudentRow(student, studentObject)
            }
        }
    ).finally(
        () => {
            console.log(students);
        }
    )
}

function createStudentRow(student, studentObject) {
    let row = document.createElement('tr');
    let mis = document.createElement('td');
    mis.innerHTML = student['mis'];
    row.appendChild(mis);
    let name = document.createElement('td');
    name.innerHTML = student['first_name'] + " " + student['last_name'];
    row.appendChild(name);
    for (const module of modules) {
        let cell = document.createElement('td');
        let checkBox = document.createElement('input');
        checkBox.type = 'checkbox';
        checkBox.addEventListener('click', (e) => {
            studentObject[module['module_id']] = !studentObject[module['module_id']];
            console.log(studentObject);
        })

        cell.appendChild(checkBox);
        row.appendChild(cell);
    }
    let finalAssessmentEligibilityCell = document.createElement('td');
    let finalAssessmentEligibilityCheckBox = document.createElement('input');
    finalAssessmentEligibilityCheckBox.type = 'checkbox';
    finalAssessmentEligibilityCell.appendChild(finalAssessmentEligibilityCheckBox);
    finalAssessmentEligibilityCheckBox.addEventListener('click', (e) => {
        studentObject['finalAssessmentEligibility'] = !studentObject['finalAssessmentEligibility'];
    })
    row.appendChild(finalAssessmentEligibilityCell);
    studentsTableBody.appendChild(row);
}

function createTableStructure() {
    let row = document.createElement('tr');
    row.innerHTML = `
    <th>MIS</th>
    <th>Name</th>
    `;
    for (const module of modules) {
        let th = document.createElement("th");
        th.innerHTML = module['module_no'];
        row.append(th);
    }
    let finalAssessmentEligibility = document.createElement('th');
    finalAssessmentEligibility.innerHTML = "Final Assessment Eligibility";

    row.appendChild(finalAssessmentEligibility);
    studentTableHeader.appendChild(row);
}

function insertAssessmentResults() {
    let dates = document.querySelectorAll('.dates');
    let dateList = [];
    dates.forEach((date) => {
        dateList.push(date.value);
    })
    let data = {
        pid: pid,
        students: students,
        dates: dateList
    }
    console.log(JSON.stringify(data));
    let options = {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    }
    fetch('/preassessment/student/results', options).then(response => response.json()).then(data => {
        if (data.hasOwnProperty('success')) {
            console.log("success");
            //done adding results redirect if required;
        } else {
            console.log(data);
        }
    }).catch(
        e => {
            console.log(e);
        }
    )
}

export {
    getContent,
    refreshListeners
}