<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php   include("layout/top.php"); ?>

        <h2>Spec Edit</h2>
        <p>Please, configure this.</p>  
        
        <div>
            <form action="#" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">
                <h2 class="w3-center">Spec Edit</h2>
                
                Spec:<br>
                <input class="w3-input w3-border" name="first" type="text" placeholder="Spec name">

                <p>
                  <input type="submit" name="submit" class="w3-button w3-teal" value="Save Changes">
                </p>
                <hr style="height: 1px; background-color: darkgrey;">
                <p>
                  <input type="submit" name="submit" class="w3-button w3-border w3-border-red" value="Delete All">
                </p>
            </form>
        </div>          
                        
<?php include("layout/bottom.php"); ?>


