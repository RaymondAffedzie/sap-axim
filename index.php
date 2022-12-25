<?php
include_once('config/security.php');
include_once('includes/header.php');
include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 text-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1 style="cursor: pointer;">
        <input id="live_search" class="form-control w-50 rounded-0" type="text" placeholder="Search..." autocomplete="off" style="cursor: pointer;">
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button style="cursor: pointer;">
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>

    <div id="searchresult"></div>

    <div class="row" id="element">
        <div class="row">
            <h4 class="text-center" style="text-transform: uppercase; font-weight: 700; color: crimson;">Welcome to St. Anthony of Padua Catholic Catholic Church, Axim, Data collection system</h4>
            <div class="col-md-3 my-3">
                <div class="card text-bg-dark text-light text-center rounded-0 border-0" style="max-height: 200px; min-height: 150px">
                    <div class="card-body" style="cursor: pointer;">
                        <h3>Members</h3>
                        <?php
                        $query = "SELECT * FROM `members`";
                        $query_run = mysqli_query($connection, $query);
                        if ($query_run) {
                            $row = mysqli_num_rows($query_run)
                        ?>
                            <h2 class="text-secondary" style="font-size: 5rem;"><?php echo $row; ?></h2>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-3">
                <div class="card text-bg-primary text-dark text-center rounded-0 border-0" style="max-height: 200px; min-height: 150px">
                    <div class="card-body" style="cursor: pointer;">
                        <h3>Males</h3>
                        <?php
                        $query = "SELECT * FROM `members` WHERE `Sex` = 'M'";
                        $query_run = mysqli_query($connection, $query);
                        if ($query_run) {
                            $row = mysqli_num_rows($query_run)
                        ?>
                            <h2 class="text-secondary" style="font-size: 5rem;"><?php echo $row; ?></h2>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-3">
                <div class="card text-bg-info text-light text-center rounded-0 border-0" style="max-height: 200px; min-height: 150px">
                    <div class="card-body" style="cursor: pointer;">
                        <h3>Females</h3>
                        <?php
                        $query = "SELECT * FROM `members` WHERE `Sex` = 'F'";
                        $query_run = mysqli_query($connection, $query);
                        if ($query_run) {
                            $row = mysqli_num_rows($query_run)
                        ?>
                            <h2 class="text-secondary" style="font-size: 5rem;"><?php echo $row; ?></h2>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-3">
                <div class="card text-bg-light text-dark text-center rounded-0 border-0" style="max-height: 200px; min-height: 150px">
                    <div class="card-body" style="cursor: pointer;">
                        <h3>Youths</h3>
                        <?php
                        $query = "SELECT * FROM members WHERE round(DATEDIFF(CURRENT_DATE(), Birth_Date)/365) > 14
                          AND round(DATEDIFF(CURRENT_DATE(), Birth_Date)/365) < 45";
                        $query_run = mysqli_query($connection, $query);
                        if ($query_run) {
                            $row = mysqli_num_rows($query_run)
                        ?>
                            <h2 class="text-secondary" style="font-size: 5rem;"><?php echo $row; ?></h2>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 my-3">
                <div class="card text-bg-warning text-light text-center rounded-0 border-0" style="max-height: 200px; min-height: 150px">
                    <div class="card-body" style="cursor: pointer;">
                        <h3>Children</h3>
                        <?php
                        $query = "SELECT * FROM members WHERE round(DATEDIFF(CURRENT_DATE(), Birth_Date)/365) < 15;";
                        $query_run = mysqli_query($connection, $query);
                        if ($query_run) {
                            $row = mysqli_num_rows($query_run)
                        ?>
                            <h2 class="text-secondary" style="font-size: 5rem;"><?php echo $row; ?></h2>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-3">
                <div class="card text-bg-success text-light text-center rounded-0 border-0" style="max-height: 200px; min-height: 150px">
                    <div class="card-body" style="cursor: pointer;">
                        <h3>Bap in Axim</h3>
                        <?php
                        $query = "SELECT * FROM `church` WHERE `Parish` = 'Axim'";
                        $query_run = mysqli_query($connection, $query);
                        if ($query_run) {
                            $row = mysqli_num_rows($query_run)
                        ?>
                            <h2 class="" style="font-size: 5rem;"><?php echo $row; ?></h2>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-3">
                <div class="card text-bg-secondary text-light text-center rounded-0 border-0" style="max-height: 200px; min-height: 150px">
                    <div class="card-body" style="cursor: pointer;">
                        <h3>Students</h3>
                        <?php
                        $query = "SELECT * FROM `other_info` WHERE `Occupation` = 'Student'";
                        $query_run = mysqli_query($connection, $query);
                        if ($query_run) {
                            $row = mysqli_num_rows($query_run)
                        ?>
                            <h2 class="" style="font-size: 5rem;"><?php echo $row; ?></h2>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 my-3">
                <div class="card text-bg-danger text-light text-center rounded-0 border-0" style="max-height: 200px; min-height: 150px">
                    <div class="card-body" style="cursor: pointer;">
                        <h3>Admins</h3>
                        <?php
                        $query = "SELECT * FROM `users` WHERE `Role` = 'M'";
                        $query_run = mysqli_query($connection, $query);
                        if ($query_run) {
                            $row = mysqli_num_rows($query_run)
                        ?>
                            <h2 class="" style="font-size: 5rem;"><?php echo $row; ?></h2>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    include_once('includes/footer.php');
    ?>

    <script src="js/jquery.js"></script>
    <script src="js/custom.js"></script>