
function refreshListeners(){
  fetchBatchData();
  fetchStuData({"batch_name":document.querySelector('#batchDropDown').value});

  document.querySelector('#trainingCard').innerHTML = `<h4 class="text-center ">No Data</h4>`;

  document.querySelector('#batchDropDown').addEventListener('change', event => {
    document.querySelector('#stuCard').innerHTML = "";
    document.querySelector('#trainingCard').innerHTML = `<h4 class="text-center ">No Data</h4>`;
    let boj = { batch_name: document.querySelector('#batchDropDown').value};
    fetchStuData(boj);
  })
}

/* Get Batch Combo Details Start */
function fetchBatchData() {

  fetch('http://localhost:3000/tempBatch', {
      method: 'GET',
    })
    .then(respone => {
      return respone.json();
    })
    .then(data => {
      showDropdownData(data);
    })
}

function showDropdownData(data) {
  let dropdown = document.querySelector('#batchDropDown');

  for (const item of data) {

    dropdown.innerHTML +=
      `<option value="${item['batch_id']}">${item['batch_name']}</option>`;
  }
  let boj = { batch_id: dropdown.value};
  fetchStuData(boj);

}
/* Get Batch Combo Details End */


/* Get Stu Card Details Start */
function fetchStuData(inputs) {

  fetch('http://localhost:3000/tempstu', {
      method: 'POST',
      headers: {
        'Content-Type':'application/json'
      },
      body:JSON.stringify(inputs)
    })
    .then(respone => {
      return respone.json();
    })
    .then(data => {
      showCardData(data);
    })
}

function showCardData(data) {
  let trainingCard = document.querySelector('#trainingCard');

  for (const item of data) {
    let tamlplate = `<div class="card ">
            <div class="card-body d-flex align-items-center">
              <div class="d-md-block d-none" style="width: 50px;">
                <img src="${item['profile_img_url']}" class="card-img-top rounded-circle">
              </div>
              <div class="ps-3" style="width: 250px;">
                <span class="card-text fs-5">${item['mis']}</span>
                <br>
                <span class="card-text">${item['name_with_initials']}</span>
              </div>
              <div class="">
                <button class="btn btn-primary me-3 fs-6" id='jt${item['student_id']}'>Job Training</button>
                <button class="btn btn-primary fs-6 mt-sm-0 mt-1" id="jp${item['student_id']}">Job Placement</button>
              </div>
            </div>
          </div>`

    document.querySelector('#stuCard').insertAdjacentHTML("beforeend",tamlplate);

    document.querySelector('#jt' + item['student_id']).addEventListener('click', event => {
      let bojTraining = { student_id: item['student_id']};
      fetchTrainingData(bojTraining);
      trainingCard.scrollIntoView({ behavior: 'smooth'});
    })

    document.querySelector('#jp' + item['student_id']).addEventListener('click', event => {
      let bojPlacement = { student_id: item['student_id']};
      fetchPlacementData(bojPlacement);
      trainingCard.scrollIntoView({ behavior: 'smooth'});      
    })
  }
}
/* Get Stu Card Details End */


/* Get Training Details Start */
function fetchTrainingData(inputs) {

  fetch('http://localhost:3000/tempTraistu', {
      method: 'POST',
      headers: {
        'Content-Type':'application/json'
      },
      body:JSON.stringify(inputs)
    })
    .then(respone => {
      return respone.json();
    })
    .then(data => {
      showTrainingData(data);
    })
}

function showTrainingData(data) {
  let trainingCard = document.querySelector('#trainingCard');

  if (data.length >= 1) {

    for (const item of data) {

      trainingCard.innerHTML =
        `
    <h4 class="text-center ">Training Details</h4>
  
    <div class="mt-3 ">
      <label for="" class="mb-2 ">
        <span class="fw-bold ">Name :</span> <span>${item['name_with_initials']}</span>
    </label>
    <br>
    <label for="" class="mb-2 ">
      <span class="fw-bold ">MIS Number :</span> <span>${item['mis']}</span>
   </label>
    <br>
    <label for="" class="mb-2 ">
      <span class="fw-bold ">Begin Date :</span> <span>${item['begin_date']}</span>
    </label>
    <br>
    <label for="" class="mb-2 ">
      <span class="fw-bold ">End Date :</span> <span>${item['end_date']}</span>
    </label>
    <br>
    <label for="" class="mb-2 ">
      <span class="fw-bold ">Salary :</span> <span>${item['salary']}</span>
    </label>
    <br>
    <label for="" class="mb-2 ">
      <span class="fw-bold ">Company Name :</span> <span>${item['company_name']}</span>
    </label>
    <br>
    <label for="" class="mb-2 ">
      <span class="fw-bold ">Company Address :</span> <span>${item['company_address']}</span>
    </label>
    <br>
    <label for="" class="mb-2 ">
      <span class="fw-bold ">Telephone Number :</span> <span>${item['telephone_num']}</span>
    </label>
    <br>
    <label for="" class="mb-2 ">
      <span class="fw-bold ">Cordinator Name :</span> <span>${item['cordinator_name']}</span>
    </label>
    <br>
    <label for="" class="mb-2 ">
    <span class="fw-bold ">Codinator Telephone Number :</span> <span>${item['cordinator_num']}</span>
    </label>
    </div>
    `;
    }
    
  } else {
    
    trainingCard.innerHTML =
        `
    <h4 class="text-center ">No Data</h4>
    `;

  }

  
}
/* Get Training Details End */


/* Get Job Placement Details Start */
function fetchPlacementData(inputs) {

fetch('http://localhost:3000/tempPlacementstu', {
    method: 'POST',
    headers: {
      'Content-Type':'application/json'
    },
    body:JSON.stringify(inputs)
  })
  .then(respone => {
    return respone.json();
  })
  .then(data => {
    showPlacementData(data);
  })
}

function showPlacementData(data) {
  let trainingCard = document.querySelector('#trainingCard');

  if (data.length >= 1) {

    for (const item of data) {

      trainingCard.innerHTML =
        `
      <h4 class="text-center ">Job Placement Details</h4>
      
      <div class="mt-3 ">
        <label for="" class="mb-2 ">
          <span class="fw-bold ">Name :</span> <span>${item['name_with_initials']}</span>
      </label>
      <br>
      <label for="" class="mb-2 ">
        <span class="fw-bold ">MIS Number :</span> <span>${item['mis']}</span>
      </label>
      <br>
      <label for="" class="mb-2 ">
        <span class="fw-bold ">Placement Date :</span> <span>${item['placement_date']}</span>
      </label>
      <br>
      <label for="" class="mb-2 ">
        <span class="fw-bold ">Company Name :</span> <span>${item['company_name']}</span>
      </label>
      <br>
      <label for="" class="mb-2 ">
        <span class="fw-bold ">Company Address :</span> <span>${item['company_address']}</span>
      </label>
      <br>
      <label for="" class="mb-2 ">
        <span class="fw-bold ">Position :</span> <span>${item['position']}</span>
      </label>
      <br>
      <label for="" class="mb-2 ">
        <span class="fw-bold ">Current Salary :</span> <span>${item['current_salary']}</span>
      </label>
      <br>
      <label for="" class="mb-2 ">
        <span class="fw-bold ">Company Telephone Number :</span> <span>${item['company_telNum']}</span>
      </label>
      <br>
      <label for="" class="mb-2 ">
        <span class="fw-bold ">Company Fax Number :</span> <span>${item['company_faxNum']}</span>
      </label>
      <br>
      <label for="" class="mb-2 ">
      <span class="fw-bold ">Company Email :</span> <span>${item['company_email']}</span>
      </label>
      <br>
      <label for="" class="mb-2 ">
      <span class="fw-bold ">Mode Of Employment :</span> <span>${item['mode_of_employment']}</span>
      </label>
      <br>
      <label for="" class="mb-2 ">
      <span class="fw-bold ">Engeged in training releted Work :</span> <span>${item['Engeged_in_trainingReletedWork']}</span>
      </label>
      <br>
      <label for="" class="mb-2 ">
      <span class="fw-bold ">Job Category :</span> <span>${item['job_category']}</span>
      </label>
      </div>
      `;
      }
    
  } else {

    trainingCard.innerHTML =
    `
  <h4 class="text-center ">No Data</h4>
  `;
    
  }


}
/* Get Job Placement Details End */

export{
  refreshListeners
};
