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
    /**
     *checks if baptism or confirmation numbers fields are not empty,
     *if not empty baptism and confirmation date fields should also be filled.
     */
    if ((!empty($_POST['b_id'])) && (empty($_POST['b_date']))) {
        $_SESSION['warning'] = "Baptism date is required";
        header('Location: ../add-church.php');
    } elseif ((!empty($_POST['b_date'])) && (empty($_POST['b_id']))) {
        $_SESSION['warning'] = "Baptism number is required";
        header('Location: ../add-church.php');
    }

    $member_id  = $_POST['member-id'];
    $baptism_date = sanitizeUserInput($_POST['b_date']);
    $baptism_number = sanitizeUserInput(ucwords($_POST['b_id']));

    $select_query = "SELECT * FROM `members` WHERE `Id` = '$member_id'";
    $query_run = mysqli_query($connection, $select_query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($row = mysqli_fetch_array($query_run)) {
            $birth_date = $row['Birth_Date'];

            if (empty($baptism_date)) {
                header('Location: ../view-church.php');
            } elseif ($birth_date > $baptism_date) {
                $_SESSION['warning'] = "Birth date should not be current than baptism date";
                header('Location: ../add-church.php');
            } else {

                $query = "INSERT INTO `church`(`MiD`, `Baptism_card_number`, `Baptism_date`) VALUES (?,?,?)";
                $stmt_insert = $connection->prepare($query);
                $stmt_insert->bind_param("iss", $member_id, $baptism_number, $baptism_date);
                $stmt_insert->execute();

                if ($stmt_insert->affected_rows > 0) {
                    $_SESSION['success'] = "Member's church details added successfully";
                    header('Location: ../add-society.php');
                } else {
                    $_SESSION['status'] =  "Failed to add member's church details";
                    header('Location: ../add-church.php');
                }
                $stmt_insert->close();
            }
        }
    }
}
