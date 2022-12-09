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
                                $query = "SELECT address.Id, address.MiD, address.Street_name, address.House_number, address.GPS_address, address.Postal_address, address.Phone_number, address.Email, members.Init, members.Reg_year, members.Id, members.Firstname, members.Sur_name, members.Other_name FROM address LEFT JOIN members ON address.MiD = members.Id ORDER BY members.Id ASC";
                                $query_run = mysqli_query($connection, $query);
                                $counter = 0;
                            ?>
                            <table class="table table-hover table-sm">
                                <thead>
                                <tr>
                                        <th scope="col">SN</th>
                                        <th scope="col">Member Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Street Name</th>
                                        <th scope="col">House Number</th>
                                        <th scope="col">GPS Address</th>
                                        <th scope="col">Postal Address</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col" class="text-wrap" style="width: 300px;">Email</th>
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
                                                <td class="text-wrap" style="width: 300px;">
                                                    <p> <?php echo $row['Street_name']; ?> </p>
                                                </td>
                                                <td class="text-wrap" style="width: 300px;">
                                                    <p> <?php echo $row['House_number']; ?> </p>
                                                </td>
                                                <td class="text-wrap" style="width: 300px;">
                                                    <p> <?php echo $row['GPS_address']; ?> </p>
                                                </td>
                                                <td class="text-wrap" style="width: 300px;">
                                                    <p> <?php echo $row['Postal_address']; ?> </p>
                                                </td>
                                                <td>
                                                    <p> <?php echo $row['Phone_number']; ?> </p>
                                                </td>
                                                <td class="text-wrap" style="width: 300px;">
                                                    <p> <?php echo $row['Email']; ?> </p>
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