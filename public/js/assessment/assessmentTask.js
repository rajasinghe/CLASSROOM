// Data variables
let selectedTask = null;
let modules = [];

// Element variables
let addTaskButton = null;
let updateTaskButton = null;
let clearButton = null;
let moduleField = null;
let taskNumberField = null;
let taskNameField = null;
let noOfStepsField = null;

function refreshListeners(){
    changeNavDirectionLink(`${APIURL}/assessment/module/addTask`, 'Add Tasks', 2);

    addTaskButton = document.querySelector('#addTaskButton');
    updateTaskButton = document.querySelector('#updateTaskButton');
    clearButton = document.querySelector('#clearButton');

    moduleField = document.querySelector('#moduleField');
    taskNumberField = document.querySelector('#taskNumberField');
    taskNameField = document.querySelector('#taskNameField');
    noOfStepsField = document.querySelector('#noOfStepsField');

    setModuleField();

    moduleField.addEventListener('focusout', event => {
        validateModuleField();
    });

    taskNumberField.addEventListener('focusout', event => {
        validateTaskNumberField();
    });

    taskNameField.addEventListener('focusout', event => {
        validateTaskNameField();
    });

    noOfStepsField.addEventListener('focusout', event => {
        validateNoOfStepsField();
    });

    addTaskButton.addEventListener('click', event => {
        //Validate the whole form and submit data
        if(!validateForm()) return;

        //Submit data
        let data = {
            "type":"SAVE",
            "context":"TASK",
            "operation":"INSERT",
            "data":{
                "module_id": moduleField.value,
                "task_no": taskNumberField.value,
                "task_name": taskNameField.value,
                "no_of_steps": noOfStepsField.value
            }
        };

        fetch(`${APIURL}/assessment/modules`,{
            method:'POST',
            headers:{
                'Content-Type':'application/json'
            },
            body:JSON.stringify(data)
        })
        .then( response => {
            return response.json();
        })
        .then( data => {
            if(data['condition'] === 'failed'){
                showErrorToast('Request Failed',data['message']);
                return;
            }

            showSuccessToast('Request Succsessful',data['message']);
        })
    });

    updateTaskButton.addEventListener('click', event => {
        //Validate the whole form and submit data
        if(!validateForm()) return;

        //Submit data
        let data = {
            "type":"SAVE",
            "context":"TASK",
            "operation":"UPDATE",
            "data":{
                "task_id": selectedTask['task_id'],
                "module_id": moduleField.value,
                "task_no": taskNumberField.value,
                "task_name": taskNameField.value,
                "no_of_steps": noOfStepsField.value
            }
        };

        fetch(`${APIURL}/assessment/modules`,{
            method:'POST',
            headers:{
                'Content-Type':'application/json'
            },
            body:JSON.stringify(data)
        })
        .then( response => {
            return response.json();
        })
        .then( data => {
            if(data['condition'] === 'failed'){
                showErrorToast('Request Failed',data['message']);
                return;
            }

            showSuccessToast('Request Succsessful',data['message']);
        })
    });

    clearButton.addEventListener('click', event => {
        moduleField.value = 'none';
        taskNumberField.value = '';
        taskNameField.value = '';
        noOfStepsField.value = '';

        selectedTask = null;

        if(addTaskButton.classList.contains('d-none')){
            addTaskButton.classList.remove('d-none');
            updateTaskButton.classList.add('d-none');
        }

        if(moduleField.disabled === true){
            moduleField.disabled = false;
        }
    })
}

function getContent(route){
    let container = document.querySelector('#module-content-container');

    if(container !== null){
        changeModuleActiveLink(`${APIURL}/assessment/module/addTask`);
        generateTemplate();
    }

    else{
        fetch( `${APIURL}` + route.link, {
            method: 'POST',
            headers: {
                'Content-Type' : 'application/json'
            },
            body: JSON.stringify({ component: route.template })
        })
        .then(response => {
            //console.log(response);
            return response.text();
        })
        .then(
            html => {
                //console.log(html);
                document.querySelector('#page-content .row').innerHTML = html;
                //if(route.hasOwnProperty('script') && route['script']) route.script.refreshListeners();
                changeModuleActiveLink(`${APIURL}/assessment/module/addTask`);
                generateTemplate();
            }
        )
        .catch( error => {
            console.error(error);
        })
    }
}

function generateTemplate(){
    let template = 
    `<div class="d-flex align-items-center floating-scroll">
        <div class="container-fluid floatin-container">
            <div class="row justify-content-center">
            <div class="col-12 px-0 site-card">
                <div class="card rounded-0 border-0 shadow">
                <div class="card-body">
                    <div class="container-fluid">

                    <!-- card -->
                    <div class="card mb-3">
                        <div class="row g-0">
                        <div class="col-md-6 d-none d-md-block ">
                            <img src="${APIURL}/public/images/module/task.jpg"
                            class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                            <div class="">
                                <p class="addpagehead">Add Task</p>
                                <hr class="modulesection">
                            </div>
                            <form>
                                <div class="mb-3 pt-2">
                                <label for="moduleField" class="form-label">Modul name</label>
                                <select id="moduleField" class="form-select">
                                    <option value="none">Select Module</option>
                                </select>
                                <label for="moduleField" id="moduleFieldError" class="text-danger"></label>
                                </div>
                                <div class="mb-1">
                                <label for="taskNumberField" class="form-label ">Task Number</label>
                                <input type="text" class="form-control" id="taskNumberField" placeholder="Task Number">
                                <label for="taskNumberField" id="taskNumberFieldError" class="text-danger"></label>
                                </div>
                                <div class="mb-1">
                                <label for="taskNameField" class="form-label ">Task Name</label>
                                <input type="text" class="form-control " id="taskNameField" placeholder="Task Name">
                                <label for="taskNameField" id="taskNameFieldError" class="text-danger"></label>
                                </div>
                                <div class="mb-1">
                                <label for="noOfStepsField" class="form-label ">Number of Steps</label>
                                <input type="text" class="form-control " id="noOfStepsField" placeholder="Number of Steps">
                                <label for="noOfStepsField" id="noOfStepsFieldError" class="text-danger"></label>
                                </div>
                                <button type="button" class="btn btn-outline-danger" id="addTaskButton">Submit</button>
                                <button type="button" class="d-none btn btn-success" id="updateTaskButton">Save Changes</button>
                                <button type="reset" class="btn btn-outline-danger" id="clearButton">Clear</button>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>


                    </div>
                </div>
                </div>
            </div>

            </div>
        </div>
    </div>`;

    document.querySelector('#module-content-container').innerHTML = template;
    refreshListeners();
}

function validateModuleField(){
    let moduleName = moduleField.value;
    let errorField =document.querySelector('#moduleFieldError');

    if(moduleName === 'none') {
        errorField.innerHTML = 'Please select a module'; 
        return false;
    }

    errorField.innerHTML = '';
    return true;
}

function validateTaskNumberField(){
    let taskNo = taskNumberField.value;
    let errorField =document.querySelector('#taskNumberFieldError');

    if(taskNo === null || taskNo === '') {
        errorField.innerHTML = 'Task Number cannot be empty'; 
        return false;
    }

    if(!taskNo.match(/^[A-Z]\d{1,2}$/)) {
        errorField.innerHTML = 'Enter a valid task number ( ex:- A5 )'; 
        return false;
    }

    errorField.innerHTML = '';
    return true;
}

function validateTaskNameField(){
    let taskName = taskNameField.value;
    let errorField =document.querySelector('#taskNameFieldError');

    if(taskName === null || taskName === '') {
        errorField.innerHTML = 'Task Name cannot be empty'; 
        return false;
    }

    if(!taskName.match(/^[a-zA-Z ]+$/)) {
        errorField.innerHTML = 'Task name can only contain letters and spaces'; 
        return false;
    }

    errorField.innerHTML = '';
    return true;
}

function validateNoOfStepsField(){
    let noOfSteps = noOfStepsField.value;
    let errorField =document.querySelector('#noOfStepsFieldError');

    if(noOfSteps === null || noOfSteps === '') {
        errorField.innerHTML = 'This field is required'; 
        return false;
    }

    if(!noOfSteps.match(/^\d+$/)) {
        errorField.innerHTML = 'Enter a valid number'; 
        return false;
    }

    errorField.innerHTML = '';
    return true;
}

function validateForm(){
    let valid = validateModuleField();
    valid = validateTaskNumberField() && valid;
    valid = validateTaskNameField() && valid;
    valid = validateNoOfStepsField() && valid;

    return valid;
}

async function getModules(){
    return await fetch(`${APIURL}/assessment/modules`,{
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

async function getTask(taskId){
    return await fetch(`${APIURL}/assessment/modules`,{
        method:'POST',
        headers:{
        'Content-Type':'application/json'
        },
        body:JSON.stringify({
            type:'TASK/SINGLE',
            task_id:taskId
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

async function checkForUpdateRequests(){
  let queryString = new URLSearchParams(window.location.search);
  let taskId = queryString.get('taskId');

  if(taskId === null) return;

  let tData = await getTask(taskId);
  if(tData.length < 1) return;

  selectedTask = tData[0];

  moduleField.value = selectedTask['module_id'];
  taskNumberField.value = selectedTask['task_no'];
  taskNameField.value = selectedTask['task_name'];
  noOfStepsField.value = selectedTask['no_of_steps'];

  moduleField.disabled = true;

  updateTaskButton.classList.remove('d-none');
  addTaskButton.classList.add('d-none');
}

async function setModuleField(){
    modules = await getModules();

    moduleField.innerHTML = `<option value="none">Select Module</option>`;

    for (const module of modules) {
        moduleField.innerHTML += `<option value="${module['module_id']}">${module['module_no']} : ${module['module_name']}</option>`;
    }

    checkForUpdateRequests();
}

export {
    getContent,
    refreshListeners
};