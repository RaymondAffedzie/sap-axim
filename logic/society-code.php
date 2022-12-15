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

    foreach ($society as $index => $socity_name) {
        $societies = sanitizeUserInput(ucwords($society_name));
        $offices = sanitizeUserInput(ucwords($office[$index]));
        
        $query = "INSERT INTO `society`(`MiD`, `Society_name`, `Position_held`) VALUES (?,?,?)";
        $stmt_insert = $connection->prepare($query);
        $stmt_insert->bind_param("iss", $member_id, $societies, $offices);
        $stmt_insert->execute();
    }

    if ($stmt_insert->affected_rows > 0) {
        $_SESSION['success'] = "Member's society(ies) added successfully";
        header('Location: ../view-society.php');
    } else {
        $_SESSION['status'] =  "Failed to add member's society(ies) details";
        header('Location: ../add-society.php');
    }
    $stmt_insert->close();

}