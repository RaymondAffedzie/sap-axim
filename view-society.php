<?php
include_once('config/security.php');
include_once('includes/header.php');
include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Societies</h1>
        <input id="live_search" class="form-control w-50 rounded-0" type="text" placeholder="Search..." autocomplete="off">
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a type="button" class="btn btn-sm btn-outline-secondary rounded-0" href="view-society.php" >View society</a>
                <a type="button" class="btn btn-sm btn-outline-secondary rounded-0" href="add-member.php">Add member</a>
            </div>
            <a type="button" class="btn btn-sm btn-outline-primary rounded-0">Export data</a>
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
                            $query = "SELECT society.Id, society.MiD, society.Society_name, society.Position_held, members.Init, members.Reg_year, members.Firstname, members.Sur_name, members.Other_name FROM society LEFT JOIN members ON members.Id = society.MiD ORDER BY society.Society_name ASC";
                            $query_run = mysqli_query($connection, $query);
                            $counter = 0;
                            ?>
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">SN</th>
                                        <th scope="col">Member Id</th>
                                        <th scope="col" class="text-wrap" style="width: 400px;">Member's name</th>
                                        <th scope="col" class="text-wrap" style="width: 600px;">Society name</th>
                                        <th scope="col" class="text-wrap" style="width: 300px;">Office held</th>
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
                                                    <p> <?php echo $row['Init'] . $row['Reg_year'] . $row['MiD']; ?> </p> <!-- MiD is member id from members table inside society table -->
                                                </td>
                                                <td class="text-wrap" style="width: 400px;">
                                                    <p> <?php echo $row['Firstname'] . " " . $row['Other_name'] . " " . $row['Sur_name']; ?> </p>
                                                </td>
                                                <td class="text-wrap" style="width: 600px;">
                                                    <p> <?php echo $row['Society_name']; ?> </p>
                                                </td>
                                                <td class="text-wrap" style="width: 400px;">
                                                    <p> <?php echo $row['Position_held']; ?> </p>
                                                </td>
                                                <td>
                                                    <form action="member-profile.php" method="post">
                                                        <input type="hidden" name="member_id" value="<?php echo $row['MiD']; ?>" hidden> <!-- MiD is member id from members table inside society table -->
                                                        <button type="submit" class="btn btn-outline-secondary" name="view-member" data-bs-toggle="tooltip" data-bs-placement="left" title="View member's profile">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="logic/society-code.php" method="post">
                                                        <input type="hidden" name="society_id" value="<?php echo $row['Id']; ?>"> <!-- society table id is used -->
                                                        <button type="submit" name="delete_society" class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="left" title="Delete this member's society" onclick="return confirm('Do you want to delete members society')">
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