function batchNumber() {
    let bNum = document.getElementById('number').value;
    let numberregex = /^[0-4]{1}$/;

    // Empty Validation
    if (bNum == "") {
        document.getElementById('lyear').innerHTML = "This Field is Null";
        lyear.style.color = "red";
        document.form.number.focus();
        return false;
    } else {
        document.getElementById('lyear').innerHTML = "";
    }

    // Regex Validation
    if (!bNum.match(numberregex)) {
        document.getElementById('lyear').innerHTML = "Not Match Regex Ex:- 1 to 4";
        lyear.style.color = "red";
        document.form.number.focus();
        return false;
    }
}

function startdate() {

    let startdate = document.form.Sdate;
    let LStartdate = document.getElementById("lStarDate");
    LStartdate.innerText = "";



    if (startdate.value == "") {
        LStartdate.innerText = "Select the Start Date";
        LStartdate.style.color = "red";

        return false;
    }

    LSubOne.innerText = "";
    LSubOne.style.color = "green";
    return true;
}

function enddate() {

    let enddate = document.form.Edate;
    let Lenddate = document.getElementById("lEndDate");
    Lenddate.innerText = "";



    if (enddate.value == "") {
        Lenddate.innerText = "Select the End Date";
        Lenddate.style.color = "red";

        return false;
    }

    Lenddate.innerText = "";
    return true;
}


/* function batchYear() {

    let year = document.form.year;
    let Lyear = document.getElementById("lYear");
    Lyear.innerText = "";



     // Empty Validation
    if (bNum == "") {
        document.getElementById('lyear').innerHTML = "This Field is Null";
        lyear.style.color = "red";
        document.form.number.focus();
        return false;
    } else {
        document.getElementById('lyear').innerHTML = "";
    }
}
 */



