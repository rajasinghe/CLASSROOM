let batchContainer = null;
let filterMenu = null;

function refreshListeners(){
    batchContainer = document.querySelector('#batch-container');

    fetchStudentData();

    document.querySelector(".jsFilter").addEventListener("mouseenter", function () {
        document.querySelector(".filter-menu").classList.add("active");
    });

    document.querySelector(".jsFilter").addEventListener("mouseleave", function () {
        document.querySelector(".filter-menu").classList.remove("active");
    });
}

function fetchStudentData(){
    fetch('http://localhost:3000/student', {
        method:'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            type:'VIEW/STUDENT',
            context:'REGISTEREDSTUDENTS/CURRENT'
        })
    })
    .then( response => {
        return response.json();
    })
    .then( data => {
        showRegisteredStudents(data);
    })
    .catch( error => {
        console.error(error);
    })
}

function showRegisteredStudents(data){
    let template = 
    `<div class="site-scroll" style="height: 65vh;">
        <table class="table table-hover text-nowrap">
        <thead class="table-dark sticky-top z-1">
            <tr>
                <th></th><th></th>
                <th>Name</th>
                <th>MIS <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                    <path fill="currentColor"
                        d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                    </svg></th>
                <th>NIC</th>
                <th>ADDRESS</th>
                <th>TELEPHONE</th>
                <th>GENDER</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>`

    for (const student of data) {
        let status = student['student_status'];

        let statusStyles = 'disabled';
        if(status === 'active') statusStyles = 'active';
        else if(status === 'inactive') statusStyles = 'inactive';

        template += 
        `<tr>
            <td>
                <a href="/batch/student/${student['id']}" class="">
                <i class="bi bi-info-circle-fill"></i>
                </a>
            </td>
            <td>
                <a href="/student/add?batch=${student['batch_id']}&interviewId=${student['student_id']}" class="">
                <i class="bi bi-pencil-fill "></i>
                </a>
            </td>
            <td>${student['initials']} ${student['first_name']} ${student['last_name']}</td>
            <td>${student['mis']}</td>
            <td>${student['nic']}</td>
            <td>${student['address']}</td>
            <td>${student['mobile_no']}</td>
            <td>${student['gender']}</td>
            <td><span class="status ${statusStyles}">${status}</span></td>
        </tr>`;
    }
            
    template +=
            `</tbody>
        </table>
    </div>`;

    batchContainer.innerHTML = template;
}

function getBatchesInYear(year){

}

export {
    refreshListeners
}