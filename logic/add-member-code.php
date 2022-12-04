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
        $firstname  = sanitizeUserInput(ucfirst($_POST['firstname']));
        $surname    = sanitizeUserInput(ucfirst($_POST['surname']));
        $othername  = sanitizeUserInput(ucfirst($_POST['othername']));
        $sex        = sanitizeUserInput($_POST['sex']);
        $birthdate  = sanitizeUserInput($_POST['birthdate']);
        $birthplace = sanitizeUserInput(ucfirst($_POST['birthplace']));
        $region     = sanitizeUserInput(ucfirst($_POST['region']));
        $district   = sanitizeUserInput(ucfirst($_POST['district']));
        $year       = date('Y'); // get the today's date year eg. 2023
        $init       = "SAP";
        
        $query = "INSERT INTO `members`(`Init`, `Reg_year`, `Firstname`, `Sur_name`, `Other_name`, `Sex`, `Birth_Date`, `Birth_Place`, `Birth_Region`, `Birth_District`) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt_insert = $connection->prepare($query);
        $stmt_insert->bind_param("sissssssss", $init, $year, $firstname, $surname, $othername, $sex, $birthdate, $birthplace, $region, $district);
        $stmt_insert->execute();

        if ($stmt_insert->affected_rows > 0) {
            $_SESSION['success'] =  "Member registered successfully";
            header('Location: ../add-member.php');
        } else {
            $_SESSION['success'] =  "Member registration failed";
            header('Location: ../add-member.php');
        }
        $stmt_insert->close();
    }
}