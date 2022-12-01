<?php
include_once('logic/control.php');
include_once('includes/header.php');
?>

<div class="container-fluid d-flex align-items-center justify-content-center" style=" width: 100vw; height:100vh; background-image: linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%); background-size: 100vw 100vh;">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-lg rounded-0">
                <div class="card-body">
                    <!-- alerts notice  -->
                    <?php include_once('logic/alerts.php'); ?>
                    <h3 class="text-center text-dark pt-3">Verify Code</h3>
                    <form action="logic/verify-user-code.php" method="post">
                        <div class="form-group mb-3">
                            <label for="code">Enter Code</label>
                            <input type="number" class="form-control" name="verify-code" id="code" minlength="6" required>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" name="confirm-code" class="btn btn-outline-primary w-100">Confirm</button>
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
    include('includes/scripts.php');
?>