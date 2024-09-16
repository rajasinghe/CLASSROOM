// Data variables
const routeParameters = new URLSearchParams(window.location.search);
let applicantData = null,courses = null;
let batchId = null,applicantId = null;

// Element Variables
const nameField = document.querySelector('#name_Applicant'),
addressField = document.querySelector('#address_Applicant'),
mobileField = document.querySelector('#telMobile_Applicant'),
whatsappField = document.querySelector('#telWhatsapp_Applicant'),
landlineField = document.querySelector('#telLand_Applicant'),
birthdayField = document.querySelector('#dobirth_Applicant'),
nicField = document.querySelector('#nic_Applicant'),
guardianNameField = document.querySelector('#guardianName_Applicant'),
guardianTelField = document.querySelector('#guardianNumber_Applicant'),
searchButton = document.querySelector('#searchButton'),
addButton = document.querySelector('#addButton'),
updateButton = document.querySelector('#updateButton'),
clearButton = document.querySelector('#clearButton'),
formInputSection = document.querySelector('#additional-content'),
formInputs = formInputSection.querySelectorAll('input:not([name="highest_educational_qualification"]),textarea'),
formDropDown = new bootstrap.Collapse(formInputSection,{
    toggle: false
  });

window.onload = function () {
    document.applicant_form.applicant_name.focus();

    init();

    nameField.addEventListener('focusout',event => {
        validateNameField();
    });
    addressField.addEventListener('focusout',event => {
        validateAddressField();
    });
    mobileField.addEventListener('focusout',event => {
        validateMobileField();
    });
    whatsappField.addEventListener('focusout',event => {
        validateWhatsappField();
    });
    landlineField.addEventListener('focusout',event => {
        validateLandlineField();
    });
    birthdayField.addEventListener('change',event => {
        validateBirthdayField();
    });
    nicField.addEventListener('focusout',event => {
        validateNicField();
    });
    guardianNameField.addEventListener('focusout',event => {
        validateGuardianNameField();
    });
    guardianTelField.addEventListener('focusout',event => {
        validateGuardianTelField();
    });
    searchButton.addEventListener('click',e => {
        if(!validateNicField()) return;

        setApplicant(null,nicField.value);
    });
    addButton.addEventListener('click', event => {
        if(! validateForm()){
            alert("Please Check all inputs");
            return;
        }

        insertApplication(false);
    });
    updateButton.addEventListener('click', event => {
        if(! validateForm()){
            alert("Please Check all inputs");
            return;
        }

        insertApplication(true);
    });
    clearButton.addEventListener('click', e => {
        formDropDown.hide();
    });
};

function validateNameField() {

    let name = nameField.value;

    let error = document.getElementById("Labelname_Applicant");

    let letter = /^[a-z A-Z ]+$/;

    if (name === "") {
        error.innerText = "Enter Applicant's Name..";
        error.style.color = 'Red';
        return false;
    }
    if (!name.match(letter)) {
        error.innerText = "Name is not valid. Enter valid Name..";
        error.style.color = 'Red';
        return false;
    }
    
    error.innerText = "";
    return true;
}
function validateAddressField() {

    let address = addressField.value;

    let error = document.getElementById("Labeladdress_Applicant");

    let letter = /^[a-z A-Z 0-9/.,-]+$/;

    if (address === "") {
        error.innerText = "Enter Applicant's Address..";
        error.style.color = 'Red';
        return false;
    }
    if (!address.match(letter)) {
        error.innerText = "Address is not valid. Enter valid Address.";
        error.style.color = 'Red';
        return false;
    }
    
    error.innerText = "";
    return true;
}
function validateMobileField() {

    let mobile = mobileField.value;

    let error = document.getElementById("LabeltelMobile_Applicant");

    let letter = /^[0-9]{10}$/;

    if (mobile === "") {
        error.innerText = "Enter Applicant's Mobile Number..";
        error.style.color = 'Red';
        return false;
    }
    if (!mobile.match(letter)) {
        error.innerText = "Mobile Number is not valid. Enter valid Mobile Number.";
        error.style.color = 'Red';
        return false;
    }

    error.innerText = "";
    return true;
}
function validateWhatsappField() {

    let whatsapp = whatsappField.value;

    let error = document.getElementById("LabeltelWhatsapp_Applicant");

    let letter = /^[0-9]{10}$/;

    if (whatsapp === "") {
        error.innerText = "Enter Applicant's Whatsapp Number..";
        error.style.color = 'Red';
        return false;
    }
    if (!whatsapp.match(letter)) {
        error.innerText = "Whatsapp Number is not valid. Enter valid Whatsapp Number.";
        error.style.color = 'Red';
        return false;
    }
        
    error.innerText = "";
    return true;
}
function validateLandlineField() {

    let landLine = landlineField.value;

    let error = document.getElementById("LabeltelLand_Applicant");

    let letter = /^[0-9]{10}$/;

    if (landLine === "") {
        error.innerText = "Enter Applicant's Land Line Number..";
        error.style.color = 'Red';
        return false;
    }

    if (!landLine.match(letter)) {
        error.innerText = "Land Line Number is not valid. Enter valid Land Line Number.";
        error.style.color = 'Red';
        return false;
    }

    error.innerText = "";
    return true;
}
function validateBirthdayField() {
    let error = document.getElementById("Labeldobirth_Applicant");
    let dateInput = birthdayField.value;

    if (dateInput.value === '' || dateInput === null) {
        error.innerText = "Date input is empty";
        error.style.color = 'Red';
        return false;
    }
    
    error.innerText = '';
    return true;
}
function validateNicField() {

    let nic = nicField.value;

    let error = document.getElementById("Labelnic_Applicant");
    let letter = /^(\d{12}|\d{9}(V|v))$/;

    if (nic === "") {
        error.innerText = "Enter Applicant's NIC..";
        error.style.color = 'Red';
        return false;
    }
    if (!nic.match(letter)) {
        error.innerText = "NIC is not valid. Enter valid NIC.";
        error.style.color = 'Red';
        return false;
    }

    error.innerText = "";
    return true;
}
function validateGenderField() {

    let GenderM = document.getElementById("gender_ApplicantM");
    let GenderF= document.getElementById("gender_ApplicantF");

    let error = document.getElementById("Labelgender_Applicant");

    if (!(GenderM.checked || GenderF.checked)) {
        error.innerText="Select Applicant's Gender..";
        error.style.color = 'Red';
        return false;
    }
    
    error.innerText='';
    return true;
}
function validateGuardianNameField() {

    let guardianName = guardianNameField.value;
    let error = document.getElementById("LabelguardianName_Applicant");
    let letter = /^[A-Za-z .]+$/;

    if (guardianName === "") {
        error.innerText = "Enter Guardian Name..";
        error.style.color = 'Red';
        return false;
    }
    if (!guardianName.match(letter)) {
        error.innerText = "Name is not valid. Enter Guardian Name.";
        error.style.color = 'Red';
        return false;
    }
    
    error.innerText = "";
    return true;
}
function validateGuardianTelField() {

    let guardianNumber = guardianTelField.value;
    let error = document.getElementById("LabelguardianNumber_Applicant");
    let letter = /^[0-9]{10}$/;

    if (guardianNumber === "") {
        error.innerText = "Enter Guardian'Telephone Number";
        error.style.color = 'Red';
        return false;
    }
    if (!guardianNumber.match(letter)) {
        error.innerText = "Number is not valid. Enter Guardian'Telephone Numbe.";
        error.style.color = 'Red';
        return false;
    }
    
    error.innerText = "";
    return true;
}
function validateEducationField() {

    let eQualify1 = document.getElementById("educationqualification_Applicant");
    let eQualify2= document.getElementById("educationqualification_Applicant1");
    let eQualify3= document.getElementById("educationqualification_Applicant2");
    let error = document.getElementById("Labeleducationqualification_Applicant");

    if (!(eQualify1.checked || eQualify2.checked || eQualify3.checked)) {
        error.innerText="Select Applicant's Education Qualification..";
        error.style.color = 'Red';
        return false;
    }
    
    error.innerText = "";
    return true;
}
function validateCourseAwarenessField() {

    let CAwareness = document.applicant_form.CAwareness_Applicant;
    let error = document.getElementById("LabelCAwareness_Applicant");
    let letter = /^[0-9 a-z A-Z .]+$/;

    if (CAwareness.value === "") {
        error.innerText = "How did you find out about the course? ";
        error.style.color = 'Red';
        return false;
    }
    if (!CAwareness.value.match(letter)) {
        error.innerText = "How did you find out about the course?";
        error.style.color = 'Red';
        return false;
    }
    else {
        error.innerText = "";
        return true;
    }
}

function validateForm(){
    let isValid = validateNameField();
    isValid = validateAddressField() & validateBirthdayField() & validateMobileField() & 
    validateWhatsappField() & validateLandlineField() & validateNicField() & validateGenderField() & 
    validateGuardianNameField() & validateGuardianTelField() & validateEducationField();

    return isValid;
}

async function getApplicant(applicantId,nicNo = null){
    let options = {
        type:'VIEW/STUDENT',
        context: 'APPLICANT/SINGLE'
    };

    if(nicNo == null) options['application_number'] = applicantId;
    else {
        options['nic'] = nicNo;
        options['batch_id'] = batchId;
    };

    return await fetch(`${APIURL}/student`,{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify(options)
    })
    .then( response => {
        return response.json();
    })
    .catch( error => {
        console.error(error);
    })
}

async function insertApplication(isUpdate){

    let formData = new FormData(document.querySelector('#applicant_form'));

    // Retrieve the data from input fields into the applicantData object
    formData.forEach((value,key) => {
        applicantData[key] = value;
    });

    applicantData['type'] = 'MODIFY/STUDENT';
    applicantData['context'] = (isUpdate)? 'UPDATE/APPLICANT':'INSERT/APPLICANT';
    applicantData['batch_id'] = batchId;

    console.log(JSON.stringify(applicantData));

    fetch(`${APIURL}/student`,{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body: JSON.stringify(applicantData)
    })
    .then( response => {return response.json();})
    .then( data => {
        if(data['condition'] === 'failed'){
            showErrorToast("Request Failed",data['message']);
            return;
        }

        showSuccessToast("Request successful",data['message']);
    })
    .catch( error => console.error(error))
}

function clearFormInputSection(){
    formInputSection.querySelectorAll('input[type="text"],textarea').forEach( element => {
        element.value = '';
    });

    formInputSection.querySelectorAll('input[type="radio"]').forEach( element => {
        element.checked = false;
    });
}

async function setApplicant(applicantId,nicNo = null){

    clearFormInputSection();

    if(nicNo === null) applicantData = await getApplicant(applicantId);
    else applicantData = await getApplicant(null,nicNo);
    
    console.log(applicantData);

    if(applicantData['condition'] === 'failed'){
        // Show applicant doesn't exist message
        console.log(applicantData['message']);
        console.log(applicantId);
        showErrorToast("Something went wrong","Applicant doesn't exist.");
        return;
    }

    applicantData = applicantData['data'];

    if(Object.keys(applicantData).length > 0) {
        nameField.value = applicantData['applicant_name']; addressField.value = applicantData['address'];
        birthdayField.value = applicantData['dob']; mobileField.value = applicantData['mobile_no'];
        whatsappField.value = applicantData['whatsapp_no']; landlineField.value = applicantData['landline_no'];
        nicField.value = applicantData['nic'];

        if(applicantData['gender'] === 'MALE') { document.querySelector("#gender_ApplicantM").checked = true; }
        else { document.querySelector("#gender_ApplicantF").checked = true; }

        switch(applicantData['highest_educational_qualification']){
            case 'Up to OL':
                document.querySelector("#educationqualification_Applicant").checked = true;
                break;
            case 'Up to AL':
                document.querySelector("#educationqualification_Applicant1").checked = true;
                break;
            case null: 
                break;
            default:
                document.querySelector("#educationqualification_Applicant2").checked = true;
        }

        guardianNameField.value = applicantData['guardian']; guardianTelField.value = applicantData['guardian_tpno'];

        for (const formInput of formInputs) {
            formInput.disabled = true;
        }
    }
    else{  
        applicantData = {};
        for (const formInput of formInputs) {
            formInput.disabled = false;
        }
    }


    if(applicantData['application_number'] !== undefined && applicantData['application_number'] !== null){

        updateButton.classList.remove('d-none');
        addButton.classList.add('d-none');
    }
    else if(addButton.classList.contains('d-none')){
        addButton.classList.remove('d-none');
        updateButton.classList.add('d-none');
    }

    formDropDown.show();
}

async function init(){
    batchId = routeParameters.get("batch");
    if(batchId === null) window.open(`${APIURL}/batch`,'_self'); // If the batch id is not found redirect

    applicantId = routeParameters.get("applicantId");
    if(applicantId !== null  && applicantId !== ''){
        searchButton.disabled = true;
        // Fetch the applicant details from database and fill the fields
        setApplicant(applicantId);
    }
    else if(addButton.classList.contains('d-none')){
        addButton.classList.remove('d-none');
        updateButton.classList.add('d-none');
    }
}