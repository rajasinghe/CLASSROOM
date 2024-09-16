// Data variables
let studentBatchData = null;

// Element variables
let batchTable, batchTableBody = null;

function getContent(route) {

    fetch(`${APIURL}${route.link}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ component: route.template })
    })
    .then(response => {
        //console.log(response);
        if (!response.ok) {
            return '<h4>Server error</h4>';
        }
        return response.text();
    })
    .then( html => {

        window.profileContainer.innerHTML = compileTemplate(html,null);
        refreshListeners();
    })
}

function refreshListeners(){
    batchTable = document.getElementById('student-batch-table');
    batchTableBody = batchTable.querySelector('tbody');

    setContent();
}

async function setContent(){

    studentBatchData = await getStudentBatchData()
    .then( data => {
        if(data['condition'] == 'failed') return []; 
        return data['data'];
    })
    .catch( error => { console.error(error); })

    let template = '';
    for(const data of studentBatchData){

        template += 
        `<tr>
            <td>${data['year']}</td>
            <td>${data['batch_name']}</td>
            <td>${data['course_name']}</td>
        </tr>`;
    }

    batchTableBody.innerHTML = template;
}

function getStudentBatchData(){

    return new Promise(
        (resolve,reject) => {
            fetch(`${APIURL}/student`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    type: 'VIEW/STUDENT',
                    context: 'STUDENT/COURSE',
                    student_id: window.routeParameters[1]
                })
            })
            .then(response => {
                resolve(response.json());
            })
            .catch( error =>{
                reject(error);
            })
        }
    );
}

export {
    getContent
}