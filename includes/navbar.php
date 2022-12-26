<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-1 fs-5" href="index.php">SAP Catholic chc -  Axim</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button"
    data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
    aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


    <!-- <input id="live_search" class="form-control form-control-dark rounded-0 border-0" type="text" placeholder="Search..." autocomplete="off"> -->


    <!-- <button type="submit" class="btn btn-outline-secondary rounded-0 border-0">
        <i class="fas fa-search"></i> search
    </button> -->
    <span class="mr-2 d-block d-sm-inline">
        <a href="./profile.php" class="text-decoration-none text-white w-100">
            <?php
                $id = $_SESSION['users']['users_id'];
                $query = "SELECT * FROM `users` WHERE `Id` = '$id'";
                $query_run = mysqli_query($connection, $query);
                if ($query_run) {
                    while ($row = mysqli_fetch_array($query_run)) {
                        // display in user's name
                        echo $row['Firstname'] . " " . $row['Surname'];
                    }
                }
            ?>
        </a>
    </span>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <form action="./logic/logout.php" method="post">
                <button type="submit" name="logout" class="btn btn-outline-warning border-0 rounded-0"
                onclick="return confirm('Confirm sign out')"><i class="fa fa-sign-out"></i> Sign Out</button>
            </form>
        </div>
    </div>
</header>


<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <span data-feather="home" class="align-text-bottom"></span>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add-member.php">
                            <span data-feather="shopping-cart" class="align-text-bottom"></span>
                            Add member
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view-members.php">
                            <span data-feather="users" class="align-text-bottom"></span>
                            View members
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="view-other-info.php">
                            <span data-feather="layers" class="align-text-bottom"></span>
                            About members
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="view-address.php">
                            <span data-feather="layers" class="align-text-bottom"></span>
                            Members address
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="view-family.php">
                            <span data-feather="layers" class="align-text-bottom"></span>
                            Members family
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="view-church.php">
                            <span data-feather="layers" class="align-text-bottom"></span>
                            Members baptism
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="view-society.php">
                            <span data-feather="layers" class="align-text-bottom"></span>
                            Members societies
                        </a>
                    </li>
                </ul>

                <!-- <li class="nav-item">
                        <a class="nav-link" href="add-other-info.php">
                            <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                            Add other info
                        </a>
                    </li> -->

                <!-- <li class="nav-item">
                        <a class="nav-link" href="add-family.php">
                            <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                            Add family
                        </a>
                    </li> -->

                <!-- <li class="nav-item">
                        <a class="nav-link" href="add-society.php">
                            <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                            Add society
                        </a>
                    </li> -->

                <!-- <li class="nav-item">
                        <a class="nav-link" href="add-church.php">
                            <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                            Add church
                        </a>
                    </li> -->

                <!-- <li class="nav-item">
                        <a class="nav-link" href="add-address.php">
                            <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                            Add address
                        </a>
                    </li> -->

                <h6 class="sidebar-heading d-flex justify-content-between
                align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                    <span>Manage system</span>
                    <a class="link-secondary" href="#" aria-label="Add a new report">
                        <span data-feather="plus-circle" class="align-text-bottom"></span>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register-admin.php">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            Add user
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view-users.php">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            View users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            Social engagement
                        </a>
                    </li>
                </ul>
            </div>
        </nav>