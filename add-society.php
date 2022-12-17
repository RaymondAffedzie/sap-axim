<?php
include_once('config/security.php');
include_once('includes/header.php');
include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Member's Societies</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a type="button" href="view-society.php" class="btn btn-sm btn-outline-secondary">View members society</a>
                <a type="button" class="btn btn-sm btn-outline-secondary">Export</a>
            </div>
            <a type="button" class="add-more-form btn btn-sm btn-outline-primary" href="javascript:void(0)">ADD MORE</a>
        </div>
    </div>

    <div class="container-fluid">
        <?php include_once('logic/alerts.php'); ?>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="logic/society-code.php" method="post" autocomplete="off">
                    <div class="row">
                        <?php
                        $query = "SELECT * FROM `members` ORDER BY `Id` DESC LIMIT 1";
                        $query_run = mysqli_query($connection, $query);
                        if ($query_run) {
                            while ($row = mysqli_fetch_array($query_run)) {
                        ?>
                                
                                <!-- will be inserted into the database as a foreign key -->
                                <input type="hidden" name="member-id" class="form-control mb-2" value="<?php echo $row['Id']; ?>">

                                <!-- Displays the member's ID to the page -->
                                <div class="form-group">
                                    <label for="full-member-id">Member ID</label>
                                    <input type="text" name="full-member-id" id="full-member-id" class="form-control mb-2" value="<?php echo $row['Init'] . $row['Reg_year'] . $row['Id']; ?>" disabled>
                                </div>

                                <div class="col-md-5 mb-2">
                                    <div class="form-floating">
                                        <input type="text" name="society_name[]" class="form-control" id="society_name">
                                        <label for="society_name">Society name</label>
                                    </div>
                                </div>

                                <div class="col-md-5 mb-2">
                                    <div class="form-floating">
                                        <input type="text" name="office_held[]" class="form-control" id="office_held">
                                        <label for="office_held">Office held</label>
                                    </div>
                                </div>

                                <div class="paste-new-forms"></div>

                        <?php
                            }
                        }
                        ?>
                        <button type="submit" class="w-100 my-3  btn btn-lg rounded-4 btn-outline-primary" name="add">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include_once('includes/footer.php');
    ?>


<!-- jquery -->
<script src="js/jquery.js"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.remove-btn', function () {
                $(this).closest('.main-form').remove();
            });

            $(document).on('click', '.add-more-form', function () {
                $('.paste-new-forms').append('<div class="row main-form my-2">\
                                <div class="col-md-5">\
                                    <div class="form-floating">\
                                        <input type="text" name="society_name[]" class="form-control" id="society_name">\
                                        <label for="society_name">Name</label>\
                                    </div>\
                                </div>\
                                <div class="col-md-5">\
                                    <div class="form-floating">\
                                        <input type="text" name="office_held[]" class="form-control" id="office_held">\
                                        <label for="office_held">Office held</label>\
                                    </div>\
                                </div>\
                                <div class="col-md-2">\
                                        <br>\
                                        <button type="button" class="remove-btn btn btn-danger">Remove</button>\
                                </div>\
                            </div>');
            });
        });
    </script>