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
    <div class="card-header">
        <ul class="nav nav-pills navbar-light  bg-dark card-header-pills mb-3" id="pills-tab" role="tablist">

            <li class="nav-item" role="presentation">
                <button class="nav-link text-light active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">Profile</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link text-light" id="pills-change_password-tab" data-bs-toggle="pill" data-bs-target="#pills-change_password" type="button" role="tab" aria-controls="pills-change_password" aria-selected="false">Change Password</button>
            </li>

            <li class="nav-item" role="presentation">
                <!-- <button class="nav-link text-light" id="pills-activities-tab" data-bs-toggle="pill" data-bs-target="#pills-activities" type="button" role="tab" aria-controls="pills-activities" aria-selected="false">Activities</button> -->
            </li>
        </ul>
        
        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card mb-3 border-0 rounded-0">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <?php
                                if (isset($_POST['view-member'])) {
                                    $id = $_POST['member_id'];
                                    $query = "SELECT * FROM `members` WHERE CONCAT(`Init`,`Reg_year`,`Id`) = '$id'";
                                    $query_run = mysqli_query($connection, $query);
                                    if ($query_run) {
                                        while ($row = mysqli_fetch_array($query_run)) {
                            ?>
                            <h1 class="display-4 mt-3 text-secondary"><i class="fa fa-user-circle-o"></i><br><?php echo $row['Firstname'] . " " . $row['Other_name'] ." " . $row['Sur_name']; ?></h1>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p style="font-size: 20px; text-align: left">First name: <?php echo  $row['Firstname']; ?></p>
                                        <p style="font-size: 20px; text-align: left">Surname: <?php echo $row['Sur_name']; ?></p>
                                        <p style="font-size: 20px; text-align: left">Other name: <?php echo $row['Other_name']; ?></p>

                                        <!-- condition to check member's sex -->
                                        <?php
                                            if ($row['Sex'] == "M" ) {
                                                ?>
                                                <p style="font-size: 20px; text-align: left">Sex: Male</p>
                                                <?php
                                            } elseif ($row['Sex'] == "F") {
                                                ?>
                                                <p style="font-size: 20px; text-align: left">Sex: Female</p>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <p style="font-size: 20px; text-align: left">Birth Date: <?php echo $row['Birth_Date']; ?></p>
                                        <p style="font-size: 20px; text-align: left">Birth Place: <?php echo $row['Birth_Place']; ?></p>
                                        <p style="font-size: 20px; text-align: left">Birth Region: <?php echo $row['Birth_Region']; ?></p>
                                        <p style="font-size: 20px; text-align: left">Birth District: <?php echo $row['Birth_District']; ?></p>
                                    </div>
                                </div>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editprofile">
                                    Edit Profile
                                </button>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <!-- edit profile modal -->
                            <div class="modal fade" id="editprofile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Edit Member's Profile</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            if (isset($_POST['view-member'])) {
                                                $id = $_POST['member_id'];
                                                $query = "SELECT * FROM `members` WHERE CONCAT(`Init`,`Reg_year`,`Id`) = '$id'";
                                                $query_run = mysqli_query($connection, $query);
                                                if ($query_run) {
                                                    while ($row = mysqli_fetch_array($query_run)) {
                                            ?>
                                            <form action="logic/add-member-code.php" method="post">
                                                <input type="hidden" class="form-control" name="member_id" value="<?php echo $id; ?>">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="firstname" value="<?php echo $row['Firstname']; ?>" id="firstname" min="2" max="32" required>
                                                    <label for="firstname">Firstname</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="surname" value="<?php echo $row['Sur_name']; ?>" id="surname" min="2" max="32" required>
                                                    <label for="surname">Surname</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="othername" value="<?php echo $row['Other_name']; ?>"  id="othername">
                                                    <label for="othername">Other name</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="birthplace" value="<?php echo $row['Birth_Place']; ?>" id="birth_place">
                                                    <label for="Birth_place">Birth Place</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="birth_region" value="<?php echo $row['Birth_Region']; ?>" id="birth_region">
                                                    <label for="Birth_region">Birth Region</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="birth_district" value="<?php echo $row['Birth_District']; ?>" id="birth_district">
                                                    <label for="Birth_district">Birth District</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="date" class="form-control" name="birthdate" value="<?php echo $row['Birth_Date']; ?>" id="birth_date">
                                                    <label for="Birth_date">Birth Date</label>
                                                </div>
                                                
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="sex" value="<?php echo $row['Sex']; ?>" id="sex" max="1" min="1">
                                                    <label for="sex">Sex</label>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="updateprofile" class="mb-2 btn btn-outline-success" onclick="return confirm('Please make sure your profile details are correct')"> Update Profile </button>
                                            </form>
                                    <?php
                                                }
                                            }
                                        }
                                    ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-change_password" role="tabpanel" aria-labelledby="pills-change_password-tab">
                <div class="card mb-3 border-0 shadow-lg rounded-0">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <h1 class="display-4 mt-3 text-secondary"><i class="fa fa-key"></i><br> Change Password</h1>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <?php
                                $id = $_SESSION['users']['users_id'];
                                $query = "SELECT `Firstname`, `Surname`, `Username`, `Email`, `Phone_number` FROM `users` WHERE `Id` = '$id'";
                                $query_run = mysqli_query($connection, $query);
                                if ($query_run) {
                                    while ($row = mysqli_fetch_array($query_run)) {
                                ?>
                                        <h2 class="card-title"><?php echo $row['Firstname'] . " " . $row['Surname']; ?></h2>
                                        <p class="card-text" style="font-size: larger;">Username: <?php echo  $row['Username']; ?></p>
                                        <p class="card-text" style="font-size: larger;">Email: <?php echo $row['Email']; ?></p>
                                        <p class="card-text" style="font-size: larger;">Phone Number: <?php echo $row['Phone_number']; ?></p>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editpassword">
                                            Change Password
                                        </button>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                            <!-- change password modal -->
                            <div class="modal fade" id="editpassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            $idcp = $_SESSION['users']['users_id'];
                                            ?>
                                            <form action="logic/changepassword.php" method="post">
                                                <input type="hidden" class="form-control" name="id" value="<?php echo $idcp; ?>">

                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control" name="old_password" id="password" placeholder="Old Password" minlength="6" required>
                                                    <label for="old_password">Old Password</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" minlength="6" required>
                                                    <label for="new_password">New Password</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control" name="con_password" id="confirm_password" placeholder="Confirm Password" minlength="6" required>
                                                    <label for="confirm_password">Confirm Password</label>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="changepassword" class="mb-2 btn btn-outline-success" onclick="return confirm('Confirm password change')"> Update Profile </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-activities" style="display:flex;" role="tabpanel" aria-labelledby="pills-activities-tab">

        </div>
    </div>
</div>
</div>


<?php
    include('includes/footer.php');
?>