import * as StudentDetails from '/public/js/registration/studentDetails.js';
import * as BatchDetails from '/public/js/registration/batchDetails.js';
import * as Applicant from '/public/js/registration/applicantDetails.js';
import * as Student from '/public/js/registration/studentProfile/studentRouter.js';

window.mainContainer = document.querySelector('#content-container .row');
window.routeParameters = null;
let contentContainer = document.querySelector('#page-content');
let studentDetailsLink = document.querySelector('#student-details-link');
let batchDetailsLink = document.querySelector('#batch-details-link');

let target = null;

document.addEventListener('click', event => {
    target = event.target;

    if (!(target.matches("a") || target.matches("a *"))) {
        return;
    }

    target = (target.href == undefined) ? target.closest("a") : target;

    if (!target.href.match(/\/batch(\/)?[a-zA-Z]*/)) {
        return;
    }

    //event.preventDefault();
    urlRoute();
});

// Routes definition
const urlRoutes = {
    "/": {
        manual: false,
        link: '/includes',
        template: "batchDetails",
        script: BatchDetails
    },
    "/student": {
        manual: false,
        link: '/includes',
        template: "studentDetails",
        script: StudentDetails
    },
    "/{(\\d+)}/{.+}": {
        manual: true,
        link: '/includes',
        template: "batchBase",
        script: Applicant
    },
    "/student/{(\\d+)(.*)}": {
        manual: true,
        link: '/includes',
        template: "studentDetails",
        script: Student
    }
};

const urlRoute = event => {
    event = event || window.event;
    event.preventDefault();
    window.history.pushState({}, "", target.href);
    urlLocationHandler();
};

const urlLocationHandler = async () => {
    let location = window.location.pathname;

    console.log(location);

    if (!location.match(/^\/batch(\/)?[a-zA-Z]*/)) {
        return;
    }

    location = location.replace(/^\/batch/, "") || "/";

    let route = matchRoutes(location);

    if (route === undefined || route === null) window.open('http://localhost:3000/notfound', '_self');

    route.pathname = location;
    // Get contents from server and add it to the dom
    if (!route.manual) getContent(route);
    else route.script.getContent(route);

};

window.onpopstate = urlLocationHandler;
window.route = urlRoute;
urlLocationHandler();

function changeActiveLink(href) {
    if (href === 'studentDetails') {
        studentDetailsLink.classList.add('active');
        batchDetailsLink.classList.remove('active');

        changeNavDirectionLink(`${APIURL}/batch/student`, 'Overview', 1);
        return;
    }

    batchDetailsLink.classList.add('active');
    studentDetailsLink.classList.remove('active');

    changeNavDirectionLink(`${APIURL}/batch`, 'Batches', 1);
}

function changePageContent(content) {
    if (!document.body.contains(contentContainer)) {
        refreshContainer();
    }

    contentContainer.innerHTML = content;
    refreshBaseScript();
}

function getContent(route) {
    const url = "http://localhost:3000" + route.link;
    //console.log(route.template);

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
                changePageContent(html);
                if (route.hasOwnProperty('script') && route['script']) route.script.refreshListeners();
                // Change the active navigation link style
                changeActiveLink(route.template);
            }
        )
}

function refreshContainer() {

    let template =
        `<!--Site Header section start-->
            <div class="col-12 py-3 bg-white" id="site-header">
                <span class="fw-medium ms-4">STUDENT DETAILS</span>
            </div>
            <!--Site Header section end-->

            <div class="col-12 pt-4 px-2 px-md-4 d-flex">
                <span class="text-dark ms-md-2" id="nav-direction-section">
                    <a href="/batch/student" class="text-decoration-none text-dark me-md-1">Student</a>
                    <i class="bi bi-caret-right-fill text-dark"></i>
                    <a href="/batch/student" class="text-decoration-none text-dark ms-md-1">Overview</a>
                </span>

                <span class="ms-auto me-md-2" id="content-nav">
                    <a href="/batch/student" class="btn border-danger rounded-1 active"
                        id="student-details-link">Student Details</a>
                    <a href="/batch" class="btn border-danger rounded-1"
                        id="batch-details-link">Batch Details</a>
                </span>
            </div>

            <div class="col-12" id="page-content">

            </div>`;

    mainContainer.innerHTML = template;

    contentContainer = document.querySelector('#page-content');
    studentDetailsLink = document.querySelector('#student-details-link');
    batchDetailsLink = document.querySelector('#batch-details-link');
}

function matchRoutes(location) {
    for (const key in urlRoutes) {
        // Replace curly braces
        let reg = key.replaceAll(/{([^}]+)}/g, (match, re) => {
            return re;
        });

        // Generate the regex from string key
        reg = "^" + reg + "$";
        reg = new RegExp(reg);

        let match = location.match(reg);

        // Match the target href against the regex
        if (match) {
            window.routeParameters = match;
            return urlRoutes[key];
        }
    }

    return null;
}