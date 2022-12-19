<?php
    include_once('config/security.php');
    include_once('includes/header.php');
    include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add new member's society details</h1>
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
                    if (isset($_POST['add_soceity'])) {
                        $mem_id = $_POST['mem_id'];

                        $query = "SELECT * FROM `members` WHERE `Id` = '$mem_id' ";
                        $query_run = mysqli_query($connection, $query);

                        if ($query_run) {
                            while ($row = mysqli_fetch_array($query_run)) {
                ?>
                <form action="logic/society-code.php" method="POST" autocomplete="off">
                    <input type="hidden" name="member-id" value="<?php echo $mem_id ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control text-center mb-3" value="<?php echo $row['Init'].$row['Reg_year'].$row['Id'] ?> " disabled>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control text-center mb-3" value="<?php echo $row['Firstname']." ".$row['Other_name']." ".$row['Sur_name'] ?> " disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="sn">Society name</label>
                                <input type="text" class="form-control" name="society_name" id="sn" autocapitalize="on">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="oh">Office held</label>
                                <input type="text" class="form-control" name="office_held" id="oh" autocapitalize="on">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-100 mb-2 btn btn-lg rounded-4 btn-outline-primary" name="save">Save</button>
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