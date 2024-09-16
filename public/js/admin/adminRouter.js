import * as controls from '/public/js/admin/controls.js';

window.mainContainer = document.querySelector('#content-container .row');
window.routeParameters = null;
let contentContainer = document.querySelector('#page-content');
let overviewLink = document.querySelector('#overview-link');
let controlsLink = document.querySelector('#control-link');

let target = null;

document.addEventListener('click', event => {
    target = event.target;

    if (!(target.matches("a") || target.matches("a *"))) {
        return;
    }

    target = (target.href == undefined) ? target.closest("a") : target;

    if (!target.href.match(/\/admin(\/)?[a-zA-Z]*/)) {
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
        template: "adminOverview",
        /* script: BatchDetails */
    },
    "/{.+}": {
        manual: true,
        link: '/includes',
        template: "studentDetails",
        script: controls
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

    if (!location.match(/^\/admin(\/)?[a-zA-Z]*/)) {
        return;
    }

    location = location.replace(/^\/admin/, "") || "/";

    let route = matchRoutes(location);

    if (route === undefined || route === null) window.open('http://localhost:3000/notfound', '_self');

    route.pathname = location;
    // Get contents from server and add it to the dom
    if (!route.manual) getContent(route);
    else route.script.getContent(route);

    changeActiveLink(route.template);
};

window.onpopstate = urlLocationHandler;
window.route = urlRoute;
urlLocationHandler();

function changeActiveLink(href) {
    if (href === 'adminOverview') {
        overviewLink.classList.add('active');
        controlsLink.classList.remove('active');

        changeNavDirectionLink(`${APIURL}/admin`, 'Overview', 1);
        removeNavDirectionLink(2);
        return;
    }

    controlsLink.classList.add('active');
    overviewLink.classList.remove('active');

    changeNavDirectionLink(`${APIURL}/admin/course`, 'Controls', 1);
}

function changePageContent(content) {
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
            }
        )
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