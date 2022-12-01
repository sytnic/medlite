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

        <h2>Spec One plus doc</h2>
        <p>Please, configure this.</p> 
        <p>Current Spec: <?php echo $specname; ?></p> 
        
        <div>
            <form action="#" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">
                <h2 class="w3-center">Spec One Plus Doc</h2>
                
                    <p>Docs:</p>
                    <select class="w3-select w3-border" name="option">
                        <option value="" disabled selected>Choose your option</option>
                        <option value="1">Doc 1</option>
                        <option value="2">Doc 2</option>
                        <option value="3">Doc 3</option>
                    </select>

                    <p>
                    <input type="submit" name="submit" class="w3-button w3-teal" value="Save Changes">
                    </p>
            </form>

            <p><a href="spec_value.php?specname=<?php echo $specname; ?>" class="w3-button w3-border">&laquo; Назад</a></p>
        </div>

<?php include("layout/bottom.php"); ?>