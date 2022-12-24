<?php
include_once('config/security.php');

?>

<div class="container-fluid" style="margin-top: -10px;">
    <div class="row">
        <div class="col-md-12">
            <?php

            if (isset($_POST['input'])) {

                $input = $_POST['input'];

                $query = "SELECT * FROM `members` WHERE `Firstname` LIKE '{$input}%' OR
                `Sur_name` LIKE '{$input}%' OR `Other_name` LIKE '{$input}%' OR
                 `Sex` LIKE '{$input}%' OR CONCAT(`Init`,`Reg_year`,`Id`) LIKE '{$input}%'";
                $query_run = mysqli_query($connection, $query);

                if (mysqli_num_rows($query_run) > 0) {
            ?>
                    <?php include_once('logic/alerts.php'); ?>
                    <div class="card shadow my-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Firstname</th>
                                            <th scope="col">Surname</th>
                                            <th scope="col">Othernames</th>
                                            <th scope="col">Sex</th>
                                            <th scope="col">Birth Date</th>
                                            <th scope="col">Birth Place</th>
                                            <th scope="col">Birth Region</th>
                                            <th scope="col">Birth District</th>
                                            <th scope="col">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                            $id = $row['Init'] . $row['Reg_year'] . $row['Id'];
                                            $firstname = $row['Firstname'];
                                            $surname = $row['Sur_name'];
                                            $othername = $row['Other_name'];
                                            $sex = $row['Sex'];
                                            $birth_place = $row['Birth_Place'];
                                            $birth_region = $row['Birth_Region'];
                                            $birth_Date = $row['Birth_Date'];
                                            $birth_District = $row['Birth_District'];
                                        ?>
                                            <tr>
                                                <td>
                                                    <p> <?php echo $id; ?></p>
                                                </td>
                                                <td>
                                                    <p> <?php echo $firstname ?></p>
                                                </td>
                                                <td>
                                                    <p> <?php echo $surname ?></p>
                                                </td>
                                                <td>
                                                    <p> <?php echo $othername ?></p>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($row['Sex'] == "M") {
                                                    ?>
                                                        <p>Male</p>
                                                    <?php
                                                    } elseif ($row['Sex'] == "F") {
                                                    ?>
                                                        <p>Female</p>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <p> <?php echo $row['Birth_Date']; ?> </p>
                                                </td>
                                                <td>
                                                    <p> <?php echo $row['Birth_Place']; ?> </p>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($row['Birth_Region'] == "AH") {
                                                    ?>
                                                        <p>Ahafo</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "AS") {
                                                    ?>
                                                        <p>Ashanti</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "BR") {
                                                    ?>
                                                        <p>Bono</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "BE") {
                                                    ?>
                                                        <p>Bono East</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "CR") {
                                                    ?>
                                                        <p>Central</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "ER") {
                                                    ?>
                                                        <p>Eastern</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "GA") {
                                                    ?>
                                                        <p>Greater Accra</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "NR") {
                                                    ?>
                                                        <p>Northern</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "NE") {
                                                    ?>
                                                        <p>North East</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "OR") {
                                                    ?>
                                                        <p>Oti</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "SR") {
                                                    ?>
                                                        <p>Savannah</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "UE") {
                                                    ?>
                                                        <p>Upper East</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "UW") {
                                                    ?>
                                                        <p>Upper West</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "VR") {
                                                    ?>
                                                        <p>Volta</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "WR") {
                                                    ?>
                                                        <p>Western</p>
                                                    <?php
                                                    } elseif ($row['Birth_Region'] == "WN") {
                                                    ?>
                                                        <p>Western North</p>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <p> <?php echo $row['Birth_District']; ?> </p>
                                                </td>
                                                <td>
                                                    <form action="member-profile.php" method="post">
                                                        <input type="hidden" name="member_id" value="<?php echo $row['Id']; ?>" hidden>
                                                        <button type="submit" class="btn btn-outline-secondary" name="view-member" data-bs-toggle="tooltip" data-bs-placement="left" title="View member's profile">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            <?php
                                        }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            <?php
                } else {
                    echo '<p class="text-warning"></p>';
                }
            }

            ?>
        </div>
    </div>
</div>