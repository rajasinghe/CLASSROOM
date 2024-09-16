let navDirectionContainer = null;
let styleContainer = document.getElementById('style-container');;
refreshBaseScript();

function refreshBaseScript(){
    let floatingContainers = document.querySelectorAll('.floatin-container');

    for(const container of floatingContainers){
        let btn = container.querySelector('.maximize-button');
        if(btn !== null){
            btn.addEventListener('click',
            event => {
                container.querySelector('.site-card').classList.toggle('floating');
            });
        }
    }
}

// Changes the current navigation direction link or adds new links
function changeNavDirectionLink(link,linkText,index){
    navDirectionContainer = 
        (navDirectionContainer != null 
        && document.body.contains(navDirectionContainer))? navDirectionContainer : document.querySelector('#nav-direction-section');

    let navDirectionLinks = document.querySelectorAll('#nav-direction-section a');

    if(index >= navDirectionLinks.length){
        let template = 
        `<i class="bi bi-caret-right-fill text-dark"></i>
        <a href="${link}" class="text-decoration-none text-dark ms-md-1">${linkText}</a>`;

        navDirectionContainer.innerHTML += template;
        console.log(`BASE : created new link at ${index} called ${linkText}`);
    }

    else{
        navDirectionLinks[index].href = link;
        navDirectionLinks[index].innerText = linkText;
        console.log(`BASE : changed existing link at ${index}`);
    }
}

// Removes unwanted links from the nav direction containerj
function removeNavDirectionLink(index){
    let navDirectionContainer =  document.querySelector('#nav-direction-section');
    let navDirectionLinks = document.querySelectorAll('#nav-direction-section a');
    let navDirectionIcons = document.querySelectorAll('#nav-direction-section i');

    if(index >= navDirectionLinks.length) return;

    navDirectionContainer.removeChild(navDirectionLinks[index]);
    navDirectionContainer.removeChild(navDirectionIcons[index - 1]);

    console.log(`BASE : removed link at ${index}`);
}

function compileTemplate(html, data,replaceCSS = false) {

    styleContainer = (styleContainer !== null || document.head.contains(styleContainer))? styleContainer : document.getElementById('style-container');
    if(replaceCSS){
        styleContainer.innerHTML = '';
    }

    let cssLinks = html.matchAll(/<link.+href=.(.+\.css).+>/g);
    for(const cssLink of cssLinks){
        if(document.querySelector(`link[href="${cssLink[1]}"]`) == null){
            styleContainer.innerHTML += cssLink[0];
        }
    }
    console.log('working');

    html = html.replaceAll(/<link.+\.css.+>/g,"");
    if(data !== null){

        html = html.replaceAll(/{{\s*([\S]+)\s*}}/g, (match, key) => {
            //console.log(key);
            return data[key];
        });
    }

    return html;
}