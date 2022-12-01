<?php
include_once('../config/control.php');
include_once('../config/connection.php');

// this file is for changing password when user forget's his/her password 

if (isset($_POST['save-pwd'])) {
    function sanitize_data($in)
    {
        $in = trim($in, " ");
        $in = stripslashes($in);
        $in = htmlspecialchars($in);
        return $in;
    }
    $new_password   = sanitize_data($_POST['new_password']);
    $con_password   = sanitize_data($_POST['con_password']);
    $code = $_SESSION['code'];
    $email = $_SESSION['email'];

    if (empty($new_password)) {
        $_SESSION['warning'] = "New Password is required";
        header('Location: ../password-reset.php');
    } elseif ($new_password !== $con_password) {
        $_SESSION['warning'] = "New Password and Confirm password do not match";
        header('Location: ../password-reset.php');
    } else {
        $query = "SELECT `Email`, `Pwd_reset_token` FROM `users` WHERE `Email` = '$email' AND `Pwd_reset_token`= '$code'";
        $query_run = mysqli_query($connection, $query);
        if (mysqli_num_rows($query_run) ===  1) {
            // update old password with new password 
            $new_password = password_hash($new_password, PASSWORD_BCRYPT);
            $query_2 = "UPDATE `users` SET `Password` = ? WHERE `Email` = ? AND `Pwd_reset_token`= ?";
            $stmt_update = $connection->prepare($query_2);
            $stmt_update->bind_param("ssi", $new_password, $email, $code);
            $stmt_update->execute();

            include_once('verification-code.php');
            // update token in password reset table
            $query_3 = "UPDATE `Password_reset` SET `Pwd_reset_token` = ? WHERE `Pwd_reset_email` = ?";
            $stmt_update_2 = $connection->prepare($query_3);
            $stmt_update_2->bind_param("is", $resetcode, $email);
            $stmt_update_2->execute();
            $stmt_update_2->close();

            // update token in admin table
            $query_4 = "UPDATE `users` SET `Pwd_reset_token` = ? WHERE `Email` = ?";
            $stmt_update_3 = $connection->prepare($query_4);
            $stmt_update_3->bind_param("is", $resetcode, $email);
            $stmt_update_3->execute();
            $stmt_update_3->close();

            include_once('send-password-change-confirmation-code.php');
            $_SESSION['success'] = "You have successfully changed your password";
            header("location: ../login.php");
        }else {
            $_SESSION['status'] = "You cannot change this password";
            header('Location: ../login.php');
        }
    }
    session_destroy();
    unset($_SESSION['email']);
    unset($_SESSION['code']);
} else {
    $_SESSION['warning'] = "An error occured!";
    header("Location: ../password-reset.php");
}
