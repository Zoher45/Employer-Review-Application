<!DOCTYPE html>
<html lang="en">
<!-- JavaScript Bundle with Popper -->
<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
</head>
<body>
<?php
session_start();
if (isset($_SESSION['loggedIn']) && $_SESSION['expire'] - time() <= 0) {
    session_destroy();
}
?>
    <!--Got some help from this-->
    <!--https://stackoverflow.com/questions/19733447/bootstrap-navbar-with-left-center-or-right-aligned-items-->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="navbar-brand p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search-heart" viewBox="0 0 16 16">
                            <path d="M6.5 4.482c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018Z"/>
                            <path d="M13 6.5a6.471 6.471 0 0 1-1.258 3.844c.04.03.078.062.115.098l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1.007 1.007 0 0 1-.1-.115h.002A6.5 6.5 0 1 1 13 6.5ZM6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11Z"/>
                        </svg>
                        Rater
                    </a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="index.php">
                        <button class="btn btn-sm btn-outline-light" type="button" >Home</button>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="navbar-brand" href="employer_rankings.php?offset=1">
                        <button class="btn btn-sm btn-outline-light" type="button">Employer Rankings</button>
                    </a>
                </li>
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
                        echo "<a class='navbar-brand' href='review_employer.php'>";
                    } else {
                        echo "<a class='navbar-brand' href='login.php?message=Please login to review an employer'>";
                    }
                    ?>
                    <button class="btn btn-sm btn-outline-light" type="button">Review Employer</button>
                    </a>
                </li>
            </ul>
        </div>
        <div style="float: left;">
            <ul class="navbar-nav mr-auto" style="float: right">
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
                        echo "<a class='navbar-brand' href='validations/logout.php'>
                                <button class='btn btn-sm btn-outline-light' type='button' >Logout</button>
                            </a>";
                    } else {
                        echo "<a class='navbar-brand' href='login.php'>
                                <button class='btn btn-sm btn-outline-light' type='button' >Login</button>
                            </a>";
                    }
                    ?>
                </li>
                <li class="nav-item">
                    <label style="color: wheat; text-align: left; padding: 5px 14px 0 0;">
                        <?php
                        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
                            $name = $_SESSION['firstName'];
                            echo $name;
                        } else {
                            echo "Guest";
                        }
                        ?>
                    </label>
                </li>
                <li>
                    <a href="<? if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) echo 'profile.php'; else echo 'login.php'; ?>">
                        <img src="img/users/<?php echo $_SESSION['image']?>"
                             width="50px" height="50px" style="border-radius: 15px; margin-right: 10px; cursor: pointer" id="user-profile-image"
                             onerror="reloadUserImage()"
                        />
                    </a>
                </li>
            </ul>
        </div>
    </nav>
<script src="js/profile.js"></script>
</body>
</html>