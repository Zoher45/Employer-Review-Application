<!DOCTYPE html>
<html lang="en">
<head>
    <title>Review Employer</title>
    <meta charset="UTF-8">
    <meta name="title" content="Review Employer">
    <meta name="description"
          content="A user can use this site to review or rank a company and provide a feedback">
    <meta name="keywords" content="company review, company rating, company ranking, company feedback">

    <link rel="icon" href="img/search-heart.svg" />
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
    <!--Navigation bar-->
    <?php include "fragments/navbar.php" ?><br>

    <div class="container">
        <h1 class="text-center">Review Employer</h1>
        <form onsubmit="return validateReviewForm()" action="employer_review_form_submission.php" method="POST">
            <br>
            <h5 id="error-message" style="display: <?php
            if (!empty($_GET['message'])) {
                echo 'block';
            } else {
                echo 'none';
            }
            ?>; text-align: center; color: red;">
                <?php
                if (!empty($_GET['message'])) {
                    $error = $_GET['message'];
                    echo $error;
                }
                ?>
            </h5>
            <h4>Employment Details:</h4>
            <div class="row">
                <div class="col-md-8">
                    <label for="employer">Employer *</label>
                    <input type="text" id="search" name="query" class="form-control" placeholder="e.g. Google"
                           autocomplete="off" onkeyup="validateEmployerName()">
                    <div class="list-group" id="show-list"
                         style="position: absolute; background: white; padding: 10px;
                         border: 1px solid black; width: 30%; display: none"></div>
                </div>
                <div class="col-md-4">
                    <label for="overallRating" id="overallRatingLabel">Overall Rating *</label>
                    <select class="form-control" id="overallRating" name="overallRating" onchange="validateOverallRating()">
                        <option value="-1">Select...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-8">
                    <label for="jobTitle" id="jobTitleLabel">Job Title *</label>
                    <input type="text" class="form-control" name="jobTitle" id="jobTitle" placeholder="e.g. Software Engineer"
                           minlength="3" maxlength="255" onchange="validateJobTitle()">
                </div>
                <div class="col-md-4">
                    <label for="employmentStatus" id="employmentStatusLabel">Employment Status *</label>
                    <select class="form-control" id="employmentStatus" name="employmentStatus" onchange="validateEmploymentStatus()">
                        <option value = "-1">Select...</option>
                        <option value="REGULAR">Regular</option>
                        <option value="PART_TIME">Part Time</option>
                        <option value="CONTRACT">Contract</option>
                        <option value="FREELANCE">Freelance</option>
                        <option value="INTERN">Intern</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <label for="currentJob" id="currentJobLabel">Is this your current job? *</label>
                    <select class="form-control" id="currentJob" name="currentJob" onchange="validateCurrentJob()">
                        <option value = "-1">Select...</option>
                        <option value = "1">Yes</option>
                        <option value = "0">No</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="jobEndingYear" id="jobEndingYearLabel">Job Ending Year</label>
                    <input type="text" class="form-control" id="jobEndingYear" name="jobEndingYear" placeholder="e.g. 2019" onchange="validateJobEndingYear()">
                </div>
                <div class="col-md-4">
                    <label for="yearsEmployed" id="yearsEmployedLabel">Years Employed *</label>
                    <input type="text" class="form-control" id="yearsEmployed" name="yearsEmployed" placeholder="e.g. 4" onchange="validateYearsEmployed()">
                </div>
            </div>
            <br>
            <br>
            <h4>Review:</h4>
            <div class="row">
                <div class="col-md-6">
                    <label for="summary">Summary</label>
                    <textarea class="form-control" id="summary" name="summary" rows="3"
                              maxlength="65535"
                    ></textarea>
                </div>
                <div class="col-md-6">
                    <label for="advice">Advice</label>
                    <textarea class="form-control" id="advice" name="advice" rows="3"
                              maxlength="65535"
                    ></textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <label for="pros">Pros</label>
                    <textarea class="form-control" id="pros" name="pros" rows="3"
                              maxlength="65535"
                    ></textarea>
                </div>
                <div class="col-md-6">
                    <label for="cons">Cons</label>
                    <textarea class="form-control" id="cons" name="cons" rows="3"
                              maxlength="65535"
                    ></textarea>
                </div>
            </div>
            <br>
            <br>
            <h4>Quick Ratings:</h4>
            <div class="row">
                <div class="col-md-4">
                    <label for="businessOutlook">Business Outlook</label> <!--not required-->
                    <select class="form-control" id="businessOutlook" name="businessOutlook">
                        <option value="-1">Select...</option>
                        <option value="POSITIVE">Positive</option>
                        <option value="NEUTRAL">Neutral</option>
                        <option value="NEGATIVE">Negative</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="recommendToFriend">Would you recommend to a friend?</label> <!--not required-->
                    <select class="form-control" id="recommendToFriend" name="recommendToFriend">
                        <option value="null">Select...</option>
                        <option value="POSITIVE">Yes</option>
                        <option value="NEGATIVE">No</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="ceoRating">CEO Rating</label> <!--not required-->
                    <select class="form-control" id="ceoRating" name="ceoRating">
                        <option value="null">Select...</option>
                        <option value="APPROVE">Approve</option>
                        <option value="NO_OPINION">No opinion</option>
                        <option value="DISAPPROVE">Disapprove</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <label for="careerOpportunities">Rating of Career Opportunities</label> <!--not required-->
                    <select class="form-control" id="careerOpportunities" name="careerOpportunities">
                        <option value="0">Select...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="compensation">Rating of Compensation and Benefits</label> <!--not required-->
                    <select class="form-control" id="compensation" name="compensation">
                        <option value="0">Select...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="culture">Rating of Culture and Values</label> <!--not required-->
                    <select class="form-control" id="culture" name="culture">
                        <option value="0">Select...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <label for="diversity">Rating of Diversity and Inclusion</label> <!--not required-->
                    <select class="form-control" id="diversity" name="diversity">
                        <option value="0">Select...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="seniorLeadership">Rating of Senior Leadership</label> <!--not required-->
                    <select class="form-control" id="seniorLeadership" name="seniorLeadership">
                        <option value="0">Select...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="workLifeBalance">Rating of Work-Life Balance</label> <!--not required-->
                    <select class="form-control" id="workLifeBalance" name="workLifeBalance">
                        <option value="0">Select...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <div class="text-end">
                        <button id="submit" name="submit" type="submit" class="btn btn-primary">Submit Review</button>
                    </div>
                </div><br><br><br>
            </div>
            <br>
        </form>
    </div>

    <script src="js/review.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

        $(document).ready(function () {
            // Send Search Text to the server
            $("#search").keyup(function () {
                let searchText = $(this).val();
                if (searchText != "") {
                    $.ajax({
                        url: "search.php",
                        method: "post",
                        data: {
                            query: searchText,
                        },
                        success: function (response) {
                            document.getElementById("show-list").style.display = "flex";
                            if (response.length > 0) {
                                document.getElementById("show-list").style.borderColor = "black";
                                $("#show-list").html(response);
                            } else {
                                document.getElementById("show-list").style.borderColor = "red";
                                $("#show-list").html("No company with given name");
                            }
                        },
                    });
                } else {
                    document.getElementById("show-list").style.display = "none";
                    $("#show-list").html("");
                }
            });

            $(document).on("click", ".selectitem", function () {
                $("#search").val($(this).text());
                $("#show-list").html(this);
                document.getElementById("show-list").style.display = "none";
            });
        });
    </script>


</body>
</html>

