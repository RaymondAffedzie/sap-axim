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
        $member_id          = $_POST['member-id'];
        $street_name     = sanitizeUserInput(ucfirst($_POST['street_name']));
        $house_number    = sanitizeUserInput($_POST['house_number']);
        $gps_address    = sanitizeUserInput(ucfirst($_POST['gps_address']));
        $post_address         = sanitizeUserInput(ucfirst($_POST['postal_address']));
        $email         = sanitizeUserInput(ucfirst($_POST['email']));
        $phone_number         = sanitizeUserInput(ucfirst($_POST['phone_number']));
        
        $query = "INSERT INTO `address`(`MiD`, `Street_name`, `House_number`, `GPS_address`, `Postal_address`, `Phone_number`, `Email`) VALUES (?,?,?,?,?,?,?)";
        $stmt_insert = $connection->prepare($query);
        $stmt_insert->bind_param("issssss", $member_id, $street_name, $house_number, $gps_address, $post_address, $phone_number, $email);
        $stmt_insert->execute();

        if ($stmt_insert->affected_rows > 0) {
            $_SESSION['success'] =  "Member's address added successfully";
            header('Location: ../view-address.php');
        } else {
            $_SESSION['success'] =  "Failed to add member's Address";
            header('Location: ../add-address.php');
        }
        $stmt_insert->close();
    }
}
