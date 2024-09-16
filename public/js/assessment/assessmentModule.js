// Data Variables
let selectedModule = null;

// Element Variables
let moduleNoField = null;
let moduleNameField = null;
let noOfTasksField = null;
let addModuleButton = null;
let updateModuleButton = null;
let clearButton = null;

function refreshListeners(){
    changeNavDirectionLink(`${APIURL}/assessment/module/addModule`, 'Add Modules', 2);

    moduleNoField = document.querySelector('#moduleNoField');
    moduleNameField = document.querySelector('#moduleNameField');
    noOfTasksField = document.querySelector('#noOfTasksField');
    addModuleButton = document.querySelector('#addModuleButton');
    updateModuleButton = document.querySelector('#updateModuleButton');
    clearButton = document.querySelector('#clearButton');

    checkForUpdateRequests();

    moduleNoField.addEventListener('focusout', event => {
        validateNumberField();
    });

    moduleNameField.addEventListener('focusout', event => {
        validateNameField();
    });

    noOfTasksField.addEventListener('focusout', event => {
        validateNoOfTasksField();
    });

    addModuleButton.addEventListener('click', event => {
        //Validate the whole form and submit data
        if(!validateForm()) return;

        //Submit data
        let data = {
            "type":"SAVE",
            "context":"MODULE",
            "operation":"INSERT",
            "data":{
                "module_no": document.querySelector('#moduleNoField').value,
                "module_name": document.querySelector('#moduleNameField').value,
                "no_of_task": document.querySelector('#noOfTasksField').value,
                "course_id": document.querySelector('#addModuleButton').value
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

    updateModuleButton.addEventListener('click', event => {
        //Validate the whole form and submit data
        if(!validateForm()) return;

        //Submit data
        let data = {
            "type":"SAVE",
            "context":"MODULE",
            "operation":"UPDATE",
            "data":{
                "module_id":selectedModule['module_id'],
                "module_no": moduleNoField.value,
                "module_name": moduleNameField.value,
                "no_of_task": noOfTasksField.value,
                "course_id": 1
            }
        };

        console.log(data);

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
        moduleNoField.value = '';
        moduleNameField.value = '';
        noOfTasksField.value = '';

        selectedModule = null;

        if(addModuleButton.classList.contains('d-none')){
            addModuleButton.classList.remove('d-none');
            updateModuleButton.classList.add('d-none');
        }
    })
}

function getContent(route){
    let container = document.querySelector('#module-content-container');

    if(container !== null){
        changeModuleActiveLink(`${APIURL}/assessment/module/addModule`);
        generateTemplate();
    }

    else{
        fetch( APIURL + route.link, {
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
                
                changeModuleActiveLink(`${APIURL}/assessment/module/addModule`);
                generateTemplate();
            }
        )
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
                            <img src="${APIURL}/public/images/module/module.jpg"
                            class="img-fluid rounded-start addimg" alt="...">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                            <div class="">
                                <p class="addpagehead">Add Module</p>
                                <hr class="modulesection">
                            </div>
                            <form id="moduleAdd" method="post">
                                <div class="mb-1 pt-2">
                                <label for="moduleNoField" class="form-label">Module Number</label>
                                <input type="text" class="form-control" id="moduleNoField" name="moduleNo"
                                    placeholder="Module Number" aria-describedby="">
                                <label for="moduleNoField" id="moduleNoFieldError" class="text-danger"></label>
                                </div>
                                <div class="mb-1">
                                <label for="moduleNameField" class="form-label ">Module Name</label>
                                <input type="text" class="form-control " placeholder="Module Name" id="moduleNameField"
                                    name="modulename">
                                <label for="moduleNameField" id="moduleNameFieldError" class="text-danger"></label>
                                </div>
                                <div class="mb-1">
                                <label for="noOfTasksField" class="form-label ">Number of Task</label>
                                <input type="text" class="form-control" id="noOfTasksField" name="no_of_task"
                                    placeholder="Number of Task" aria-describedby="">
                                <label for="noOfTasksField" id="noOfTasksFieldError" class="text-danger"></label>
                                </div>
                                <button type="button" class="btn btn-success" id="addModuleButton">Add Module</button>
                                <button type="button" class="d-none btn btn-success" id="updateModuleButton">Save Changes</button>
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

function validateNumberField(){
    let moduleNumber = moduleNoField.value;
    let errorField = document.querySelector('#moduleNoFieldError');

    if(moduleNumber === null || moduleNumber === ''){
        errorField.innerHTML = 'Module number cannot be empty';
        return false;
    }

    if(!moduleNumber.match(/^M-\d{2,3}$/)){
        errorField.innerHTML = 'Enter a valid module number ( ex:- M-12 )';
        return false;
    }

    errorField.innerHTML = '';
    return true;
}

function validateNameField(){
    let moduleName = moduleNameField.value;
    let errorField = document.querySelector('#moduleNameFieldError');

    if(moduleName === null || moduleName === ''){
        errorField.innerHTML = 'Module name cannot be empty';
        return false;
    }

    if(!moduleName.match(/^[a-zA-Z ]+$/)){
        errorField.innerHTML = 'Module name can only contain letters and spaces';
        return false;
    }

    errorField.innerHTML = '';
    return true;
}

function validateNoOfTasksField(){
    let noOdTasks = noOfTasksField.value;
    let errorField = document.querySelector('#noOfTasksFieldError');

    if(noOdTasks === null || noOdTasks === ''){
        errorField.innerHTML = 'This field is required';
        return false;
    }

    if(!noOdTasks.match(/^\d+$/)){
        errorField.innerHTML = 'Enter a valid number';
        return false;
    }

    errorField.innerHTML = '';
    return true;
}

function validateForm(){
    let valid = validateNumberField();
    valid = validateNameField() && valid;
    valid = validateNoOfTasksField() && valid;

    return valid;
}

async function checkForUpdateRequests(){
    let queryString = new URLSearchParams(window.location.search);
    let moduleId = queryString.get('moduleId');

    if(moduleId === null) return;

    let mData = await getModule(moduleId);
    if(mData.length < 1) return;

    selectedModule = mData[0];

    moduleNoField.value = selectedModule['module_no'];
    moduleNameField.value = selectedModule['module_name'];
    noOfTasksField.value = selectedModule['no_of_tasks'];

    updateModuleButton.classList.remove('d-none');
    addModuleButton.classList.add('d-none');
}

async function getModule(moduleId){
    return await fetch(`${APIURL}/assessment/modules`,{
        method:'POST',
        headers:{
        'Content-Type':'application/json'
        },
        body:JSON.stringify({
            type:'MODULE/SINGLE',
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

export {
    getContent,
    refreshListeners
};