<?php
    include_once('config/security.php');
    include_once('includes/header.php');
    include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">All Registered Members</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a type="button" href="view-members.php" class="btn btn-sm btn-outline-secondary">Members Page</a>
            <a type="button" class="btn btn-sm btn-outline-secondary">Export</a>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar" class="align-text-bottom"></span>
            This week
          </button>
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
                                                    <p> <?php echo $row['Init'].$row['Reg_year'].$row['Id']; ?> </p>
                                                </td>
                                                <td class="text-wrap" style="width: 300px;">
                                                    <p> <?php echo $row['Firstname']." ".$row['Other_name']." ".$row['Sur_name']; ?> </p>
                                                </td>
                                                <td>
                                                    <p> <?php echo $row['Sex']; ?> </p>
                                                </td>
                                                <td>
                                                    <p> <?php echo $row['Birth_Date']; ?> </p>
                                                </td>
                                                <td>
                                                    <p> <?php echo $row['Birth_Place']; ?> </p>
                                                </td>
                                                <td>
                                                    <p> <?php echo $row['Birth_Region']; ?> </p>
                                                </td>
                                                <td>
                                                    <p> <?php echo $row['Birth_District']; ?> </p>
                                                </td>
                                                <td>
                                                    <form action="member-profile.php" method="post">
                                                        <input type="hidden" name="member_id" value="<?php echo $row['Init'].$row['Reg_year'].$row['Id']; ?>" hidden>
                                                        <button type="submit" class="btn btn-outline-secondary" name="view-member" data-bs-toggle="tooltip" data-bs-placement="left" title="View member's profile">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="delete_id" value="<?php echo $row['Init'].$row['Reg_year'].$row['Id']; ?>">
                                                        <button type="submit" name="delete_news" class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="left" title="Delete this member" onclick="return confirm('Do you want to delete member')">
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
?>