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
            <a type="button" class="btn btn-sm btn-outline-secondary" href="profile.php">View profile</a>
            <a type="button" class="btn btn-sm btn-outline-secondary" href="register-admin.php">View users</a>
          </div>
          <a type="button" class="btn btn-sm btn-outline-secondary" href="register-admin.php">Add user</a>
        </div>
    </div>
    
    <div class="container-fluid">
        <?php include_once('logic/alerts.php'); ?>
        <div class="card shadow mb-4">
            <div class="card-body">
               
                <?php
                    if (isset($_POST['edit_btn'])) {
                        $id = $_POST['edit_id'];

                        $query = "SELECT * FROM `users` WHERE `Id` = '$id' ";
                        $query_run = mysqli_query($connection, $query);

                        if ($query_run) {
                            while ($row = mysqli_fetch_array($query_run)) {
                ?>
                <form action="logic/change-password-code.php" method="POST" autocomplete="off">
                    <input type="hidden" name="member_id" value="<?php echo $id ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset>
                                <legend>Old passwod</legend>
                                    <div class="form-group mb-3">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" value="<?php echo $row['Username']; ?>" id="username" disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="old_password">Old Password</label>
                                        <input type="password" class="form-control" name="old_password" id="password" minlength="6" required>
                                    </div>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset>
                                <legend>New password</legend>
                                    <div class="form-group mb-3">
                                        <label for="new_password">New Password</label>
                                        <input type="password" class="form-control" name="new_password" id="new_password" minlength="6" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" class="form-control" name="con_password" id="confirm_password"  minlength="6" required>
                                    </div>
                            </fieldset>
                        </div>
                    </div>
                    <button type="submit" name="changepassword" class="w-100 mb-2 btn btn-outline-primary" onclick="return confirm('Confirm password change')">Save</button>
                </form>
                <?php
                            }
                        }
                    }
                ?>
            </div>
            <div class="card-footer">
                <a href="profile.php" class="btn btn-outline-danger">Cancel</a>
            </div>
        </div>
    </div>

    <!-- script for regions and districts in ghana -->
    <script src="js/region-districts.js"></script>
    <script src="js/region-districts-code.js"></script>
<?php
    include_once('includes/footer.php');
?>
