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
    $society = $_POST['society_name'];
    $office = $_POST['office_held'];
    $member_id = $_POST['member-id'];

    foreach ($society as $index => $names) {
        $societies = sanitizeUserInput(ucwords($names));
        $offices = sanitizeUserInput(ucwords($office[$index]));

        $query = "INSERT INTO `society`(`MiD`, `Society_name`, `Position_held`) VALUES ('$member_id', '$societies', '$offices')";
        $query_run = mysqli_query($connection, $query);
    }

    if ($query_run) {
        $_SESSION['success'] = "Member's society(ies) added successfully";
        header('Location: ../view-members.php');
    } else {
        $_SESSION['status'] =  "Failed to add member's society(ies) details";
        header('Location: ../add-society.php');
    }
}



// manual add society
if (isset($_POST['save'])) {
    $society    = sanitizeUserInput(ucwords($_POST['society_name']));
    $office     = sanitizeUserInput(ucwords($_POST['office_held']));
    $member_id  = $_POST['member-id'];


    $query = "INSERT INTO `society`(`MiD`, `Society_name`, `Position_held`) VALUES (?,?,?)";
    $stmt_update = $connection->prepare($query);
    $stmt_update->bind_param("iss", $member_id, $society, $office);
    $stmt_update->execute();
    
    if ($stmt_update->affected_rows > 0) {
        $_SESSION['success'] = "Member's society added successfully";
        header('Location: ../view-society.php');
    } else {
        $_SESSION['status'] =  "Failed to add member's society details";
        header('Location: ../view-society.php');
    }
}




// update society details
if (isset($_POST['update'])) {
    if (empty($_POST['society_name'])) {
        $_SESSION['warning'] = "Society's name is required";
        header('Location: ../view-society.php');
    } elseif (empty($_POST['office_held'])) {
        $_SESSION['warning'] = "Office or rank is required";
        header('Location: ../view-society.php');
    }  else {
        $id           = $_POST['member_id'];
        $society_name = sanitizeUserInput(ucwords($_POST['society_name']));
        $office_held  = sanitizeUserInput(ucwords($_POST['office_held']));
        
        $query = "UPDATE `society` SET `Society_name` = ?,`Position_held` = ? WHERE `Id` = ?";
        $stmt_update = $connection->prepare($query);
        $stmt_update->bind_param("ssi", $society_name, $office_held, $id);
        $stmt_update->execute();
        
        if ($stmt_update->affected_rows > 0) {
            $_SESSION['success'] =  "Member's society details updated successfully";
            header('Location: ../view-society.php');
        } else {
            $_SESSION['neutral'] =  "Member's society details update failed";
            header('Location: ../view-society.php');
        }
        $stmt_update->close();
    }
}




// delete member society code
if (isset($_POST['delete_society'])) {
    $sid = $_POST['society_id'];

    $query = "DELETE FROM `society` WHERE `Id` = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $sid);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['success'] = "Member's society <i class='text-danger'>deleted</i> successfully";
        header("Location: ../view-society.php");
    } else {
        $_SESSION['warning'] = "Failed to delete member's society";
        header("Location: ../view-society.php");
    }

    $stmt->close();
}
