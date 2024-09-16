    document.querySelector('#side-toggle-btn').addEventListener('click', event => {
        document.querySelector('#sidebar-container').classList.add('hide');
        document.cookie = "sideBarHidden=true";
    });

    document.querySelector('#side-close-btn').addEventListener('click', event => {
        document.querySelector('#sidebar-container').classList.remove('hide');
        document.cookie = "sideBarHidden=false";
    });