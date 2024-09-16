let modules = [];
let tasks = [];
let assessmentSteps = null;
let theoryAssessmentData = null;

// Element variables
let assessmentCard = null;
let practicalButton = null;
let theoryButton = null;

function refreshListeners(){

    assessmentCard = document.querySelector('#assessment-card');
    practicalButton = document.querySelector('#pButton');
    theoryButton = document.querySelector('#tButton');

    getSummaryData();
    generatePracticalAssessmentCard();

    practicalButton.addEventListener('click', event => {
        generatePracticalAssessmentCard();
        changeActiveAssessmentMarkButton(practicalButton);
    })

    theoryButton.addEventListener('click', event => {
        generateTheoryAssessmentCard();
        changeActiveAssessmentMarkButton(theoryButton);
    })
}

function refreshDataFunctions(){
    getSummaryData();
    document.querySelector('#assessment-mark-section').innerHTML = '';
    document.querySelector('#moduleField').value = 'none';
    document.querySelector('#taskField').value = 'none'
}

async function getModules(){
    return await fetch('http://localhost:3000/assessment/modules',{
        method:'POST',
        headers:{
        'Content-Type':'application/json'
        },
        body:JSON.stringify({
            type:'MODULE/ALL'
        })
    })
    .then( response => {
        return response.json();
    })
    .then( data => {
        return data;
    }).catch( error => {
      console.error(error);
    })
}
  
async function setModuleField(){
    modules = await getModules();
  
    let moduleField = document.querySelector('#moduleField');
  
    moduleField.innerHTML = `<option value="none">Select Module</option>`;
  
    for (const module of modules) {
        moduleField.innerHTML += `<option value="${module['module_id']}">${module['module_no']} : ${module['module_name']}</option>`;
    }
}

async function getTasks(moduleId){
    return await fetch('http://localhost:3000/assessment/modules',{
        method:'POST',
        headers:{
        'Content-Type':'application/json'
        },
        body:JSON.stringify({
            type:'TASK/ALL',
            module_id:moduleId
        })
    })
    .then( response => {
        return response.json();
    })
    .then( data => {
        return data;
    }).catch( error => {
      console.error(error);
    })
}
  
async function setTaskField(moduleId,isTheory){
    let taskField = document.querySelector('#taskField');
  
    taskField.innerHTML = `<option value="none">Select Task</option>`;
  
    if(moduleId === 'none') return;
  
    if(isTheory) taskField.innerHTML += `<option value="all">All Tasks</option>`;

    tasks = await getTasks(moduleId);
  
    for (const task of tasks) {
        taskField.innerHTML += `<option value="${task['task_id']}">${task['task_no']} : ${task['task_name']}</option>`;
    }
}

async function getAssessmentSteps(taskId){
    return await fetch('http://localhost:3000/assessment/marks', {
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify({
            type:'ASSESSMENT/MARK/FORMAT',
            task_id:taskId,
            batch_id: window.selectedBatch['batch_id']
        })
    })
    .then( response => {
        return response.json();
    })
    .catch( error => {
        console.error(error);
    })
}

async function getTheoryAssessmentMarks(moduleId,taskId){
    return await fetch('http://localhost:3000/assessment/marks', {
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify({
            type:'ASSESSMENT/THEORY/MARK/FORMAT',
            batch_id: window.selectedBatch['batch_id'],
            module_id:moduleId,
            task_id:taskId
        })
    })
    .then( response => {
        return response.json();
    })
    .catch( error => {
        console.error(error);
    })
}

async function saveAssessmentMarks(){
    if(assessmentSteps === null){
        return;
    }
    
    // Formate the data
    let tableRows = document.querySelectorAll('#assessment-mark-table tbody tr');
    //console.log(tableRows);

    let studentMarks = assessmentSteps['students'];

    for (let index =0; index < tableRows.length; index++) {
        let assMarks = tableRows[index].querySelectorAll('.f-check');

        studentMarks[index]['marks'] = {};
        let cDate = tableRows[index].querySelector('.c-date .d-field').value;
        studentMarks[index]['completed_date'] = (cDate === "")? null:cDate;

        for (let j = 0; j < assessmentSteps['steps'].length; j++) {

            let step = assessmentSteps['steps'][j]['step_id'];
            let mark = (assMarks[j].checked)? 1:0;

            studentMarks[index]['marks'][step] = mark;
        }
    }

    let requestData = {
        "type":"ASSESSMENT/MARK",
        "module_id" : document.querySelector('#moduleField').value,
        "task_id" : document.querySelector('#taskField').value,
        "studentMarks" :  studentMarks
    };

    //console.log(requestData);

    fetch('http://localhost:3000/assessment/marks',{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body: JSON.stringify(requestData)
    })
    .then( response => {
        return response.json();
    })
    .then( data => {
        console.log(data);
        if(data['condition'] === 'failed'){
            showErrorToast('Request unsuccessful',data['message']);
            return;
        }

        showSuccessToast('Request successful',data['message']);
    })
}

async function saveTheoryAssessmentMarks(){
    if(theoryAssessmentData === null){
        return;
    }
    // Formate the data
    let tableRows = document.querySelectorAll('#assessment-mark-table tbody tr');
    //console.log(tableRows);

    let studentMarks = [];

    for (let index =0; index < tableRows.length; index++) {
        let mark = tableRows[index].querySelector('.f-marks').value;

        if(mark !== '' || mark !== null){
            let newMarkObject = {};
            newMarkObject['student_id'] = theoryAssessmentData[index]['id'];
            newMarkObject['marks'] = mark;

            studentMarks.push(newMarkObject);
        }
    }

    let requestData = {
        "type":"ASSESSMENT/THEORY/MARK",
        "module_id" : document.querySelector('#moduleField').value,
        "task_id" : document.querySelector('#taskField').value,
        "studentMarks" :  studentMarks
    };

    console.log(JSON.stringify(requestData));

    /* fetch('http://localhost:3000/assessment/marks',{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body: JSON.stringify(requestData)
    })
    .then( response => {
        return response.json();
    })
    .then( data => {
        console.log(data);
        if(data['condition'] === 'failed'){
            showErrorToast('Request unsuccessful',data['message']);
            return;
        }

        showSuccessToast('Request successful',data['message']);
    }) */
}

async function generateTableTemplate(taskId){
    if(taskId === 'none'){
        document.querySelector('#assessment-mark-section').innerHTML =
        `<h5 class="ps-5 fw-light">Please select a task</h5>`;
        return;
    }

    assessmentSteps = await getAssessmentSteps(taskId);

    let template = 
    `<table class="table table-bordered mb-0" id="assessment-mark-table">
        <thead>
            <tr>
                <th scope="col" class="align-middle" rowspan="2">
                    MIS
                </th>
                <th scope="col" class="align-middle" rowspan="2">STUDENT NAME</th>
                <th scope="col" class="text-center" colspan="${assessmentSteps['steps'].length}">STEPS</th>
                <th scope="col" class="align-middle c-date" rowspan="2">COMPLETED DATE</th>
            </tr>
            <tr>`

    for (const step of assessmentSteps['steps']) {
        template += `<th scope="col" class="text-center">
        <span class="tooltip-element text-center" data-message="${step['step_name']}">${step['step_no']}</span>
        </th>`;
    }
                
    template +=
            `</tr>
        </thead>
        <tbody>`;

    for (const student of assessmentSteps['students']) {
        template += 
        `<tr>
        <th scope="row">
            ${student['mis']}
        </th>
        <td>${student['initials']} ${student['surname']}</td>`;

        for(const mark of student['marks']){
            template += 
            `<td>
                <span class="d-flex justify-content-center">
                <input type="checkbox" class="f-check" ${(mark == 1)? 'checked':''}>
                </span>
            </td>`;
        }

        template += 
            `<td class="c-date">
                <span class="d-flex justify-content-center px-0">
                    <input type="date" class="d-field" value="${student['completed_date']}">
                </span>
            </td>
        </tr>`;
    }

    template += 
    `</tbody>
    </table>`;

    document.querySelector('#assessment-mark-section').innerHTML = template;
}

async function generateTheoryTable(moduleId,taskId){
    theoryAssessmentData = await getTheoryAssessmentMarks(moduleId,taskId);
    console.log(theoryAssessmentData);

    let template = 
    `<table class="table table-bordered mb-0" id="assessment-mark-table">
    <thead>
    <tr>
        <th scope="col" class="align-middle">
        MIS
        </th>
        <th scope="col" class="align-middle">NIC</th>
        <th scope="col" class="align-middle">INITIALS</th>
        <th scope="col" class="align-middle">SURNAME</th>
        <th scop="col" class="text-center">MARKS</th>
    </tr>
    </thead>
    <tbody>`;

    for (const data of theoryAssessmentData) {
        template += 
        `<tr>
            <th scope="row">
            ${data['mis']}
            </th>
            <td>${data['nic']}</td>
            <td>${data['initials']}</td>
            <td>${data['last_name']}</td>
            <td class="">
                <span class="d-flex justify-content-center">
                    <input type="number" class="border-0 form-control f-marks" value="${(data['marks']===null)? '':data['marks']}">
                </span>
            </td>
        </tr>`;
    }

    template += 
    `</tbody>
    </table>`;

    document.querySelector('#assessment-mark-section').innerHTML = template;
}

function getSummaryData(){

    fetch('http://localhost:3000/assessment/marks',{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify({
            type:'ASSESSMENT/SUMMARY',
            batch_id: window.selectedBatch['batch_id']
        })
    })
    .then( response => {
        return response.json();
    })
    .then( data => {
        if(data === null) return;

        generateAssessmentSummaryReport(data);
    })
}

function generateAssessmentSummaryReport(summaryData){
    let summaryTable = document.querySelector('#assessment-summary-table');
    summaryTable.innerHTML = '';

    let template = 
    `<thead>
        <tr>
            <th scope="col">
            MIS
            </th>
            <th scope="col">SURNAME</th>`;

    for (const module of summaryData['modules']) {
        template += `<th scope="col">${module['module_no']}</th>`;
    }
            
    template +=
    `    </tr>
    </thead><tbody>`;

    for (const summary of summaryData['summary']) {
        template += 
        `<tr>
        <td>${summary['mis']}</td>
        <td>${summary['surname']}</td>`;

        for (const mark of summary['summary']) {

            template += `<td>${mark}</td>`;

        }
        template +=`</tr>`;
    }

    template += `</tbody>`;

    summaryTable.innerHTML = template;
}

function changeActiveAssessmentMarkButton(button){
    if(button === practicalButton){
        practicalButton.classList.add('active');
        theoryButton.classList.remove('active');
        return;
    }

    theoryButton.classList.add('active');
    practicalButton.classList.remove('active');
}

function generatePracticalAssessmentCard(){
    let template = 
    `<div class="container-fluid">
        <div class="row">
        <div class="col-12 col-md-5 px-0 d-flex align-items-center">
            <h4 class="fs-4 my-0">PRACTICAL ASSESSMENTS</h4>
        </div>
        <div class="col-12 col-md-7 px-0 pt-3 pt-md-0">
            <form class="container-fluid">
                <div class="row justify-content-end align-items-center">
                    <div class="col-6 col-md-5 pe-md-2">
                        <select id="moduleField" class="form-control form-select">
                            <option value="none">Select Module</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-5 pe-md-2">
                        <select id="taskField" class="form-control form-select">
                        <option value="none">Select Task</option>
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
    <div class="table-responsive site-scrollbar" id="assessment-mark-section">
        
    </div>
    <div class="d-flex justify-content-end pt-3 pe-3">
        <button class="btn site-btn rounded-1" id="saveAssessmentButton">Save Marks</button>
    </div>`;

    assessmentCard.innerHTML = template;

    document.querySelector('#moduleField').addEventListener('change', event => {
        assessmentSteps = null;

        setTaskField(event.target.value);
    });

    document.querySelector('#taskField').addEventListener('change', event => {
        generateTableTemplate(event.target.value);
    });

    document.querySelector('#saveAssessmentButton').addEventListener('click', event => {
        saveAssessmentMarks();
        console.log(assessmentSteps);
    });

    setModuleField();
}

function generateTheoryAssessmentCard(){
    let template = 
    `<div class="container-fluid">
        <div class="row">
        <div class="col-12 col-md-5 px-0 d-flex align-items-center">
            <button class="maximize-button  d-none d-md-block"><i class="fa-solid fa-maximize"></i></button>
            <h4 class="fs-4 my-0">THEORY ASSESSMENTS</h4>
        </div>
        <div class="col-12 col-md-7 px-0 pt-3 pt-md-0">
            <form class="container-fluid">
                <div class="row justify-content-end align-items-center">
                    <div class="col-6 col-md-5 pe-md-2">
                        <select id="moduleField" class="form-control form-select">
                            <option value="none">Select Module</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-5 pe-md-2">
                        <select id="taskField" class="form-control form-select">
                        <option value="none">Select Task</option>
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
    <div class="table-responsive site-scrollbar" id="assessment-mark-section">
    </div>
    <div class="d-flex justify-content-end pt-3 pe-3">
        <button class="btn site-btn rounded-1" id="saveAssessmentButton">Save Marks</button>
    </div>`;

    assessmentCard.innerHTML = template;

    document.querySelector('#moduleField').addEventListener('change', event => {
        setTaskField(event.target.value,true);
    });

    document.querySelector('#taskField').addEventListener('change', event => {
        generateTheoryTable(document.querySelector('#moduleField').value,event.target.value);
    });

    document.querySelector('#saveAssessmentButton').addEventListener('click', event => {
        //console.log(assessmentSteps);
        saveTheoryAssessmentMarks();
    });

    setModuleField();
}

export {
    refreshListeners,
    refreshDataFunctions
}