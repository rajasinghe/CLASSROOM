
function refreshListeners(){
    // Add all event listeners and data initializers here
}

async function getContent(route){

    let content = await fetch(`${APIURL}/includes`,{
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify({component:route.template})
    })
    .then( response => response.text())

    document.getElementById('control-section').innerHTML = content;
    changeNavDirectionLink(`${APIURL}/admin/course`,'Courses',2);
    refreshListeners();
}

export {
    getContent,
    refreshListeners
}