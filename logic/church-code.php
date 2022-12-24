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

    $member_id  = $_POST['member-id'];
    $parish = sanitizeUserInput(ucwords($_POST['parish']));
    $baptism_number = sanitizeUserInput($_POST['baptism_number']);
    
    /**
     *checks if baptism  number field is not empty,
     *if it is not empty then parish of baptism field should also be filled.
     */
    if ((!empty($_POST['baptism_number'])) && (empty($_POST['parish']))) {
        $_SESSION['warning'] = "Parish or Station of baptism is required";
        header('Location: ../add-church.php');
    } elseif ((!empty($_POST['parish'])) && (empty($_POST['baptism_number']))) {
        $_SESSION['warning'] = "Baptism number is required";
        header('Location: ../add-church.php');
    }

    $select_query = "SELECT * FROM `church` WHERE `MiD` = '$member_id'";
    $query_run = mysqli_query($connection, $select_query);

    if (mysqli_num_rows($query_run) > 0) {
        $_SESSION['warning'] = "Member's baptism details exits";
        header('Location: ../view-church.php');
    } else {

        $query = "INSERT INTO `church`(`MiD`, `Baptism_card_number`, `Parish`) VALUES (?,?,?)";
        $stmt_insert = $connection->prepare($query);
        $stmt_insert->bind_param("iss", $member_id, $baptism_number, $parish);
        $stmt_insert->execute();

        if ($stmt_insert->affected_rows > 0) {
            $_SESSION['success'] = "Member's baptism details added successfully";
            header('Location: ../add-society.php');
        } else {
            $_SESSION['status'] =  "Failed to add member's baptism details";
            header('Location: ../add-church.php');
        }
        $stmt_insert->close();
    }
}




// update church/baptism details
if (isset($_POST['update'])) {
    if (empty($_POST['card_number'])) {
        $_SESSION['warning'] = "Baptism number is required";
        header('Location: ../view-church.php');
    } elseif (empty($_POST['parish'])) {
        $_SESSION['warning'] = "Member's parish is required";
        header('Location: ../view-church.php');
    } else {
        $id             = $_POST['member_id'];
        $parish   = sanitizeUserInput(ucwords($_POST['parish']));
        $baptism_number = sanitizeUserInput($_POST['card_number']);


        $query = "UPDATE `church` SET `Baptism_card_number` = ?, `Parish` = ? WHERE `MiD` = ?";
        $stmt_update = $connection->prepare($query);
        $stmt_update->bind_param("ssi", $baptism_number, $parish, $id);
        $stmt_update->execute();

        if ($stmt_update->affected_rows > 0) {
            $_SESSION['success'] =  "Member's baptism details updated successfully";
            header('Location: ../view-church.php');
        } else {
            $_SESSION['neutral'] =  "Member's baptism details update failed";
            header('Location: ../view-church.php');
        }
        $stmt_update->close();
    }
}
