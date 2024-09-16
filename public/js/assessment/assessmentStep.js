// Data variables
let selectedStep = null;
let modules = [];
let tasks = [];

// Element variables
let addStepButton = null;
let updateStepButton = null;
let clearButton = null;
let moduleField = null;
let taskField = null;
let stepNumberField = null;
let stepNameField = null;
let descriptionField = null;

function refreshListeners() {
  changeNavDirectionLink(`${APIURL}/assessment/module/addSteps`, 'Add Steps', 2);

  addStepButton = document.querySelector('#addStepButton');
  updateStepButton = document.querySelector('#updateStepButton');
  clearButton = document.querySelector('#clearButton');

  moduleField = document.querySelector('#moduleField');
  taskField = document.querySelector('#taskField');
  stepNumberField = document.querySelector('#stepNumberField');
  stepNameField = document.querySelector('#stepNameField');
  descriptionField = document.querySelector('#descriptionField');

  setModuleField();

  // Set tasks when a module is selected
  moduleField.addEventListener('change', event => {
    setTaskField(event.target.value);
  });

  moduleField.addEventListener('focusout', event => {
    validateModuleField();
  });

  taskField.addEventListener('focusout', event => {
    validateTaskField();
  });

  stepNumberField.addEventListener('focusout', event => {
    validateStepNumberField();
  });

  stepNameField.addEventListener('focusout', event => {
    validateStepNameField();
  });

  descriptionField.addEventListener('focusout', event => {
    validateDescriptionField();
  });

  addStepButton.addEventListener('click', event => {
    //Validate the whole form and submit data
    if (!validateForm()) return;

    //Submit data
    let data = {
      "type": "SAVE",
      "context": "STEP",
      "operation": "INSERT",
      "data": {
        "module_id": moduleField.value,
        "task_id": taskField.value,
        "step_no": stepNumberField.value,
        "step_name": stepNameField.value,
        "step_description": descriptionField.value
      }
    };

    fetch('http://localhost:3000/assessment/modules', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
    .then(response => {
      return response.json();
    })
    .then(data => {
      if (data['condition'] === 'failed') {
        showErrorToast('Request Failed', data['message']);
        return;
      }

      showSuccessToast('Request Succsessful', data['message']);
    })
  });

  updateStepButton.addEventListener('click', event => {
    //Validate the whole form and submit data
    if (!validateForm()) return;

    //Submit data
    let data = {
      "type": "SAVE",
      "context": "STEP",
      "operation": "UPDATE",
      "data": {
        "step_id": selectedStep['step_id'],
        "module_id": moduleField.value,
        "task_id": taskField.value,
        "step_no": stepNumberField.value,
        "step_name": stepNameField.value,
        "step_description": descriptionField.value
      }
    };

    fetch('http://localhost:3000/assessment/modules', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
      .then(response => {
        return response.json();
      })
      .then(data => {
        if (data['condition'] === 'failed') {
          showErrorToast('Request Failed', data['message']);
          return;
        }

        showSuccessToast('Request Succsessful', data['message']);
      })
  });

  clearButton.addEventListener('click', event => {
    moduleField.value = 'none';
    setTaskField('none');
    stepNumberField = '';
    stepNameField = '';
    descriptionField = '';

    selectedStep = null;

    if(addStepButton.classList.contains('d-none')){
        addStepButton.classList.remove('d-none');
        updateStepButton.classList.add('d-none');
    }

    if(moduleField.disabled === true){
      moduleField.disabled = false;
      taskField.disabled = false;
    }
})
}

function getContent(route) {
  let container = document.querySelector('#module-content-container');

  if (container !== null) {
    changeModuleActiveLink('http://localhost:3000/assessment/module/addStep');
    generateTemplate();
  }

  else {
    fetch("http://localhost:3000" + route.link, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
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
          changeModuleActiveLink('http://localhost:3000/assessment/module/addStep');
          generateTemplate();
        }
      )
      .catch(error => {
        console.error(error);
      })
  }
}

function generateTemplate() {
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
                          <img src="http://localhost:3000/public/images/module/3704229.jpg"
                            class="img-fluid  rounded-start  pt-5" alt="...">
                        </div>
                        <div class="col-md-6">
                          <div class="card-body">
                            <div class="">
                              <p class="addpagehead">Add Step</p>
                              <hr class="modulesection">
                            </div>
                            <form>
                              <div class="mb-3 pt-2 ">
                                <label for="moduleField" class="form-label">Modul name</label>
                                <select id="moduleField" class="form-select">
                                  <option value="none">Select Module</option>
                                </select>
                                <label for="moduleField" id="moduleFieldError" class="text-danger"></label>
                              </div>
                              <div class="mb-3">
                                <label for="taskField" class="form-label">Task Name</label>
                                <select id="taskField" class="form-select">
                                  <option value="none">Select Task</option>
                                </select>
                                <label for="taskField" id="taskFieldError" class="text-danger"></label>
                              </div>
                              <div class="mb-1">
                                <label for="stepNumberField" class="form-label ">Step Number</label>
                                <input type="text" class="form-control" id="stepNumberField" placeholder="Step Number"
                                  aria-describedby="">
                                <label for="stepNumberField" id="stepNumberFieldError" class="text-danger"></label>
                              </div>
                              <div class="mb-1">
                                <label for="stepNameField" class="form-label ">Step Name</label>
                                <input type="text" class="form-control " id="stepNameField" placeholder="Step Name"
                                  aria-describedby="">
                                <label for="stepNameField" id="stepNameFieldError" class="text-danger"></label>
                              </div>
                              <div class="mb-1">
                                <label for="descriptionField" class="form-label">Step Description</label>
                                <textarea id="descriptionField" cols="30" rows="5" class="form-control" placeholder="Step Description"></textarea>
                                <label for="descriptionField" id="descriptionFieldError" class="text-danger"></label>
                              </div>
                              <button type="button" id="addStepButton" class="btn btn-outline-danger">Submit</button>
                              <button type="button" class="d-none btn btn-success" id="updateStepButton">Save Changes</button>
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

function validateModuleField() {
  let moduleName = moduleField.value;
  let errorField = document.querySelector('#moduleFieldError');

  if (moduleName === 'none') {
    errorField.innerHTML = 'Please select a module';
    return false;
  }

  errorField.innerHTML = '';
  return true;
}

function validateTaskField() {
  let taskName = taskField.value;
  let errorField = document.querySelector('#taskFieldError');

  if (taskName === 'none') {
    errorField.innerHTML = 'Please select a task';
    return false;
  }

  errorField.innerHTML = '';
  return true;
}

function validateStepNumberField() {
  let stepNo = stepNumberField.value;
  let errorField = document.querySelector('#stepNumberFieldError');

  if (stepNo === null || stepNo === '') {
    errorField.innerHTML = 'Step Number cannot be empty';
    return false;
  }

  if (!stepNo.match(/^\d+$/)) {
    errorField.innerHTML = 'Enter a valid step number';
    return false;
  }

  errorField.innerHTML = '';
  return true;
}

function validateStepNameField() {
  let stepName = stepNameField.value;
  let errorField = document.querySelector('#stepNameFieldError');

  if (stepName === null || stepName === '') {
    errorField.innerHTML = 'Step Name cannot be empty';
    return false;
  }

  if (!stepName.match(/^[a-zA-Z ]+$/)) {
    errorField.innerHTML = 'Step name can only contain letters and spaces';
    return false;
  }

  errorField.innerHTML = '';
  return true;
}

function validateDescriptionField() {
  let description = descriptionField.value;
  let errorField = document.querySelector('#descriptionFieldError');

  if (description === null || description === '') {
    errorField.innerHTML = 'Provide some description of the step';
    return false;
  }

  if (!description.match(/^[a-zA-Z\d ]+$/)) {
    errorField.innerHTML = 'Step name can only contain letters, numbers and spaces';
    return false;
  }

  errorField.innerHTML = '';
  return true;
}

function validateForm() {
  let valid = validateModuleField();
  valid = validateTaskField() && valid;
  valid = validateStepNumberField() && valid;
  valid = validateStepNameField() && valid;
  valid = validateDescriptionField() && valid;

  return valid;
}

async function getModules() {
  return await fetch('http://localhost:3000/assessment/modules', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      type: 'MODULE/ALL'
    })
  })
    .then(response => {
      return response.json();
    })
    .then(data => {
      return data;
    }).catch(error => {
      console.error(error);
    })
}

async function getStep(stepId) {
  return await fetch('http://localhost:3000/assessment/modules', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      type: 'STEP/SINGLE',
      step_id: stepId
    })
  })
  .then(response => {
    return response.json();
  })
  .then(data => {
    return data;
  }).catch(error => {
    console.error(error);
  })
}

async function checkForUpdateRequests() {
  let queryString = new URLSearchParams(window.location.search);
  let stepId = queryString.get('stepId');

  if (stepId === null) return;

  let sData = await getStep(stepId);
  if (sData.length < 1) return;

  selectedStep = sData[0];

  await setTaskField(selectedStep['module_id']);

  moduleField.value = selectedStep['module_id'];
  taskField.value = selectedStep['task_id'];
  stepNumberField.value = selectedStep['step_no'];
  stepNameField.value = selectedStep['step_name'];
  descriptionField.value = selectedStep['step_description'];

  moduleField.disabled = true;
  taskField.disabled = true;

  updateStepButton.classList.remove('d-none');
  addStepButton.classList.add('d-none');
}

async function setModuleField() {
  modules = await getModules();

  moduleField.innerHTML = `<option value="none">Select Module</option>`;

  for (const module of modules) {
    moduleField.innerHTML += `<option value="${module['module_id']}">${module['module_no']} : ${module['module_name']}</option>`;
  }

  checkForUpdateRequests();
}

async function getTasks(moduleId) {
  return await fetch('http://localhost:3000/assessment/modules', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      type: 'TASK/ALL',
      module_id: moduleId
    })
  })
    .then(response => {
      return response.json();
    })
    .then(data => {
      return data;
    }).catch(error => {
      console.error(error);
    })
}

async function setTaskField(moduleId) {
  taskField.innerHTML = `<option value="none">Select Task</option>`;

  if (moduleId === 'none') return;

  tasks = await getTasks(moduleId);

  for (const task of tasks) {
    taskField.innerHTML += `<option value="${task['task_id']}">${task['task_no']} : ${task['task_name']}</option>`;
  }
}

export {
  getContent,
  refreshListeners
};