let mis = document.querySelector('#misNum');
let btnNext = document.querySelector('#Next');
let btnRadio = document.querySelector('#radiobtn');
let cId;
fetchComNames();
btnNext.addEventListener('click', event =>{

    let cId = btnRadio.querySelector('input[type="radio"]:checked');

    console.log(cId.value);
let boj = { mis: mis.value, cid: cId.value};

fetchmisData(boj);


});

/* Get Details Using MIS Start */
function fetchmisData(inputs) {

fetch('http://localhost:3000/misdata', {
method: 'POST',
mode:'cors',
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
    if(data.length < 1) {
        // Show error message
        return;
    }
    //showmisFormData(data);
    window.open('http://localhost:3000/ojtform?mis=' + data[0]['mis'] + '&cid=' + inputs['cid'],'_blank');
})
}

function showmisFormData(data) {



for (const item of data) {

    txtmis.value = item['mis'];
txtname.value = item['name_with_initials'];


      }
}
/* Get Details Using MIS End */


/* Set Data for Dropdown Start */
function fetchComNames() {

    fetch('http://localhost:3000/comname', {
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
    
  
    for (const item of data) {
  
        btnRadio.innerHTML +=
        `<input type="radio" value="${item['company_id']}" name="comName" id="${item['company_id']}">${item['company_name']}<br>`;
    }
    /* let boj = { batch_name: dropdown.value};
    fetchStuData(boj); */
  
  }
  /* Set Data for Dropdown End */