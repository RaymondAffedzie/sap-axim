<?php
include_once('config/security.php');
include_once('includes/header.php');
include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Change your password</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a type="button" class="btn btn-sm btn-outline-secondary rounded-0" href="register-admin.php">Add user</a>
                <a type="button" class="btn btn-sm btn-outline-secondary rounded-0" href="view-users.php">View users</a>
            </div>
            <a type="button" class="btn btn-sm btn-outline-success rounded-0" href="profile.php">View profile</a>
        </div>
    </div>

    <div class="container-fluid">
        <?php include_once('logic/alerts.php'); ?>
        <div class="card shadow mb-4">
            <div class="card-body">
                <?php
                $id  = $_SESSION['users']['users_id'];
                $query = "SELECT * FROM `users` WHERE `Id` = '$id' ";
                $query_run = mysqli_query($connection, $query);

                if ($query_run) {
                    while ($row = mysqli_fetch_array($query_run)) {
                ?>
                        <form action="logic/change-password-code.php" method="POST" autocomplete="off">
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>Old passwod</legend>
                                        <div class="form-group mb-3">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control rounded-0" name="username" value="<?php echo $row['Username']; ?>" id="username" disabled>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="old_password">Old Password</label>
                                            <input type="password" class="form-control rounded-0" name="old_password" id="password" minlength="6" required>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset>
                                        <legend>New password</legend>
                                        <div class="form-group mb-3">
                                            <label for="new_password">New Password</label>
                                            <input type="password" class="form-control rounded-0" name="new_password" id="new_password" minlength="6" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" class="form-control rounded-0" name="con_password" id="confirm_password" minlength="6" required>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <button type="submit" name="changepassword" class="w-100 mb-2 btn btn-outline-primary rounded-0" onclick="return confirm('Confirm password change')">Save</button>
                        </form>
                <?php
                    }
                }
                ?>
            </div>
            <div class="card-footer">
                <a href="profile.php" class="btn btn-outline-danger rounded-0">Cancel</a>
            </div>
        </div>
    </div>

    <?php
    include_once('includes/footer.php');
    ?>

    <script src="js/jquery.js"></script>
    <script src="js/custom.js"></script>