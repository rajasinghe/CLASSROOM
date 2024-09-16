import * as Overview from '/public/js/inventory/inventoryOverview.js';
import * as Reports from '/public/js/inventory/inventoryReports.js';

const contentContainer = document.querySelector('#page-content .row');
const overviewLink = document.querySelector('#overview-link');
const reportsLink = document.querySelector('#reports-link');
window.formContainer = document.querySelector('#form_div');

document.addEventListener('click', event => {
    const {target} = event;

    if(!target.matches("a") || ! target.href.match(/\/inventory(\/)?[a-zA-Z]*/)){

        return;
    }
    //event.preventDefault();
    urlRoute();
});

// Routes definition
const urlRoutes = {
    "/": {
        manual:false,
        link: '/includes',
        template: "inventoryOverview",
        script: Overview
    },
    "/reports": {
        manual:false,
        link: '/includes',
        template: "inventoryReports",
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

    if(! location.match(/^\/inventory(\/)?[a-zA-Z]*/)){
        return;
    }
    location = location.replace(/^\/inventory/,"") || "/";

    const route = urlRoutes[location];
    
    if(route === undefined || route === null) window.open('http://localhost:3000/notfound','_self');

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
    if(href === 'inventoryOverview'){
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