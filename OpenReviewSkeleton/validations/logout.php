<?php
session_start();

unset($_SESSION['loggedIn']);
unset($_SESSION['firstName']);
unset($_SESSION['expire']);
session_destroy();
header("location:../index.php");