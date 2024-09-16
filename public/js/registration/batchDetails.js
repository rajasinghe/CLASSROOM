let batchContainer = null;

function refreshListeners(){
    batchContainer = document.querySelector('#batch-container');

    fetchBatches();

    document.querySelector(".jsFilterSec").addEventListener("mouseenter", function () {
        document.querySelector(".filter-menuSec").classList.add("active");
    });

    document.querySelector(".jsFilterSec").addEventListener("mouseleave", function () {
        document.querySelector(".filter-menuSec").classList.remove("active");
    });
}

function fetchBatches(){

    fetch('http://localhost:3000/batch',{
        method:'POST',
        headers: {
            'Content-Type':'application/json'
        },
        body: JSON.stringify({
            type:'ALL'
        })
    })
    .then( response => {
        return response.json();
    })
    .then( data => {
        showBatches(data);
    })
    .catch( error => {
        console.error(error);
    })
}

function showBatches(batches){
    let template = 
    `<div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="batch-list new-batch">
            <a href="../form/bactchdd.html">
                <div class="picture newpicture addNewPicture">
                    <img class="img-fluid" src="/public/images/batchDetails/plusCrop.jpg">
                </div>
                <div class="batch-content">
                    <h3 class="batch-name">Add New</h3>
                    <h4 class="batch-title">Batch</h4>
                </div>
                <ul class="social addNewSocial">
                    <li><span class="goAhead">Go Ahead... </span><img src="/public/images/batchDetails/more.png">
                    </li>
                </ul>
            </a>
        </div>
    </div>`;

    for (const batch of batches) {
        
        template += 
        `<div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="batch-list old-batch">
                <a href="/batch/${batch['batch_id']}/registeredStudent">
                    <div class="picture ">
                        <img class="img-fluid" src="/public/images/batchDetails/fallowersIMG.png">
                    </div>
                    <div class="batch-content">
                        <h3 class="batch-name">FN/SD/${batch['year']}/0${batch['batch_number']}</h3>
                        <h4 class="batch-title">${batch['batch_name']}</h4>
                    </div>
                    <ul class="social">
                        <li><span class="goAhead">Go Ahead... </span><img src="/public/images/batchDetails/more.png">
                        </li>
                    </ul>
                </a>
            </div>
        </div>`;
    }

    batchContainer.innerHTML = template;
}

export {
    refreshListeners
}