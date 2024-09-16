const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

let txtmis = document.querySelector('#mis');
let txtname = document.querySelector('#name');
let txtComName = document.querySelector('#comName');
let txttelNo = document.querySelector('#telNo');
/* let txtsalary = document.querySelector('#salary'); */
let txtaddress = document.querySelector('#address');
let txtcodinatorName = document.querySelector('#codinatorName');
let txtcodinatorNum = document.querySelector('#codinatorNum');
/* let txtstDate = document.querySelector('#stDate');
let txtendDate = document.querySelector('#endDate'); */

console.log(urlParams.get('mis'));

fetchmisData({ mis: urlParams.get('mis')});
fetchComData({ cid: urlParams.get('cid')});

/* Get Details Using MIS Start */
function fetchmisData(inputs) {

    fetch('http://localhost:3000/misdata', {
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
        showmisFormData(data);
    })
    }
    
    function showmisFormData(data) {
    
    
    txtmis.value = data[0]['mis'];
    txtname.value = data[0]['name_with_initials'];
    
    
    
    }
    /* Get Details Using MIS End */

/* Get Details Using com ID Start */
function fetchComData(inputs) {

    fetch('http://localhost:3000/comdetails', {
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
        showComFormData(data);
    })
    }
    
    function showComFormData(data) {
    
    
    txtComName.value = data[0]['company_name'];
    txttelNo.value = data[0]['telephone_num'];
    txtaddress.value = data[0]['company_address'];
    txtcodinatorName.value = data[0]['cordinator_name'];
    txtcodinatorNum.value = data[0]['cordinator_num'];
    
    
    
    }
    /* Get Details Using com ID End */

    