<?php
    include_once('config/security.php');
    include_once('includes/header.php');
    include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add new member</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a type="button" href="view-members.php" class="btn btn-sm btn-outline-secondary">View Members</a>
            <a type="button" class="btn btn-sm btn-outline-secondary">Export</a>
          </div>
          <a type="button" class="btn btn-sm btn-outline-secondary" href="add-member.php">Add member</a>
        </div>
    </div>
    

    <div class="container-fluid">
        <?php include_once('logic/alerts.php'); ?>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="logic/member-code.php" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname" minlength="2" maxlength="32" required>
                                <label for="firstname">First name</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="surname" id="surname" placeholder="Surname" minlength="2" maxlength="32" required>
                                <label for="surname">Surname</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="othername" id="othername" placeholder="othername" minlength="2" maxlength="32">
                                <label for="othername">Other name</label>
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
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" name="birthdate" id="birthdate" required>
                                <label for="birthdate">Date of Birth</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="birthplace" id="birthplace" placeholder="Takoradi" minlength="2" maxlength="32" required>
                                <label for="birthplace">Place of Birth</label>
                            </div>

                            <div class="form-group mb-3">
                                <label for="region">Birth Region</label>
                                <select class="form-control" name="region" id="country">
                                    <option value="">Select birth region</option>
                                </select>
                            </div>

                            <div class="form-group mb-3" id="state-code">
                                <input type="text" class="form-control" name="district" id="state">
                                <label for="state">District</label>
                            </div>
                        </div>
                        <button type="submit" class="w-100 my-3  btn btn-lg rounded-4 btn-outline-primary" name="add">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- script for regions and districts in ghana -->
    <script src="js/region-districts.js"></script>
    <script src="js/region-districts-code.js"></script>
<?php
    include_once('includes/footer.php');
?>