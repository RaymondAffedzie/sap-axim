<?php
include_once('config/security.php');
include_once('includes/header.php');
include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Member's Societies</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a type="button" href="view-society.php" class="btn btn-sm btn-outline-secondary">View members society</a>
                <a type="button" class="btn btn-sm btn-outline-secondary">Export</a>
            </div>
            <a type="button" class="add-more-form btn btn-sm btn-outline-primary" href="javascript:void(0)">ADD MORE</a>
        </div>
    </div>

    <div class="container-fluid">
        <?php include_once('logic/alerts.php'); ?>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="logic/society-code.php" method="post" autocomplete="off">
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

                                <div class="col-md-5 mb-2">
                                    <div class="form-group">
                                        <label for="society_name">Society name</label>
                                        <select type="text" name="society_name[]" id="society" class="form-control" placeholder="Society Name">
                                            <option value="">None</option>
                                            <option value="Catholic Women Association">Catholic Women Association</option>
                                            <option value="Charismatic Renewal">Charismatic Renewal</option>
                                            <option value="Christian Mothers and Fathers">Christian Mothers and Fathers</option>
                                            <option value="Knight and Ladies of the Alter">Knight and Ladies of the Alter</option>
                                            <option value="Knight and Ladies of St. Johns International">Knight and Ladies of St. John's International</option>
                                            <option value="Knight and Ladies of Marshal">Knight and Ladies of Marshal</option>
                                            <option value="Sacred Heart of Jesus">Sacred heart of Jesus</option>
                                            <option value="Senior Choir">Senior Choir</option>
                                            <option value="St. Anthony Guild">St. Anthony Guild</option>
                                            <option value="St. Cecilia Singing Band">St. Cecilia Singing Band</option>
                                            <option value="St. Theresa of Child Jesus">St. Theresa's of Child Jesus</option>
                                            <option value="Youth Choir">Youth Choir</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-5 mb-2">
                                    <div class="form-group">
                                        <label for="office_held">Office held</label>
                                        <input type="text" name="office_held[]" class="form-control" id="office_held">
                                    </div>
                                </div>

                                <div class="paste-new-forms"></div>

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