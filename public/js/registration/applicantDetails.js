// Data variables
let currentRoute = null;

// Element variables
let contentContainer = null,
applicantLink = null, interviewLink = null, studentLink = null,
searchField = null,filterMenu = null,applyButton = null,resetButton = null;

const urlRoutes = {
    '/applicant':{
        getTemplate: getApplicantContent,
        link : '/student',
        context: 'APPLICANTS',
        topLink : '/applicant/add',
        linkText : 'Add Applicant',
        linkOff : false,
        name : 'Applicants'
    },
    '/interview':{
        getTemplate: getInterviewContent,
        link : '/student',
        context: 'INTERVIEW',
        searchContext:'IW/SEARCH',
        linkOff : true,
        name : 'Interviewees'
    },
    '/registeredStudent':{
        getTemplate: getRegisteredContent,
        link : '/student',
        context: 'REGISTEREDSTUDENTS',
        searchContext:'RS/SEARCH',
        linkOff : true,
        name : 'Registered Students'
    }
}

function refreshListeners(){

    applicantLink = document.querySelector('#applicant-link');
    interviewLink = document.querySelector('#interview-link');
    studentLink = document.querySelector('#student-link');

    searchField = document.querySelector('#search-field'); filterMenu = document.querySelector('#filter-menu');
    applyButton = document.querySelector('#apply-button'); resetButton = document.querySelector('#clear-button')

    document.querySelector(".filter-button-wrapper").addEventListener("mouseenter", function () {
        document.querySelector(".filter-menu").classList.add("active");
    });

    document.querySelector(".filter-button-wrapper").addEventListener("mouseleave", function () {
        document.querySelector(".filter-menu").classList.remove("active");
    });

    searchField.addEventListener('keyup',e => {
        searchStudents(e.target.value);
    });

    applyButton.addEventListener('click',e => {
        searchStudents(searchField.value);
    });

    resetButton.addEventListener('click',e => {
        filterMenu.reset();
        searchStudents(searchField.value);
    });
}

async function getContent(route){
    let location = route.pathname.replace(/^\/\d+/,"") || "/";

    currentRoute = urlRoutes[location];
    if(currentRoute === undefined || currentRoute === null) window.open(`${APIURL}/notfound`,'_self');

    let data = await getContentData(currentRoute);
    console.log(data);
    if(data['condition'] === 'failed') window.open(`${APIURL}/batch`,'_self');
    let template = currentRoute.getTemplate(data);
    
    contentContainer = document.querySelector('#batch-content-container');
    if(contentContainer === null) contentContainer = await getBaseContent(route);

    contentContainer.innerHTML = template;
    changeLink(currentRoute.topLink,currentRoute.linkText,currentRoute.linkOff);

    refreshListeners();
    changeActiveLink(location);
    changeNavDirection(location,currentRoute);
}

async function getContentData(route){
    const url = APIURL + route.link;
    //console.log(route.template);
    let batchId = window.routeParameters[1];

    return await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            type: 'VIEW/STUDENT',
            context: route.context,
            batch_id: batchId
        })
    })
    .then(response => {
        //console.log(response);
        return response.json();
    })
    .catch( error => {
        console.error(error);
    })
}

async function getBaseContent(route){
    return await fetch(`${APIURL}/includes`,{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify({ component: route.template })
    })
    .then( response => {
        return response.text();
    })
    .then( html => {
        window.mainContainer.innerHTML = compileTemplate(html,{batch_id : window.routeParameters[1]});
        return document.querySelector('#batch-content-container');
    })
    .catch( error => {
        console.error(error);
    })
}

function changeNavDirection(key,route){
    if( !Object.hasOwn(route, 'name')) return;

    let batchNo = window.routeParameters[1];

    console.log(batchNo);
    changeNavDirectionLink(`${APIURL}/batch/${batchNo}`,batchNo,2);
    changeNavDirectionLink(key,route.name,3);
}

function getApplicantContent(data){
    let template = 
    `<div class="site-scroll mb-4" style="height: 70vh">
        <table class="table table-hover text-nowrap">
            <thead class="table-dark sticky-top z-1">
                <tr>
                <th></th>
                <th></th>
                <th>Name</th>
                <th>NIC</th>
                <th>TELEPHONE</th>
                <th>WhattsApp Number</th>
                <th>Educational qualification</th>
                <th>Address</th>
                <th></th>
                </tr>
            </thead>
            <tbody>`

    for (const applicant of data) {
        template += 
        `<tr>
            <td>
                <a href="/applicant/add?batch=${window.routeParameters[1]}&applicantId=${applicant['id']}"> 
                    <i class="bi bi-pencil-fill "></i> 
                </a>
            </td>
            <td>
                <a href="/interviewee/add?batch=${window.routeParameters[1]}&applicantId=${applicant['id']}"> 
                    <i class="bi bi-person-fill-up"></i> 
                </a>
            </td>
            <td>${applicant['applicant_name']}</td>
            <td>${applicant['nic']}</td>
            <td>${applicant['mobile_no']}</td>
            <td>${applicant['whatsapp_no']}</td>
            <td>${applicant['highest_educational_qualification']}</td>
            <td>${applicant['address']}</td>
        </tr>`;
    }
                
    template += `</tbody>
        </table>
    </div>`;

    return template;
}

function getRegisteredContent(data){
    let template = 
    `<div class="site-scroll mb-4" style="height: 70vh;">
        <table class="table table-hover text-nowrap">
            <thead class="table-dark sticky-top z-1">
                <tr>
                <th></th>
                <th></th>
                <th>Name</th>
                <th>MIS <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                    <path fill="currentColor"
                        d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                    </svg></th>
                <th>NIC</th>
                <th>ADDRESS</th>
                <th>TELEPHONE</th>
                <th>GENDER</th>
                <th>STATUS</th>
                </tr>
            </thead>
            <tbody>`

    for (const student of data) {
        let status = student['student_status'];

        let statusStyles = 'disabled';
        if(status === 'active') statusStyles = 'active';
        else if(status === 'inactive') statusStyles = 'inactive';

        template += 
        `<tr>
            <td>
                <a href="/batch/student/${student['id']}" class="">
                    <i class="bi bi-info-circle-fill"></i>
                </a>
            </td>
            <td>
                <a href="/student/add?batch=${window.routeParameters[1]}&studentId=${student['id']}"> 
                    <i class="bi bi-pencil-fill"></i> 
                </a>
            </td>
            <td>${student['initials']} ${student['first_name']} ${student['last_name']}</td>
            <td>${student['mis']}</td>
            <td>${student['nic']}</td>
            <td>${student['address']}</td>
            <td>${student['mobile_no']}</td>
            <td>${student['gender']}</td>
            <td><span class="status ${statusStyles}">${status}</span></td>
        </tr>`;
    }
            
    template +=
            `</tbody>
        </table>
    </div>`;

    return template;
}

function getInterviewContent(data){
    let template = 
    `<div class="site-scroll mb-4" style="height: 70vh">
        <table class="table table-hover text-nowrap">
            <thead class="table-dark sticky-top z-1">
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Name with Inisials</th>
                    <th>NIC</th>
                    <th>DATE OF BRITHDAY</th>
                    <th>GENDER</th>
                    <th>Address</th>
                    <th>EMAIL</th>
                    <th>TELEPHONE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>`
    
    for (const interviewee of data) {
        template += 
        `<tr>
            <td>
                <a href="/batch/student/${interviewee['id']}">
                    <i class="bi bi-info-circle-fill"></i>
                </a>
            </td>
            <td>
                <a href="/interviewee/add?batch=${window.routeParameters[1]}&applicantId=${interviewee['application_number']}"> 
                    <i class="bi bi-pencil-fill "></i> 
                </a>
            </td>
            <td>
                <a href="/student/add?batch=${window.routeParameters[1]}&interviewId=${interviewee['interview_no']}" 
                    class="tooltip-element" data-message="Promote to registered student"> 
                    <i class="bi bi-person-fill-up"></i> 
                </a>
            </td>
            <td>${interviewee['initials']} ${interviewee['first_name']} ${interviewee['last_name']}</td>
            <td>${interviewee['nic']}</td>
            <td>${interviewee['dob']}</td>
            <td>${interviewee['gender']}</td>
            <td>${interviewee['address']}</td>
            <td>${interviewee['email']}</td>
            <td>${interviewee['mobile_no']}</td>
        </tr>`;
    }

    template +=  
            `</tbody>
        </table>
    </div>`;

    return template;
}

async function searchStudents(searchQuery){

    if(! Object.hasOwn(currentRoute, 'searchContext')) return;

    let requestData = {
        type: 'VIEW/STUDENT',
        context: currentRoute.searchContext,
        batch_id: window.routeParameters[1],
        searchQuery : (searchQuery === '')? null:searchQuery
    };

    let formData = new FormData(filterMenu);
    formData.forEach((value,key) =>{
        requestData[key] = value;
    })
    console.log(requestData);

    let data = await fetch(APIURL + currentRoute.link, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestData)
    })
    .then(response => {
        return response.json();
    })
    .catch( error => {
        console.error(error);
    })

    console.log(data);
    contentContainer.innerHTML = currentRoute.getTemplate(data);
}

function changeActiveLink(href){
    if(href === '/applicant'){
        applicantLink.classList.add('active');
        interviewLink.classList.remove('active');
        studentLink.classList.remove('active');
        return;
    }
    else if(href === '/interview'){
        interviewLink.classList.add('active');
        applicantLink.classList.remove('active');
        studentLink.classList.remove('active');
        return;
    }

    studentLink.classList.add('active');
    interviewLink.classList.remove('active');
    applicantLink.classList.remove('active');
}

function changeLink(link,linktText,linkOff){
    let linkContainer = document.querySelector('#options-link-container');
    
    if(linkOff){
        linkContainer.classList.add('d-none');
    }
    else{
        linkContainer.classList.remove('d-none');
        let anchor = document.querySelector('#batch-options-link');
        anchor.href = link + `?batch=${window.routeParameters[1]}`;
        anchor.innerHTML = linktText;
    }
}

export {
    getContent
}