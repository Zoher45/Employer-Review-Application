"use-scrict"

const errorMessage = document.getElementById("error-message");
const userEmail = document.getElementById("user-email");
const password = document.getElementById("password");


const validateLoginForm = () => {
    if (!(userEmail.value.length > 0 && userEmail.value.split("@").length > 1)) {
        errorMessage.innerText = "Please enter your email address";
        errorMessage.style.display = 'flex';
        return false;
    }

    if (password.value.length === 0) {
        errorMessage.innerText = "Please enter your password";
        errorMessage.style.display = 'flex';
        return  false;
    }

    errorMessage.innerText = "";
    errorMessage.style.display = 'none';
    return true;
}