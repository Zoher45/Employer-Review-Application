"use-scrict"

const firstName = document.getElementById("first-name");
const lastName = document.getElementById("last-name");
const email = document.getElementById("user-email");
const password = document.getElementById("user-password");
const matchPassword = document.getElementById("match-password");

const errorMessage = document.getElementById("error-message");

const NAMEREGEX = /^[a-zA-Z ]*$/;

const validateFirstName = () => {
    if (firstName.value.length === 0 || firstName.value.length > 20) {
        errorMessage.innerText = "First name must be between 1 and 20 characters";
        errorMessage.style.display = "flex";
        return false;
    }

    if (!firstName.value.match(NAMEREGEX)) {
        errorMessage.innerText = "First name can only alphabetical characters";
        errorMessage.style.display = "flex";
        return false;
    }
    errorMessage.innerText = "";
    errorMessage.style.display = "none";
    return true;
}

const validateLastName = () => {
    if (lastName.value.length === 0 || lastName.value.length > 20) {
        errorMessage.innerText = "Last name must be between 1 and 20 characters";
        errorMessage.style.display = "flex";
        return false;
    }

    if (!lastName.value.match(NAMEREGEX)) {
        errorMessage.innerText = "Last name can only alphabetical characters";
        errorMessage.style.display = "flex";
        return false;
    }
    errorMessage.innerText = "";
    errorMessage.style.display = "none";
    return true;
}

const validateEmail = () => {
    if (!(email.value.length > 0 && email.value.split("@").length > 1)) {
        errorMessage.innerText = "Please enter a valid email";
        errorMessage.style.display = "flex";
        return false;
    }

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "validations/email_in_use.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText.length > 0) {
                errorMessage.innerText = this.responseText;
                errorMessage.style.display = "flex";
                return false;
            }
        }
    }
    xhttp.send('email=' + email.value);

    errorMessage.innerText = "";
    errorMessage.style.display = "none";
    return true;
}

const validatePassword = () => {
    if (password.value.length < 6 || password.value.length > 15) {
        errorMessage.innerText = "A password must be between 6 and 15 characters";
        errorMessage.style.display = "flex";
        return false;
    }
    errorMessage.innerText = "";
    errorMessage.style.display = "none";
    return true;
}

const validateMatchPassword = () => {
    if (!matchPassword.value.match(password.value)) {
        errorMessage.innerText = "Password does not match";
        errorMessage.style.display = "flex";
        return false;
    }
    errorMessage.innerText = "";
    errorMessage.style.display = "none";
    return true;
}

const validateForm = () => {

    if (
        validateFirstName() && validateLoginForm() &&
        validateEmail() && validatePassword() && validateMatchPassword()
    ) {
        errorMessage.innerText = "Please fill all the fields";
        errorMessage.style.display = "flex";
        return false;
    }



    errorMessage.innerText = "";
    errorMessage.style.display = "none";
    return true;
}