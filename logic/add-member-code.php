<?php
include_once('../config/security.php');

function sanitizeUserInput($data)
{
    $data = trim($data, " ");
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['add'])) {
    if (empty($_POST['firstname'])) {
        $_SESSION['warning'] = "Firstname is required";
        header('Location: ../add-member.php');
    } elseif (empty($_POST['surname'])) {
        $_SESSION['warning'] = "Surname is required";
        header('Location: ../add-member.php');
    } elseif (empty($_POST['othername'])) {
        $_SESSION['warning'] = "Othername is required";
        header('Location: ../add-member.php');
    } elseif (empty($_POST['sex'])) {
        $_SESSION['warning'] = "sex is required";
        header('Location: ../add-member.php');
    } elseif (empty($_POST['birthdate'])) {
        $_SESSION['warning'] = "Date of birth is required";
        header('Location: ../add-member.php');
    } elseif (empty($_POST['birthplace'])) {
        $_SESSION['warning'] = "Place of birth is required";
        header('Location: ../add-member.php');
    } else {

        $firstname          = sanitizeUserInput(ucfirst($_POST['firstname']));
        $surname            = sanitizeUserInput(ucfirst($_POST['surname']));
        $othername            = sanitizeUserInput(ucfirst($_POST['othername']));
        $sex  = sanitizeUserInput($_POST['sex']);
        $birthdate      = sanitizeUserInput($_POST['birthdate']);
        $birthplace = sanitizeUserInput($_POST['birthplace']);
        $region = sanitizeUserInput($_POST['region']);
        $district = sanitizeUserInput($_POST['district']);

        echo 'SAP'. date('Y') . rand(99, 1000);
    }
}