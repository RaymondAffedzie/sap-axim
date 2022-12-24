<?php
include_once('config/security.php');
include_once('includes/header.php');
include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Member's Personal Infomation</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a type="button" href="view-other-info.php" class="btn btn-sm btn-outline-secondary">View other info</a>
                <a type="button" class="btn btn-sm btn-outline-secondary">Export</a>
            </div>
            <a type="button" class="btn btn-sm btn-outline-secondary" href="add-member.php">Add member</a>
        </div>
    </div>

    <div class="container-fluid">
        <?php include_once('logic/alerts.php'); ?>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="logic/other-info-code.php" method="post" autocomplete="off">
                    <div class="row">
                        <?php
                            $query = "SELECT * FROM `members` ORDER BY `Id` DESC LIMIT 1";
                            $query_run = mysqli_query($connection, $query);
                            if ($query_run) {
                                while ($row = mysqli_fetch_array($query_run)) {
                        ?>
                                    <!-- will be inserted into the database as a foreign key -->
                                    <input type="hidden" name="member-id" class="form-control mb-2" value="<?php echo $row['Id']; ?>">

                                    <!-- Displays the member's ID to the page -->
                                    <div class="form-group">
                                        <label for="full-member-id">Member ID</label>
                                        <input type="text" name="full-member-id" id="full-member-id" class="form-control mb-2" value="<?php echo $row['Init'] . $row['Reg_year'] . $row['Id']; ?>" disabled>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-floating mb-3">
                                            <select class="form-control" name="marital_status" id="marital_status" required>
                                                <option value="">Select status</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Divorced">Divorced</option>
                                                <option value="Widowed">Widowed</option>
                                            </select>
                                            <label for="marital_status">Marital Status</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" name="children_number" id="children_number" required>
                                            <label for="children_number">Number of Children</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-floating mb-3">
                                            <select class="form-control" name="education_level" id="education_level" required>
                                                <option value="">Select Education Level</option>
                                                <option value="none">None</option>
                                                <option value="Basic">Basic</option>
                                                <option value="JSS/JHS">JSS/JHS</option>
                                                <option value="SSS/SHS">SSS/SHS</option>
                                                <option value="Tertiary">Tertiary</option>
                                                <option value="Post Graduate">Post Graduate</option>
                                            </select>
                                            <label for="education_level">Education Level</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="occupation" id="occupation" min="0">
                                            <label for="occupation">Occupation</label>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        ?>
                        <button type="submit" class="w-100 my-3  btn btn-lg rounded-4 btn-outline-primary" name="add">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <?php
    include_once('includes/footer.php');
    ?>
    
    <script src="js/jquery.js"></script>
    <script src="js/custom.js"></script>