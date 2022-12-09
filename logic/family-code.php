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
    if (empty($_POST['mother_name'])) {
        $_SESSION['warning'] = "Mother's name is required";
        header('Location: ../add-family.php');
    } elseif (empty($_POST['m_status'])) {
        $_SESSION['warning'] = "Mother's status is required";
        header('Location: ../add-family.php');
    } elseif (empty($_POST['father_name'])) {
        $_SESSION['warning'] = "Father's name is required";
        header('Location: ../add-family.php');
    } elseif (empty($_POST['f_status'])) {
        $_SESSION['warning'] = "Father's status is required";
        header('Location: ../add-family.php');
    } elseif (empty($_POST['kin_name'])) {
        $_SESSION['warning'] = "Next of Kin's name is required";
        header('Location: ../add-family.php');
    } elseif (empty($_POST['phone_number'])) {
        $_SESSION['warning'] = "Next of Kin's Phone number is required";
        header('Location: ../add-family.php');
    } else {
        $member_id  = $_POST['member-id'];
        $m_name     = sanitizeUserInput(ucwords($_POST['mother_name']));
        $m_status   = sanitizeUserInput($_POST['m_status']);
        $f_name     = sanitizeUserInput(ucwords($_POST['father_name']));
        $f_status   = sanitizeUserInput(ucfirst($_POST['f_status']));
        $kin_name   = sanitizeUserInput(ucwords($_POST['kin_name']));
        $kin_contact = sanitizeUserInput($_POST['phone_number']);
        $gps_address = sanitizeUserInput(ucfirst($_POST['gps_address']));
        
        $query = "INSERT INTO `family`(`MiD`, `Mother_name`, `M_decease`, `Father_name`, `F_decease`, `Next_of_kin`, `NoK_contact`, `NoK_GPS_address`) VALUES (?,?,?,?,?,?,?,?)";
        $stmt_insert = $connection->prepare($query);
        $stmt_insert->bind_param("isssssss", $member_id, $m_name, $m_status, $f_name, $f_status, $kin_name, $kin_contact, $gps_address);
        $stmt_insert->execute();

        if ($stmt_insert->affected_rows > 0) {
            $_SESSION['success'] =  "Member's family added successfully";
            header('Location: ../view-family.php');
        } else {
            $_SESSION['success'] =  "Failed to add member's family";
            header('Location: ../add-family.php');
        }
        $stmt_insert->close();
    }
}
