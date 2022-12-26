<?php
    include_once('config/security.php');
    include_once('includes/header.php');
    include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap
     align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add new member</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a type="button" class="btn btn-sm btn-outline-secondary rounded-0" href="view-members.php">
                    View member
                </a>
                <!-- <a type="button" class="btn btn-sm btn-outline-secondary rounded-0" href="add-member.php">Add member</a> -->
            </div>
        </div>
    </div>
    

    <div class="container-fluid">
        <?php include_once('logic/alerts.php'); ?>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="logic/member-code.php" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="firstname">First name</label>
                                <input type="text" class="form-control rounded-0" name="firstname"
                                 id="firstname" minlength="2" maxlength="32" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="surname">Surname</label>
                                <input type="text" class="form-control rounded-0" name="surname"
                                 id="surname" minlength="2" maxlength="32" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="othername">Other name</label>
                                <input type="text" class="form-control rounded-0" name="othername"
                                 id="othername" minlength="2" maxlength="32">
                            </div>

                            <fieldset>
                                <legend>Sex</legend>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="sex" id="male" value="M">
                                    <label for="male" class="form-check-label">Male</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="sex" id="female" value="F">
                                    <label for="female" class="form-check-label">Female</label>
                                </div>
                            </fieldset>
                        
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="birthdate">Date of Birth</label>
                                <input type="date" class="form-control rounded-0" name="birthdate"
                                 id="birthdate" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="birthplace">Place of Birth</label>
                                <input type="text" class="form-control rounded-0" name="birthplace"
                                 id="birthplace" minlength="2" maxlength="32" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="region">Birth Region</label>
                                <select class="form-control rounded-0" name="region" id="country">
                                    <option value="">Select birth region</option>
                                </select>
                            </div>

                            <div class="form-group mb-3" id="state-code">
                                <label for="state">District</label>
                                <input type="text" class="form-control rounded-0" name="district" id="state">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-100 my-3  btn btn-lg rounded-0 btn-outline-primary" name="add">
                        Register
                    </button>
                </form>
            </div>
        </div>
    </div>

    
<?php
    include_once('includes/footer.php');
?>

    <!-- script for regions and districts in ghana -->
    <script src="js/region-districts.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/custom.js"></script>