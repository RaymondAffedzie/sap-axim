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
        <?php include_once('logic/alerts.php'); ?>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="logic/add-member-code.php" method="post" autocomplete="off">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname" minlength="2" maxlength="32" required>
                                <label for="firstname">First name</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="surname" id="surname" placeholder="Surname" minlength="2" maxlength="32" required>
                                <label for="surname">Surname</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="othername" id="othername" placeholder="othername" minlength="2" maxlength="32" required>
                                <label for="othername">Other name</label>
                            </div>

                            <fieldset>
                                <legend>Sex</legend>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="sex" id="male" value="male">
                                    <label for="male" class="form-check-label">Male</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="sex" id="female" value="female">
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
                            <select class="form-control" name="region" id="region">
                                <option value="">Select birth region</option>
                                <option value="Ahafo">Ahafo Region</option>
                                <option value="Ashanti">Ashanti Region</option>
                                <option value="Bono">Bono Region</option>
                                <option value="Bono East">Bono East Region</option>
                                <option value="Central">Central Region</option>
                                <option value="Eastern">Eastern Region</option>
                                <option value="Greater Accra">Greater Accra Region</option>
                                <option value="Northern">Northern Region</option>
                                <option value="North East">North East Region</option>
                                <option value="Oti">Oti Region</option>
                                <option value="Savannah">Savannah Region</option>
                                <option value="Upper East">Upper East Region</option>
                                <option value="Upper West">Upper West Region</option>
                                <option value="Volta">Volta Region</option>
                                <option value="Western">Western Region</option>
                                <option value="Western North">Western North Region</option>
                            </select>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="district" id="district" placeholder="Nzema East" minlength="2" maxlength="32">
                            <label for="district">Birth District</label>
                        </div>
                    </div>
                    <button type="submit" class="w-100 my-3  btn btn-lg rounded-4 btn-outline-primary" name="add">Register</button>
                </div>
            </div>
        </div>
    </div>


<?php
    include_once('includes/footer.php');
?>