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
        $sex        = sanitizeUserInput(ucfirst($_POST['sex']));
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

// update member profile
if (isset($_POST['updateprofile'])) {
    if (empty($_POST['firstname'])) {
        $_SESSION['warning'] = "Firstname is required";
        header('Location: ../member-profile.php');
    } elseif (empty($_POST['surname'])) {
        $_SESSION['warning'] = "Surname is required";
        header('Location: ../member-profile.php');
    } elseif (empty($_POST['sex'])) {
        $_SESSION['warning'] = "sex is required";
        header('Location: ../member-profile.php');
    } elseif (empty($_POST['birthdate'])) {
        $_SESSION['warning'] = "Date of birth is required";
        header('Location: ../member-profile.php');
    } elseif (empty($_POST['birthplace'])) {
        $_SESSION['warning'] = "Place of birth is required";
        header('Location: ../member-profile.php');
    } else {
        $id         = $_POST['member_id'];
        $firstname  = sanitizeUserInput(ucfirst($_POST['firstname']));
        $surname    = sanitizeUserInput(ucfirst($_POST['surname']));
        $othername  = sanitizeUserInput(ucfirst($_POST['othername']));
        $sex        = sanitizeUserInput(ucfirst($_POST['sex']));
        $birthdate  = sanitizeUserInput($_POST['birthdate']);
        $birthplace = sanitizeUserInput(ucfirst($_POST['birthplace']));
        $region     = sanitizeUserInput(ucfirst($_POST['region']));
        $district   = sanitizeUserInput(ucfirst($_POST['district']));
        
        $query = "UPDATE `members` SET `Firstname` =  ?, `Sur_name` = ?, `Other_name` = ?, `Sex` = ?, `Birth_Date` = ?, `Birth_Place` = ?, `Birth_Region` = ?, `Birth_District` = ? WHERE CONCAT(Init,`Reg_year`,`Id`) = ?";
        $stmt_update = $connection->prepare($query);
        $stmt_update->bind_param("sssssssss",$firstname, $surname, $othername, $sex, $birthdate, $birthplace, $region, $district, $id);
        $stmt_update->execute();
        
        if ($stmt_update->affected_rows > 0) {
            $_SESSION['success'] =  "Member's profile updated successfully";
            header('Location: ../view-members.php');
        } else {
            $_SESSION['success'] =  "Member's profile update failed";
            header('Location: ../view-members.php');
        }
        $stmt_update->close();
    }
}


// delete member code
if (isset($_POST['delete_member'])) {
    $id = $_POST['member_id'];

    $query = "SELECT * FROM `members` WHERE CONCAT(`Reg_year`,`Id`) = '$id'";
    $query_run = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($query_run);

    if (mysqli_num_rows($query_run) == 1) {
        $query = "DELETE FROM `members` WHERE CONCAT(`Reg_year`,`Id`) = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $_SESSION['success'] = "Member deleted successfully";
        header("Location: ../view-members.php");
    } else {
        $_SESSION['neutral'] = "Member does not exist";
        header("Location: ../view-members.php");
    }
}




/**
 * query for selecting specific member details
 * SELECT `Firstname`, `Sur_name`, `Other_name`, `Sex`, `Birth_Date`, `Birth_Place`, `Birth_Region`, `Birth_District` FROM members WHERE CONCAT(`Init`,`Reg_year`,`Id`) LIKE "SAP%";
 * query for selecting all member details
 * SELECT * FROM `members` WHERE CONCAT(`Init`,`Reg_year`,`Id`) = "SAP20221";
 * query for updating member details
 * UPDATE `members` SET `Firstname`='Raymond' WHERE CONCAT(`Init`,`Reg_year`,`Id`) = "SAP20221";
 */