<?php
include_once('../config/security.php');

function sanitizeUserInput($data)
{
    $data = trim($data, " ");
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


// register new member
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
        $firstname  = sanitizeUserInput(ucwords($_POST['firstname']));
        $surname    = sanitizeUserInput(ucwords($_POST['surname']));
        $othername  = sanitizeUserInput(ucwords($_POST['othername']));
        $sex        = sanitizeUserInput(ucwords($_POST['sex']));
        $birthdate  = sanitizeUserInput($_POST['birthdate']);
        $birthplace = sanitizeUserInput(ucwords($_POST['birthplace']));
        $region     = sanitizeUserInput(ucwords($_POST['region']));
        $district   = sanitizeUserInput(ucwords($_POST['district']));
        $year       = date('Y'); // get the today's date year eg. 2023
        $init       = "SAP";
        
        $query = "INSERT INTO `members`(`Init`, `Reg_year`, `Firstname`, `Sur_name`, `Other_name`, `Sex`, `Birth_Date`, `Birth_Place`, `Birth_Region`, `Birth_District`) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt_insert = $connection->prepare($query);
        $stmt_insert->bind_param("sissssssss", $init, $year, $firstname, $surname, $othername, $sex, $birthdate, $birthplace, $region, $district);
        $stmt_insert->execute();

        if ($stmt_insert->affected_rows > 0) {
            $_SESSION['success'] =  "Member registered successfully";
            header('Location: ../add-other-info.php');
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
        header('Location: ../view-members.php');
    } elseif (empty($_POST['surname'])) {
        $_SESSION['warning'] = "Surname is required";
        header('Location: ../view-members.php');
    } elseif (empty($_POST['sex'])) {
        $_SESSION['warning'] = "sex is required";
        header('Location: ../view-members.php');
    } elseif (empty($_POST['birthdate'])) {
        $_SESSION['warning'] = "Date of birth is required";
        header('Location: ../view-members.php');
    } elseif (empty($_POST['birthplace'])) {
        $_SESSION['warning'] = "Place of birth is required";
        header('Location: ../view-members.php');
    } else {
        $id         = $_POST['member_id'];
        $birthdate  = sanitizeUserInput($_POST['birthdate']);
        $firstname  = sanitizeUserInput(ucwords($_POST['firstname']));
        $surname    = sanitizeUserInput(ucwords($_POST['surname']));
        $othername  = sanitizeUserInput(ucwords($_POST['othername']));
        $sex        = sanitizeUserInput(ucwords($_POST['sex']));
        $birthplace = sanitizeUserInput(ucwords($_POST['birthplace']));
        $region     = sanitizeUserInput(ucwords($_POST['region']));
        $district   = sanitizeUserInput(ucwords($_POST['district']));
        
        $query = "UPDATE `members` SET `Firstname` =  ?, `Sur_name` = ?, `Other_name` = ?,
        `Sex` = ?, `Birth_Date` = ?, `Birth_Place` = ?, `Birth_Region` = ?, `Birth_District` = ? WHERE `Id` = ?";
        $stmt_update = $connection->prepare($query);
        $stmt_update->bind_param("ssssssssi", $firstname, $surname, $othername, $sex, $birthdate, $birthplace, $region, $district, $id);
        $stmt_update->execute();
        
        if ($stmt_update->affected_rows > 0) {
            $_SESSION['success'] =  "Member's profile updated successfully";
            header('Location: ../view-members.php');
        } else {
            $_SESSION['neutral'] =  "Member's profile update failed";
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
        $_SESSION['success'] = $row['Firstname']." ".$row['Other_name']." ".$row['Sur_name']." ".$row['Init'].$row['Reg_year'].$row['Id']." deleted successfully";
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