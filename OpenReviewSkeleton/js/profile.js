"use-strict"

const reloadUserImage = () => {
    setTimeout(()=> {
        const defaultImage = "https://humanimals.co.nz/wp-content/uploads/2019/11/blank-profile-picture-973460_640.png";
        const image = document.getElementById("user-profile-image")
        console.log(image.onerror);
        image.onerror = null;
        image.src = defaultImage;
    }, 200);
}


const editUpdateFields = () => {
    const first_name = document.getElementById('first-name');
    const last_name = document.getElementById('last-name');
    const edit_button = document.getElementById('edit-button');
    first_name.removeAttribute('disabled');
    last_name.removeAttribute('disabled');
    edit_button.setAttribute('disabled', 'true');
}
