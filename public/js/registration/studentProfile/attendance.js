// Data variables
let studentAttendanceData = null;

// Element variables
let annualChart, annualChartBody = null;

async function getContent(route) {

    await fetch(`${APIURL}${route.link}`, {
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
    annualChart = document.getElementById('annual-chart');
    annualChartBody = annualChart.querySelector('tbody');

    setContent();
}

async function setContent(){

    studentAttendanceData = await getStudentAttendanceData()
    .then( data => {
        if(data['condition'] == 'failed') return {}; 
        return data['data'];
    })
    .catch( error => { console.error(error); })

    console.log(studentAttendanceData);
    let months = studentAttendanceData['dates'];
    let attendance = studentAttendanceData['students'][0]['attendance'];

    let template = '';
    let previousMark = 0.1;
    for(let i = 0; i < months.length; i++){

        //console.log(math[i]);
        let month = months[i]["month"];
        let conductedDays = months[i]["conducted_days"];
        conductedDays = (conductedDays == null || conductedDays == undefined)? 0 : conductedDays;
        let studentAttendance = attendance[month];
        studentAttendance = (studentAttendance == null || studentAttendance == undefined)? 0 : studentAttendance;
        let percentage = (studentAttendance == 0 || conductedDays == 0)? 0 : ((studentAttendance / conductedDays));
        percentage = (percentage < 0.1)? 0 : (percentage).toFixed(1);

        template += 
        `<tr>
            <th scope="row"> ${month} </th>
            <td style="--start: ${previousMark}; --end: ${percentage};"> <span class="data"> ${percentage * 100}% </span> </td>
        </tr>`;

        previousMark = percentage;
    }

    annualChartBody.innerHTML = template;
    console.log('working');
}

function getStudentAttendanceData(){

    return new Promise(
        (resolve,reject) => {
            fetch(`${APIURL}/reports`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    reportType: 'annual',
                    type: 'single',
                    batch_id: 2,
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