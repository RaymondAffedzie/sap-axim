<?php
include_once('config/control.php');
include_once('includes/header.php');
?>

<div class="container-fluid d-flex align-items-center justify-content-center" style=" width: 100vw; height:100vh; background-image: linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%); background-size: 100vw 100vh;">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-lg rounded-0">
                <div class="card-body">
                    <h3 class="text-center text-dark pt-3">Reset Password</h3>
                    <!-- alerts notice  -->
                    <form action="logic/password-reset-code.php" method="POST">
                        <?php include_once('logic/alerts.php') ?>
                        <div class="form-group mb-3">
                            <label for="npswd">New Password</label>
                            <input type="password" class="form-control" name="new_password" id="npswd" placeholder="Password" minlength="6" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="cpswd">Confirm Password</label>
                            <input type="password" class="form-control" name="con_password" id="cpswd" placeholder="Password" minlength="6" required>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" name="save-pwd" class="btn btn-outline-primary w-100">Create password</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <p><a class="text-decoration-none" href="login.php">Password Remembered!</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php
    include('includes/footer.php');
?>