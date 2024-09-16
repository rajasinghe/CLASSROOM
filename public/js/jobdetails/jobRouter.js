import * as Reports from '/public/js/jobdetails/jobReports.js';
import * as Overview from '/public/js/jobdetails/jobOverview.js';

const contentContainer = document.querySelector('#page-content .row');
const overviewLink = document.querySelector('#overview-link');
const reportsLink = document.querySelector('#reports-link');

document.addEventListener('click', event => {
    const {target} = event;
    //console.log(target.href);
    if(!target.matches("a") || ! target.href.match(/\/jobDetails(\/)?[a-zA-Z]*/)){
        //console.log("doesn't match");
        return;
    }
    //event.preventDefault();
    urlRoute();
});

const urlRoutes = {
    "/": {
        link: '/includes',
        template: "jobOverview",
        script: Overview
    },
    "/reports": {
        link: '/includes',
        template: "jobReports",
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

    if(! location.match(/^\/jobDetails(\/)?[a-zA-Z]*/)){
        return;
    }
    location = location.replace(/^\/jobDetails/,"") || "/";
    //console.log(location);

    const route = urlRoutes[location];
    
    // Change the active navigation link style
    changeActiveLink(route.template);
    // Get contents from server and add it to the dom
    getContent(route);
};

window.onpopstate = urlLocationHandler;
window.route = urlRoute;
urlLocationHandler();

function changeActiveLink(href){
    if(href === 'jobOverview'){
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