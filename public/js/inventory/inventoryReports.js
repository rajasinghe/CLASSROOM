// Element Varaibles
let itemReportButton = null;
let storeReportButton = null;
let inventoryReportButton = null;
let reportContainer = null;
let reportTableContainer = null;

function refreshListeners(){

    itemReportButton = document.querySelector('#itemReportButton');
    storeReportButton = document.querySelector('#storeReportButton');
    inventoryReportButton = document.querySelector('#inventoryReportButton');
    reportContainer = document.querySelector('#inventory-report .card-body');

    generateItemReport();

    itemReportButton.addEventListener('click', event => {
        changeActiveButton(event.target);
        generateItemReport();
        setItemForm();
    });

    storeReportButton.addEventListener('click', event => {
        changeActiveButton(event.target);
        generateStoreReport();
        setStoreForm();
    });

    inventoryReportButton.addEventListener('click', event => {
        changeActiveButton(event.target);
        generateInventoryReport();
        setInventoryForm();
    });
}

function changeActiveButton(button){
    if(button === itemReportButton){
        itemReportButton.classList.add('active');
        storeReportButton.classList.remove('active');
        inventoryReportButton.classList.remove('active');
        return;
    }
    else if(button === storeReportButton){
        storeReportButton.classList.add('active');
        itemReportButton.classList.remove('active');
        inventoryReportButton.classList.remove('active');
        return;
    }
    inventoryReportButton.classList.add('active');
    storeReportButton.classList.remove('active');
    itemReportButton.classList.remove('active');
    return;
}

async function getData(requestData){
    requestData['type'] = 'get';

    let responseData = await fetch(`${APIURL}/inventory`,{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify(requestData)
    })
    .then( response => {
        return response.json()
    })
    .catch( error => {
        console.error(error);
    })

    let results = [];
    if(responseData['condition'] == 'success') results = responseData['data'];

    return results;
}

function generateInventoryReport(){

    let template = getReportTemplate({title:'INVENTORY DETAILS'});
    reportContainer.innerHTML = template;

    document.querySelector('#remove_Button').addEventListener('click', event => {
        // Show remove form
    });

    document.querySelector('#update_Button').addEventListener('click', event => {
        // Show update form
        showForm();
    });

    reportTableContainer = document.querySelector('#table-section');
    generateInventoryTable();
}

function generateStoreReport(){

    let template = getReportTemplate({title:'STORE DETAILS'});
    reportContainer.innerHTML = template;

    document.querySelector('#remove_Button').addEventListener('click', event => {
        // Show remove form
    });

    document.querySelector('#update_Button').addEventListener('click', event => {
        // Show update form
        showForm();
    });

    reportTableContainer = document.querySelector('#table-section');
    generateStoreTable();
}

function generateItemReport(){

    let template = getReportTemplate({title:'ITEM DETAILS'});
    reportContainer.innerHTML = template;

    document.querySelector('#remove_Button').addEventListener('click', event => {
        // Show remove form
    });

    document.querySelector('#update_Button').addEventListener('click', event => {
        showForm();
    });

    reportTableContainer = document.querySelector('#table-section');
    generateItemTable();
}

function getReportTemplate(templateData){
    return (
    `<div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-5 px-0 d-flex align-items-center">
                <h4 class="fs-4 my-0">${templateData['title']}</h4>
            </div>

            <div class="col-12 px-0 ">
                <hr>
            </div>
        </div>
    </div>
    <div class="table-responsive site-scrollbar" id="table-section">
        
    </div>
    <div class="d-flex justify-content-end  pe-3 pt-3">
        <button class="btn site-btn rounded-1 " id="update_Button">Update</button>
        <button class="btn site-btn rounded-1 ms-3 " id="remove_Button">Remove</button>
    </div>`
    );
}

function getTableTemplate(templateData){
    return (
    `<table class="table table-bordered text-nowrap">
        <thead class="sticky-top">
            ${templateData['thead']}
        </thead>
        <tbody>
            ${templateData['tbody']}
        </tbody>
    </table>`
    );
}

function generateInventoryTable(){
    let thead = // Generate table headings
    `<tr>
        <th>No</th>
        <th>Item Code</th>
        <th>Item Name</th>
        <th>Inventory Code</th>
        <th>Description</th>
        <th>Received Date</th>
        <th>Status</th>
    </tr>`;

    reportTableContainer.innerHTML = getTableTemplate({thead,tbody:''});
}

async function generateItemTable(){
    let items = await getData({ context:'ITEM' });

    let thead = // Generate table headings
    `<tr>
        <th>No</th>
        <th>Item Code</th>
        <th>Item Name</th>
        <th>Model</th>
        <th>Balance</th>
    </tr>`,
    tbody = '';

    let count = 1;
    for(const item of items){ // Generate table body
        tbody += 
        `<tr>
            <td>${count}</td>
            <td>${item['item_code']}</td>
            <td>${item['item_name']}</td>
            <td>${item['model']}</td>
            <td>${item['balance']}</td>
        </tr>`;

        count++;
    }

    reportTableContainer.innerHTML = getTableTemplate({thead,tbody});
}

function generateStoreTable(){
    let thead = // Generate table headings
    `<tr>
        <th>No</th>
        <th>Item Code</th>
        <th>Item Name</th>
        <th>Model</th>
        <th>Quantity</th>
        <th>Received Date</th>
        <th>Order Bill No</th>
        <th>Received Bill No</th>
        <th>Page No</th>
        <th>Balance</th>
    </tr>`;

    reportTableContainer.innerHTML = getTableTemplate({thead,tbody:''});
}

function showForm(){
    window.formContainer.classList.remove('d-none');
}

function hideForm(){
    window.formContainer.classList.add('d-none');
}

function setInventoryForm(){
    let template = 
    `<div class="container">
        <div class="text">
            ADD INVENTORY ITEMS
        </div>
        <form name="n1" action="#">
            <div class="form-row">

                <div class="custom-select">
                    <button class="select-button" role="combobox" aria-labelledby="select button"
                        aria-haspopup="listbox" aria-expanded="false" aria-controls="select-dropdown">
                        <span class="selected-value">Select Item Code</span>
                        <span class="arrow"></span>
                    </button>
                    <ul class="select-dropdown" role="listbox" id="select-dropdown">
                        <li role="option">
                            <input type="radio" id="github" name="social-account" />
                            <label for="github"><i class="bx bxl-github"></i>GitHub</label>
                            
                        </li>
                        <li role="option">
                            <input type="radio" id="instagram" name="social-account" />
                            <label for="instagram"><i class="bx bxl-instagram"></i>Instagram</label>
                        </li>
                        <li role="option">
                            <input type="radio" id="facebook" name="social-account" />
                            <label for="facebook"><i class="bx bxl-facebook-circle"></i>Facebook</label>
                        </li>
                        <li role="option">
                            <input type="radio" id="linkedIn" name="social-account" />
                            <label for="linkedIn"><i class="bx bxl-linkedin-square"></i>LinkedIn</label>
                        </li>
                        <li role="option">
                            <input type="radio" id="twitter" name="social-account" />
                            <label for="twitter"><i class="bx bxl-twitter"></i>Twitter</label>
                        </li>
                        <li role="option">
                            <input type="radio" id="reddit" name="social-account" />
                            <label for="reddit"><i class="bx bxl-reddit"></i>Reddit</label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" id="Name" required>
                    <div class="underline"></div>
                    <label for="">Item Name</label>
                </div>
                    <label for="errorName" id="errorName" class="lable"></label><br>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" id="Code" required>
                    <div class="underline"></div>
                    <label for="">Inventory Code</label>
                </div>
                <label for="errorCode" id="errorCode" class="lable"></label><br>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" id="Model" required>
                    <div class="underline"></div>
                    <label for="">Model</label>
                </div>
                <label for="errorModel" id="errorModel" class="lable"></label><br>
            </div>
            <div class="form-row">
                <div class="input-data textarea">
                    <textarea rows="8" cols="80" id="Description" required></textarea>
                    <br />
                    <div class="underline"></div>
                    <label for="">Description</label>
                    <br />
                </div>
                <label for="errorDescription" id="errorDescription" class="lable"></label><br>
            </div>
            <div class="form-row" id="btn_Group">
                <button class="button button3" id="btn_Clear">Clear</button>
                <button class="button button3" id="btn_Add">Add</button>
            </div>
        </form>
    </div>`;

    window.formContainer.innerHTML = template;


    document.querySelector('#btn_Clear').addEventListener('click', event => {
        hideForm();
    });
}

function setStoreForm(){
    let template = 
    `<div class="container">
        <div class="text">
            ADD STORE ITEMS
        </div>
        <form name="n1" action="#">
            <div class="form-row">

                <div class="custom-select">
                    <button class="select-button" role="combobox" aria-labelledby="select button"
                        aria-haspopup="listbox" aria-expanded="false" aria-controls="select-dropdown">
                        <span class="selected-value">Select Item Code</span>
                        <span class="arrow"></span>
                    </button>
                    <ul class="select-dropdown" role="listbox" id="select-dropdown">
                        <li role="option">
                            <input type="radio" id="github" name="social-account" />
                            <label for="github"><i class="bx bxl-github"></i>GitHub</label>
                            
                        </li>
                        <li role="option">
                            <input type="radio" id="instagram" name="social-account" />
                            <label for="instagram"><i class="bx bxl-instagram"></i>Instagram</label>
                        </li>
                        <li role="option">
                            <input type="radio" id="facebook" name="social-account" />
                            <label for="facebook"><i class="bx bxl-facebook-circle"></i>Facebook</label>
                        </li>
                        <li role="option">
                            <input type="radio" id="linkedIn" name="social-account" />
                            <label for="linkedIn"><i class="bx bxl-linkedin-square"></i>LinkedIn</label>
                        </li>
                        <li role="option">
                            <input type="radio" id="twitter" name="social-account" />
                            <label for="twitter"><i class="bx bxl-twitter"></i>Twitter</label>
                        </li>
                        <li role="option">
                            <input type="radio" id="reddit" name="social-account" />
                            <label for="reddit"><i class="bx bxl-reddit"></i>Reddit</label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" id="Name" onblur="userNamevalidate()" required>
                    <div class="underline"></div>
                    <label for="">Item Name</label>
                </div>
                    <label for="errorName" id="errorName" class="lable"></label><br>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" id="Code" onblur="userCodevalidate()" required>
                    <div class="underline"></div>
                    <label for="">Inventory Code</label>
                </div>
                <label for="errorCode" id="errorCode" class="lable"></label><br>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" id="Model" onblur="userModelvalidate()" required>
                    <div class="underline"></div>
                    <label for="">Model</label>
                </div>
                <label for="errorModel" id="errorModel" class="lable"></label><br>
            </div>
            <div class="form-row">
                <div class="input-data textarea">
                    <textarea rows="8" cols="80" id="Description" onblur="userDescriptionvalidate()" required></textarea>
                    <br />
                    <div class="underline"></div>
                    <label for="">Description</label>
                    <br />
                </div>
                <label for="errorDescription" id="errorDescription" class="lable"></label><br>
            </div>
            <div class="form-row" id="btn_Group">
                <button class="button button3" id="btn_Clear">Clear</button>
                <button class="button button3" id="btn_Add">Add</button>
            </div>
        </form>
    </div>`;

    window.formContainer.innerHTML = template;

    document.querySelector('#btn_Clear').addEventListener('click', event => {
        hideForm();
    });
}

function setItemForm(){
    let template = 
    `<div class="container">
        <div class="text">
            ADD ITEMS
        </div>
        <form name="n1" action="#">
            <div class="form-row">

                <div class="custom-select">
                    <button class="select-button" role="combobox" aria-labelledby="select button"
                        aria-haspopup="listbox" aria-expanded="false" aria-controls="select-dropdown">
                        <span class="selected-value">Select Item Code</span>
                        <span class="arrow"></span>
                    </button>
                    <ul class="select-dropdown" role="listbox" id="select-dropdown">
                        <li role="option">
                            <input type="radio" id="github" name="social-account" />
                            <label for="github"><i class="bx bxl-github"></i>GitHub</label>
                            
                        </li>
                        <li role="option">
                            <input type="radio" id="instagram" name="social-account" />
                            <label for="instagram"><i class="bx bxl-instagram"></i>Instagram</label>
                        </li>
                        <li role="option">
                            <input type="radio" id="facebook" name="social-account" />
                            <label for="facebook"><i class="bx bxl-facebook-circle"></i>Facebook</label>
                        </li>
                        <li role="option">
                            <input type="radio" id="linkedIn" name="social-account" />
                            <label for="linkedIn"><i class="bx bxl-linkedin-square"></i>LinkedIn</label>
                        </li>
                        <li role="option">
                            <input type="radio" id="twitter" name="social-account" />
                            <label for="twitter"><i class="bx bxl-twitter"></i>Twitter</label>
                        </li>
                        <li role="option">
                            <input type="radio" id="reddit" name="social-account" />
                            <label for="reddit"><i class="bx bxl-reddit"></i>Reddit</label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" id="Name" onblur="userNamevalidate()" required>
                    <div class="underline"></div>
                    <label for="">Item Name</label>
                </div>
                    <label for="errorName" id="errorName" class="lable"></label><br>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" id="Code" onblur="userCodevalidate()" required>
                    <div class="underline"></div>
                    <label for="">Inventory Code</label>
                </div>
                <label for="errorCode" id="errorCode" class="lable"></label><br>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" id="Model" onblur="userModelvalidate()" required>
                    <div class="underline"></div>
                    <label for="">Model</label>
                </div>
                <label for="errorModel" id="errorModel" class="lable"></label><br>
            </div>
            <div class="form-row">
                <div class="input-data textarea">
                    <textarea rows="8" cols="80" id="Description" onblur="userDescriptionvalidate()" required></textarea>
                    <br />
                    <div class="underline"></div>
                    <label for="">Description</label>
                    <br />
                </div>
                <label for="errorDescription" id="errorDescription" class="lable"></label><br>
            </div>
            <div class="form-row" id="btn_Group">
                <button class="button button3" id="btn_Clear">Clear</button>
                <button class="button button3" id="btn_Add">Add</button>
            </div>
        </form>
    </div>`;

    window.formContainer.innerHTML = template;

    document.querySelector('#btn_Clear').addEventListener('click', event => {
        hideForm();
    });
}

export {
    refreshListeners
};