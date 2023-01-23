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
                <a type="button" class="btn btn-sm btn-outline-secondary rounded-0" href="register-admin.php">Add user</a>
                <a type="button" class="btn btn-sm btn-outline-secondary rounded-0" href="view-users.php">View users</a>
            </div>
            <a type="button" class="btn btn-sm btn-outline-success rounded-0" href="profile.php">View profile</a>
        </div>
    </div>

    <!-- display live search result -->
    <div id="searchresult"></div>

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
                                    <th scope="col">View</th>
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
                                                <form action="users-profile.php" method="post">
                                                    <input type="hidden" name="user_id" value="<?php echo $row['Id']; ?>">
                                                    <button type="submit" name="view_user" class="btn btn-outline-secondary rounded-0" data-bs-toggle="tooltip" data-bs-placement="left" title="View user's Profile">
                                                        <i class="fa fa-eye"></i>
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

    <script src="js/jquery.js"></script>
    <script src="js/custom.js"></script>