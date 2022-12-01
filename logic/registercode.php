<?php
include_once('../config/security.php');

function sanitize_user_input($data)
{
    $data = trim($data, " ");
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function valisantize_email($data)
{
    $data = filter_var($data, FILTER_VALIDATE_EMAIL);
    $data = filter_var($data, FILTER_SANITIZE_EMAIL);
    return $data;
}

// user registration code
if (isset($_POST['register'])) {
    if (empty($_POST['firstname'])) {

        $_SESSION['warning'] = "Firstname is required";
        header('Location: ../register-admin.php');
    } elseif (empty($_POST['surname'])) {

        $_SESSION['warning'] = "Surname is required";
        header('Location: ../register-admin.php');
    } elseif (empty($_POST['username'])) {

        $_SESSION['warning'] = "Username is required";
        header('Location: ../register-admin.php');
    } elseif (empty($_POST['email'])) {

        $_SESSION['warning'] = "Email is required";
        header('Location: ../register-admin.php');
    } elseif (empty($_POST['phone_number'])) {

        $_SESSION['warning'] = "Phone Number is required";
        header('Location: ../register-admin.php');
    } elseif (empty($_POST['password'])) {

        $_SESSION['warning'] = "Password is required";
        header('Location: ../register-admin.php');
    } elseif (empty($_POST['confirm_password'])) {

        $_SESSION['warning'] = "Please confirm your password";
        header('Location: ../register-admin.php');
    } else {

        $firstname          = sanitize_user_input(ucfirst($_POST['firstname']));
        $surname            = sanitize_user_input(ucfirst($_POST['surname']));
        $username           = sanitize_user_input($_POST['username']);
        $email              = valisantize_email($_POST['email']);
        $phone_number       = sanitize_user_input($_POST['phone_number']);
        $password           = $_POST['password'];
        $confirm_password   = $_POST['confirm_password'];
        $status_check       = 'A';

        $email_query = "SELECT Email, Username FROM users WHERE Email = '$email' OR Username = '$username'";
        $email_query_run = mysqli_query($connection, $email_query);

        if (mysqli_num_rows($email_query_run)> 0) {
            while($row = mysqli_fetch_array($email_query_run)){
                $username_check = $row['Username'];
                $email_check = $row['Email'];
                $phone_number_check = $row['Phone_number'];

                if($username === $username_check){
                    $_SESSION['warning'] = "Username is registered to another user";
                    header('Location: ../register-admin.php');
                }elseif ($email === $email_check){
                    $_SESSION['warning'] = "E-mail is registered to another user";
                    header('Location: ../register-admin.php');
                }elseif ($phone_number === $phone_number_check){
                    $_SESSION['warning'] = "Phone number is registered to another user";
                    header('Location: ../register-admin.php');
                }
            }
        } else {
            if ($password != $confirm_password) {
                $_SESSION['warning'] =  "Passwords Do Not Match";
                header('Location: ../register-admin.php');
            } else {
                $password = password_hash($password, PASSWORD_BCRYPT);
                $query = "INSERT INTO `users` (`Firstname`, `Surname`, `Username`, `Email`, `Phone_number`, `Password`, `Status`) VALUES (?,?,?,?,?,?,?)";
                $stmt_insert = $connection->prepare($query);
                $stmt_insert->bind_param("sssssss", $firstname, $surname, $username, $email, $phone_number, $password, $status_check);
                $stmt_insert->execute();

                if ($stmt_insert->affected_rows > 0) {
                    $_SESSION['success'] =  "Admin Registered";
                    header('Location: ../register-admin.php');
                } else {
                    $_SESSION['status'] =  "Admin Not Added ";
                    header('Location: ../register-admin.php');
                }
                $stmt_insert->close();
            }
        }
        $stmt_check->close();
    }
}

// delete user account
if (isset($_POST['delete_admin_profile'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM `users` WHERE  `Id` = ?";
    $stmt_del = $connection->prepare($query);
    $stmt_del->bind_param("i", $id);
    $stmt_del->execute();

    if ($stmt_del) {
        $_SESSION['warning'] = "Admin <strong>Terminated</strong>";
        header("location: ../register-admin.php");
    } else {
        $_SESSION['status'] = "User termination <strong>Failed</strong>";
        header("location: ../register-admin.php");
    }
    $stmt_del->close();
}

// update other users password
if (isset($_POST['update-user-profile'])) {

    $id                 = $_POST['id'];
    $username           = sanitize_user_input($_POST['username']);
    $email              = valisantize_email($_POST['email']);
    $password           = sanitize_user_input($_POST['new_password']);
    $confirm_password   = sanitize_user_input($_POST['con_password']);

    if (empty($username)) {
        $_SESSION['warning'] = "Username is required";
        header('Location: ../register-admin.php');
    } elseif (empty($email)) {
        $_SESSION['warning'] = "Email is required";
        header('Location: ../register-admin.php');
    } elseif (empty($password)) {

        $_SESSION['warning'] = "Password is required";
        header('Location: ../register-admin.php');
    } else {
        if ($password != $confirm_password) {
            $_SESSION['warning'] =  "Passwords Do Not Match";
            header('Location: ../registeredit.php');
        } else {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $query = "UPDATE `users` SET `Username` = ?, `Email` = ?, `Password` = ? WHERE `Id` = ? ";
            $stmt_update = $connection->prepare($query);
            $stmt_update->bind_param("sssi", $username, $email, $password, $id);
            $stmt_update->execute();

            if ($stmt_update) {
                $_SESSION['success'] = "Admins profile is updated";
                header("location: ../register-admin.php");
                exit();
            } else {
                $_SESSION['status'] = "Admins profile is not updated";
                header("location: ../registeredit.php");
                exit();
            }
            $stmt_update->close();
        }
        $stmt_check->close();
    }
}

// update active users profile
if (isset($_POST['updateprofile'])) {
    if (empty($_POST['firstname'])) {
        $_SESSION['warning'] = "Firstname is required";
        header('Location: ../register-admin.php');
    } elseif (empty($_POST['surname'])) {
        $_SESSION['warning'] = "Surname is required";
        header('Location: ../register-admin.php');
    } elseif (empty($_POST['email'])) {
        $_SESSION['warning'] = "Email is required";
        header('Location: ../register-admin.php');
    } elseif (empty($_POST['phone_number'])) {
        $_SESSION['warning'] = "Phone Number is required";
        header('Location: ../register-admin.php');
    } else {
        function sanitize_user_update($input)
        {
            $input = trim($input, " ");
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }
        function valisantize_update($input)
        {
            $input = filter_var($input, FILTER_VALIDATE_EMAIL);
            $input = filter_var($input, FILTER_SANITIZE_EMAIL);
            return $input;
        }

        $id             = $_POST['id'];
        $firstname      = sanitize_user_update($_POST['firstname']);
        $surname        = sanitize_user_update($_POST['surname']);
        $username       = sanitize_user_update($_POST['username']);
        $phone_number   = sanitize_user_update($_POST['phone_number']);
        $email          = valisantize_update($_POST['email']);

        $query = "UPDATE `users` SET `Firstname` = ?, `Surname` = ?, `Username` = ?, `Phone_number` = ?, `Email` = ? WHERE `Id` = ? ";
        $stmt_update = $connection->prepare($query);
        $stmt_update->bind_param("sssssi", $firstname, $surname, $username, $phone_number, $email, $id);
        $stmt_update->execute();

        if ($stmt_update) {
            $_SESSION['success'] = "Your profile is updated";
            header("location: ../profile.php");
            exit();
        } else {
            $_SESSION['status'] = "Your profile is not updated";
            header("location: ../profile.php");
            exit();
        }
    }
}

// suspend user
if (isset($_POST['status_block'])){
    $id = $_POST['id'];
    $status = "I";
    $query = "UPDATE `users` SET `Status` = ? WHERE `Id` = ? ";
    $stmt_update = $connection->prepare($query);
    $stmt_update->bind_param("si", $status, $id);
    $stmt_update->execute();

    if ($stmt_update) {
        $_SESSION['success'] = "User's account suspended successfully";
        header("Location: ../register-admin.php");
    }else{
        $_SESSION['danger'] = "Failed to suspend user";
        header("Location: ../register-admin.php");
    }
}

// unblock user
if (isset($_POST['status_unblock'])){
    $id = $_POST['id'];
    $status = "A";
    $query = "UPDATE `users` SET `Status` = ? WHERE `Id` = ? ";
    $stmt_update = $connection->prepare($query);
    $stmt_update->bind_param("si", $status, $id);
    $stmt_update->execute();

    if ($stmt_update) {
        $_SESSION['success'] = "User's account activated successfully";
        header("Location: ../register-admin.php");
    }else{
        $_SESSION['danger'] = "Failed to activate user";
        header("Location: ../register-admin.php");
    }
}
