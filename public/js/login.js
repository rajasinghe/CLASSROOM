const userNameField = document.querySelector('#usernameField');
const userNameFieldError = document.querySelector('#usernameFieldError');
const passwordField = document.querySelector('#passwordField');
const passwordFieldError = document.querySelector('#passwordFieldError');
const submitButton = document.querySelector('#submitBtn');

userNameField.addEventListener('focusout', event => {
    validateUserName();
});

passwordField.addEventListener('focusout', event => {
    validatePassword();
});

submitButton.addEventListener('click', event => {
    if(!validateForm()) return;

    let data = {
        username: userNameField.value,
        password: passwordField.value
    }

    fetch('http://localhost:3000/login', {
        method:'POST',
        headers:{
            'Content-Type':'application/json'
        },
        body: JSON.stringify(data)
    })
    .then( response => {
        return response.json();
    })
    .then( data => {
        if(data['condition'] === 'failed'){
            // Handle failed condition status
            if(data['error_type'] === 'USERNAME'){
                userNameFieldError.innerHTML = data['message'];
            }
            else if(data['error_type'] === 'PASSWORD'){
                passwordFieldError.innerHTML = data['message'];
            }

            // Show failure toast
            showErrorToast('Login failed',data['message']);
            return;
        }

        // Show success toast
        showSuccessToast('Login successful',data['message']);
        window.open('http://localhost:3000' + data['redirect_to'], '_self');
    })
});

function validateUserName(){
    let userName = userNameField.value;

    if(userName === null || userName === ''){
        userNameFieldError.innerHTML = 'Username Cannot be Empty';
        return false;
    }

    if(!userName.match(/^[a-zA-Z.]+$/)){
        userNameFieldError.innerHTML = 'Please Enter a Valid username';
        return false;
    }

    userNameFieldError.innerHTML = '';
    return true;
}

function validatePassword(){
    let password = passwordField.value;

    if(password === null || password === ''){
        passwordFieldError.innerHTML = 'Password Cannot be Empty';
        return false;
    }

    if(!password.match(/^[a-zA-Z$@\d]{8}$/)){
        passwordFieldError.innerHTML = 'Please Enter a Valid password';
        return false;
    }

    passwordFieldError.innerHTML = '';
    return true;
}

function validateForm(){
    let validity = true && validateUserName();
    validity = validatePassword() && validity;

    return validity;
}