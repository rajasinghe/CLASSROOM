let modules = [];
let tasks = [];
let assessmentSteps = null;
let practicalReportData = null;
let theoryReportData = null;
let activeReportFunction = null;

// Element Varaibles
let practicalButton = null;
let taskReportButton = null;
let theoryReportButton = null;
let reportContainer = null;

function refreshListeners(){

    practicalButton = document.querySelector('#practicalReportButton');
    taskReportButton = document.querySelector('#taskReportButton');
    theoryReportButton = document.querySelector('#theoryReportButton');
    reportContainer = document.querySelector('#assessment-report .card-body');

    generatePracticalReport();
    activeReportFunction = generatePracticalReport;

    practicalButton.addEventListener('click', event => {
        changeActiveButton(event.target);
        generatePracticalReport();
        activeReportFunction = generatePracticalReport;
    });

    taskReportButton.addEventListener('click', event => {
        changeActiveButton(event.target);
        generateTaskReport();

        activeReportFunction = clearTaskReport;
    });

    theoryReportButton.addEventListener('click', event => {
        changeActiveButton(event.target);
        generateTheoryReport();

        activeReportFunction = generateTheoryReport;
    });
}

function refreshDataFunctions(){
    activeReportFunction();
}

function changeActiveButton(button){
    if(button === practicalButton){
        practicalButton.classList.add('active');
        taskReportButton.classList.remove('active');
        theoryReportButton.classList.remove('active');
        return;
    }
    else if(button === taskReportButton){
        taskReportButton.classList.add('active');
        practicalButton.classList.remove('active');
        theoryReportButton.classList.remove('active');
        return;
    }
    theoryReportButton.classList.add('active');
    practicalButton.classList.remove('active');
    taskReportButton.classList.remove('active');
    return;
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

async function setModuleField(){
    modules = await getModules();
  
    let moduleField = document.querySelector('#moduleField');
  
    moduleField.innerHTML = `<option value="none">Select Module</option>`;
  
    for (const module of modules) {
        moduleField.innerHTML += `<option value="${module['module_id']}">${module['module_no']} : ${module['module_name']}</option>`;
    }
}

async function setTaskField(moduleId){
    let taskField = document.querySelector('#taskField');
  
    taskField.innerHTML = `<option value="none">Select Task</option>`;
  
    if(moduleId === 'none') return;

    tasks = await getTasks(moduleId);
  
    for (const task of tasks) {
        taskField.innerHTML += `<option value="${task['task_id']}">${task['task_no']} : ${task['task_name']}</option>`;
    }
}

function generatePracticalReport(){

    let template = 
    `<div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-5 px-0 d-flex align-items-center">
                <h4 class="fs-4 my-0">PRACTICAL ASSESSMENT REPORT</h4>
            </div>
            <div class="col-12 px-0 ">
                <hr>
            </div>
        </div>
    </div>
    <div class="table-responsive tablescorlbar" id="report-table-container">
    </div>
    <div class="pt-4 d-flex flex-column flex-md-row" id="report-info">
    </div>
    <div class="d-flex justify-content-end  pe-3">
        <button class="btn site-btn rounded-1" id="saveReportButton">Save as PDF</button>
    </div>`;

    reportContainer.innerHTML = template;

    getPracticalReportData();

    document.querySelector('#saveReportButton').addEventListener('click', event => {
        saveReport('ASSESSMENT/PRACTICAL',practicalReportData);
    });
}

function generateTheoryReport(){
    
    let template = 
    `<div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-5 px-0 d-flex align-items-center">
                <h4 class="fs-4 my-0">THEORY ASSESSMENT REPORT</h4>
            </div>
            <div class="col-12 px-0 ">
                <hr>
            </div>
        </div>
    </div>
    <div class="table-responsive tablescorlbar" id="report-table-container">
    </div>
    <div class="pt-4 d-flex flex-column flex-md-row" id="report-info">
    </div>
    <div class="d-flex justify-content-end  pe-3">
        <button class="btn site-btn rounded-1" id="saveReportButton">Save as PDF</button>
    </div>`;

    reportContainer.innerHTML = template;

    getTheoryReportData();

    document.querySelector('#saveReportButton').addEventListener('click', event => {
        saveReport('ASSESSMENT/THEORY',theoryReportData);
    });
}

function generateTaskReport(){

    let template = 
    `<div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-5 px-0 d-flex align-items-center">
                <h4 class="fs-4 my-0">ASSESSMENT TASK REPORT</h4>
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
    <div class="table-responsive tablescorlbar" id="report-table-container">
    </div>
    <div class="pt-4 d-flex flex-column flex-md-row" id="report-info">
    </div>
    <div class="d-flex justify-content-end  pe-3">
        <button class="btn site-btn rounded-1" id="saveReportButton">Save as PDF</button>
    </div>`;

    reportContainer.innerHTML = template;

    setModuleField();

    document.querySelector('#moduleField').addEventListener('change', event => {
        setTaskField(event.target.value,true);
    });

    document.querySelector('#taskField').addEventListener('change', event => {
        generateTaskTable(event.target.value,document.querySelector('#moduleField').value);
    });

    document.querySelector('#saveReportButton').addEventListener('click', event => {
        saveReport('ASSESSMENT/TASK',assessmentSteps);
    });
}

function clearTaskReport(){
    document.querySelector('#report-table-container').innerHTML = '';
    document.querySelector('#moduleField').value = 'none';
    document.querySelector('#taskField').value = 'none';
}

async function generatePracticalTable(summaryData){

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

    let table = document.createElement('table');
    table.className = "table table-bordered mb-0";
    table.id = "practical-table";

    table.innerHTML = template;

    let tableContainer = document.querySelector('#report-table-container');
    tableContainer.innerHTML = '';
    tableContainer.appendChild(table);
}

async function generateTheoryTable(theoryData){
    
    let template =  
    `<thead>
        <tr>
            <th scope="col">
            MIS
            </th>
            <th scope="col">SURNAME</th>`;

    for (const module of theoryData['modules']) {
        template += `<th scope="col">${module['module_no']}</th>`;
    }

    template +=
    `       <th scope="col">TOTAL</th>
            <th scope="col">AVERAGE</th> 
        </tr>
    </thead><tbody>`;

    for (const summary of theoryData['student_marks']) {
        template += 
        `<tr>
        <td>${summary['mis']}</td>
        <td>${summary['surname']}</td>`;

        for (const mark of summary['marks']) {
            template += `<td>`;

            for (const m of mark) {
                template += `<span class="d-block">${m}</span>`;
            }

            template += `</td>`;
        }

        template += 
        `<td>${summary['total']}</td>
        <td>${summary['average']}</td>
        </tr>`;
    }

    template += `</tbody>`;

    let table = document.createElement('table');
    table.className = "table table-bordered mb-0";
    table.id = "theory-table";

    table.innerHTML = template;

    let tableContainer = document.querySelector('#report-table-container');
    tableContainer.innerHTML = '';
    tableContainer.appendChild(table);

    document.querySelector('#report-info').innerHTML = 
    `<h6 class="ms-md-3 ">Total No of Assessments - ${theoryData['total']}</h6>`;
}

async function generateTaskTable(taskId){
    if(taskId === 'none'){
        document.querySelector('#report-table-container').innerHTML =
        `<h5 class="ps-5 fw-light">Please select a task</h5>`;
        return;
    }

    assessmentSteps = await getTaskReportData(taskId);

    let template = 
    `<table class="table table-bordered mb-0" id="task-table">
        <thead>
            <tr>
                <th scope="col" class="align-middle" rowspan="2">
                    MIS
                </th>
                <th scope="col" class="align-middle" rowspan="2">STUDENT NAME</th>
                <th scop="col" class="text-center" colspan="${assessmentSteps['steps'].length}">STEPS</th>
                <th scope="col" class="align-middle c-date" rowspan="2">COMPLETED DATE</th>
            </tr>
            <tr>`

    for (const step of assessmentSteps['steps']) {
        template += `<th scope="col">${step['step_no']}</th>`;
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

    document.querySelector('#report-table-container').innerHTML = template;
}

function getPracticalReportData(){

    fetch('http://localhost:3000/assessment/marks',{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify({
            type:'ASSESSMENT/SUMMARY',
            batch_id:window.selectedBatch['batch_id']
        })
    })
    .then( response => {
        return response.json();
    })
    .then( data => {
        if(data === null) return;
        practicalReportData = data;
        generatePracticalTable(data);
    })
}

async function getTaskReportData(taskId){
    return await fetch('http://localhost:3000/assessment/marks', {
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify({
            type:'ASSESSMENT/MARK/FORMAT',
            task_id:taskId,
            batch_id:window.selectedBatch['batch_id']
        })
    })
    .then( response => {
        return response.json();
    })
    .catch( error => {
        console.error(error);
    })
}

function getTheoryReportData(){
    fetch('http://localhost:3000/assessment/marks',{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify({
            type:'ASSESSMENT/THEORY/REPORT',
            batch_id:window.selectedBatch['batch_id']
        })
    })
    .then( response => {
        return response.json();
    })
    .then( data => {
        if(data === null) return;
        theoryReportData = data;
        generateTheoryTable(data);
    })
}

function saveReport(reportType,reportData){

    if(reportData === null) return;

    fetch('http://localhost:3000/reports/save',{
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

export {
    refreshListeners,
    refreshDataFunctions
};