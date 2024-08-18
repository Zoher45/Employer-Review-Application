<?php
if (isset($_POST['firstName'], $_POST["lastName"], $_POST["email"],
    $_POST["password"], $_POST["matchPassword"])) {
    registerUser(htmlentities($_POST['firstName']), htmlentities($_POST['lastName']),
        htmlentities($_POST['email']), htmlentities($_POST['password']),
        htmlentities($_POST['matchPassword']));
} else {
    $error = "Please fill all the required fields";
    header("Location: ../register_user.php?message=$error");
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

function registerUser($firstName, $lastName, $email, $password, $re_password)
{
    try {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $pdo = openConnection();
        $data = $pdo->query("SELECT * from user WHERE user.email LIKE '$email'");

        if ($data->fetch()) {
            $error = "This email is already in use";
            header("Location: ../register_user.php?message=$error");
        }

        $pdo->query(sprintf("INSERT INTO user (FIRST_NAME, LAST_NAME, EMAIL, PASSWORD, IMAGE)
                                VALUES ('%s', '%s', '%s', '%s', '%s')", $firstName, $lastName, $email, $hashPassword, ""));

        $user = $pdo->query("SELECT * FROM user WHERE user.email LIKE '$email'")->fetch();

        session_start();
        $_SESSION['loggedIn'] = true;
        $_SESSION['firstName'] = $firstName;
        $_SESSION['userId'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['image'] = $user['image'];
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (60 * 60);
        header("Location: ../index.php");
    } catch (PDOException $e) {
        $error = "SERVER ERROR";
        if ($e->getCode() == 23000) {
            $error = "This email is already in use";
        }
        header("Location: ../register_user.php?message=$error");
    }
}