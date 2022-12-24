<?php
    include_once('config/security.php');
    include_once('includes/header.php');
    include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Update member's address</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a type="button" href="view-address.php" class="btn btn-sm btn-outline-secondary">View address</a>
            <a type="button" class="btn btn-sm btn-outline-secondary">Export</a>
          </div>
          <a type="button" class="btn btn-sm btn-outline-secondary" href="#">Add member</a>
        </div>
    </div>
    
    <div class="container-fluid">
        <?php include_once('logic/alerts.php'); ?>
        <div class="card shadow mb-4">
            <div class="card-body">
               
                <?php
                    if (isset($_POST['edit_btn'])) {
                        $id = $_POST['edit_id'];

                        $query = "SELECT * FROM `address` WHERE `MiD` = '$id' ";
                        $query_run = mysqli_query($connection, $query);

                        if ($query_run) {
                            while ($row = mysqli_fetch_array($query_run)) {
                ?>
                <form action="logic/address-code.php" method="POST" autocomplete="off">
                    <input type="hidden" name="member_id" value="<?php echo $id ?>">
                    <div class="row">
                        <?php
                            $sql ="SELECT `Id`, `Reg_year`, `Init`, `Firstname`, `Sur_name`,
                            `Other_name` FROM `members` WHERE `Id` = '$id'";
                            $sql_run = mysqli_query($connection, $sql);
                            if ($sql_run) {
                                while ($fetch = mysqli_fetch_array($sql_run)) {
                        ?>
                        <div class="col-md-6">
                            <input type="text" class="form-control text-center mb-3" value="<?php echo $fetch['Init'].$fetch['Reg_year'].$fetch['Id'] ?> " disabled>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control text-center mb-3" value="<?php echo $fetch['Firstname']." ".$fetch['Other_name']." ".$fetch['Sur_name'] ?> " disabled>
                        </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="sn">Street name</label>
                                <input type="text" class="form-control" name="street_name" value="<?php echo $row['Street_name']; ?>" id="sn" autocapitalize="on">
                            </div>
                            <div class="form-group mb-3">
                                <label for="hn">House number</label>
                                <input type="text" class="form-control" name="house_number" value="<?php echo $row['House_number']; ?>" id="hn" autocapitalize="on">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="gps">GPS address</label>
                                <input type="text" class="form-control" name="gps_address" value="<?php echo $row['GPS_address']; ?>" id="gps" autocapitalize="on">
                            </div>
                            <div class="form-group mb-3">
                                <label for="post">Postal address</label>
                                <input type="text" class="form-control" name="post_address" value="<?php echo $row['Postal_address']; ?>" id="post" autocapitalize="on">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="phone">Phone number</label>
                                <input type="tel" class="form-control" name="phone" value="<?php echo $row['Phone_number']; ?>" id="phone">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo $row['Email']; ?>" id="email">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-100 mb-2 btn btn-lg rounded-4 btn-outline-primary" name="update">Save</button>
                </form>
                <?php
                            }
                        }
                    }
                ?>
            </div>
            <div class="card-footer">
                <a href="view-address.php" class="btn btn-outline-danger">Cancel</a>
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