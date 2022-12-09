<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-1 fs-6" href="index.php">St. Anthony Catholic Church Axim</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-70 rounded-0 border-0" type="text" placeholder="Search">
    <button type="submit" class="btn btn-outline-secondary rounded-0 border-0 w-10"><i class="fas fa-search"></i> search</button>
    <span class="mr-2 d-none d-lg-inline w-20">
        <a href="./profile.php" class="text-decoration-none text-white">
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
            ?></a>
    </span>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3 text-warning" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="fas fa-sign-out-alt"></i> Sign Out
            </a>
        </div>
    </div>
</header>


<!-- Sign out Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Confirm sign out</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Do you want to sign out?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="./logic/logout.php" method="post">
                    <button type="submit" name="logout" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Sign Out</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link"  href="index.php">
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
                        <a class="nav-link" href="add-other-info.php">
                            <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                            Add other info
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view-other-info.php">
                            <span data-feather="layers" class="align-text-bottom"></span>
                            View other info
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add-address.php">
                            <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                            Add address
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view-address.php">
                            <span data-feather="layers" class="align-text-bottom"></span>
                            View address
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add-family.php">
                            <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                            Add family
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view-family.php">
                            <span data-feather="layers" class="align-text-bottom"></span>
                            View family
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                    <span>Saved reports</span>
                    <a class="link-secondary" href="#" aria-label="Add a new report">
                        <span data-feather="plus-circle" class="align-text-bottom"></span>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            Current month
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            Last quarter
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            Social engagement
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            Year-end sale
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="register-admin.php">
                            <span data-feather="file" class="align-text-bottom"></span>
                            User's Panel
                        </a>
                    </li>
                </ul>
            </div>
        </nav>