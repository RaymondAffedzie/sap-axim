<?php
include_once('config/security.php');
include_once('includes/header.php');
include_once('includes/navbar.php');
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <input id="live_search" class="form-control w-50 rounded-0" type="text" placeholder="Search..." autocomplete="off">
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

    <div id="searchresult"></div>

    <div class="row" id="element">
        <h4 class="text-center">Welcome to St. Anthony of Padua Catholic Catholic Church, Axim.</h4>
        <div class="col-md-3 my-3">
            <div class="card text-bg-dark text-light rounded-0 border-0" style="max-height: 200px; min-height: 150px">
                <div class="card-body">
                    <h3>Members</h3>
                    <?php
                    $query = "SELECT * FROM `members`";
                    $query_run = mysqli_query($connection, $query);
                    if ($query_run) {
                        $row = mysqli_num_rows($query_run)
                    ?>
                        <h2 class="text-secondary text-center" style="font-size: 5rem;"><?php echo $row; ?></h2>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-3 my-3">
            <div class="card text-bg-light text-dark rounded-0 border-0" style="max-height: 200px; min-height: 150px">
                <div class="card-body">
                    <h3>Males</h3>
                    <?php
                    $query = "SELECT * FROM `members` WHERE `Sex` = 'M'";
                    $query_run = mysqli_query($connection, $query);
                    if ($query_run) {
                        $row = mysqli_num_rows($query_run)
                    ?>
                        <h2 class="text-secondary text-center" style="font-size: 5rem;"><?php echo $row; ?></h2>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-3 my-3">
            <div class="card text-bg-dark text-light rounded-0 border-0" style="max-height: 200px; min-height: 150px">
                <div class="card-body">
                    <h3>Females</h3>
                    <?php
                    $query = "SELECT * FROM `members` WHERE `Sex` = 'F'";
                    $query_run = mysqli_query($connection, $query);
                    if ($query_run) {
                        $row = mysqli_num_rows($query_run)
                    ?>
                        <h2 class="text-secondary text-center" style="font-size: 5rem;"><?php echo $row; ?></h2>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-3 my-3">
            <div class="card text-bg-light text-dark rounded-0 border-0" style="max-height: 200px; min-height: 150px">
                <div class="card-body">
                    <h3>Youths</h3>
                    <?php
                    $query = "SELECT Firstname,Sur_name,Id, round(DATEDIFF(CURRENT_DATE(), Birth_Date)/365) as Age
                     FROM members WHERE round(DATEDIFF(CURRENT_DATE(), Birth_Date)/365) > 14
                      AND round(DATEDIFF(CURRENT_DATE(), Birth_Date)/365) < 45";
                    $query_run = mysqli_query($connection, $query);
                    if ($query_run) {
                        $row = mysqli_num_rows($query_run)
                    ?>
                        <h2 class="text-secondary text-center" style="font-size: 5rem;"><?php echo $row; ?></h2>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


    <?php
    include_once('includes/footer.php');
    ?>

    <script src="js/jquery.js"></script>
    <script src="js/custom.js"></script>