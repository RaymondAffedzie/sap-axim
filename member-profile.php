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
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>

    <?php include_once('logic/alerts.php') ?>
    <div class="card text-center col-md-12 border-0 rounded-3">

        <div class="card mb-1 border-0 rounded-0">
            <?php
            if (isset($_POST['view-member'])) {
                $id = $_POST['member_id'];
                echo $id;
                $query = "SELECT members.Init, members.Reg_year, members.Id, members.Firstname, members.Sur_name, members.Other_name, members.Sex, members.Birth_Date, members.Birth_Place, members.Birth_Region, members.Birth_District,
                address.Id, address.MiD, address.Street_name, address.House_number, address.GPS_address, address.Postal_address, address.Phone_number, address.Email,
                church.MiD, church.Baptism_card_number, church.Baptism_date, church.Confirmation_number, church.Confirmation_datE,
                family.Id, family.MiD, family.Mother_name, family.M_decease, family.Father_name, family.F_decease, family.Next_of_kin, family.NoK_contact, family.NoK_GPS_address,
                other_info.Id, other_info.MiD, other_info.Marital_status, other_info.Number_of_children, other_info.Education_level, other_info.Occupation,
                society.Id, society.MiD, society.Society_name, society.Position_held
                FROM members
                INNER JOIN address ON members.Id = address.MiD
                INNER JOIN church ON members.Id = church.MiD
                INNER JOIN family ON members.Id = family.MiD
                INNER JOIN other_info ON members.Id = other_info.MiD
                INNER JOIN society ON members.Id = society.MiD
                WHERE CONCAT(members.Init,members.Reg_year,members.Id) = '$id'";
                $query_run = mysqli_query($connection, $query);
                if ($query_run) {
                    while ($row = mysqli_fetch_array($query_run)) {
            ?>

            <!-- personal -->
            <div class="row">
                <div class="col-md-5">
                    <h1 class="display-4 mt-3 text-center text-secondary"><i class="fa-regular fa-id-badge"></i><br><?php echo $row['Firstname'] . " " . $row['Other_name'] . " " . $row['Sur_name']; ?></h1>
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p style="font-size: 20px; text-align: left">First name: <b><?php echo  $row['Firstname']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">Surname: <b><?php echo $row['Sur_name']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">Other name: <b><?php echo $row['Other_name']; ?></b></p>

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
                                <p style="font-size: 20px; text-align: left">Birth Date: <b><?php echo $row['Birth_Date']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">Birth Place: <b><?php echo $row['Birth_Place']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">Birth Region: <b><?php echo $row['Birth_Region']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">Birth District: <b><?php echo $row['Birth_District']; ?></b></p>
                            </div>
                        </div>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editprofile">
                            Edit
                        </button>
                    </div>
                    
                </div>
            </div>
            `
            <!-- other info -->
            <div class="row">
                <div class="col-md-5">
                    <h1 class="display-4 mt-3 text-center text-secondary"><i class="fa-regular fa-user"></i><br>Other Information</h1>
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p style="font-size: 20px; text-align: left">Marital status: <b><?php echo  $row['Marital_status']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">Number of Children: <b><?php echo $row['Number_of_children']; ?></b></p>
                            </div>
                            <div class="col-md-6">
                                <p style="font-size: 20px; text-align: left">Level of Education: <b><?php echo $row['Education_level']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">Occupation: <b><?php echo $row['Occupation']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">MID: <b><?php echo $_POST['mem_id']; ?></b></p>
                            </div>
                        </div>
                    </div>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#edit-other-info">
                        edit
                    </button>
                </div>
            </div>

            <!-- address -->
            <div class="row">
                <div class="col-md-5">
                    <h1 class="display-4 mt-3 text-center text-secondary"><i class="fa-regular fa-address-card"></i><br>Address</h1>
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p style="font-size: 20px; text-align: left">Street name: <b><?php echo  $row['Street_name']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">House number: <b><?php echo $row['House_number']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">GPS address: <b><?php echo $row['GPS_address']; ?></b></p>
                            </div>
                            <div class="col-md-6">
                                <p style="font-size: 20px; text-align: left">Postal address: <b><?php echo $row['Postal_address']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">Phone number: <b><?php echo $row['Phone_number']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">Email: <b><?php echo $row['Email']; ?></b></p>
                            </div>
                        </div>
                    </div>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#edit-other-info">
                        edit
                    </button>
                </div>
            </div>

            <!-- family -->
            <div class="row">
                <div class="col-md-4">
                    <h1 class="display-4 mt-3 text-center text-secondary"><i class="fa-solid fa-people-roof"></i><br>Family</h1>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <p style="font-size: 20px; text-align: left">Mother name: <b><?php echo  $row['Mother_name']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">Status: <b><?php echo $row['M_decease']; ?></b></p>
                            </div>
                            <div class="col-md-4">
                                <p style="font-size: 20px; text-align: left">Father name: <b><?php echo $row['Father_name']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">Status: <b><?php echo $row['F_decease']; ?></b></p>
                            </div>
                            <div class="col-md-4">
                                <p style="font-size: 20px; text-align: left">Confirmation number: <b><?php echo $row['Next_of_kin']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">Next of kin contact: <b><?php echo $row['NoK_contact']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">Next of kin GPS address: <b><?php echo $row['NoK_GPS_address']; ?></b></p>
                            </div>
                        </div>
                    </div>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#edit-other-info">
                        edit
                    </button>
                </div>
            </div>

            <!-- chruch -->
            <div class="row">
                <div class="col-md-5">
                    <h1 class="display-4 mt-3 text-center text-secondary"><i class="fa-solid fa-church"></i><br>Church</h1>
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p style="font-size: 20px; text-align: left">Baptism card number: <b><?php echo  $row['Baptism_card_number']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">Baptism date: <b><?php echo $row['Baptism_date']; ?></b></p>
                            </div>
                            <div class="col-md-6">
                                <p style="font-size: 20px; text-align: left">Confirmation number: <b><?php echo $row['Confirmation_number']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">Confirmation date: <b><?php echo $row['Confirmation_date']; ?></b></p>
                            </div>
                        </div>
                    </div>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#edit-other-info">
                        edit
                    </button>
                </div>
            </div>

            <!-- society -->
            <div class="row">
                <div class="col-md-5">
                    <h1 class="display-4 mt-3 text-center text-secondary"><i class="fa-solid fa-people-roof"></i><br>Societies</h1>
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p style="font-size: 20px; text-align: left">Society name: <b><?php echo  $row['Society_name']; ?></b></p>
                                <p style="font-size: 20px; text-align: left">Position held: <b><?php echo $row['Position_held']; ?></b></p>
                            </div>
                        </div>
                    </div>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#edit-other-info">
                        edit
                    </button>
                </div>
            </div>

        </div>
        <?php
                        }
                    }
                }
        ?>
    </div>


    <?php
    include_once('includes/footer.php');
    ?>