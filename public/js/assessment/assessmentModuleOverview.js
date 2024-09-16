let moduleData = [];

function getContent(route){
    let container = document.querySelector('#module-content-container');

    if(container !== null){
        changeModuleActiveLink('http://localhost:3000/assessment/module');
        // Generate the template
        generateTemplate();
    }

    else{
        fetch( "http://localhost:3000" + route.link, {
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
                changeModuleActiveLink('http://localhost:3000/assessment/module');

                // Generate the template
                generateTemplate();
            }
        ).catch( error => {
          console.error(error);
        })
    }
}

function refreshListeners(){
  changeNavDirectionLink(`${APIURL}/assessment/module`, 'Overview', 2);

  let moduleDeleteButtons = document.querySelectorAll('.moduleRemove');
  let taskDeleteButtons = document.querySelectorAll('.taskRemove');
  let stepDeleteButtons = document.querySelectorAll('.stepRemove');

  for (const mButton of moduleDeleteButtons) {
    mButton.addEventListener('click', event => {
      removeModule(mButton.dataset.module);
    });
  }

  for (const tButton of taskDeleteButtons) {
    tButton.addEventListener('click', event => {
      removeTask(tButton.dataset.task);
    });
  }

  for (const sButton of stepDeleteButtons) {
    sButton.addEventListener('click', event => {
      removeStep(sButton.dataset.step);
    });
  }
}

async function generateTemplate(){
  if(moduleData.length < 1){
    moduleData = await getModuleData();
  }

  let template = 
  `<div class="d-flex align-items-center floating-scroll">
    <div class="container-fluid floatin-container">
        <div class="row justify-content-center">
          <div class="col-12 px-0 site-card">
            <div class="card rounded-0 border-0 shadow">
              <div class="card-body">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12 d-flex align-items-center ps-0">
                      <h4 class="fs-4 my-0">MODULE DETAILS</h4>
                      <div class="ms-auto me-md-2">
                      </div>
                    </div>
                    <div class="col-12 px-0 ">
                      <hr>
                    </div>
                  </div>
                </div>
                <div class="site-scrollbar">
                  <div class="accordion" id="accordionPanelsStayOpenExample">`;

  for (const module of moduleData) {
    template += 
    `<div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#module-accordian${module['module_id']}" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
          ${module['module_no']} : ${module['module_name']}
        </button>
      </h2>
      <div id="module-accordian${module['module_id']}" class="accordion-collapse collapse">
        <div class="pt-3 ps-3 ">
          <div id="cheng-section">
            <a href="/assessment/module/addModule?moduleId=${module['module_id']}" class="btn">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                  fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                  <path
                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
              </svg></a>
            <button class="btn delet moduleRemove" data-module="${module['module_id']}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-trash3-fill" viewBox="0 0 16 16">
                <path
                  d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
              </svg></button>
          </div>
        </div>
        <div class="accordion-body">
          Provide a basic description of the module if needed.<br>
          Number of tasks : ${module['no_of_tasks']}
          <h5 class="pt-3"> Tasks </h5>
          <div class="accordion pt-2 " id="taskAccordian">`;

      for (const task of module['tasks']) {
        
        template += 
        `<div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#task${task['task_id']}"
                aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                ${task['task_no']} : ${task['task_name']}
              </button>
            </h2>
            <div id="task${task['task_id']}" class="accordion-collapse collapse">
              <div class="pt-3 ps-3 ">
                <div id="cheng-section">
                  <a href="/assessment/module/addTask?taskId=${task['task_id']}" class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                        <path
                          d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                      </svg>
                  </a>
                  <button class="btn delet taskRemove" data-task="${task['task_id']}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                      fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                      <path
                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="accordion-body">
                Provide some basic description about the task and it's content.
                Number of steps : ${task['no_of_steps']}
                <h5 class="pt-3"> Steps </h5>
                <div class="accordion pt-2" id="stepAccordian">`;
                
        for (const step of task['steps']) {
          template += 
          `<div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#step${step['step_id']}"
                  aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                  Step ${step['step_no']} : ${step['step_name']}
                </button>
              </h2>
              <div id="step${step['step_id']}" class="accordion-collapse collapse ">
                <div id="cheng-section" class="pt-3 ">
                  <a href="/assessment/module/addStep?stepId=${step['step_id']}" class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                        <path
                          d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                      </svg>
                  </a>
                  <button class="btn delet stepRemove" data-step="${step['step_id']}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                      fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                      <path
                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                    </svg></button>
                </div>
                <div class="accordion-body">
                  ${getTextContext(step['step_description'])}
                </div>
              </div>
            </div>`;
        }

        template +=
        `      </div>
              </div>
            </div>
          </div>`;

      }
        
    template += 
        `</div>
        </div>
      </div>
    </div>`;

  }

  template += 
    `             </div>
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

async function getModuleData(){
  return await fetch('http://localhost:3000/assessment/modules',{
    method:'POST',
    headers:{
      'Content-Type':'application/json'
    },
    body:JSON.stringify({
      type:'ALL'
    })
  })
  .then( response => {
    return response.json();
  })
  .then( data => {
    return data;
  })
}

function removeModule(moduleId){
  let data = {
    "type": "REMOVE",
    "context": "MODULE",
    "module_id": moduleId
  };

  if(confirm("Are you sure you want to delete this module " + moduleId)){
    console.log('removed');
  }

  /* fetch('http://localhost:3000/assessment/modules', {
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
  }) */
}

function removeTask(taskId){
  let data = {
    "type": "REMOVE",
    "context": "TASK",
    "task_id": taskId
  };

  if(confirm("Are you sure you want to delete this task " + taskId)){
    console.log('removed');
  }

  /* fetch('http://localhost:3000/assessment/modules', {
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
  }) */
}

function removeStep(stepId){
  let data = {
    "type": "REMOVE",
    "context": "STEP",
    "step_id": stepId
  };

  if(confirm("Are you sure you want to delete this step " + stepId)){
    console.log('removed');
  }

  /* fetch('http://localhost:3000/assessment/modules', {
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
  }) */
}

function getTextContext(html) {
  return html.replaceAll(/</g, '&lt;').replaceAll(/>/g, '&gt;');
}

export {
    getContent
};