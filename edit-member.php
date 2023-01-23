<?php
include_once('config/security.php');
include_once('includes/header.php');
include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Update member's details</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a type="button" href="view-members.php" class="btn btn-sm btn-outline-secondary rounded-0">View Members</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <?php include_once('logic/alerts.php'); ?>
        <div class="card shadow mb-4">
            <div class="card-body">

                <?php
                if (isset($_POST['edit_btn'])) {
                    $id = $_POST['edit_id'];

                    $query = "SELECT * FROM `members` WHERE `Id` = '$id' ";
                    $query_run = mysqli_query($connection, $query);

                    if ($query_run) {
                        while ($row = mysqli_fetch_array($query_run)) {
                ?>
                            <form action="logic/member-code.php" method="POST" autocomplete="off">
                                <input type="hidden" name="member_id" value="<?php echo $id ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control rounded-0 text-center mb-3" value="<?php echo $row['Init'] . $row['Reg_year'] . $row['Id'] ?> " disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control rounded-0 text-center mb-3" value="<?php echo $row['Firstname'] . " " . $row['Other_name'] . " " . $row['Sur_name'] ?> " disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="first_name">First name</label>
                                            <input type="text" class="form-control rounded-0" name="firstname" value="<?php echo $row['Firstname']; ?>" id="first_name" autocapitalize="on">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="surname">Surname</label>
                                            <input type="text" class="form-control rounded-0" name="surname" value="<?php echo $row['Sur_name']; ?>" id="surname" autocapitalize="on">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="other_names">Other names</label>
                                            <input type="text" class="form-control rounded-0" name="othername" value="<?php echo $row['Other_name']; ?>" id="other_names" autocapitalize="on">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="sex">Sex</label>
                                            <input type="text" class="form-control rounded-0" name="sex" value="<?php echo $row['Sex']; ?>" id="sex">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="b_date">Birth Date</label>
                                            <input type="date" class="form-control rounded-0" name="birthdate" value="<?php echo $row['Birth_Date']; ?>" id="b_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="b_place">Birth Place</label>
                                            <input type="text" class="form-control rounded-0" name="birthplace" value="<?php echo $row['Birth_Place']; ?>" id="b_place">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="b_region">Birth Region</label>
                                            <input type="text" class="form-control rounded-0" name="region" value="<?php echo $row['Birth_Region']; ?>" id="b_region">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="b_district">Birth District</label>
                                            <input type="text" class="form-control rounded-0" name="district" value="<?php echo $row['Birth_District']; ?>" id="b_district">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="w-100 mb-2 btn btn-lg rounded-0 btn-outline-primary" name="updateprofile">Save</button>
                            </form>
                <?php
                        }
                    }
                }
                ?>
            </div>
            <div class="card-footer">
                <a href="view-members.php" class="btn btn-outline-danger rounded-0">Cancel</a>
            </div>
        </div>
    </div>

    
    <?php
    include_once('includes/footer.php');
    ?>


    <script src="js/jquery.js"></script>
    <script src="js/custom.js"></script>