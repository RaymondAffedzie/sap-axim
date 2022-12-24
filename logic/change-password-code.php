<?php
    include_once('../config/security.php');
    // change password
    if (isset($_POST['changepassword'])) {
        function sanitizeData($in)
        {
            $in = trim($in, " ");
            $in = stripslashes($in);
            $in = htmlspecialchars($in);
            return $in;
        }

        $id             = $_SESSION['users']['users_id'];
        $old_password   = sanitizeData($_POST['old_password']);
        $new_password   = sanitizeData($_POST['new_password']);
        $con_password   = sanitizeData($_POST['con_password']);

        if (empty($old_password)) {
            $_SESSION['warning'] = "Old Password is required";
            header('Location: ../profile.php');
        } elseif (empty($new_password)) {
            $_SESSION['warning'] = "New Password is required";
            header('Location: ../profile.php');
        } elseif ($new_password !== $con_password) {
            $_SESSION['warning'] = "New Password and Confirm password do not match";
            header('Location: ../profile.php');
        } else {

            $new_password = password_hash($new_password, PASSWORD_BCRYPT);
            $query = "SELECT `Password` FROM `users` WHERE `Id` = '$id'";
            $query_run = mysqli_query($connection, $query);
            if ($query_run) {
                while ($row = mysqli_fetch_array($query_run)) {
                    $verify_password = password_verify($old_password, $row['Password']);
                    if ($verify_password === $_SESSION['users']['pswd']) {
                        $query_2 = "UPDATE `users` SET `Password` = ? WHERE `Id` = ?";
                        $stmt_update = $connection->prepare($query_2);
                        $stmt_update->bind_param("si", $new_password, $id);
                        $stmt_update->execute();

                        $email = $_SESSION['users']['users_email'];
                        include_once('send-password-change-confirmation-code.php');
                        $_SESSION['success'] = "You have successfully changed your password";
                        header("location: ../profile.php");
                    } else {
                        $_SESSION['status'] = "You entered a wrong password";
                        header('Location: ../profile.php');
                    }
                }
            }
        }
    }
