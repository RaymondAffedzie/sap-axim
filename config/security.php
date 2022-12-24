<?php
    session_start();
    require_once('connection.php');

    // until session is started with the username do not open the index page
    if (!(isset($_SESSION['users']['users_email']) && isset($_SESSION['users']['pswd']))) {
        isset($_SESSION['users']['users_email']);
        isset($_SESSION['users']['users_id']);
        isset($_SESSION['users']['fname']);
        isset($_SESSION['users']['sname']);
        isset($_SESSION['users']['fullname']);
        isset($_SESSION['users']['phonenumber']);
        isset($_SESSION['users']['username']);
        header('Location: login.php');
    }

?>