// Data Variables
const routeParameters = new URLSearchParams(window.location.search);
let intervieweeData = null, batchId = null, intervieweeId = null, applicantId = null;

let interviewMarks = 0; // Marks of the interviewee
let criteriaMarks = [];

// Element Variables
const initialsField = document.querySelector('#initials_Interview'),
fisrtNameField = document.querySelector('#first_name_Interview'),
lastNameField = document.querySelector('#last_name_Interview'),
addressField = document.querySelector('#address_Interview'),
dobField = document.querySelector('#dobirth_Interview'),
nicField = document.querySelector('#nic_Interview'),
mobileField = document.querySelector('#telMobile_Interview'),
whatsappField = document.querySelector('#telWhatsapp_Interview'),
landlineField = document.querySelector('#telLand_Interview'),
emailField = document.querySelector('#email_Interview'),
districtField = document.querySelector('#District_Interview'),
divisionalSecField = document.querySelector('#DivitionalSec_Interview'),
gramaSewaField = document.querySelector('#GramaSewaDiv_Interview'),
olField = document.querySelector('#Up_to_ol'),
olPassField = document.querySelector('#OLpass_Interview'),
englishField = document.querySelector('#eng_Interview'),
mathsField = document.querySelector('#maths_Interview'),
scienceField = document.querySelector('#Science_Interview'),
ownSkillsField = document.querySelector('#Own_Skills'),
jobField = document.querySelector('#Job_Field'),
desireField = document.querySelector('#Desire_Field'),
olEnglishField = document.querySelector('#olEnglishField'),
olMathsField = document.querySelector('#olMathsField'),
olScienceField = document.querySelector('#olScienceField'),
alSub1Field = document.querySelector('#ALSubject01_Interview'),
alSub2Field = document.querySelector('#ALSubject02_Interview'),
alSub3Field = document.querySelector('#ALSubject03_Interview'),
alSub1MarksField = document.querySelector('#ALSubject01Marks_Interview'),
alSub2MarksField = document.querySelector('#ALSubject02Marks_Interview'),
alSub3MarksField = document.querySelector('#ALSubject03Marks_Interview'),
awarenessField = document.querySelector('#CAwareness_Applicant'),
remarkField = document.querySelector('#Remark_Applicant1'),
genderRadios = document.querySelectorAll('.gender-radio'),
categories = document.querySelectorAll('.category-radio'),
jobRadios = document.querySelectorAll('.job-target-radio'),
selectionRadios = document.querySelectorAll('.selection-radio'),
addButton = document.querySelector('#addButton'),
updateButton = document.querySelector('#updateButton'),
studentFields = document.querySelectorAll('[data-type="student"] input,[data-type="student"] textarea');

window.onload = () => {

    init();

    initialsField.addEventListener('focusout', e => { validatenameInt(); }); fisrtNameField.addEventListener('focusout', e => { validateFirstName(); });
    lastNameField.addEventListener('focusout', e => { validateLastName(); });
    addressField.addEventListener('focusout', e => { validateAddress(); }); dobField.addEventListener('focusout', e => { dobvalidate(); });
    nicField.addEventListener('focusout', e => { validateNAtionalId(); }); mobileField.addEventListener('focusout', e => { validateMobileNO(); });
    whatsappField.addEventListener('focusout', e => { validateWhMobileNO(); }); landlineField.addEventListener('focusout', e => { validateLandLine(); });
    emailField.addEventListener('focusout', e => { emailvalidate(); }); districtField.addEventListener('focusout', e => { validateDistric(); });
    gramaSewaField.addEventListener('focusout', e => { validateGramasewa(); }); divisionalSecField.addEventListener('focusout', e => { validateDivision(); });
    olEnglishField.addEventListener('focusout', e => { validateOlevelEng(); });
    olMathsField.addEventListener('focusout', e => { validateOlevelMaths(); }); olScienceField.addEventListener('focusout', e => { validateOlevelScie(); });
    alSub1MarksField.addEventListener('focusout', e => { validateAlevelResult(); }); alSub2MarksField.addEventListener('focusout', e => { validateAlevelResultTwo(); });
    alSub3MarksField.addEventListener('focusout', e => { validateAlevelResultThree(); });

    addButton.addEventListener('click', e => {
        if(! validateForm()){
            alert("Please check all inputs");
            return;
        }

        insertInterviewee(false);
    });

    updateButton.addEventListener('click', e => {
        if(! validateForm()){
            alert("Please check all inputs");
            return;
        }

        insertInterviewee(true);
    });
}

function validateFirstName() {
    let nameRegex = /^[a-zA-Z ]+$/;
    let name = fisrtNameField.value;
    let LnamesFull = document.getElementById("firstNameError");
    LnamesFull.innerText = "";

    if (name === "") {
        LnamesFull.innerText = "Enter the Name";
        LnamesFull.style.color = "red";
        return false;
    }

    if (!name.match(nameRegex)) {
        LnamesFull.innerText = "Name is not valid Enter the Valid Name"
        LnamesFull.style.color = "red";
        return false;
    }

    return true;


}

function validateLastName() {
    let nameRegex = /^[a-zA-Z ]+$/;
    let name = lastNameField.value;
    let LnamesFull = document.getElementById("lastNameError");
    LnamesFull.innerText = "";

    if (name === "") {
        LnamesFull.innerText = "Enter the Name";
        LnamesFull.style.color = "red";
        return false;
    }

    if (!name.match(nameRegex)) {
        LnamesFull.innerText = "Name is not valid Enter the Valid Name"
        LnamesFull.style.color = "red";
        return false;
    }

    return true;


}

function validatenameInt() {
    let nameRegex = /^[a-zA-Z. ]+$/;
    let name = initialsField.value;
    let LnameInt = document.getElementById("lNameInt");
    LnameInt.innerText = "";

    if (name === "") {
        LnameInt.innerText = "Enter the Name";
        LnameInt.style.color = "red";
        return false;
    }

    if (!name.match(nameRegex)) {
        LnameInt.innerText = "Name is not valid Enter the Valid Name"
        LnameInt.style.color = "red";
        return false;
    }

    return true;


}

function validateAddress() {
    let addres = addressField.value;
    let Laddress = document.getElementById("lAddress");
    let regex = /[A-Za-z0-9'\.\-\s\,]/;
    Laddress.innerText = "";

    if (addres === "") {
        Laddress.innerText = "Enter the Address";
        Laddress.style.color = "red";
        return false;
    }
    if (!addres.match(regex)) {
        Laddress.innerText = "Address Does not match Enter the valid Address !";
        Laddress.style.color = "red";
        return false;
    }

    return true;
}

function validateGender() {
    let LSEX = document.getElementById("lGender");

    for(const radio of genderRadios){

        if(radio.checked){
            
            LSEX.innerText = "";
            return true;
        }
    }

    LSEX.innerText = "Select the Applicant's Gender";
    LSEX.style.color = "red";
    return false;
}

function validateMobileNO() {
    let Mo_num = mobileField.value;
    let l_Mo_num = document.getElementById("lMobile");
    let regex = /^(\+\d{1,3}[- ]?)?\d{10}$/;
    l_Mo_num.innerText = "";

    if (Mo_num === "") {
        l_Mo_num.innerText = "Enter the Mobile Number Code";
        l_Mo_num.style.color = "red";
        return false;
    }
    if (!Mo_num.match(regex)) {
        l_Mo_num.innerText = " Number is Does not match Enter the valid Number !";
        l_Mo_num.style.color = "red";
        return false;
    }

    return true;
}

function validateWhMobileNO() {
    let Mo_num = whatsappField.value;
    let l_Mo_num = document.getElementById("lWMobile");
    let regex = /^(\+\d{1,3}[- ]?)?\d{10}$/;
    l_Mo_num.innerText = "";

    if (Mo_num === "") {
        l_Mo_num.innerText = "Enter the Whatsapp Mobile Number Code";
        l_Mo_num.style.color = "red";
        return false;
    }
    if (!Mo_num.match(regex)) {
        l_Mo_num.innerText = "Whatsapp Number is Does not match Enter the valid Number !";
        l_Mo_num.style.color = "red";
        return false;
    }

    return true;
}

function validateLandLine() {
    let Mo_num = landlineField.value;
    let l_Mo_num = document.getElementById("lLand");
    let regex = /^(\+\d{1,3}[- ]?)?\d{10}$/;
    l_Mo_num.innerText = "";

    if (Mo_num !== "" && !Mo_num.match(regex)) {
        l_Mo_num.innerText = "Please enter a valid Landline number";
        l_Mo_num.style.color = "red";
        return false;
    }

    return true;
}

function emailvalidate() {
    let emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    let validemail = emailField.value;
    let Lmail = document.getElementById("lEmail");
    Lmail.innerText = "";

    if (validemail !== "" && !validemail.match(emailRegex)) {
        Lmail.innerText = "Enter a Valid Email"
        Lmail.style.color = "red";
        return false;
    }

    return true;
}

function validateCategory() {
    let Lcategery = document.getElementById("lCategory");

    for(const category of categories){
        if (category.checked) {
            
            Lcategery.innerText = "";
            return true;
        }
    }

    Lcategery.innerText = "Select the Applicant Catogary";
    Lcategery.style.color = "red";
    return false;
}

function validateDistric() {
    let nameRegex = /^[a-zA-Z ]+$/;
    let validateDistric = districtField.value;
    let LDistrict = document.getElementById("lDistric");
    LDistrict.innerText = "";

    if (validateDistric !== "" && !validateDistric.match(nameRegex)) {
        LDistrict.innerText = "District is not valid Enter the Valid District"
        LDistrict.style.color = "red";
        return false;
    }

    return true;


}

function validateDivision() {
    let nameRegex = /^[a-zA-Z ]+$/;
    let validateDivition = divisionalSecField.value;
    let LDivition = document.getElementById("lDivition");
    LDivition.innerText = "";

    if (validateDivition !== "" && !validateDivition.match(nameRegex)) {
        LDivition.innerText = "Divitional Secretariant  is not valid Enter the Valid Divitional Secretariant "
        LDivition.style.color = "red";
        return false;
    }

    return true;
}

function validateGramasewa() {
    let nameRegex = /^[a-zA-Z ]+$/;
    let validateGramasewa = gramaSewaField.value;
    let LGramasewa = document.getElementById("lGramasewa");
    LGramasewa.innerText = "";

    if (validateGramasewa !== "" && !validateGramasewa.match(nameRegex)) {
        LGramasewa.innerText = "Gramasewa Divition  is not valid Enter the Valid Gramasewa Divition "
        LGramasewa.style.color = "red";
        return false;
    }

    return true;


}

function validateJob() {
    let Ljob = document.getElementById("ljob");

    for(const jobRadio of jobRadios){
        
        if (jobRadio.checked) {
            Ljob.innerText = "";
            return true;
        }
    }

    Ljob.innerText = "Select the Job Target";
    Ljob.style.color = "red";
    return false;
}

function validateSelection() {
    let validateSelection = document.form.selection;
    let LSelection = document.getElementById("lSelection");

    if (validateSelection.value == "") {
        LSelection.innerText = "Select the Selection";
        LSelection.style.color = "red";

        return false;
    }

    LSelection.innerText = "";
    LSelection.style.color = "green";
    return true;
}

function validateOlevelField() {
    /* let Mo_num = olField.value;
    let l_Mo_num = document.getElementById("lOlevelPass");

    let regex = /^([0-9]{1}|10)$/;
    l_Mo_num.innerText = "";

    if (Mo_num === "") {
        l_Mo_num.innerText = "Give marks if up to  O'Level";
        l_Mo_num.style.color = "red";
        return false;
    }
    if (!Mo_num.match(regex)) {
        l_Mo_num.innerText = "Give a mark between 1 and 10 !";
        l_Mo_num.style.color = "red";
        return false;
    } */

    return true;
}

function validateOlevelpASSField() {
    /* let pass = olPassField.value;
    let lpass = document.getElementById("lpass");
    let regex = /^([0-9]{1}|12)$/;
    lpass.innerText = "";

    if (pass === "") {
        lpass.innerText = "Give marks if  pass the  O'Level";
        lpass.style.color = "red";
        return false;
    }
    if (!pass.match(regex)) {
        lpass.innerText = "Give a mark between 1 and 12 !";
        lpass.style.color = "red";
        return false;
    } */

    return true;
}

function validateEnglishField() {
    /* let pass = englishField.value;
    let lpass = document.getElementById("leng");

    let regex = /^[0-5]{1,5}$/;
    lpass.innerText = "";

    if (pass === "") {
        lpass.innerText = "Give marks if  pass the  O'Level";
        lpass.style.color = "red";
        return false;
    }
    if (!pass.match(regex)) {
        lpass.innerText = "Give a mark between 1 and 5 !";
        lpass.style.color = "red";
        return false;
    } */

    return true;
}

function validateMAthsField() {
    /* let passMAths = mathsField.value;
    let lpassMaths = document.getElementById("lMaths");

    let regex = /^[0-5]{1,5}$/;
    lpassMaths.innerText = "";

    if (passMAths === "") {
        lpassMaths.innerText = "Give marks if  pass the  O'Level";
        lpassMaths.style.color = "red";
        return false;
    }
    if (!passMAths.match(regex)) {
        lpassMaths.innerText = "Give a mark between 1 and 5 !";
        lpassMaths.style.color = "red";
        return false;
    } */

    return true;
}

function validateScieField() {
    /* let passScie = scienceField.value;
    let lpassScie = document.getElementById("lScie");

    let regex = /^[0-5]{1,5}$/;
    lpassScie.innerText = "";

    if (passScie === "") {
        lpassScie.innerText = "Give marks if  pass the  O'Level";
        lpassScie.style.color = "red";
        return false;
    }
    if (!passScie.match(regex)) {
        lpassScie.innerText = "Give a mark between 1 and 5 !";
        lpassScie.style.color = "red";
        return false;
    } */

    return true;
}

function validateALevelSubject() {
    let SubOne = alSub1Field.value;
    let LSubOne = document.getElementById("lSubOne");

    if (SubOne == "") {
        LSubOne.innerText = "Select the Your Subject";
        LSubOne.style.color = "red";

        return false;
    }

    LSubOne.innerText = "";
    return true;
}

function validateNAtionalId() {
    let NAtionaId = nicField.value;
    let LNAtionaId = document.getElementById("lID");
    let regex = /^([0-9]{9}(v|V)|[0-9]{12})$/;
    LNAtionaId.innerText = "";

    if (NAtionaId === "") {
        LNAtionaId.innerText = " Enter the ID Card Number";
        LNAtionaId.style.color = "red";
        return false;
    }
    if (!NAtionaId.match(regex)) {
        LNAtionaId.innerText = " Invalide ID ";
        LNAtionaId.style.color = "red";
        return false;
    }

    return true;
}

function validateAlevelResult() {
    let resultSubOne = alSub1MarksField.value;
    let LsubOne = document.getElementById("LSubjectOne");

    if (resultSubOne == "none") {
        LsubOne.innerText = "Select the Subject One Result";
        LsubOne.style.color = "red";
        return false;
    }

    LsubOne.innerText = "";
    LsubOne.style.color = "green";
    return true;
}

function validateAlevelResultTwo() {
    let resultSubTwo = alSub2MarksField.value;
    let LsubTwo = document.getElementById("LSubjectTwo");

    if (resultSubTwo == "none") {
        LsubTwo.innerText = "Select the Subject Two Result";
        LsubTwo.style.color = "red";
        return false;
    }

    LsubTwo.innerText = "";
    LsubTwo.style.color = "green";
    return true;

}

function validateAlevelResultThree() {
    let resultSubTwo = alSub3MarksField.value;
    let LsubTwo = document.getElementById("LSubjectThree");

    if (resultSubTwo == "none") {
        LsubTwo.innerText = "Select the Subject Three Result";
        LsubTwo.style.color = "red";
        return false;
    }

    LsubTwo.innerText = "";
    LsubTwo.style.color = "green";
    return true;
}

function validateOlevelEng() {
    let resultEng = olEnglishField.value;

    if (resultEng == "none") {
        return false;
    }

    return true;

}

function validateOlevelMaths() {
    let resultEng = olMathsField.value;

    if (resultEng== "none") {
        return false;
    }

    return true;

}

function validateOlevelScie() {
    let resulSci =olScienceField.value;

    if (resulSci == "none") {
        return false;
    }

    return true;

}

function dobvalidate() {

    let enddate = dobField.value;
    let Lenddate = document.getElementById("lDob");
    Lenddate.innerText = "";



    if (enddate == "") {
        Lenddate.innerText = "Select the Date of Brithday";
        Lenddate.style.color = "red";

        return false;
    }

    Lenddate.innerText = "";
    return true;
}

function validateForm(){
    let isValid = validatenameInt() & validateFirstName() & validateAddress() & validateGender() & validateMobileNO() & validateWhMobileNO() 
    & validateLandLine() & emailvalidate() & validateCategory() & validateDistric() & validateDivision() 
    & validateGramasewa() & validateJob() & validateSelection() & validateOlevelField() & validateOlevelpASSField() & validateEnglishField() 
    & validateMAthsField() & validateScieField() & validateNAtionalId() & validateAlevelResult() & validateAlevelResultTwo() 
    & validateAlevelResultThree() & validateOlevelEng() & validateOlevelMaths() & validateOlevelScie() & dobvalidate();

    return isValid;
}

async function getInterviewee(options){
    return await fetch(`${APIURL}/student`,{
        method: 'POST',
        headers: {
            'Content-Type':'application/json'
        },
        body: JSON.stringify(options)
    })
    .then( response => {
        return response.json();
    })
    .catch( error => {
        console.error(error);
    })
}

async function insertInterviewee(isUpdate){

    // Retrieve the data from input fields into the intervieweeData object
    let formData = new FormData(document.querySelector('#interviewee_form'));
    formData.forEach( (value,key) => {
        // If the value is empty it should sent as null
        if(value === ""){
            intervieweeData[key] = null;
        }
        else{
            intervieweeData[key] = value;
        }
    })

    intervieweeData['batch_id'] = batchId;
    intervieweeData['application_number'] = applicantId;
    intervieweeData['interview_date'] = '2023-04-15';
    intervieweeData['type'] = 'MODIFY/STUDENT';
    intervieweeData['context'] = (isUpdate)? 'UPDATE/INTERVIEWEE':'INSERT/INTERVIEWEE';

    console.log(intervieweeData);

    fetch(`${APIURL}/student`,{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body: JSON.stringify(intervieweeData)
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

async function setInterviewee(applicantId){
    intervieweeData = await getInterviewee({
        type:'VIEW/STUDENT',
        context: 'INTERVIEW/SINGLE',
        forContext: 'FOR/INTERVIEW',
        application_number: applicantId
    });

    console.log(intervieweeData);

    // Check if the data is empty and fill the input fields
    if(intervieweeData['condition'] == 'failed'){
        showErrorToast("Request Failed","Interviewee does not exist.");
        return;
    }

    intervieweeData = intervieweeData['data'];

    if(intervieweeData['is_selected'] === 'TRUE'){
        // Fetch the interviewee details from database and fill the fields
        setExistingInterviewee();

        updateButton.classList.remove('d-none');
        addButton.classList.add('d-none');
    }
    else {

        // Fetch the applicant details from database and fill the fields
        setNewInterviewee();
        
        if(addButton.classList.contains('d-none')){
            addButton.classList.remove('d-none');
            updateButton.classList.add('d-none');
        }
    }

    for (const studentField of studentFields) {
        if(studentField.value !== ''){
            studentField.disabled = true;
        }
    }
}

async function setNewInterviewee(){

    fisrtNameField.value = intervieweeData['applicant_name']; addressField.value = intervieweeData['address'];
    dobField.value = intervieweeData['dob']; 
    
    if(intervieweeData['gender'] === 'Male') genderRadios[0].checked = true; else genderRadios[1].checked = true;

    nicField.value = intervieweeData['nic']; mobileField.value = intervieweeData['mobile_no'];
    whatsappField.value = intervieweeData['whatsapp_no']; landlineField.value = intervieweeData['landline_no'];
}

async function setExistingInterviewee(){

    initialsField.value = intervieweeData['initials'];
    fisrtNameField.value = intervieweeData['first_name']; lastNameField.value = intervieweeData['last_name'];
    addressField.value = intervieweeData['address']; dobField.value = intervieweeData['dob']; 
    
    if(intervieweeData['gender'] === 'Male') genderRadios[0].checked = true; else genderRadios[1].checked = true;

    nicField.value = intervieweeData['nic']; mobileField.value = intervieweeData['mobile_no'];
    whatsappField.value = intervieweeData['whatsapp_no']; landlineField.value = intervieweeData['landline_no'];
    emailField.value = intervieweeData['email']; 
    
    for(const category of categories){

        category.checked = ( category.value == intervieweeData['application_catogary'] );
    }
    
    districtField.value = intervieweeData['district'];
    divisionalSecField.value = intervieweeData['divisional_secretariant']; gramaSewaField.value = intervieweeData['grama_sewa_division'];

    for(const jobRadio of jobRadios){
        
        jobRadio.checked = ( jobRadio.value == intervieweeData['job_target'] );
    }
    
    olEnglishField.value = intervieweeData['english_ol']; olMathsField.value = intervieweeData['maths_ol'];
    olScienceField.value = intervieweeData['science_ol']; alSub1Field.value = intervieweeData['subject1_name_al'];
    alSub2Field.value = intervieweeData['subject2_name_al']; alSub3Field.value = intervieweeData['subject3_name_al'];
    alSub1MarksField.value = intervieweeData['subject1_result_al']; alSub2MarksField.value = intervieweeData['subject2_result_al'];
    alSub3MarksField.value = intervieweeData['subject3_result_al']; awarenessField.value = intervieweeData['course_awareness'];
    
    if(intervieweeData['selection'] === 'y') selectionRadios[0].checked = true; else selectionRadios[1].checked = true;
    
    remarkField.value = intervieweeData['remarks'];
}

async function getCourseCriterias(){

    let data = await fetch(`${APIURL}/student`,{
        method:'POST',
        headers:{
            'Content-Type': 'application/json'
        },
        body:JSON.stringify({
            type:'VIEW/COURSE',
            context:'COURSE/CRITERIAS',
            course_id: 29
        })
    })
    .then( response => {
        return response.json();
    })

    console.log(data);
    data = (data['condition'] == 'failed')? [] : data['data'];

    criteriaMarks = data;
    let criteriaContainer = document.getElementById('course-criteria-section');
    criteriaContainer.innerHTML = '';

    let template = '';
    for(const criteria of data){
        template += 
        `<div class="col-12 col-lg-6 mb-4 text-center  d-lg-flex justify-content-lg-evenly ">
            <div class="col-12 col-lg-8 align-self-center mb-2 mb-lg-0  ">
                <label for="uptool" class="me-2">${criteria['criteria_name']}</label>
            </div>
            <div class=" col-12 col-lg-4 align-self-center d-flex justify-content-center ">
                <input type="number" min="0" max="${criteria['marks']}" class=" form-control w-50" placeholder="marks" id="criteria${data.indexOf(criteria)}">
            </div>
        </div>`;
    }

    criteriaContainer.innerHTML = template;

    for(let i=0; i < data.length; i++){
        document.getElementById(`criteria${i}`).addEventListener('input',e => {
            // Handle marks
            let mark = e.target.value;
            mark = (mark !== '')? Number.parseInt(mark) : mark;
            interviewMarks += mark;
            console.log(interviewMarks);
        });
    }
}

// Performs initial data fetching and processing
async function init(){
    batchId = routeParameters.get("batch");
    applicantId = routeParameters.get("applicantId");

    if(batchId === null || applicantId === null) window.open(`${APIURL}/batch`,'_self'); // If the batch id is not found redirect

    await getCourseCriterias();
    setInterviewee(applicantId);
}