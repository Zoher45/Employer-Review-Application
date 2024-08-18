<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="icon" href="img/search-heart.svg"/>
    <link rel="stylesheet" href="css/register_user.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="page-container" style="min-height: 100vh">
<!--Navigation bar-->
<?php include "fragments/navbar.php" ?><br>
    <div id="content-wrap">
<!--Registration Form -->
<div class="registration-body">
    <div class="registration-card">
        <div style="width: 100%; display: flex; justify-content: center;">
            <div class="card-block-login">
                <div>
                    <h1>Welcome to RATER</h1>
                    <p>Where you can rate any employer and leave reviews</p>
                    <h1>Registration Form</h1>
                </div>
                <form style="text-align-last: left; margin-bottom: 50px;"
                      onsubmit="return validateForm()" action="validations/registration.php" method="post">
                    <table class="registration-table">
                        <tr>
                            <td>
                                <h5 id="error-message" class="form-error" style="display: <?php
                                if (!empty($_GET['message'])) {
                                    echo 'flex';
                                } else {
                                    echo 'none';
                                }
                                ?>">
                                    <?php
                                    if (!empty($_GET['message'])) {
                                        $error = $_GET['message'];
                                        echo $error;
                                    }
                                    ?>
                                </h5>
                            </td>
                        </tr>
                        <tr class="registration-row">
                            <td style="margin: 20px; width: 50vh">
                                <input id="first-name" class="form-control form-control-lg" type="text" maxlength="20"
                                       minlength="1" placeholder="First Name*" name="firstName" required
                                       onchange="validateFirstName()">
                            </td>
                        </tr>
                        <tr class="registration-row">
                            <td style="margin: 20px; width: 50vh">
                                <input id="last-name" class="form-control form-control-lg" type="text" maxlength="20"
                                       minlength="1" placeholder="Last Name*" name="lastName" required
                                       onchange="validateLastName()">
                            </td>
                        </tr>
                        <tr class="registration-row">
                            <td style="margin: 20px; width: 50vh">
                                <input id="user-email" class="form-control form-control-lg" type="email" maxlength="50"
                                       minlength="1" placeholder="Enter Email*" name="email" required
                                       onchange="validateEmail()">
                            </td>
                        </tr>
                        <tr class="registration-row">
                            <td style="margin: 20px; width: 50vh">
                                <input id="user-password" class="form-control form-control-lg" type="password" maxlength="50"
                                       minlength="1" placeholder="Enter Password*" name="password" required
                                       onchange="validatePassword()">
                            </td>
                        </tr>
                        <tr class="registration-row">
                            <td style="margin: 20px; width: 50vh">
                                <input id="match-password" class="form-control form-control-lg" type="password"  maxlength="50"
                                       minlength="1" placeholder="Re-enter Password*" name="matchPassword" required
                                       onchange="validateMatchPassword()">
                            </td>
                        </tr>
                    </table>
                    <div style="display: flex; justify-content: center;width: 100%; padding: 12px 0 0 0;">
                        <button id="registration-button" type="submit" class="btn btn-primary" style="width: 50vh; text-align-last: center"
                        >REGISTER
                        </button>
                    </div>
                </form>
                <div class="bottom-link">
                    <div style="float: left;">
                        <span>If you have an account, to login&nbsp;</span>
                    </div>
                    <div style="float: left;">
                        <a class="click-here-link" href="login.php"> click here </a>
                    </div>
                </div>
            </div>
        </div>
    </div><br><br><br><br>
</div>
<?php include "fragments/footer.php" ?>
    </div>
</div>
</body>
<script src="js/register_user.js"></script>

</html>