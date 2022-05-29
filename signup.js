function checkName(event) {
    const input = event.currentTarget;
    
    /* if(formStatus[input.name] = /^[a-zA-Z]+$/.test(input.value)) { */
    if (formStatus[input.name] = input.value.length > 0) {
        input.parentNode.parentNode.classList.remove('errore');
    } else {
        input.parentNode.parentNode.classList.add('errore');
    }
    
    checkForm();
}

function OnJsonEmail(json) {
        
        console.log(json);
    if (formStatus.email = !json.exists) {
        document.querySelector('.email').classList.remove('errore');
    } else {
        
        document.querySelector('.email').classList.add('errore');
    }
    checkForm();
}

function OnResponse(response) {
    if (!response.ok) return null;
    console.log(response);
    return response.json();
}

function checkEmail(event) {
    const emailIn = document.querySelector('.email input');
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(emailIn.value).toLowerCase())) {
        //document.querySelector('.email span').textContent = "Email non valida";
        document.querySelector('.email').classList.add('errore');
        formStatus.email = false;
        checkForm();
    } else {
        fetch("email.php?q="+encodeURIComponent(String(emailIn.value).toLowerCase())).then(OnResponse).then(OnJsonEmail);
    }
}

function checkPassword(event) {
    const pass = document.querySelector('.password input');
    if (formStatus.password = pass.value.length >= 7) {
        document.querySelector('.password').classList.remove('errore');
    } else {
        document.querySelector('.password').classList.add('errore');
    }
    checkForm();
}

function checkConfirmPassword(event) {
    const confirm = document.querySelector('.confirm_password input');
    if (formStatus.confirmPassord = confirm.value === document.querySelector('.password input').value) {
        document.querySelector('.confirm_password').classList.remove('errore');
    } else {
        document.querySelector('.confirm_password').classList.add('errore');
    }
    checkForm();
}

function checkForm() {
    document.getElementById('submit').disabled = !document.querySelector(".allow input").checked ||
    Object.keys(formStatus).length !== 6 ||
    Object.values(formStatus).includes(false);
}

const formStatus = {'upload': true};
document.querySelector('.name input').addEventListener('blur', checkName);
document.querySelector('.lastname input').addEventListener('blur', checkName);
document.querySelector('.email input').addEventListener('blur', checkEmail);
document.querySelector('.password input').addEventListener('blur', checkPassword);
document.querySelector('.confirm_password input').addEventListener('blur', checkConfirmPassword);
document.querySelector('.allow input').addEventListener('change', checkForm);

if (document.querySelector('.errore') !== null) {
    checkPassword(); checkConfirmPassword(); checkEmail();
    document.querySelector('.name input').dispatchEvent(new Event('blur'));
    document.querySelector('.lastname input').dispatchEvent(new Event('blur'));
}