<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php   include("layout/top.php"); ?>

        <h2>Spec Create</h2>  

        <p>Please, configure this.</p>  
        
        <div>
            <form action="#" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">
                <h2 class="w3-center">Spec Create</h2>
                
                    Spec:<br>
                    <input class="w3-input w3-border" name="first" type="text" placeholder="New Spec">

                    <p>
                    <input type="submit" name="submit" class="w3-button w3-teal" value="Save Changes">
                    </p>
            </form>
        </div>        
                        
<?php include("layout/bottom.php"); ?>


