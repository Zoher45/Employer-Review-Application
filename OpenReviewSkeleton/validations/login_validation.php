<?php

if (isset($_POST["user-email"], $_POST["password"])) {
    attemptLogin(htmlentities($_POST['user-email']), htmlentities($_POST['password']));
} else {
    $error = "Please fill all the required fields";
    header("Location:../login.php?message=$error");
}

/**
 * Create connection to the database
 *
 * @return PDO object which is the connection to the database
 */
function openConnection(): PDO
{
    try {
        $pdo = new PDO("sqlite:open_review_s_sqlite.db");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
    return $pdo;
}

function attemptLogin($email, $password): bool {
    try {
        $pdo = openConnection();
        $data = $pdo->query("SELECT * FROM user WHERE user.email LIKE '$email'");
        $user = $data->fetch();
        $pdo = null;
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['loggedIn'] = $user[true];
            $_SESSION['firstName'] = $user['first_name'];
            $_SESSION['userId'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['image'] = $user['image'];
            $_SESSION['start'] = time();
            $_SESSION['expire'] = $_SESSION['start'] + (60 * 60);
            header("Location:../index.php");
        } else {
            $error = "Please enter the correct email and password";
            header("Location:../login.php?message=$error");
        }

        return true;
    } catch (PDOException $e) {
        die($e->getMessage());
        $error = "Server Error - Try again later";
        header("Location:../login.php?message=$error");
    }
    return false;
}