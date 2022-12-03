<?php
    include_once('../config/control.php');
    include_once('../config/connection.php');

    if (isset($_POST['code-request'])) {
        function valisantizeEmail($data)
        {
            $data = filter_var($data, FILTER_VALIDATE_EMAIL);
            $data = filter_var($data, FILTER_SANITIZE_EMAIL);
            return $data;
        }
        
        $email =  valisantizeEmail($_POST['email']);
        $_SESSION['email'] = $email;
        
        if (empty($email)) {
            $_SESSION['warning'] = "Enter your email";
            header("Location: ../forgot-password.php");
        } else {
            $query = "SELECT `Email` FROM `users` WHERE `Email` = ?";
            $stmt_check = $connection->prepare($query);
            $stmt_check->bind_param("s", $email);
            $stmt_check->execute();
            $stmt_check->store_result();

            if ($stmt_check->num_rows > 0) {
                $stmt_check->bind_result($email);
                $stmt_check->fetch();

                $query_2 = "DELETE FROM `password_reset` WHERE `Pwd_reset_email` = ?";
                $stmt_del = $connection->prepare($query_2);
                $stmt_del->bind_param("s", $email);
                $stmt_del->execute();
                $stmt_del->close();

                include_once('verification-code.php');
                $query_3 = "INSERT INTO password_reset (Pwd_reset_email, Pwd_reset_token) VALUES (?,?)";
                $stmt_insert = $connection->prepare($query_3);
                $stmt_insert->bind_param("si", $email, $resetcode);
                $stmt_insert->execute();
                $query_4 = "UPDATE `users` SET `Pwd_reset_token` = ? WHERE `Email` = ?";
                $stmt_insert_2 = $connection->prepare($query_4);
                $stmt_insert_2->bind_param("is", $resetcode, $email);
                $stmt_insert_2->execute();
                $stmt_insert_2->close();
                
                if ($stmt_insert->affected_rows > 0) {
                    include_once('send-password-verification-code.php');
                    $_SESSION['success'] = "Check your email for reset code";
                    header("location: ../verify-user.php");
                } else {
                    $_SESSION['status'] = "Could not send verificaiton code <strong>Try Again</strong>";
                    header("location: ../forgot-password.php");
                }
            } else {
                $_SESSION['status'] = "Account is not registered";
                header("Location: ../forgot-password.php");
                $stmt_insert->close();
            }
            $stmt_check->close();
        }
    } else {
        $_SESSION['warning'] = "An error occured!";
        header("Location: ../forgot-password.php");
    }