<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php   include("layout/top.php"); ?>

        <h2>Create doc</h2>
        <p>Please, configure this.</p>



        <div class="w3-container w3-light-grey w3-responsive w3-mobile" style="width:80%; float:left;">      
            
            <form action="#" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">
                <h2 class="w3-center">Doc data</h2>
                
                    Doc:<br>
                    <input class="w3-input w3-border" name="first" type="text" placeholder="First Name">
                    <input class="w3-input w3-border" name="middle" type="text" placeholder="Middle Name">
                    <input class="w3-input w3-border" name="last"  type="text" placeholder="Last Name">
                    <input class="w3-input w3-border" name="spec1" type="text" placeholder="Specialization 1">
                    <input class="w3-input w3-border" name="spec2" type="text" placeholder="Specialization 2">
                    <input class="w3-input w3-border" name="spec3" type="text" placeholder="Specialization 3">
                    <input class="w3-input w3-border" name="phone" type="text" placeholder="Phone">
                    <input class="w3-input w3-border" name="cost"  type="text" placeholder="Cost">   
                    
                    <p>
                    <input type="submit" name="submit" class="w3-button w3-teal" value="Create Doc">
                    </p>            

            </form>
        </div>        
                        
<?php include("layout/bottom.php"); ?>