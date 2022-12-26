<?php
include_once('config/security.php');
include_once('includes/header.php');
include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap
     align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Member's Address</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a type="button" href="view-address.php" class="btn btn-sm btn-outline-secondary">
                    View members address
                </a>
                <!-- <a type="button" class="btn btn-sm btn-outline-secondary" href="add-address.php">Add member</a> -->
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <?php include_once('logic/alerts.php'); ?>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="logic/address-code.php" method="post" autocomplete="off">
                    <div class="row">
                        <?php
                        $query = "SELECT * FROM `members` ORDER BY `Id` DESC LIMIT 1";
                        $query_run = mysqli_query($connection, $query);
                        if ($query_run) {
                            while ($row = mysqli_fetch_array($query_run)) {
                        ?>
                                <!-- will be inserted into the database as a foreign key -->
                                <input type="hidden" name="member-id" class="form-control mb-2 rounded-0"
                                 value="<?php echo $row['Id']; ?>">

                                <!-- Displays the member's ID to the page -->
                                <div class="form-group">
                                    <label for="full-member
                                    -id">Member ID</label>
                                    <input type="text" name="full-member-id"
                                     id="full-member-id" class="form-control mb-2 rounded-0"
                                      value="<?php echo $row['Init'] . $row['Reg_year'] . $row['Id']; ?>" disabled>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="street_name">Street Name</label>
                                        <input type="text" class="form-control rounded-0" name="street_name"
                                         id="street_name" min="0" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="house_number">House Number</label>
                                        <input type="text" class="form-control rounded-0" name="house_number"
                                         id="house_number" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="gps_address">GPS Address</label>
                                        <input type="text" class="form-control rounded-0" name="gps_address"
                                         id="gps_address" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="postal_address">Post Address</label>
                                        <input type="text" class="form-control rounded-0" name="postal_address"
                                         id="postal_address" min="0" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control rounded-0" name="email"
                                         id="email" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="tel" class="form-control rounded-0" name="phone_number"
                                        
                                        id="phone_number" required>
                                    </div>
                                </div>
                                </div>
                                <button type="submit" class="w-100 my-3  btn btn-lg rounded-0 btn-outline-primary" name="add">
                                    Submit
                                </button>
                            </form>
                        <?php
                            }
                        }
                        ?>
            </div>
        </div>
    </div>

    <?php
    include_once('includes/footer.php');
    ?>

    <script src="js/jquery.js"></script>
    <script src="js/custom.js"></script>