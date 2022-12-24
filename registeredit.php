<?php
include_once('config/security.php');
include_once('includes/header.php');
include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Update user's profile</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <?php
                        include_once('logic/alerts.php');

                        if (isset($_POST['edit_btn'])) {
                            $id = $_POST['edit_id'];

                            $query = "SELECT * FROM `users` WHERE `Id` = '$id' ";
                            $query_run = mysqli_query($connection, $query);

                            if ($query_run) {
                                while ($row = mysqli_fetch_array($query_run)) {
                        ?>
                                    <form action="logic/registercode.php" method="post" autocomplete="off">
                                        <input type="hidden" name="id" value="<?php echo $row['Id'] ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label for="username">Username<b class="text-danger">*</b></label>
                                                    <input type="text" class="form-control" name="username" value="<?php echo $row['Username']; ?>" id="username" minlength="3" maxlength="16" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="email">Email<b class="text-danger">*</b></label>
                                                    <input type="email" class="form-control" name="email" value="<?php echo $row['Email']; ?>" id="email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-groupg mb-3">
                                                    <label for="password">Password<b class="text-danger">*</b></label>
                                                    <input type="password" class="form-control" name="new_password" id="password" minlength="6" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="con_password">Confirm Password<b class="text-danger">*</b></label>
                                                    <input type="password" class="form-control" name="con_password" id="con_password" minlength="6" required>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="w-100 mb-2 btn btn-outline-primary" name="update-user-profile">Save</button>
                                    </form>
                        <?php
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="card-footer">
                        <a href="view-users.php" class="btn btn-outline-danger">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once('includes/footer.php');
    ?>

    <script src="js/jquery.js"></script>
    <script src="js/custom.js"></script>