"use-strict"

const ALPHAREGEX = /^[a-zA-Z '.-]*$/;
const currentYear = new Date().getFullYear();
const EMPSTATUSREGEX = /^(PART_TIME|REGULAR|CONTRACT|FREELANCE|INTERN)$/;

const overallRating = document.getElementById("overallRating");
const employer = document.getElementById("search");
const jobTitle = document.getElementById("jobTitle");
const employmentStatus = document.getElementById("employmentStatus");
const currentJob = document.getElementById("currentJob");
const jobEndingYear = document.getElementById("jobEndingYear");
const yearsEmployed = document.getElementById("yearsEmployed");
const submitButton = document.getElementById("submit");

const validateReviewForm = () => {
    if (validateEmployerName() &&
        validateOverallRating() &&
        validateJobTitle() &&
        validateEmploymentStatus() &&
        validateCurrentJob() &&
        validateJobEndingYear() &&
        validateYearsEmployed()
    ) {
        console.log("I'm IN");
        // submitButton.removeAttribute("disabled");
        return true;
    }
    console.log("I'm NOT IN");
    // submitButton.setAttribute("disabled", "true");
    window.scrollTo(0, 0);
    return false;
}

const validateEmployerName = () => {
    if (employer.value.length == 0) {
        employer.style.borderColor = "red";
        return false;
    }
    employer.style.borderColor = "#dbdadd";
    return true;
}

const validateOverallRating = () => {
    if (overallRating.value == -1){
        document.getElementById("overallRatingLabel").style.color="red";
        return false;
    }
    document.getElementById("overallRatingLabel").style.color="black";
    return true;
}

const validateJobTitle = () => {

    console.log(ALPHAREGEX);
    console.log(jobTitle.value);
    console.log(ALPHAREGEX.test(jobTitle.value));

    if (jobTitle.value == "" || jobTitle.value.length >255 || !ALPHAREGEX.exec(jobTitle.value)) {
        document.getElementById("jobTitleLabel").style.color="red";
        return false;
    }
    document.getElementById("jobTitleLabel").style.color="black";
    return true;
}

const validateEmploymentStatus = () => {
    if (employmentStatus.value == -1 || !EMPSTATUSREGEX.test(employmentStatus.value)){
        document.getElementById("employmentStatusLabel").style.color="red";
        return false;
    }
    document.getElementById("employmentStatusLabel").style.color="black";
    return true;
}
const validateCurrentJob = () => {
    if (currentJob.value == -1) {
        document.getElementById("currentJobLabel").style.color="red";
        return false;
    }

    if (currentJob.value == 1) {
        document.getElementById("jobEndingYear").setAttribute("disabled", "true");
    } else {
        document.getElementById("jobEndingYear").removeAttribute("disabled");
    }

    document.getElementById("currentJobLabel").style.color="black";
    return true;
}
const validateJobEndingYear = () => {
    if (currentJob.value == 0 && jobEndingYear.value < 0 || jobEndingYear.value > currentYear) {
        document.getElementById("jobEndingYearLabel").style.color="red";
        return false;
    }
    document.getElementById("jobEndingYearLabel").style.color="black";
    return true;

}
const validateYearsEmployed = () => {
    if (!(yearsEmployed.value >= 0 && yearsEmployed.value < 100)) {
        document.getElementById("yearsEmployedLabel").style.color="red";
        return false;
    }
    document.getElementById("yearsEmployedLabel").style.color="black";
    return true;
}

