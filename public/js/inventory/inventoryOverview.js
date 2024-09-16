// Element Variables
let itemSummaryTable, allItemCard, removedItemCard = null;

function refreshListeners(){

    itemSummaryTable = document.querySelector('#item-table tbody');
    removedItemCard = document.querySelector('#removed-item-card');
    allItemCard = document.querySelector('#all-item-card');

    showSummaryData();
}

async function getSummaryData(){
    let data = await fetch(`${APIURL}/inventory`,{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify({
            type:'get',
            context:'ITEM'
        })
    })
    .then( response => {
        return response.json();
    })
    .catch( error => {
        console.error(error);
    })

    let results = [];
    if(data['condition'] == 'success') results = data['data'];

    return results;
}

async function showSummaryData(){

    let summaryData = await getSummaryData();
    let template = '';

    let count = 1;
    for (const item of summaryData) {
        template +=  
        `<tr>
            <th scope="row">
                ${count}
            </th>
            <td>${item['item_name']}</td>
            <td class="d-none d-md-table-cell">${item['item_code']}</td>
            <td class="d-none d-lg-table-cell">
                <div class="progress rounded-pill pro" role="progressbar"
                    aria-label="Warning example" aria-valuenow="75" aria-valuemin="0"
                    aria-valuemax="100">
                    <div class="progress-bar rounded-pill" style="width: 95%">${item['balance']}</div>
                </div>
            </td>
        </tr>`;

        count++;
    }

    itemSummaryTable.innerHTML = template;
}

export {
    refreshListeners
}