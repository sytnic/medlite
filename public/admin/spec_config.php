<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php confirm_getparam();  ?>
<?php
        if (isset($_GET["specname"])) {
              $specname = $_GET["specname"];
        }        
?>
<?php   include("layout/top.php"); ?>

        <h2>Config Specializations</h2>
        <p>Please, configure your docs in specializations.</p>  

        <div>
            <p>Spec: <?php echo $specname; ?></p>
            <a href="spec_edit.php?specname=<?php echo $specname; ?>" class="w3-button w3-border">Edit Specname</a>
            <a href="spec_value.php?specname=<?php echo $specname; ?>" class="w3-button w3-border">Value of spec</a>

            <p><a href="spec_list.php" class="w3-button w3-border">&laquo; Spec List</a></p>
        </div>
                        
<?php include("layout/bottom.php"); ?>