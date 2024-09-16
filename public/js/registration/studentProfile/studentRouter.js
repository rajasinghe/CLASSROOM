import * as courseDetails from '/public/js/registration/studentProfile/courseDetails.js';
import * as attendance from '/public/js/registration/studentProfile/attendance.js';
import * as assessment from '/public/js/registration/studentProfile/assessment.js';

window.profileContainer = null;
let applicantLink = null, interviewLink = null,
    studentBaseData = null,
    studentLink = null;

const urlRoutes = {
    'base': {
        link: '/includes',
        template: 'studentProfile'
    },
    '/': {
        manual: true,
        link: '/includes',
        template: 'profileAdditional',
        script: {
            getContent: getProfileContent
        }
    },
    '/courseDetails': {
        manual: true,
        link: '/includes',
        template: 'profileRegistration',
        script: courseDetails
    },
    '/attendance': {
        manual: true,
        link: '/includes',
        template: 'profileAttendance',
        script:attendance
    },
    '/assessments': {
        manual: true,
        link: '/includes',
        template: 'profileAssessments',
        script: assessment
    }
}

function refreshListeners() {
    applicantLink = document.querySelector('#applicant-link');
    interviewLink = document.querySelector('#interview-link');
    studentLink = document.querySelector('#student-link');
}

async function getContent(route) {
    let location = route.pathname.replace(/^\/student\/\d+/, "") || "/";

    let urlRoute = urlRoutes[location];
    if (urlRoute === undefined || urlRoute === null) window.open(`${APIURL}/notfound`, '_self');

    profileContainer = document.querySelector('#profile-content-container');
    
    if (profileContainer === null) profileContainer = await getBaseContent();

    if (urlRoute.manual) urlRoute.script.getContent(urlRoute);
    else getProfileContent(urlRoute);

    changeActiveLink(urlRoute);
}

async function getBaseContent() {
    
    let baseOps = urlRoutes['base'];
    const url = APIURL + baseOps.link;
    let template = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ component: baseOps.template })
    })
    .then(response => {
            //console.log(response);
            if (!response.ok) {
                return '<h4>Server error</h4>';
            }
            return response.text();
        })

    studentBaseData = await getStudentProfileData();
    console.log(studentBaseData);
    studentBaseData['profile_img_url'] = (studentBaseData['profile_img_url'] == null)? '/public/images/students/p (3).jpg' : studentBaseData['profile_img_url'];

    window.mainContainer.innerHTML = compileTemplate(template, studentBaseData);

    refreshListeners();
    return document.querySelector('#profile-content-container');
}

async function getProfileContent(route) {
    const url = `${APIURL}${route.link}`;

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ component: route.template })
    })
        .then(response => {
            //console.log(response);
            return response.text();
        })
        .then(
            html => {
                profileContainer.innerHTML = compileTemplate(html, studentBaseData);
                if (route.hasOwnProperty('script') && route['script'] && route['script'].hasOwnProperty('script'))
                    route.script.refreshListeners();
            }
        )
}

async function getStudentProfileData() {
    
    return await fetch(`${APIURL}/student`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            type: 'VIEW/STUDENT',
            context: 'STUDENT/PROFILE',
            student_id: window.routeParameters[1]
        })
    })
        .then(response => {
            return response.json();
        })
}

function changeActiveLink(route){
    let links = document.querySelectorAll('#button-group a');

    let selectedIndex = 0;
    switch(route.template){

        case 'profileRegistration': selectedIndex = 1; break;
        case 'profileAttendance': selectedIndex = 2; break;
        case 'profileAssessments': selectedIndex = 3; break;
    }

    for (let index = 0; index < links.length; index++) {
        const element = links[index];
        if(index == selectedIndex){
            element.classList.add('active');
        }
        else{
            element.classList.remove('active');
        }
    }
}

export {
    getContent,
    refreshListeners
}