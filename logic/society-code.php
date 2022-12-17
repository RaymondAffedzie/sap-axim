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
