<?php
include_once('config/security.php');
include_once('includes/header.php');
include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap
     align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add new member's society details</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a type="button" class="btn btn-sm btn-outline-secondary rounded-0"
                 href="view-society.php">View society</a>
                <a type="button" class="btn btn-sm btn-outline-secondary">Add member</a>
            </div>
            <a type="button" class="btn btn-sm btn-outline-secondary rounded-0">Export</a>
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
                                        <input type="text" class="form-control text-center mb-3 rounded-0"
                                         value="<?php echo $row['Init'] . $row['Reg_year'] . $row['Id'] ?> " disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control text-center mb-3 rounded-0"
                                         value="<?php echo $row['Firstname'] . " " . $row['Other_name'] . " " . $row['Sur_name'] ?> " disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="sn">Society name</label>
                                            <select type="text" name="society_name" id="society"
                                             class="form-control rounded-0" placeholder="Society Name">
                                            <option value="">None</option>
                                            <option value="Catholic Women Association">
                                                Catholic Women Association
                                            </option>
                                            <option value="Charismatic Renewal">
                                                Charismatic Renewal
                                            </option>
                                            <option value="Christian Mothers and Fathers">
                                                Christian Mothers and Fathers
                                            </option>
                                            <option value="Knight and Ladies of the Alter">
                                                Knight and Ladies of the Alter
                                            </option>
                                            <option value="Knight and Ladies of St. John\'s International">
                                                Knight and Ladies of St. John's International
                                            </option>
                                            <option value="Knight and Ladies of Marshal">
                                                Knight and Ladies of Marshal
                                            </option>
                                            <option value="Sacred Heart of Jesus">
                                                Sacred heart of Jesus
                                            </option>
                                            <option value="Senior Choir">
                                                Senior Choir
                                            </option>
                                            <option value="St. Anthony Guild">
                                                St. Anthony Guild
                                            </option>
                                            <option value="St. Cecilia Singing Band">
                                                St. Cecilia Singing Band
                                            </option>
                                            <option value="St. Theresa\' of the Child Jesus">
                                                St. Theresa's of the Child Jesus
                                            </option>
                                            <option value="Youth Choir">Youth Choir</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="oh">Office held</label>
                                            <input type="text" class="form-control rounded-0" name="office_held" id="oh" autocapitalize="on">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="w-100 mb-2 btn btn-lg rounded-0 btn-outline-primary" name="save">
                                    Save
                                </button>
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

   
    <?php
    include_once('includes/footer.php');
    ?>

    <script src="js/jquery.js"></script>
    <script src="js/custom.js"></script>