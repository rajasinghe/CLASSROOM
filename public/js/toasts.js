// All the notification and toast functions goes in this file
const successToast = bootstrap.Toast.getOrCreateInstance(document.querySelector('#success-toast'));
const failureToat = bootstrap.Toast.getOrCreateInstance(document.querySelector('#failure-toast'));

function showSuccessToast(heading,message){
    document.querySelector('#success-toast .toast-content .heading').innerHTML = heading;
    document.querySelector('#success-toast .toast-content .body').innerHTML = message;
    successToast.show();
}

function showErrorToast(heading,message){
    document.querySelector('#failure-toast .toast-content .heading').innerHTML = heading;
    document.querySelector('#failure-toast .toast-content .body').innerHTML = message;
    failureToat.show();
}