import * as course from '/public/js/admin/controls/course.js';
import * as center from '/public/js/admin/controls/center.js';
import * as account from '/public/js/admin/controls/account.js';

// Element variables
let controlsContainer = null;
let centerLink, courseLink, accountLink = null;


// Routes definition
const urlRoutes = {
    "/course": {
        manual: true,
        link: '/includes',
        template: "adminCourse",
        script: course
    },
    "/center": {
        manual: true,
        link: '/includes',
        template: "adminCenter",
        script: center
    },
    "/account": {
        manual: true,
        link: '/includes',
        template: "adminAccount",
        script: account
    }
};

function refreshListeners(){
    controlsContainer = document.getElementById('control-section');
    courseLink = document.getElementById('course-link');
    centerLink = document.getElementById('center-link');
    accountLink = document.getElementById('account-link');
}

async function getContent(route){
    let urlRoute = urlRoutes[route.pathname];
    if (urlRoute === undefined || urlRoute === null) window.open('http://localhost:3000/notfound', '_self');

    // Get contents from server and add it to the dom
    if (controlsContainer == null || ! document.body.contains(controlsContainer)) {
        
        await getBaseContent();
    }
    urlRoute.script.getContent(urlRoute);
    changeActiveLink(urlRoute.template);
}

async function getBaseContent(){

    let baseContent = await fetch(`${APIURL}/includes`,{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify({component:'adminControls'})
    })
    .then( response => response.text())

    document.querySelector('#page-content').innerHTML = baseContent;
    refreshListeners();
}

function changeActiveLink(href){

    if(href == 'adminCourse'){
        courseLink.classList.add('active');
        centerLink.classList.remove('active');
        accountLink.classList.remove('active');
    }
    else if(href == 'adminCenter'){
        centerLink.classList.add('active');
        courseLink.classList.remove('active');
        accountLink.classList.remove('active');
    }
    else{
        accountLink.classList.add('active');
        centerLink.classList.remove('active');
        courseLink.classList.remove('active');
    }
}

export {
    getContent,
    refreshListeners
}