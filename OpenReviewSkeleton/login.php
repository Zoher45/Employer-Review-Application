<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="icon" href="img/search-heart.svg"/>
    <link rel="stylesheet" href="css/register_user.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!--Navigation bar-->
<div id="page-container" style="min-height: 100vh">
<?php include "fragments/navbar.php" ?><br>

<?php
if(isset($_SESSION['user_id'])){
    header('Location: index.php');
    exit;
}
?>

<!--Login Form -->
    <div id="content-wrap">
<div class="login-body">
    <div class="registration-card">
        <div style="width: 100%; justify-content: center; display: flex;">
            <div class="card-block-login">
                <div>
                    <h1>Welcome to RATER</h1>
                    <p>Where you can rate any employer and leave reviews</p>
                </div>
                <form style="text-align-last: left; height: 80%" onsubmit="return validateLoginForm()"
                      action="validations/login_validation.php" method="post">
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
                                <input id="user-email" class="form-control form-control-lg" type="email"
                                       placeholder="Enter email*" name="user-email" required>
                            </td>
                        </tr>
                        <tr class="registration-row">
                            <td style="margin: 20px; width: 50vh">
                                <input id="password" class="form-control form-control-lg" type="password"
                                       placeholder="Enter password*" name="password" required>
                            </td>
                        </tr>
                    </table>
                    <div style="float: right; width: 100%; padding: 12px 0 0 0;">
                        <button type="submit" class="btn btn-primary"
                                style="width: 50vh; text-align-last: center; cursor: pointer">
                            Login
                        </button>
                    </div>
                </form>
                <br/>
                <br/>
                <div class="bottom-link">
                    <div style="float: left;">
                        <span>If you do not have an account, to register&nbsp;</span>
                    </div>
                    <div style="float: left;">
                        <a class="click-here-link" href="register_user.php"> click here </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "fragments/footer.php" ?><br><br><br>
</div>
</div>
</body>
<script src="js/login_user.js"></script>
<script src="js/profile.js"></script>
</html>