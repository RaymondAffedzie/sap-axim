<?php
include_once('../config/security.php');

// login
    if (isset($_POST['login'])) {
        function validateEmail($user)
        {
            $user = filter_var($user, FILTER_VALIDATE_EMAIL);
            $user = filter_var($user, FILTER_SANITIZE_EMAIL);
            return $user;
        }

        $email_login = mysqli_real_escape_string($connection, validateEmail($_POST['email']));
        $username_login = mysqli_real_escape_string($connection, $_POST['email']);
        $password_login = mysqli_real_escape_string($connection, $_POST['password']);

        $query = "SELECT * FROM `users` WHERE `Email` = '$email_login' OR `Username` = '$username_login'";
        $query_run = mysqli_query($connection, $query);

        if (mysqli_num_rows($query_run) ===  1) {
            $row = mysqli_fetch_array($query_run);
            $status = $row['Status'];
            $db_password = $row['Password'];

            if ($status !== "A") {
                $_SESSION['warning'] = "<b>Account suspended!</b><br>Contact any senior Administrator for help.";
                header('Location: ../login.php');
            } else {
                if (password_verify($password_login, $db_password)) {
                    $userspswd    =  password_verify($password_login, $db_password);
                    $users_email  = $row['Email'];
                    $users_id     = $row['Id'];
                    $fname        = $row['Firstname'];
                    $sname        = $row['Surname'];
                    $fullname     = $fname." ".$sname;
                    $username     = $row['Username'];
                    $phone_nubmer = $row['Phone_number'];
                    
                    $_SESSION['users'] = [
                        'users_email'=> $users_email,
                        'pswd'       => $userspswd,
                        'users_id'   => $users_id,
                        'fname'      => $fname,
                        'sname'      => $sname,
                        'fullname'   => $fullname,
                        'username'   => $username,
                        'phonenumber'=> $phone_nubmer,
                    ];
                    header('Location: ../index.php');
                } else {
                    $_SESSION['status'] = "Incorrect password";
                    header('Location: ../login.php');
                }
            }
        } else {
            $_SESSION['status'] = "Invalid username or email";
            header('Location: ../login.php');
        }
    }