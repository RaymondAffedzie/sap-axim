<?php
    include_once('config/security.php');
    include_once('includes/header.php');
    include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">All Members Address</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a type="button" href="view-address.php" class="btn btn-sm btn-outline-secondary">View address</a>
                <a type="button" class="btn btn-sm btn-outline-secondary">Export</a>
            </div>
            <a type="button" class="btn btn-sm btn-outline-secondary" href="add-member.php">Add member</a>
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
                                $query = "SELECT family.Id, family.MiD, family.Mother_name, family.M_decease, family.Father_name, family.F_decease, family.Next_of_kin, family.NoK_contact, family.NoK_GPS_address, members.Id, members.Init, members.Reg_year, members.Firstname, members.Sur_name, members.Other_name FROM family LEFT JOIN members ON members.Id = family.MiD ORDER BY members.Id ASC";
                                $query_run = mysqli_query($connection, $query);
                                $counter = 0;
                            ?>
                            <table class="table table-hover table-sm">
                                <thead>
                                <tr>
                                        <th scope="col">SN</th>
                                        <th scope="col">Member Id</th>
                                        <th scope="col" class="text-wrap" style="width: 300px;">Member's name</th>
                                        <th scope="col" class="text-wrap" style="width: 300px;">Father's name</th>
                                        <th scope="col" class="text-wrap" style="width: 100px;">Father's status</th>
                                        <th scope="col" class="text-wrap" style="width: 300px;">Mother's name</th>
                                        <th scope="col" class="text-wrap" style="width: 100px;">Mother's status</th>
                                        <th scope="col" class="text-wrap" style="width: 300px;">Next of Kin's name</th>
                                        <th scope="col" class="text-wrap" style="width: 100px;">Phone number</th>
                                        <th scope="col" class="text-wrap" style="width: 300px;">GPS Address</th>
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
                                                <td class="text-wrap" style="width: 300px;">
                                                    <p> <?php echo $row['Firstname']." ".$row['Other_name']." ".$row['Sur_name']; ?> </p>
                                                </td>
                                                <td class="text-wrap" style="width: 300px;">
                                                    <p> <?php echo $row['Father_name']; ?> </p>
                                                </td>
                                                <td>
                                                    <p> <?php echo $row['F_decease']; ?> </p>
                                                </td>
                                                <td class="text-wrap" style="width: 300px;">
                                                    <p> <?php echo $row['Mother_name']; ?> </p>
                                                </td>
                                                <td>
                                                    <p> <?php echo $row['M_decease']; ?> </p>
                                                </td>
                                                <td class="text-wrap" style="width: 300px;">
                                                    <p> <?php echo $row['Next_of_kin']; ?> </p>
                                                </td>
                                                <td>
                                                    <p> <?php echo $row['NoK_contact']; ?> </p>
                                                </td>
                                                <td class="text-wrap" style="width: 300px;">
                                                    <p> <?php echo $row['NoK_GPS_address']; ?> </p>
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