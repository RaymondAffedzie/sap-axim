<?php
    include_once('config/security.php');
    include_once('includes/header.php');
    include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Members society</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a type="button" href="view-church.php" class="btn btn-sm btn-outline-secondary">View society</a>
                <a type="button" class="btn btn-sm btn-outline-secondary">Export</a>
            </div>
            <a type="button" class="btn btn-sm btn-outline-secondary" href="add-society.php">Add society</a>
        </div>
    </div>

    <div class="container-fluid">
        <?php include_once('logic/alerts.php'); ?>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <?php
                                include_once('logic/alerts.php');
                                $query = "SELECT society.Id, society.MiD, society.Society_name, society.Position_held, members.Id, members.Init, members.Reg_year, members.Firstname, members.Sur_name, members.Other_name FROM society LEFT JOIN members ON members.Id = society.MiD ORDER BY society.MiD ASC";
                                $query_run = mysqli_query($connection, $query);
                                $counter = 0;
                            ?>
                            <table class="table table-hover table-sm">
                                <thead>
                                <tr>
                                        <th scope="col">SN</th>
                                        <th scope="col">Member Id</th>
                                        <th scope="col" class="text-wrap" style="width: 400px;">Member's name</th>
                                        <th scope="col" class="text-wrap" style="width: 400px;">Society name</th>
                                        <th scope="col" class="text-wrap" style="width: 300px;">Office held</th>
                                        <th scope="col">View</th>
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
                                                    <p> <?php echo $row['Init'].$row['Reg_year'].$row['Id']; ?> </p>
                                                </td>
                                                <td class="text-wrap" style="width: 400px;">
                                                    <p> <?php echo $row['Firstname']." ".$row['Other_name']." ".$row['Sur_name']; ?> </p>
                                                </td>
                                                <td class="text-wrap" style="width: 400px;">
                                                    <p> <?php echo $row['Society_name']; ?> </p>
                                                </td>
                                                <td class="text-wrap" style="width: 400px;">
                                                    <p> <?php echo $row['Position_held']; ?> </p>
                                                </td>
                                                <td>
                                                    <form action="member-profile.php" method="post">
                                                        <input type="hidden" name="member_id" value="<?php echo $row['Init'].$row['Reg_year'].$row['Id']; ?>" hidden>
                                                        <button type="submit" class="btn btn-outline-secondary" name="view-member" data-bs-toggle="tooltip" data-bs-placement="left" title="View member's profile">
                                                            <i class="fa fa-eye"></i>
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