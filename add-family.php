<?php
include_once('config/security.php');
include_once('includes/header.php');
include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap
     align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Member's Family</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a type="button" href="view-address.php" class="btn btn-sm btn-outline-secondary">
                    View members family
                </a>
                <!-- <a type="button" class="btn btn-sm btn-outline-secondary" href="add-family.php">Add family</a> -->
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <?php include_once('logic/alerts.php'); ?>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="logic/family-code.php" method="post" autocomplete="off">
                    <div class="row">
                        <?php
                        $query = "SELECT * FROM `members` ORDER BY `Id` DESC LIMIT 1";
                        $query_run = mysqli_query($connection, $query);
                        if ($query_run) {
                            while ($row = mysqli_fetch_array($query_run)) {
                        ?>
                                <!-- will be inserted into the database as a foreign key -->
                                <input type="hidden" name="member-id" class="form-control mb-2 rounded-0"
                                 value="<?php echo $row['Id']; ?>">

                                <!-- Displays the member's ID to the page -->
                                <div class="form-group">
                                    <label for="full-member-id">Member ID</label>
                                    <input type="text" name="full-member-id" id="full-member-id"
                                     class="form-control mb-2 rounded-0"
                                      value="<?php echo $row['Init'] . $row['Reg_year'] . $row['Id']; ?>" disabled>
                                </div>

                                <div class="col-md-4">
                                    <fieldset>
                                        <legend>Father</legend>
                                        <div class="form-group mb-3">
                                            <label for="father_name">Father's name</label>
                                            <input type="text" class="form-control rounded-0" name="father_name"
                                             id="father_name" min="0" required>
                                        </div>

                                        <legend>Status</legend>
                                        <div class="form-check">
                                            <label for="f_status" class="form-check-label">Alive</label>
                                            <input type="radio" class="form-check-input " name="f_status"
                                             id="f_status" value="A">
                                        </div>
                                        <div class="form-check">
                                            <label for="f_deceased" class="form-check-label">Deceased</label>
                                            <input type="radio" class="form-check-input" name="f_status"
                                             id="f_deceased" value="D">
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-md-4">
                                    <fieldset>
                                        <legend>Mother</legend>
                                        <div class="form-group mb-3">
                                            <label for="mother_name">Mother's name</label>
                                            <input type="text" class="form-control rounded-0" name="mother_name"
                                             id="mother_name" min="0" required>
                                        </div>

                                        <legend>Status</legend>
                                        <div class="form-check">
                                            <label for="m_alive" class="form-check-label">Alive</label>
                                            <input type="radio" class="form-check-input" name="m_status"
                                             id="m_alive" value="A">
                                        </div>
                                        <div class="form-check">
                                            <label for="m_deceased" class="form-check-label">Deceased</label>
                                            <input type="radio" class="form-check-input" name="m_status"
                                             id="m_deceased" value="D">
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="col-md-4">
                                    <fieldset>
                                        <legend>Next of Kin</legend>
                                        <div class="form-group mb-3">
                                            <label for="kin_name">Kin's name</label>
                                            <input type="text" class="form-control rounded-0" name="kin_name"
                                             id="kin_name" min="0" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="tel" class="form-control rounded-0" name="phone_number"
                                             id="phone_number" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="gps_address">GPS Address</label>
                                            <input type="text" class="form-control rounded-0" name="gps_address"
                                             id="gps_address" required>
                                        </div>
                                    </fieldset>
                                </div>
                    </div>
                    <button type="submit" class="w-100 my-3  btn btn-lg rounded-0 btn-outline-primary" name="add">
                        Submit
                    </button>
                </form>
        <?php
                            }
                        }
        ?>
            </div>
        </div>
    </div>


    <?php
    include_once('includes/footer.php');
    ?>

    <script src="js/jquery.js"></script>
    <script src="js/custom.js"></script>