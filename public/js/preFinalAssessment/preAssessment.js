/* defined variables */
let preassessmentStudentApi = `${APIURL}/preassessment/student`;
let createAssessmentApi = `${APIURL}/preassessment/createPreAssessment`;

let currentBatchId = 1;

//Element Variables
let searchTable, searchLoader,
    nameOption, misOption, batchOption = null,
    userInput = null;

/* variable needed for script functions */
let searchOption = null;
let currentBatchStudentsRows = [];
let preAssessmentStudents = [];
let preAssessmentRepeatedStudents = [];
let searchTableStudents = [];
let searchController = new AbortController();
let searchControllerSignal = searchController.signal;
let searchOptions = [nameOption, misOption, batchOption];
/* page initialization */

async function getContent(preAssessmentContainer) {
    let options = {
        body: JSON.stringify({
            component: 'preAssessment'
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
    searchTable = document.getElementById('searchTable');
    searchLoader = document.getElementById('searchloader');
    nameOption = document.getElementById('nameOption');
    misOption = document.getElementById('misOption');
    batchOption = document.getElementById('batchIdOption');
    userInput = document.getElementById('searchField');

    searchOption = "name";
    userInput.addEventListener('keyup', (e) => {
        console.log(searchOption);
        console.log(userInput.value);
        searchStudents(e.target.value);
    });


    document.getElementById('continueBtn').addEventListener('click', (e) => {
        //getCheckedstudents();

        let mergedArray = [...preAssessmentStudents, ...preAssessmentRepeatedStudents];
        let arrayString = mergedArray.join(',');

        if (assessorRegNoValidation() & asssessorNameValidation() & dateValidation() & selectedStudentsValidation()) {

            let data = {
                assessorName: document.getElementById('preAssessmentAssessorName').value,
                assessorRegNo: document.getElementById('preAssessmentAssessorRegNo').value,
                date: document.getElementById('preAssessmentDate').value,
                batchId: currentBatchId,
                students: arrayString
            }
            console.log("date" + document.getElementById('preAssessmentDate').value)
            console.log("arrayString" + arrayString)

            let options = {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            }

            fetch(createAssessmentApi, options).then(
                response => response.json()
            ).then(
                data => {
                    console.log(data);
                    if (data.hasOwnProperty('pid')) {
                        console.log(data['pid']);
                        window.location.href = '/assessment/preAssessment/students?pid=' + data['pid'];

                    } else {
                        console.log("pid not recieved")
                    }
                }
            )
        }

    });

    nameOption.addEventListener("click", (e) => {
        searchOptions.forEach(option => {
            option.classList.remove('active-filter')
        })
        e.target.classList.add('active-filter');
        searchOption = 'name'

    });

    misOption.addEventListener("click", (e) => {
        searchOptions.forEach(option => {
            option.classList.remove('active-filter')
        })
        e.target.classList.add('active-filter');
        searchOption = 'mis'
    });

    batchOption.addEventListener("click", (e) => {
        searchOptions.forEach(option => {
            option.classList.remove('active-filter')
        })
        e.target.classList.add('active-filter');
        searchOption = 'batchId'
    });

    //getCurrentBatchStudents();
}

function getCurrentBatchStudents() {

    let requestData = {
        batchId: currentBatchId
    }
    let jsonData = JSON.stringify(requestData);
    console.log(jsonData);
    let options = {
        method: "POST",
        body: jsonData,
        headers: {
            'Content-Type': 'application/json'
        }
    }

    fetch(preassessmentStudentApi, options).then(response => response.json()).then(
        data => {
            console.log(data);
            let currentBatchStudents = data;
            currentBatchStudentsRows = currentBatchStudents.map((student) => {
                let row = document.createElement("tr");
                let misData = document.createElement('td');
                misData.textContent = student['mis'];
                let studentName = document.createElement('td');
                studentName.textContent = student["first_name"] + " " + student["last_name"];
                let participation = document.createElement('td');
                let checkBox = document.createElement('input');
                checkBox.type = 'checkbox';
                checkBox.value = student['student_id'];
                participation.appendChild(checkBox);
                row.appendChild(misData);
                row.appendChild(studentName);
                row.appendChild(participation);

                checkBox.addEventListener('change', (e) => {
                    if (e.target.checked) {
                        preAssessmentStudents.push(e.target.value);
                    } else {
                        let index = preAssessmentStudents.indexOf(e.target.value);
                        if (index > -1) {
                            preAssessmentStudents.splice(index, 1);
                        }
                    }
                })
                return row;
            }
            )
            currentBatchStudentsRows.forEach(element => {
                document.getElementById("currentBatchTableBody").insertAdjacentElement('beforeend', element);
            });
        }
    )

    //set the student to preassessment looping through the rows
    /*  function getCheckedstudents(){
         currentBatchStudentsRows.forEach(row=>{
             console.log(row.lastChild.firstChild);
             if(row.lastChild.firstChild.checked){
                 preAssessmentStudents.push(row.lastChild.firstChild.value);
             }
         })
     }
      */


}


function searchStudents(keyword) {

    let data = {
        type: searchOption,
        keyword: keyword,
        currentBatch: currentBatchId
    }
    let options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data),
        signal: searchControllerSignal
    }
    let location = preassessmentStudentApi + '/search';
    searchTable.classList.add('d-none');
    searchLoader.classList.remove('d-none');
    fetch(location, options).then(
        response => response.json()
    ).then(data => {
        console.log(data);
        document.getElementById('searchTableBody').innerHTML = "";
        data.forEach(student => {
            let row = createSearchTableRow(student);
            document.getElementById('searchTableBody').insertAdjacentElement('beforeend', row);
        })

    }).finally(
        () => {
            searchTable.classList.remove('d-none');
            searchLoader.classList.add('d-none');
        }
    )

}

function createSearchTableRow(student) {
    //create table row for each student 
    let row = document.createElement("tr");
    row.className = "repeat-row"
    let misData = document.createElement('td');
    misData.textContent = student['mis'];
    let studentName = document.createElement('td');
    studentName.textContent = student["first_name"] + " " + student["last_name"];

    let batch = document.createElement('td');
    batch.className = "d-flex align-items-center ";
    let batchId = document.createElement('div');
    batchId.textContent = student['batch_id'];

    let btnContainer = document.createElement('div');
    btnContainer.className = "ms-auto repeat-row-batch";
    let button = document.createElement('button');
    button.className = "btn btn-danger";
    let image = document.createElement('img');
    image.className = "add-img";
    if (preAssessmentRepeatedStudents.indexOf(student['student_id']) > -1) {
        image.src = "/public/images/icons8-minus-96 (1).png";
    } else {
        image.src = "/public/images/icons8-add-96 (1).png";
    }

    button.appendChild(image);
    btnContainer.appendChild(button);

    button.addEventListener('click', (e) => {
        let index = preAssessmentRepeatedStudents.indexOf(student['student_id']);
        console.log("clicked index=" + index);

        if (index > -1) {
            image.src = "/public/images/icons8-add-96 (1).png";
            preAssessmentRepeatedStudents.splice(index, 1);
            document.getElementById(student['student_id']).remove();
        } else {
            preAssessmentRepeatedStudents.push(student['student_id']);
            image.src = "/public/images/icons8-minus-96 (1).png";
            addStudentsToRepeatedTableRows(student);
        }
    })

    batch.appendChild(batchId);
    batch.appendChild(btnContainer);

    row.appendChild(misData);
    row.appendChild(studentName);
    row.appendChild(batch);

    return row;

}

function addStudentsToRepeatedTableRows(student) {
    document.getElementById('repeatStudentsTableBody').insertAdjacentElement('beforeend', createRepeatTableRow(student));
}

function createRepeatTableRow(student) {
    let row = document.createElement("tr");
    row.id = student['student_id'];
    row.className = "repeat-row"
    let misData = document.createElement('td');
    misData.textContent = student['mis'];
    let studentName = document.createElement('td');
    studentName.textContent = student["first_name"] + " " + student["last_name"];

    let batch = document.createElement('td');
    batch.className = "d-flex align-items-center ";
    let batchId = document.createElement('div');
    batchId.textContent = student['batch_id'];

    let btnContainer = document.createElement('div');
    btnContainer.className = "ms-auto repeat-row-batch";
    let button = document.createElement('button');
    button.className = "btn btn-danger";
    let image = document.createElement('img');
    image.className = "add-img";
    image.src = "/public/images/icons8-remove-96 (1).png";
    button.appendChild(image);

    btnContainer.appendChild(button);

    button.addEventListener('click', (e) => {
        let index = preAssessmentRepeatedStudents.indexOf(student['student_id']);
        console.log(index + "in repeatTableRow")
        console.log(preAssessmentRepeatedStudents.length)
        preAssessmentRepeatedStudents.splice(index, 1)
        console.log(preAssessmentRepeatedStudents.length)
        document.getElementById('repeatStudentsTableBody').removeChild(row)
    })

    batch.appendChild(batchId);
    batch.appendChild(btnContainer);

    row.appendChild(misData);
    row.appendChild(studentName);
    row.appendChild(batch);

    return row;
}

function assessorRegNoValidation() {
    return true;
}

function asssessorNameValidation() {
    return true;
}

function dateValidation() {
    return true;
}

function selectedStudentsValidation() {
    return true;
}


export {
    getContent
}
