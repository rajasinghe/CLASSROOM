import * as Overview from '/public/js/assessment/assessmentOverview.js';
import * as ModuleOverview from '/public/js/assessment/assessmentModuleOverview.js';
import * as ModuleForm from '/public/js/assessment/assessmentModule.js';
import * as TaskForm from '/public/js/assessment/assessmentTask.js';
import * as StepForm from '/public/js/assessment/assessmentStep.js';
import * as Reports from '/public/js/assessment/assessmentReports.js';
import * as PreFinalAssessment from '/public/js/PreFinalAssessment/preFinalAssessment.js';

const contentContainer = document.querySelector('#page-content .row');
const overviewLink = document.querySelector('#overview-link');
const modulesLink = document.querySelector('#modules-link');
const reportsLink = document.querySelector('#reports-link');
const preFinalLink = document.querySelector('#pre-final-link');
const batchField = document.querySelector('#batchField');

let batchDetails = null;
window.selectedBatch = null;

document.addEventListener('click', event => {
    const {target} = event;

    if(!target.matches("a") || ! target.href.match(/\/assessment(\/)?[a-zA-Z]*/)){

        return;
    }
    //event.preventDefault();
    urlRoute();
});

batchField.addEventListener('change', event => {
    window.selectedBatch = batchDetails[batchField.value];

    let location = window.location.pathname;
    location = location.replace(/^\/assessment/,"") || "/";

    urlRoutes[location].script.refreshDataFunctions();
})

// Routes definition
const urlRoutes = {
    "/": {
        manual:false,
        link: '/includes',
        template: "assessmentOverview",
        script: Overview
    },
    "/reports": {
        manual:false,
        link: '/includes',
        template: "assessmentReports",
        script: Reports
    },
    "/module": {
        manual:true,
        link: '/includes',
        template: "assessmentModules",
        script: ModuleOverview
    },
    "/module/addModule": {
        manual:true,
        link: '/includes',
        template: "assessmentModules",
        script: ModuleForm
    },
    "/module/addTask": {
        manual:true,
        link: '/includes',
        template: "assessmentModules",
        script: TaskForm
    },
    "/module/addStep": {
        manual:true,
        link: '/includes',
        template: "assessmentModules",
        script: StepForm
    },
    "/preAssessment":{
        manual:true,
        link:'/includes',
        template: "preFinalAssessmentModule",
        script: PreFinalAssessment
    }
};

const urlRoute = event => {
    event = event || window.event;
    event.preventDefault();
    window.history.pushState({}, "", event.target.href);
    urlLocationHandler();
};

const urlLocationHandler = async () => {
    let location = window.location.pathname;

    if(! location.match(/^\/assessment(\/)?[a-zA-Z]*/)){
        return;
    }
    location = location.replace(/^\/assessment/,"") || "/";

    const route = urlRoutes[location];
    
    if(route === undefined || route === null) window.open('http://localhost:3000/notfound','_self');

    await init();
    // Change the active navigation link style
    changeActiveLink(route.template);

    // Get contents from server and add it to the dom
    if(! route.manual)  getContent(route);
    else route.script.getContent(route);
};

window.onpopstate = urlLocationHandler;
window.route = urlRoute;
urlLocationHandler();

function changeActiveLink(href){
    switch(href){
        case 'assessmentOverview' : 
            overviewLink.classList.add('active');
            modulesLink.classList.remove('active');
            reportsLink.classList.remove('active');
            preFinalLink.classList.remove('active');

            changeNavDirectionLink(`${APIURL}/assessment`, 'Overview', 1);
            removeNavDirectionLink(2);
            return;

        case 'assessmentModules':
            modulesLink.classList.add('active');
            overviewLink.classList.remove('active');
            reportsLink.classList.remove('active');
            preFinalLink.classList.remove('active');

            changeNavDirectionLink(`${APIURL}/assessment/module`, 'Modules', 1);
            return;

        case 'preFinalAssessmentModule':
            preFinalLink.classList.add('active');
            modulesLink.classList.remove('active');
            overviewLink.classList.remove('active');
            reportsLink.classList.remove('active');
    
            changeNavDirectionLink(`${APIURL}/assessment/module`, 'Modules', 1);
            removeNavDirectionLink(2);
            return;

        default :
            reportsLink.classList.add('active');
            modulesLink.classList.remove('active');
            overviewLink.classList.remove('active');
            preFinalLink.classList.remove('active');

            changeNavDirectionLink(`${APIURL}/assessment/reports`, 'Reports', 1);
            removeNavDirectionLink(2);
    }
}

function changePageContent(content){
    contentContainer.innerHTML = content;
    refreshBaseScript();
}

function getContent(route){
    const url = "http://localhost:3000" + route.link;
    //console.log(route.template);

    fetch( url, {
        method: 'POST',
        headers: {
            'Content-Type' : 'application/json'
        },
        body: JSON.stringify({ component: route.template })
    })
    .then(response => {
        //console.log(response);
        return response.text();
    })
    .then(
        html => {
            //console.log(html);
            changePageContent(html);
            if(route.hasOwnProperty('script') && route['script']) route.script.refreshListeners();
        }
    )
}

window.changeModuleActiveLink = (href) => {
    let navs = document.querySelectorAll('#module-navigation-section a');

    for (const nav of navs) {
        if(nav.href === href){
            nav.classList.add('active');
        }
        else{
            nav.classList.remove('active');
        }
    }
}

async function setBatchField(){
    if(batchDetails !== null) return;

    batchField.innerHTML = '';

    await fetch('http://localhost:3000/batch',{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify({
            type:"ALL"
        })
    })
    .then( response => {
        return response.json();
    })
    .then( data => {
        batchDetails = data;
        window.selectedBatch = data[0];

        for (const batch of data) {
            batchField.innerHTML += `<option value="${data.indexOf(batch)}">${batch['batch_name']}</option>`;
        }
    })

}

async function init(){
    await setBatchField();
}