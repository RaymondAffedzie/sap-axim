<?php
    include_once('config/security.php');
    include_once('includes/header.php');
    include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Update member's society details</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a type="button" href="view-society.php" class="btn btn-sm btn-outline-secondary">View society</a>
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
                        $mem_id = $_POST['mem_id'];

                        $query = "SELECT * FROM `society` WHERE `Id` = '$id' ";
                        $query_run = mysqli_query($connection, $query);

                        if ($query_run) {
                            while ($row = mysqli_fetch_array($query_run)) {
                ?>
                <form action="logic/society-code.php" method="POST" autocomplete="off">
                    <input type="hidden" name="member_id" value="<?php echo $id ?>">
                    <div class="row">
                        <?php
                            $sql ="SELECT `Id`, `Reg_year`, `Init`, `Firstname`, `Sur_name`,
                            `Other_name` FROM `members` WHERE `Id` = '$mem_id'";
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
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="sn">Society name</label>
                                <input type="text" class="form-control" name="society_name" value="<?php echo $row['Society_name']; ?>" id="sn" autocapitalize="on">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="oh">Office held</label>
                                <input type="text" class="form-control" name="office_held" value="<?php echo $row['Position_held']; ?>" id="oh">
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
                <a href="view-society.php" class="btn btn-outline-danger">Cancel</a>
            </div>
        </div>
    </div>

    <!-- script for regions and districts in ghana -->
    <script src="js/region-districts.js"></script>
    <script src="js/region-districts-code.js"></script>
<?php
    include_once('includes/footer.php');
?>
