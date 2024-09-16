// Data variables
const routeParameters = new URLSearchParams(window.location.search);
let studentData = null;
let batchId = null,intervieweeId = null;
let selectedImage = null;

// Element Variables
const controlSection = document.getElementById('form-container');
let nameField = null,
nicField = null,
batchField = null,
imageField = null,
misField = null,
misErrorField = null,
addButton = null,
updateButton = null;

window.onload = () => {
    init();
}

function initRegistrationForm(){
    nameField = document.querySelector('#nameField');
    nicField = document.querySelector('#nicField');
    batchField = document.querySelector('#batchField');
    imageField = document.querySelector('#image_registerd');
    misField = document.querySelector('#misEnterField');
    misErrorField = document.querySelector('#misNumberLabel');
    addButton = document.querySelector('#addButton');
    updateButton = document.querySelector('#updateButton');

    misField.addEventListener("focusout", e => {
        misValidation();
    });

    imageField.addEventListener("change", event => {
        let filelist = event.target.files;

        selectedImage = (filelist.length > 0)? filelist[0]: null;
    });

    addButton.addEventListener("click", event => {
        if(!misValidation()){
            return;
        }

        insertStudent(false);
    })

    updateButton.addEventListener("click", event => {
        if(!misValidation()){
            return;
        }

        insertStudent(true);
    })
}

function initPaymentForm(){

}

function autoGenDistrictName() {
    let misNum = misField.value;//MIS field value
    if (misNum === "") {            //auto genarate mis number => field empty
        let districtName = "FN/";

        //auto genarate District Name =>FN
        misField.value = districtName;

    } else {
        
    }

}

function misValidation() {


    let misNum = misField.value;
    let misNumberRegex = /^[A-Z]{2}\/\d{2}\/[A-Z]{1,5}\/\d\/\d{4}$/; //Regex number for regex


    //empty validation
    if (misNum == "") {
        misErrorField.innerHTML = 'Please Enter MIS Number';
        misErrorField.style.color = "red";
        misErrorField.style.align = "left";
        misField.focus();
        return false;

    } else {
        misErrorField.innerHTML = '';
    }
    //muis regex validation
    if (!misNum.match(misNumberRegex)) {
        misErrorField.innerHTML = "Please Enter valid MIS Number Ex: FN/23/SD/1/0014";
        misErrorField.style.color = "red";
        misField.focus();
        return false;
    }

    return true;
}

//clear input field validaton labels
function resetField() {
    misErrorField.innerHTML = "";
}

async function insertStudent(isUpdate){

    let uploadResponse = {};
    // Send the request to upload the student photo if one has been selected
    if(selectedImage !== null){
        let formData = new FormData();
        formData.append("image",selectedImage);
        formData.append("image_type","STUDENT/PROFILE");
        formData.append("interview_no",intervieweeId);

        console.log(formData);

        uploadResponse = await fetch(`${APIURL}/uploads`,{
            method:'POST',
            body: formData
        })
        .then( response => {return response.json()})
        .catch( error => console.error(error))
    }

    // Retrieve the data from the input fields and generate the json object
    studentData['mis'] = misField.value; studentData['batch_id'] = batchId;
    studentData['interview_no'] = intervieweeId; studentData['student_status'] = 'active';
    studentData['registered_date'] = '2023-04-18';
    studentData['profile_img_url'] = uploadResponse['directory'] || null;
    studentData['type'] = 'MODIFY/STUDENT';
    studentData['context'] = (isUpdate)? 'UPDATE/STUDENT':'INSERT/STUDENT';

    console.log(studentData);

    fetch(`${APIURL}/student`,{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body: JSON.stringify(studentData)
    })
    .then( response => {return response.json()})
    .then( data => {
        if(data['condition'] === 'failed'){
            showErrorToast("Request Failed",data['message']);
            return;
        }

        showSuccessToast("Request successful",data['message']);
    })
    .catch( error => console.error(error))
}

async function getStudent(intervieweeId,batchId){
    studentData = await fetch(`${APIURL}/student`,{
        method: 'POST',
        headers: {
            'Content-Type':'application/json'
        },
        body: JSON.stringify({
            type:'VIEW/STUDENT',
            context: 'INTERVIEW/SINGLE',
            forContext: 'FOR/REGISTRATION',
            interview_no: intervieweeId,
            batch_id: batchId
        })
    })
    .then( response => {
        return response.json();
    })
    .catch( error => {
        console.error(error);
    })

    console.log(studentData);

    // Check if the data is empty and fill the input fields
    if(studentData['condition'] == 'failed'){
        showErrorToast("Request Failed","Interviewee does not exist.");
        return;
    }

    studentData = studentData['data'];

    if(studentData['is_registered'] === 'TRUE'){

        nameField.innerText = studentData['initials'] + " " + studentData['surname'];
        nicField.innerText = studentData['nic']; batchField.innerText = studentData['batch_name'];
        misField.value = studentData['mis']; imageField.value = studentData['profile_img_url'];

        updateButton.classList.remove('d-none');
        addButton.classList.add('d-none');
    }
    else {

        nameField.innerText = studentData['initials'] + " " + studentData['surname'];
        nicField.innerText = studentData['nic']; batchField.innerText = studentData['batch_name'];

        if(addButton.classList.contains('d-none')){
            addButton.classList.remove('d-none');
            updateButton.classList.add('d-none');
        }
    }
}

async function init(){
    intervieweeId = routeParameters.get("interviewId");
    batchId = routeParameters.get("batch");

    if(batchId === null || intervieweeId === null) window.open(`${APIURL}/batch`,'_self');

    let template = null;
    if(true){
        template = await getFormContent('payment');
        controlSection.innerHTML = template;
    }else{
        template = await getFormContent('registrationForm');
        controlSection.innerHTML = template;
        initRegistrationForm();
        getStudent(intervieweeId,batchId);
    }

}

async function getFormContent(component){

    return await fetch(`${APIURL}/includes`,{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify({
            component
        })
    }).then( response => {
        if(! response.ok){
            return '<p>Server Error<p>';
        }
        return response.text();
    })
    .catch( error => {

    })
}