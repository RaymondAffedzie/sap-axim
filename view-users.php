<?php
include_once('config/security.php');
include_once('includes/header.php');
include_once('includes/navbar.php');
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Registered users</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a type="button" class="btn btn-sm btn-outline-secondary" href="register-admin.php">Add user</a>
                <a type="button" class="btn btn-sm btn-outline-secondary" href="view-users.php">View users</a>
            </div>
            <a type="button" class="btn btn-sm btn-outline-secondary" href="profile.php">View profile</a>
        </div>
    </div>

<?php include_once('logic/alerts.php') ?>
<div class="card text-center shadow mb-4">
    <div class="card-body">
        <!-- change profile info -->
        <div class="row">
            <div class="col-md-12">
            <div class="table-responsive">
                <?php
                include_once('logic/alerts.php');
                $admin_id = $_SESSION['users']['users_id'];
                // select moderators and not the current logged in admin
                $query = "SELECT `Id`, `Firstname`, `Surname`, `Username`, `Phone_number`, `Email`, `Status` FROM `users` WHERE `Role` = 'M' AND NOT `Id` = $admin_id";
                $query_run = mysqli_query($connection, $query);

                ?>
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Firstname</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Username</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Current State</th>
                            <th scope="col">Action</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($query_run) {
                            while ($row = mysqli_fetch_array($query_run)) {
                        ?>
                                <tr>
                                    <td>
                                        <p> <?php echo $row['Firstname']; ?> </p>
                                    </td>
                                    <td>
                                        <p> <?php echo $row['Surname']; ?> </p>
                                    </td>
                                    <td>
                                        <p> <?php echo $row['Username']; ?> </p>
                                    </td>
                                    <td>
                                        <p> <?php echo $row['Phone_number']; ?> </p>
                                    </td>
                                    <td>
                                        <p> <?php echo $row['Email']; ?> </p>
                                    </td>
                                    <td>
                                        <?php
                                        $status_check = $row['Status'];
                                        if ($status_check === "A") {
                                        ?>
                                            <p class="text-success">Active</p>
                                        <?php
                                        } elseif ($status_check === "I") {
                                        ?>
                                            <p class="text-danger">Suspended</p>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $status_check = $row['Status'];
                                        if ($status_check === "A") {
                                        ?>
                                            <form action="logic/registercode.php" method="post">
                                                <input type="hidden" name="check_status_id" value="<?php echo $row['Id']; ?>">
                                                <button type="submit" name="status_block" class="btn btn-outline-warning" data-bs-toggle="tooltip" data-bs-placement="left" title="Suspend user" onclick="return confirm('Do you want to suspend user')">
                                                    <i class="fa-solid fa-lock"></i>
                                                </button>
                                            </form>
                                        <?php
                                        } elseif ($status_check === "I") {
                                        ?>
                                            <form action="logic/registercode.php" method="post">
                                                <input type="hidden" name="check_status_id" value="<?php echo $row['Id']; ?>">
                                                <button type="submit" name="status_unblock" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="left" title="Activate user" onclick="return confirm('Do you want to activate user')">
                                                    <i class="fa-solid fa-lock-open"></i>
                                                </button>
                                            </form>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <form action="registeredit.php" method="post">
                                            <input type="hidden" name="edit_id" value="<?php echo $row['Id']; ?>">
                                            <button type="submit" name="edit_btn" class="btn btn-outline-info" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit user's Profile">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="registercode.php" method="post">
                                            <input type="hidden" name="delete_id" value="<?php echo $row['Id']; ?>">
                                            <button type="submit" name="delete_admin_profile" class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="left" title="Delete user's account" onclick="return confirm('Do you want to delete user\'s account')">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td><?php echo "No data found"; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>


<?php
    include_once('includes/footer.php');
?>