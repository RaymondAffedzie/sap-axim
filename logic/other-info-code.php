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
    if (empty($_POST['marital_status'])) {
        $_SESSION['warning'] = "Marital status is required";
        header('Location: ../add-other-info.php');
    } elseif (empty($_POST['education_level'])) {
        $_SESSION['warning'] = "Level of education is required";
        header('Location: ../add-other-info.php');
    } else {
        $member_id          = $_POST['member-id'];
        $marital_status     = sanitizeUserInput(ucfirst($_POST['marital_status']));
        $children_number    = sanitizeUserInput($_POST['children_number']);
        $education_level    = sanitizeUserInput(ucfirst($_POST['education_level']));
        $occupation         = sanitizeUserInput(ucfirst($_POST['occupation']));
        
        $query = "INSERT INTO `other_info`(`MiD`, `Marital_status`, `Number_of_children`, `Education_level`, `Occupation`) VALUES (?,?,?,?,?)";
        $stmt_insert = $connection->prepare($query);
        $stmt_insert->bind_param("issss", $member_id, $marital_status, $children_number, $education_level, $occupation);
        $stmt_insert->execute();

        if ($stmt_insert->affected_rows > 0) {
            $_SESSION['success'] =  "Member's personal information added successfully";
            header('Location: ../view-other-info.php');
        } else {
            $_SESSION['success'] =  "Failed to add member's personal information";
            header('Location: ../add-other-info.php');
        }
        $stmt_insert->close();
    }
}
