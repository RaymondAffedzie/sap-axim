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
        $marital_status     = sanitizeUserInput(ucwords($_POST['marital_status']));
        $children_number    = sanitizeUserInput($_POST['children_number']);
        $education_level    = sanitizeUserInput(ucwords($_POST['education_level']));
        $occupation         = sanitizeUserInput(ucwords($_POST['occupation']));
        
        $query = "INSERT INTO `other_info`(`MiD`, `Marital_status`, `Number_of_children`,
        `Education_level`, `Occupation`) VALUES (?,?,?,?,?)";
        $stmt_insert = $connection->prepare($query);
        $stmt_insert->bind_param("issss", $member_id, $marital_status, $children_number, $education_level, $occupation);
        $stmt_insert->execute();

        if ($stmt_insert->affected_rows > 0) {
            $_SESSION['success'] =  "Member's other information added successfully";
            header('Location: ../add-address.php');
        } else {
            $_SESSION['success'] =  "Failed to add member's other information";
            header('Location: ../add-other-info.php');
        }
        $stmt_insert->close();
    }
}





// update other info
if (isset($_POST['updatede'])) {
    if (empty($_POST['marital_status'])) {
        $_SESSION['warning'] = "Marital status is required";
        header('Location: ../view-other-info.php');
    } elseif (empty($_POST['children_number'])) {
        $_SESSION['warning'] = "Number of children is required";
        header('Location: ../view-other-info.php');
    } elseif (empty($_POST['education_level'])) {
        $_SESSION['warning'] = "Level of education is required";
        header('Location: ../view-other-info.php');
    } elseif (empty($_POST['occupation'])) {
        $_SESSION['warning'] = "occupation is required";
        header('Location: ../view-other-info.php');
    } else {
        $id                 = $_POST['member_id'];
        $children_number    = sanitizeUserInput($_POST['children_number']);
        $marital_status     = sanitizeUserInput(ucwords($_POST['marital_status']));
        $education_level    = sanitizeUserInput(ucwords($_POST['education_level']));
        $occupation         = sanitizeUserInput(ucwords($_POST['occupation']));
        
        $query = "UPDATE `other_info` SET `Marital_status` = ?, `Number_of_children` = ?,
        `Education_level` = ?, `Occupation` = ? WHERE `MiD` = ?";
        $stmt_update = $connection->prepare($query);
        $stmt_update->bind_param("ssssi", $marital_status, $children_number, $education_level, $occupation, $id);
        $stmt_update->execute();
        
        if ($stmt_update->affected_rows > 0) {
            $_SESSION['success'] =  "Member's other info updated successfully";
            header('Location: ../view-other-info.php');
        } else {
            $_SESSION['neutral'] =  "Member's other info update failed";
            header('Location: ../view-other-info.php');
        }
        $stmt_update->close();
    }
}
