<?php
    include_once('config/security.php');
    include_once('includes/header.php');
    include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Update your(admin) details</h1>
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
                <form action="logic/registercode.php" method="POST" autocomplete="off">
                    <input type="hidden" name="member_id" value="<?php echo $id ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <fieldset>
                                <legend>About</legend>
                                <div class="form-group mb-3">
                                    <label for="first_name">First name</label>
                                    <input type="text" class="form-control" name="firstname" value="<?php echo $row['Firstname']; ?>" id="first_name" autocapitalize="on">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="surname">Surname</label>
                                    <input type="text" class="form-control" name="surname" value="<?php echo $row['Surname']; ?>" id="surname" autocapitalize="on">
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset>
                                <legend>Account</legend>
                                <div class="form-group mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" value="<?php echo $row['Username']; ?>" id="username">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="status">Status</label>
                                    <?php
                                    if ($row['Status'] == 'A') {
                                        ?>
                                        <input type="text" class="form-control" name="status" value="Active" id="status" disabled>
                                        <?php
                                    } else {
                                        ?>
                                        <input type="text" class="form-control" name="status" value="Suspended" id="status" disabled>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset>
                                <legend>Contact</legend>
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $row['Email']; ?>" id="email">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="pn">Phone nubmer</label>
                                    <input type="tel" class="form-control" name="phone_number" value="<?php echo $row['Phone_number']; ?>" id="pn">
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <button type="submit" class="w-100 mb-2 btn btn-lg rounded-4 btn-outline-primary" name="updateprofile">Save</button>
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
