<?php

    if(isset($_SESSION['success']) && $_SESSION['success'] !=''){

        ?>
            <div class="alert alert-success alert-dismissible fade mt-3 show" role="alert">
                <?php echo $_SESSION['success'];?>
            </div>
        <?php
            unset($_SESSION['success']);

    }elseif(isset($_SESSION['warning']) && $_SESSION['warning'] !=''){
        
        ?>
            <div class="alert alert-warning alert-dismissible fade mt-3 show" role="alert">
                <?php echo $_SESSION['warning'];?>
            </div>
        <?php
            unset($_SESSION['warning']);

    }elseif(isset($_SESSION['status']) && $_SESSION['status'] !=''){

        ?>
            <div class="alert alert-danger alert-dismissible fade mt-3 show" role="alert">
                <?php echo $_SESSION['status'];?>
            </div>
        <?php
                unset($_SESSION['status']);

    }elseif(isset($_SESSION['neutral']) && $_SESSION['neutral'] !=''){

        ?>
            <div class="alert alert-secondary alert-dismissible fade mt-3 show" role="alert">
                <?php echo $_SESSION['neutral'];?>
            </div>
        <?php
                unset($_SESSION['neutral']);
    }

?>