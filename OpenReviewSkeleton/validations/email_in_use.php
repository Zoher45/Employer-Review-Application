<?php

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

if (sizeof($_POST) > 0) {
    $email = ($_POST['email']);
    $pdo = openConnection();
    $data = $pdo->query("SELECT email FROM user WHERE user.email LIKE '$email'")->fetch();

    if ($data) {
        echo "This email is already in use";
    } else {
        echo "";
    }
}
