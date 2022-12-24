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
    $member_id      = $_POST['member-id'];
    $house_number   = sanitizeUserInput(ucwords($_POST['house_number']));
    $street_name    = sanitizeUserInput(ucwords($_POST['street_name']));
    $gps_address    = sanitizeUserInput($_POST['gps_address']);
    $post_address   = sanitizeUserInput(ucwords($_POST['postal_address']));
    $email          = sanitizeUserInput($_POST['email']);
    $phone_number   = sanitizeUserInput($_POST['phone_number']);

    if (empty($_POST['gps_address'])) {
        $_SESSION['warning'] = "GPS address is required";
        header('Location: ../add-address.php');
    } elseif (empty($_POST['house_number'])) {
        $_SESSION['warning'] = "House number is required";
        header('Location: ../add-address.php');
    } elseif (empty($_POST['street_name'])) {
        $_SESSION['warning'] = "Street name is required";
        header('Location: ../add-address.php');
    } else {

        $select_query = "SELECT * FROM `address` WHERE `MiD` = '$member_id'";
        $query_run = mysqli_query($connection, $select_query);

        if (mysqli_num_rows($query_run) > 0) {
            $_SESSION['warning'] = "Member's address details exits";
            header('Location: ../view-address.php');
        } else {

            $query = "INSERT INTO `address`(`MiD`, `Street_name`, `House_number`, `GPS_address`,
             `Postal_address`, `Phone_number`, `Email`) VALUES (?,?,?,?,?,?,?)";
            $stmt_insert = $connection->prepare($query);
            $stmt_insert->bind_param("issssss", $member_id, $street_name, $house_number, $gps_address, $post_address, $phone_number, $email);
            $stmt_insert->execute();

            if ($stmt_insert->affected_rows > 0) {
                $_SESSION['success'] =  "Member's address added successfully";
                header('Location: ../add-family.php');
            } else {
                $_SESSION['success'] =  "Failed to add member's Address";
                header('Location: ../add-address.php');
            }
            $stmt_insert->close();
        }
    }
}



// update address
if (isset($_POST['update'])) {
    if (empty($_POST['gps_address'])) {
        $_SESSION['warning'] = "GPS Address is required";
        header('Location: ../view-address.php');
    } elseif (empty($_POST['street_name'])) {
        $_SESSION['warning'] = "street name is required";
        header('Location: ../view-address.php');
    } elseif (empty($_POST['house_number'])) {
        $_SESSION['warning'] = "House number is required";
        header('Location: ../view-address.php');
    } else {
        $id             = $_POST['member_id'];
        $email          = sanitizeUserInput($_POST['email']);
        $phone          = sanitizeUserInput(ucwords($_POST['phone']));
        $gps_address    = sanitizeUserInput(ucwords($_POST['gps_address']));
        $street_name    = sanitizeUserInput(ucwords($_POST['street_name']));
        $house_number   = sanitizeUserInput(ucwords($_POST['house_number']));
        $post_address   = sanitizeUserInput(ucwords($_POST['post_address']));

        $query = "UPDATE `address` SET `Street_name` = ?, `House_number` = ?, `GPS_address` = ?,
        `Postal_address` = ? ,`Phone_number` = ?, `Email` = ? WHERE `MiD` = ?";
        $stmt_update = $connection->prepare($query);
        $stmt_update->bind_param("ssssssi", $street_name, $house_number, $gps_address, $post_address, $phone, $email, $id);
        $stmt_update->execute();

        if ($stmt_update->affected_rows > 0) {
            $_SESSION['success'] =  "Member's address updated successfully";
            header('Location: ../view-address.php');
        } else {
            $_SESSION['neutral'] =  "Member's address update failed";
            header('Location: ../view-address.php');
        }
        $stmt_update->close();
    }
}
