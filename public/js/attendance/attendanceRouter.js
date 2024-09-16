import * as Reports from '/public/js/attendance/attendanceReports.js';
import * as Overview from '/public/js/attendance/attendanceOverview.js';

const contentContainer = document.querySelector('#page-content .row');
const overviewLink = document.querySelector('#overview-link');
const reportsLink = document.querySelector('#reports-link');
const batchField = document.querySelector('#batchField');

let batchDetails = null;
window.selectedBatch = null;

document.addEventListener('click', event => {
    const {target} = event;
    //console.log(target.href);
    if(!target.matches("a") || ! target.href.match(/\/attendance(\/)?[a-zA-Z]*/)){
        //console.log("doesn't match");
        return;
    }
    //event.preventDefault();
    urlRoute();
});

batchField.addEventListener('change', event => {
    window.selectedBatch = batchDetails[batchField.value];

    let location = window.location.pathname;
    location = location.replace(/^\/attendance/,"") || "/";

    urlRoutes[location].script.refreshDataFunctions();
})

const urlRoutes = {
    "/": {
        link: '/includes',
        template: "attendanceOverview",
        script: Overview
    },
    "/reports": {
        link: '/includes',
        template: "attendanceReports",
        script: Reports
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

    if(! location.match(/^\/attendance(\/)?[a-zA-Z]*/)){
        return;
    }
    location = location.replace(/^\/attendance/,"") || "/";
    //console.log(location);

    const route = urlRoutes[location];
    
    await init();
    // Change the active navigation link style
    changeActiveLink(route.template);
    // Get contents from server and add it to the dom
    getContent(route);
};

window.onpopstate = urlLocationHandler;
window.route = urlRoute;
urlLocationHandler();

function changeActiveLink(href){
    if(href === 'attendanceOverview'){
        overviewLink.classList.add('active');
        reportsLink.classList.remove('active');
        return;
    }

    reportsLink.classList.add('active');
    overviewLink.classList.remove('active');
}

function changePageContent(content){
    contentContainer.innerHTML = content;
    refreshBaseScript();
}

function getContent(route){
    const url = `${APIURL}` + route.link;
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

async function setBatchField(){
    if(batchDetails !== null) return;

    batchField.innerHTML = '';

    await fetch(`${APIURL}/batch`,{
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