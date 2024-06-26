<?php
include_once('config/security.php');
include_once('includes/header.php');
include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap
     align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Members</h1>
        <input id="live_search" class="form-control w-50 rounded-0" type="search"
         placeholder="Search..." autocomplete="off">
        <div class="btn-toolbar mb-2 mb-md-0">
            <form action="export.php" method="post">
                <div class="btn-group me-2">
                    <select type="button" class="btn btn-sm btn-outline-secondary rounded-0" name="export_file_type">
                        <option value="">Select file type</option>
                        <option value="xlsx">XLSX</option>
                        <option value="xls">XLS</option>
                        <option value="csv">CSV</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-outline-primary rounded-0" name="export_excel_btn">
                        Export data
                    </button>
                </div>
            </form>
            <div class="btn-group me-2">
                <a type="button" class="btn btn-sm btn-outline-success rounded-0" href="view-members.php">
                View members
                </a>
            </div>
        </div>
    </div>

    <!-- display live search result -->
    <div id="searchresult"></div>
    
    <div class="container-fluid" id="element">
        <?php include_once('logic/alerts.php'); ?>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <?php
                            include_once('logic/alerts.php');
                            $query = "SELECT * FROM `members`";
                            $query_run = mysqli_query($connection, $query);
                            $counter = 0;
                            ?>
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">SN</th>
                                        <th scope="col">Member Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Sex</th>
                                        <th scope="col">Birth Date</th>
                                        <th scope="col">Birth Place</th>
                                        <th scope="col">Birth Region</th>
                                        <th scope="col">Birth District</th>
                                        <th scope="col">View</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($query_run) {
                                        while ($row = mysqli_fetch_array($query_run)) {
                                            $counter++;
                                    ?>
                                            <tr>
                                                <td>
                                                    <p> <?php echo $counter; ?> </p>
                                                </td>
                                                <td class="text-wrap">
                                                    <p> <?php echo $row['Init'] . $row['Reg_year'] . $row['Id']; ?> </p>
                                                </td>
                                                <td class="text-wrap" style="width: 300px;">
                                                    <p> <?php echo $row['Firstname'] . " " . $row['Other_name'] . " " . $row['Sur_name']; ?> </p>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($row['Sex'] == "M") {
                                                    ?>
                                                        <p>Male</p>
                                                    <?php
                                                    } elseif ($row['Sex'] == "F") {
                                                    ?>
                                                        <p>Female</p>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <p> <?php echo $row['Birth_Date']; ?> </p>
                                                </td>
                                                <td>
                                                    <p> <?php echo $row['Birth_Place']; ?> </p>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($row['Birth_Region'] == "AH") {
                                                    ?>
                                                        <p>Ahafo</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "AS") {
                                                    ?>
                                                        <p>Ashanti</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "BR") {
                                                    ?>
                                                        <p>Bono</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "BE") {
                                                    ?>
                                                        <p>Bono East</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "CR") {
                                                    ?>
                                                        <p>Central</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "ER") {
                                                    ?>
                                                        <p>Eastern</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "GA") {
                                                    ?>
                                                        <p>Greater Accra</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "NR") {
                                                    ?>
                                                        <p>Northern</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "NE") {
                                                    ?>
                                                        <p>North East</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "OR") {
                                                    ?>
                                                        <p>Oti</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "SR") {
                                                    ?>
                                                        <p>Savannah</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "UE") {
                                                    ?>
                                                        <p>Upper East</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "UW") {
                                                    ?>
                                                        <p>Upper West</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "VR") {
                                                    ?>
                                                        <p>Volta</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "WR") {
                                                    ?>
                                                        <p>Western</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "WN") {
                                                    ?>
                                                        <p>Western North</p>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <p> <?php echo $row['Birth_District']; ?> </p>
                                                </td>
                                                <td>
                                                    <form action="member-profile.php" method="post">
                                                        <input type="hidden" name="member_id" value="<?php echo $row['Id']; ?>" hidden>
                                                        <button type="submit" class="btn btn-outline-secondary rounded-0" name="view-member" data-bs-toggle="tooltip" data-bs-placement="left" title="View member's profile">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="logic/member-code.php" method="post">
                                                        <input type="hidden" name="member_id" value="<?php echo $row['Reg_year'] . $row['Id']; ?>">
                                                        <button type="submit" name="delete_member" class="btn btn-outline-danger rounded-0" data-bs-toggle="tooltip" data-bs-placement="left" title="Delete this member" onclick="return confirm('Do you want to delete this member')">
                                                            <i class="fa fa-trash-o"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    include_once('includes/footer.php');

    /**
     * query for selecting specific member details
     * SELECT `Firstname`, `Sur_name`, `Other_name`, `Sex`, `Birth_Date`, `Birth_Place`, `Birth_Region`, `Birth_District` FROM members WHERE CONCAT(`Init`,`Reg_year`,`Id`) LIKE "SAP%";
     * query for selecting all member details
     * SELECT * FROM `members` WHERE CONCAT(`Init`,`Reg_year`,`Id`) = "SAP20221";
     * query for updating member details
     * UPDATE `members` SET `Firstname`='Raymond' WHERE CONCAT(`Init`,`Reg_year`,`Id`) = "SAP20221";
     */
    ?>

    <script src="js/jquery.js"></script>
    <script src="js/custom.js"></script>