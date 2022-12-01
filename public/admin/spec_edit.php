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

        <h2>Spec Edit: <?php echo $specname; ?></h2>
        <p>Please, configure this.</p>  
        
        <div>
            <form action="#" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">
                <h2 class="w3-center">Spec Edit</h2>
                
                Spec:<br>
                <input class="w3-input w3-border" name="first" type="text" value="<?php echo $specname; ?>">

                <p>
                  <input type="submit" name="submit" class="w3-button w3-teal" value="Save Changes">
                </p>
                <hr style="height: 1px; background-color: darkgrey;">
                
                <p>
                  <a href="spec_delete.php?specname=<?php echo $specname; ?>" class="w3-button w3-border w3-border-red"
                     onclick="return confirm('Are you sure?');">Delete</a>
                </p>
            </form>

                <p><a href="spec_config.php?specname=<?php echo $specname; ?>" class="w3-button w3-border">&laquo; Назад</a></p>
        </div>          
                        
<?php include("layout/bottom.php"); ?>


