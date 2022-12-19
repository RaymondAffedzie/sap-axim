<?php
include_once('config/security.php');
include_once('includes/header.php');
include_once('includes/navbar.php');
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Member's Profile</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">This week</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                Export
            </button>
        </div>
    </div>

    <?php include_once('logic/alerts.php') ?>
    <div class="card text-left col-md-12 border-0 rounded-3">
        <div class="card my-1 border-0 rounded-0">
            <?php
            if (isset($_POST['view-member'])) {
                $id = $_POST['member_id'];
                $query = "SELECT `members`.`Id`, `members`.`Init`, `members`.`Reg_year`, `members`.`Firstname`,
                    `members`.`Sur_name`, `members`.`Other_name`, `members`.`Sex`, `members`.`Birth_Date`,
                    `members`.`Birth_Place`, `members`.`Birth_Region`, `members`.`Birth_District`,
                    `address`.`MiD`, `address`.`Street_name`, `address`.`House_number`,
                    `address`.`GPS_address`, `address`.`Postal_address`, `address`.`Phone_number`, `address`.`Email`,
                    `church`.`MiD`, `church`.`Baptism_card_number`, `church`.`Baptism_date`,
                    `family`.`MiD`, `family`.`Mother_name`, `family`.`M_decease`, `family`.`Father_name`,
                    `family`.`F_decease`, `family`.`Next_of_kin`, `family`.`NoK_contact`, `family`.`NoK_GPS_address`,
                    `other_info`.`MiD`, `other_info`.`Marital_status`, `other_info`.`Number_of_children`,
                    `other_info`.`Education_level`, `other_info`.`Occupation`
                    -- `society`.`MiD`, `society`.`Society_name`, `society`.`Position_held`
                    FROM `members`
                    JOIN `address` ON `members`.`Id` = `address`.`MiD`
                    JOIN `church` ON `members`.`Id` = `church`.`MiD`
                    JOIN `family` ON `members`.`Id` = `family`.`MiD`
                    JOIN `other_info` ON `members`.`Id` = `other_info`.`MiD`
                    -- JOIN `society` on `members`.`Id` = `society`.`MiD`
                    WHERE `members`.`Id` =  '$id'";
                $query_run = mysqli_query($connection, $query);
                if ($query_run) {
                    while ($row = mysqli_fetch_array($query_run)) {
            ?>
            <!-- personal -->
            <div class="row">
                <div class="col-md-5">
                    <h1 class="display-4 mt-3 text-center text-secondary">
                        <i class="fas fa-id-badge"></i><br>
                        <?php echo $row['Firstname'] . " " . $row['Other_name'] . " " . $row['Sur_name']; ?>
                    </h1>
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p style="font-size: 20px; text-align: left">
                                    First name: <b><?php echo  $row['Firstname']; ?></b>
                                </p>
                                <p style="font-size: 20px; text-align: left">
                                    Surname: <b><?php echo $row['Sur_name']; ?></b>
                                </p>
                                <p style="font-size: 20px; text-align: left">
                                    Other names: <b><?php echo $row['Other_name']; ?></b>
                                </p>
                                <!-- condition to check member's sex -->
                                <?php
                                if ($row['Sex'] == "M") {
                                ?>
                                    <p style="font-size: 20px; text-align: left">Sex: <b>Male</b></p>
                                <?php
                                } elseif ($row['Sex'] == "F") {
                                ?>
                                    <p style="font-size: 20px; text-align: left">Sex: <b>Female</b></p>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-md-6">
                                <p style="font-size: 20px; text-align: left">
                                    Birth Date: <b><?php echo $row['Birth_Date']; ?></b>
                                </p>
                                <p style="font-size: 20px; text-align: left">
                                    Birth Place: <b><?php echo $row['Birth_Place']; ?></b>
                                </p>
                                <p style="font-size: 20px; text-align: left">
                                    Birth Region: <b><?php echo $row['Birth_Region']; ?></b>
                                </p>
                                <p style="font-size: 20px; text-align: left">
                                    Birth District: <b><?php echo $row['Birth_District']; ?></b>
                                </p>
                            </div>
                        </div>
                    </div>
                    <form action="edit-member.php" method="POST">
                        <input type="hidden" name="edit_id" value="<?php echo $row['Id']; ?>"> <!-- Edit profile using member table id -->
                        <button type="submit" name="edit_btn" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit member's profile">
                            <i class="fas fa-edit"></i> Edit details
                        </button>
                    </form>
                </div>
                <hr class="my-3" />
            </div>
            `
            <!-- other info -->
            <div class="row">
                <div class="col-md-5">
                    <h1 class="display-4 mt-3 text-center text-secondary">
                        <i class="fas fa-user"></i><br>
                        Other Information
                    </h1>
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p style="font-size: 20px; text-align: left">
                                    Marital status: <b><?php echo  $row['Marital_status']; ?></b>
                                </p>
                                <p style="font-size: 20px; text-align: left">
                                    Number of Children: <b><?php echo $row['Number_of_children']; ?></b>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p style="font-size: 20px; text-align: left">
                                    Level of Education: <b><?php echo $row['Education_level']; ?></b>
                                </p>
                                <p style="font-size: 20px; text-align: left">
                                    Occupation: <b><?php echo $row['Occupation']; ?></b>
                                </p>
                                <p style="font-size: 20px; text-align: left">
                                    Member ID: <b><?php echo $row['Init'] . $row['Reg_year'] . $row['Id']; ?></b>
                                </p>
                            </div>
                        </div>
                    </div>
                    <form action="edit-other-info.php" method="POST">
                        <input type="hidden" name="edit_id" value="<?php echo $row['Id']; ?>"> <!-- Edit profile using member table id -->
                        <button type="submit" name="edit_btn" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit member's other info">
                            <i class="fas fa-edit"></i> Edit details
                        </button>
                    </form>
                </div>
                <hr class="my-3" />
            </div>

            <!-- chruch -->
            <div class="row">
                <div class="col-md-5">
                    <h1 class="display-4 mt-3 text-center text-secondary">
                        <i class="fas fa-church"></i><br>
                        Church details
                    </h1>
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p style="font-size: 20px; text-align: left">
                                    Baptism card number: <b><?php echo  $row['Baptism_card_number']; ?></b>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p style="font-size: 20px; text-align: left">
                                    Baptism date: <b><?php echo $row['Baptism_date']; ?></b>
                                </p>
                            </div>
                        </div>
                    </div>
                    <form action="edit-church.php" method="POST">
                        <input type="hidden" name="edit_id" value="<?php echo $row['Id']; ?>"> <!-- Edit profile using member table id -->
                        <button type="submit" name="edit_btn" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit member's baptism details">
                            <i class="fas fa-edit"></i> Edit details
                        </button>
                    </form>
                </div>
                <hr class="my-3" />
            </div>

            <!-- address -->
            <div class="row">
                <div class="col-md-4">
                    <h1 class="display-4 mt-3 text-center text-secondary">
                        <i class="fas fa-address-card"></i><br>
                        Address
                    </h1>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <p style="font-size: 20px; text-align: left">Street name:
                                    <b><?php echo  $row['Street_name']; ?></b>
                                </p>
                                <p style="font-size: 20px; text-align: left">
                                    House number: <b><?php echo $row['House_number']; ?></b>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p style="font-size: 20px; text-align: left">
                                    GPS address: <b><?php echo $row['GPS_address']; ?></b>
                                </p>
                                <p style="font-size: 20px; text-align: left">
                                    Postal address: <b><?php echo $row['Postal_address']; ?></b>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p style="font-size: 20px; text-align: left">
                                    Phone number: <b><?php echo $row['Phone_number']; ?></b>
                                </p>
                                <p style="font-size: 20px; text-align: left">
                                    Email: <b><?php echo $row['Email']; ?></b>
                                </p>
                            </div>
                        </div>
                    </div>
                    <form action="edit-address.php" method="POST">
                        <input type="hidden" name="edit_id" value="<?php echo $row['Id']; ?>"> <!-- Edit profile using member table id -->
                        <button type="submit" name="edit_btn" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit member's address">
                            <i class="fas fa-edit"></i> Edit details
                        </button>
                    </form>
                </div>
                <hr class="my-3" />
            </div>
            
            <!-- family -->
            <div class="row">
                <div class="col-md-4">
                    <h1 class="display-4 mt-3 text-center text-secondary">
                        <i class="fa-solid fa-people-roof"></i><br>
                        Family
                    </h1>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <p style="font-size: 20px; text-align: left">
                                    Mother name: <b><?php echo  $row['Mother_name']; ?></b>
                                </p>
                                <p style="font-size: 20px; text-align: left">
                                    Status:
                                    <b>
                                        <?php
                                        if ($row['M_decease'] == "A") {
                                        ?>
                                            Alive
                                        <?php
                                        } elseif ($row['M_decease'] == "D") {
                                        ?>
                                            Deceased
                                        <?php
                                        }
                                        ?>
                                    </b>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p style="font-size: 20px; text-align: left">
                                    Father name: <b><?php echo $row['Father_name']; ?></b>
                                </p>
                                <p style="font-size: 20px; text-align: left">
                                    Status:
                                    <b>
                                        <?php
                                        if ($row['F_decease'] == "A") {
                                        ?>
                                            Alive
                                        <?php
                                        } elseif ($row['F_decease'] == "D") {
                                        ?>
                                            Deceased
                                        <?php
                                        }
                                        ?>
                                    </b>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p style="font-size: 20px; text-align: left">
                                    Next of kin's name: <b><?php echo $row['Next_of_kin']; ?></b>
                                </p>
                                <p style="font-size: 20px; text-align: left">
                                    Next of kin contact: <b><?php echo $row['NoK_contact']; ?></b>
                                </p>
                                <p style="font-size: 20px; text-align: left">
                                    Next of kin GPS address: <b><?php echo $row['NoK_GPS_address']; ?></b>
                                </p>
                            </div>
                        </div>
                    </div>
                    <form action="edit-family.php" method="POST">
                        <input type="hidden" name="edit_id" value="<?php echo $row['Id']; ?>"> <!-- Edit profile using member table id -->
                        <button type="submit" name="edit_btn" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit member's family details">
                            <i class="fas fa-edit"></i> Edit details
                        </button>
                    </form>
                </div>
                <hr class="my-3" />
            </div>
            <?php
                    }
                }
            }
            ?>

            <!-- society -->
            <div class="row">
                <div class="col-md-5">
                    <h1 class="display-4 mt-3 text-center text-secondary">
                        <i class="fas fa-users"></i><br>
                        Societies
                    </h1>
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <?php
                                        if (isset($_POST['view-member'])) {
                                            $id = $_POST['member_id'];
                                            $query = "SELECT `Id`, `Society_name`, `Position_held` FROM society WHERE `MiD` = '$id'";
                                            $query_run = mysqli_query($connection, $query);
                                            $counter = 0;
                                    ?>
                                    <table class="table table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">SN</th>
                                                <th scope="col" class="text-wrap" style="width: 400px;">Society name</th>
                                                <th scope="col" class="text-wrap" style="width: 300px;">Office held</th>
                                                <th scope="col">Edit</th>
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
                                                        <td class="text-wrap" style="width: 400px;">
                                                            <p> <?php echo $row['Society_name']; ?> </p>
                                                        </td>
                                                        <td class="text-wrap" style="width: 400px;">
                                                            <p> <?php echo $row['Position_held']; ?> </p>
                                                        </td>
                                                        <td>
                                                            <form action="edit-society.php" method="POST">
                                                                <input type="hidden" name="edit_id" value="<?php echo $row['Id']; ?>"> <!-- Edit profile using society table id -->
                                                                <input type="hidden" name="mem_id" value="<?php echo $id; ?>"> <!-- Edit profile using member table id -->
                                                                <button type="submit" name="edit_btn" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit member's profile">
                                                                    <i class="fas fa-edit"></i>
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
                                                            <form action="manual-add-society.php" method="POST">
                                                                <input type="hidden" name="mem_id" value="<?php echo $id; ?>"> <!-- Add society using member id -->
                                                                <button type="submit" name="add_soceity" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="left" title="Add member's society">
                                                                    <i class="fas fa-plus"></i> Add new society
                                                                </button>
                                                            </form>
                                                    <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-3" />
            </div>
        </div>
    </div>


    <?php
    include_once('includes/footer.php');
    ?>