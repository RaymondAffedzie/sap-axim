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
    $m_name     = sanitizeUserInput(ucwords($_POST['mother_name']));
    $m_status   = sanitizeUserInput(ucwords($_POST['m_status']));
    $f_name     = sanitizeUserInput(ucwords($_POST['father_name']));
    $f_status   = sanitizeUserInput(ucfirst($_POST['f_status']));
    $kin_name   = sanitizeUserInput(ucwords($_POST['kin_name']));
    $kin_contact = sanitizeUserInput($_POST['phone_number']);
    $gps_address = sanitizeUserInput(ucwords($_POST['gps_address']));

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

        $select_query = "SELECT * FROM `family` WHERE `MiD` = '$member_id'";
        $query_run = mysqli_query($connection, $select_query);

        if (mysqli_num_rows($query_run) > 0) {
            $_SESSION['warning'] = "Member's family details exits";
            header('Location: ../view-family.php');
        } else {

            $query = "INSERT INTO `family`(`MiD`, `Mother_name`, `M_decease`, `Father_name`, `F_decease`,
             `Next_of_kin`, `NoK_contact`, `NoK_GPS_address`) VALUES (?,?,?,?,?,?,?,?)";
            $stmt_insert = $connection->prepare($query);
            $stmt_insert->bind_param("isssssss", $member_id, $m_name, $m_status, $f_name, $f_status, $kin_name, $kin_contact, $gps_address);
            $stmt_insert->execute();

            if ($stmt_insert->affected_rows > 0) {
                $_SESSION['success'] =  "Member's family added successfully";
                header('Location: ../add-church.php');
            } else {
                $_SESSION['success'] =  "Failed to add member's family";
                header('Location: ../add-family.php');
            }
            $stmt_insert->close();
        }
    }
}


// update family details
if (isset($_POST['update'])) {
    if (empty($_POST['f_name'])) {
        $_SESSION['warning'] = "Father's name is required";
        header('Location: ../view-family.php');
    } elseif (empty($_POST['m_name'])) {
        $_SESSION['warning'] = "Mother's name is required";
        header('Location: ../view-family.php');
    } elseif (empty($_POST['k_name'])) {
        $_SESSION['warning'] = "Next of kin's name is required";
        header('Location: ../view-family.php');
    } elseif (empty($_POST['f_status'])) {
        $_SESSION['warning'] = "Father's status is required";
        header('Location: ../view-family.php');
    } elseif (empty($_POST['m_status'])) {
        $_SESSION['warning'] = "Mother's status is required";
        header('Location: ../view-family.php');
    } elseif (empty($_POST['k_contact'])) {
        $_SESSION['warning'] = "Next of kin's contact is required";
        header('Location: ../view-family.php');
    } else {
        $id             = $_POST['member_id'];
        $kin_contact    = sanitizeUserInput($_POST['k_contact']);
        $kin_gps        = sanitizeUserInput(ucwords($_POST['k_gps']));
        $mother_status  = sanitizeUserInput(ucwords($_POST['m_status']));
        $father_status  = sanitizeUserInput(ucwords($_POST['f_status']));
        $kin_name       = sanitizeUserInput(ucwords($_POST['k_name']));
        $father_name    = sanitizeUserInput(ucwords($_POST['f_name']));
        $mother_name    = sanitizeUserInput(ucwords($_POST['m_name']));

        $query = "UPDATE `family` SET `Mother_name` = ?, `M_decease`= ?, `Father_name` = ?,
        `F_decease` = ?, `Next_of_kin` = ?, `NoK_contact` = ?, `NoK_GPS_address`= ? WHERE `MiD` = ?";
        $stmt_update = $connection->prepare($query);
        $stmt_update->bind_param("sssssssi", $mother_name, $mother_status, $father_name, $father_status, $kin_name, $kin_contact, $kin_gps, $id);
        $stmt_update->execute();

        if ($stmt_update->affected_rows > 0) {
            $_SESSION['success'] =  "Member's family details updated successfully";
            header('Location: ../view-family.php');
        } else {
            $_SESSION['neutral'] =  "Member's family details update failed";
            header('Location: ../view-family.php');
        }
        $stmt_update->close();
    }
}
