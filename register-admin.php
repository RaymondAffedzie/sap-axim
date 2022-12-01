<?php
include_once('config/security.php');
include_once('includes/header.php');
include_once('includes/navbar.php');

?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">All Registered User's</h1>
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
<!-- Modal -->
<div class="modal fade modal-signin" id="add_admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-plus"></i>Register Admininistrator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="logic/registercode.php" method="POST" autocomplete="off">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname" minlength="2" maxlength="32" required>
                        <label for="firstname">Firstname</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="surname" id="surname" placeholder="Surname" minlength="2" maxlength="32" required>
                        <label for="surname">Surname</label>
                    </div>

                    <div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control verify_username" name="username" id="username" placeholder="Username" minlength="4" maxlength="32" aria-label="Username" aria-describedby="basic-addon1" required>
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <p class="notice_username text-danger"></p>
                    </div>

                    <div class="form-floating mb-3">
                        <div class="invalid-feedback" data-sb-feedback="emailAddress:required">Email Address is required.</div>
                        <div class="invalid-feedback" data-sb-feedback="emailAddress:email">Email Address Email is not valid.</div>
                        <input type="email" class="form-control verify_email" name="email" id="email" placeholder="Email" data-sb-validations="required,email" required>
                        <label for="email">Email</label>
                        <p class="notice_email text-danger"></p>
                    </div>

                    <div>
                        <label for="phone_number">Phone Number</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">+233 (0)</span>
                            <input type="text" class="form-control verify_phone_number" name="phone_number" id="phone_number" placeholder="eg. 024 000 000 0000" patter="^\+?(\233?|0)\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}?" minlength="10" maxlength="16" required>
                        </div>
                        <p class="notice_phone_number text-danger"></p>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" minlength="4" required>
                        <label for="password">Password</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" minlength="4" required>
                        <label for="confirm_password">Confirm Password</label>
                    </div>

                    <hr class="my-4">

                    <button type="submit" class="w-100 mb-2 btn btn-lg rounded-4 btn-outline-primary" name="register">Register</button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <!-- Button trigger modal -->
            <h3 class="font-weight-bold m-0 text-primary">Registered users
                <button type="button" class="btn btn-primary ml-5 float-end" data-bs-toggle="modal" data-bs-target="#add_admin">
                    <i class="fa fa-user-plus"></i> Add user
                </button>
            </h3>

        </div>
        <div class="card-body">

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
                            <th scope="col" colspan="3" class="text-center text-bg-secondary">Actions</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
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
        <!-- no card footer -->
    </div>
</div>

<?php
    include('includes/footer.php');
?>