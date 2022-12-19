<?php
include_once('config/security.php');
include_once('includes/header.php');
include_once('includes/navbar.php');
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Profile</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a type="button" class="btn btn-sm btn-outline-secondary" href="register-admin.php">Add user</a>
            <a type="button" class="btn btn-sm btn-outline-secondary" href="view-users.php">View users</a>
        </div>
        <a type="button" class="btn btn-sm btn-outline-secondary" href="profile.php">View profile</a>
        </div>
    </div>

<?php include_once('logic/alerts.php'); ?>
<div class="card text-center shadow mb-4">
    <div class="card-body">
        <!-- change profile info -->
        <div class="row">
            <div class="col-md-12">
                <div class="row g-0">
                    <div class="col-md-5">
                        <?php
                        $id = $_SESSION['users']['users_id'];
                        $query = "SELECT * FROM `users` WHERE `Id` = '$id'";
                        $query_run = mysqli_query($connection, $query);
                        if ($query_run) {
                            while ($row = mysqli_fetch_array($query_run)) {
                        ?>
                        <h1 class="display-4 mt-3 text-secondary"><i class="fa fa-user-circle-o"></i><br><?php echo $row['Firstname'] . " " . $row['Surname']; ?></h1>
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <p>Username: <?php echo  $row['Username']; ?></p>
                            <p>Email: <?php echo $row['Email']; ?></p>
                            <p>Phone Number: <?php echo $row['Phone_number']; ?></p>
                            

                            <!-- Edit profile details -->
                            <form action="edit-profile.php" method="POST" class="my-2">
                                <input type="hidden" name="edit_id" value="<?php echo $id ?>">
                                <button type="submit" name="edit_btn" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit member's profile">
                                    <i class="fas fa-edit"></i> Edit details
                                </button>
                            </form>
                            <hr class="my-5">
                            <!-- change password -->
                            <form action="change-password.php" method="POST" class="my-2">
                                <input type="hidden" name="edit_id" value="<?php echo $id ?>">
                                <button type="submit" name="edit_btn" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit member's profile">
                                    <i class="fa fa-key"></i> Change password
                                </button>
                            </form>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    include_once('includes/footer.php');
?>