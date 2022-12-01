<?php
session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['users_id']);
    unset($_SESSION['fname']);
    unset($_SESSION['sname']);
    unset($_SESSION['fullname']);
    unset($_SESSION['phonenumber']);
    unset($_SESSION['username']);
    unset($_SESSION['pass']);
    unset($_SESSION['users_email']);
    header('Location: ../login.php');
}

?>