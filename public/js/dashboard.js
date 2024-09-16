let currentDate = new Date();
let month = currentDate.getMonth() + 1;
let m = (month < 10)? "0" + month:month;
let d = (currentDate.getDate() < 10)? "0" + currentDate.getDate():currentDate.getDate();
let dateString = currentDate.getFullYear() + "-" + m + "-" + d;

const attendanceSection = document.querySelector('#attendance-section');
console.log(dateString);
getAttendance({date: dateString, batch_id:2});

function generateAttendanceTable(data){
  let template = 
  `<table class="table table-borderless mb-0" id="attendance-table">
  <thead>
  <tr>
      <th scope="col" class="text-center">
      MIS
      </th>
      <th scope="col" class="text-center d-none d-md-table-cell">NIC</th>
      <th scope="col" class="text-center d-none d-lg-table-cell">INITIALS</th>
      <th scope="col" class="text-center">SURNAME</th>
      <th scope="col" class="text-center">Attendance</th>
  </tr>
  </thead><tbody>`;

  for (const d of data) {
      template += 
      `<tr>
          <th scope="row" class="text-center">
          ${d['mis']}
          </th>
          <td class="d-none d-md-table-cell text-center">${d['nic']}</td>
          <td class="d-none d-lg-table-cell text-center">${d['initials']}</td>
          <td class="text-center">${d['surname']}</td>
          <td>
          <div class="d-flex justify-content-center bg">
              <input type="checkbox" class="form-check" ${(d['attendance'] == 1)? 'checked':''}>
          </div>
          </td>
      </tr>`;
  }

  template += `</tbody>`;

  attendanceSection.innerHTML = template;
}

async function getAttendance(attendanceObject){

  let data = await fetch(`${APIURL}/attendance/view`,{
      method:'POST',
      headers:{
          'Content-Type':'application/json'
      },
      body:JSON.stringify(attendanceObject)
  })
  .then( response => {
      return response.json();
  }).catch( error => {
      alert(error);
  })

  //let statusDiv = document.querySelector('#attendance-status');
  //let dayNameDiv = document.querySelector('#attendance-dayname');

  /* if(data['status'] === 'date_ahead'){
      attendanceSection.innerHTML = 
      `<div class="d-flex justify-content-center align-items-center">
          <img src="${APIURL}/public/images/nodata.gif" style="max-height:280px;" class="img-fluid" alt="nothing">
          <div class="ps-2 d-none d-lg-block">
              <h1>Oops No Data Found...</h1>
              <p class="fs-5">${data['message']}</p>
          </div>
      </div>`;
      statusDiv.innerHTML = '';
      return;
  } */
  
  attendanceData = data['data'];
  generateAttendanceTable(data['data']);

}