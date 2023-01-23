<?php
include_once('config/security.php');
include_once('includes/header.php');
include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Register new user</h1>
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
                <div class="row">
                    <div class="col-md-12">
                        <form action="logic/registercode.php" method="POST" autocomplete="off">
                            <div class="row">
                                <div class="col-md-4">
                                    <fieldset>
                                        <legend>About</legend>
                                        <div class="form-group mb-3">
                                            <label for="firstname">Firstname<b class="text-danger">*</b></label>
                                            <input type="text" class="form-control rounded-0" name="firstname" id="firstname" minlength="2" maxlength="32" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="surname">Surname<b class="text-danger">*</b></label>
                                            <input type="text" class="form-control rounded-0" name="surname" id="surname" minlength="2" maxlength="32" required>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                    <fieldset>
                                        <legend>Contact</legend>
                                        <div class="form-group mb-3">
                                            <label for="email">Email<b class="text-danger">*</b></label>
                                            <div class="invalid-feedback" data-sb-feedback="emailAddress:required">Email Address is required.</div>
                                            <div class="invalid-feedback" data-sb-feedback="emailAddress:email">Email Address Email is not valid.</div>
                                            <input type="email" class="form-control rounded-0 verify_email" name="email" id="email" data-sb-validations="required,email" required>
                                            <p class="notice_email text-danger"></p>
                                        </div>

                                        <div>
                                            <div class="form-group mb-3">
                                                <label for="phone_number">Phone Number<b class="text-danger">*</b></label>
                                                <input type="text" class="form-control rounded-0 verify_phone_number" name="phone_number" id="phone_number" minlength="10" maxlength="10" required>
                                            </div>
                                            <p class="notice_phone_number text-danger"></p>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                    <fieldset>
                                        <legend>Account</legend>
                                        <div>
                                            <div class="form-group mb-3">
                                                <label for="username">Username<b class="text-danger">*</b></label>
                                                <input type="text" class="form-control rounded-0 verify_username" name="username" id="username" minlength="3" maxlength="16" required>
                                            </div>
                                            <p class="notice_username text-danger"></p>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="password">Password<b class="text-danger">*</b></label>
                                            <input type="password" class="form-control rounded-0" name="password" id="password" minlength="4" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="confirm_password">Confirm Password<b class="text-danger">*</b></label>
                                            <input type="password" class="form-control rounded-0" name="confirm_password" id="confirm_password" minlength="4" required>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <button type="submit" class="w-100 mb-2 btn btn-lg btn-outline-primary rounded-0" name="register">Register</button>
                        </form>
                    </div>
                </div>
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