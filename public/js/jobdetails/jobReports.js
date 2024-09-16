let tableBody;
let caption;
let dropdown;
let trainingbtn;
let placementbtn;
let tableHead;

function refreshListeners(){
  trainingbtn = document.querySelector('#btnTraining');
  placementbtn = document.querySelector('#btnPlacement');
  tableBody = document.querySelector('#tableBody');
  tableHead = document.querySelector('#tableHead');
  dropdown = document.querySelector('#batchDropDown');
  caption = document.querySelector('#caption');

  fetchBatchData();

  dropdown.addEventListener('change', event => {
    tableBody.innerHTML = "";
    let boj = { batch_id: dropdown.value};
    
    let aBtn = document.querySelector('#report-nav .active');

    if(aBtn === trainingbtn){
      fetchTrainingData(boj);
    }
    else{
      fetchPlacementData(boj);
    }
  });

  trainingbtn.addEventListener('click', event =>{
    caption.innerHTML = `<h4 class="fs-4 my-0">Job Training Details</h4>`;
    tableBody.innerHTML = "";
    let boj = { batch_id: dropdown.value};
    fetchTrainingData(boj);
    changeActiveButton(trainingbtn);
  });

  placementbtn.addEventListener('click', event => {
    caption.innerHTML = `<h4 class="fs-4 my-0">Job Placement Details</h4>`;
    tableBody.innerHTML = "";
    let boj = { batch_id: dropdown.value};

    console.log (boj);
    fetchPlacementData(boj);
    changeActiveButton(placementbtn);
  });
  
}

function changeActiveButton(button){

  if(button == trainingbtn){
    trainingbtn.classList.add('active');
    placementbtn.classList.remove('active');
    return;
  }

  placementbtn.classList.add('active');
  trainingbtn.classList.remove('active');
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
  
    console.log(data);
    for (const item of data) {
  
      dropdown.innerHTML +=
        `<option value="${item['batch_id']}">${item['batch_name']}</option>`;
    }
    let boj = { batch_id: dropdown.value};
    fetchTrainingData(boj);
  }
  /* Get Batch Combo Details End */


/* Get Batch Training Details for Table Start */
function fetchTrainingData(inputs) {

    fetch('http://localhost:3000/tainingData', {
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
            showTrainingTableData(data);
        })
}

function showTrainingTableData(data) {

  caption.innerHTML = `<h4 class="fs-4 my-0">Job Training Details</h4>`;
  
  tableHead.innerHTML = `
  <tr>
    <th>No</th>
    <th>MIS No</th>
    <th>Company Name</th>
    <th>Telephone No</th>
    <th>Addresss</th>
    <th>Coordinator Name</th>
    <th>Coordinator Telephone No</th>
    <th>Salary(Daily)</th>
    <th>Starting Date</th>
    <th>Closing Date</th>
  </tr>
`;
    
    for (const item of data) {

      tableBody.innerHTML +=
            `<tr>
              <td>${item['id']}</td>
              <td>${item['mis']}</td>
              <td>${item['company_name']}</td>
              <td>${item['telephone_num']}</td>
              <td>${item['company_address']}</td>
              <td>${item['cordinator_name']}</td>
              <td>${item['cordinator_num']}</td>
              <td>${item['salary']}</td>
              <td>${item['begin_date']}</td>
              <td>${item['end_date']}</td>
            </tr>`;
        

        
              }
}
/* Get Batch Training Details for Table End */


/* Get Job Placement Details For Table Start */
function fetchPlacementData(inputs) {

  fetch('http://localhost:3000/jobplacement', {
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
        console.log(data);
          showPlacementTableData(data);
      })
}

function showPlacementTableData(data) {

caption.innerHTML = `<h4 class="fs-4 my-0">Job Placement Details</h4>`;

tableHead.innerHTML = `
  <tr>
    <th>No</th>
    <th>MIS No</th>
    <th>Placement Date</th>
    <th>Company Name</th>
    <th>Addresss</th>
    <th>Telephone No</th>
    <th>Company Email</th>
    <th>Position</th>
    <th>Current Salary</th>
    <th>Mode Of Employment</th>
    <th>Engeged in Training Releted Work</th>
    <th>Job Category</th>
  </tr>
`;
  
  for (const item of data) {

    tableBody.innerHTML +=
          `<tr>
            <td>${item['id']}</td>
            <td>${item['mis']}</td>
            <td>${item['placement_date']}</td>
            <td>${item['company_name']}</td>
            <td>${item['company_address']}</td>
            <td>${item['company_telNum']}</td>
            <td>${item['company_email']}</td>
            <td>${item['position']}</td>
            <td>${item['current_salary']}</td>
            <td>${item['mode_of_employment']}</td>
            <td>${item['Engeged_in_trainingReletedWork']}</td>
            <td>${item['job_category']}</td>
          </tr>`;
      

      
            }
}
/* Get Job Placement Details For Table End */


export{
  refreshListeners
};