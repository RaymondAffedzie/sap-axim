<?php
    session_start();
    require_once('connection.php');
    /**
     * until session is stated with email
     * do not open verification code;
     */

    if (!isset($_SESSION['email'])) {
        isset($_SESSION['email']);
        isset($_SESSION['code']);
        header("Location: forgot-password.php");
    }
