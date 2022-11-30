<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php   include("layout/top.php"); ?>

        <h2>Edit client's request</h2>
        <p>Please, configure this.</p>

        <div class="w3-container w3-light-grey w3-responsive w3-mobile" style="width:100%; float:left;">      
            
            <form action="#" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">
                <h2 class="w3-center">Client data</h2>
                
                      Client:<br>
                      <input class="w3-input w3-border" name="first" type="text" placeholder="First Name">
                      <input class="w3-input w3-border" name="last" type="text" placeholder="Middle Name">
                      <input class="w3-input w3-border" name="email" type="text" placeholder="Last Name">
                      <input class="w3-input w3-border" name="message" type="number" min="1" max="99" placeholder="Age">
                      <input class="w3-input w3-border" name="phone" type="text" placeholder="Phone" required>   
                      Doc:<br>
                      <input class="w3-input w3-border" name="" type="text" placeholder="Name">
                      Date:<br>
                      <input class="w3-input w3-border" name="" type="date" >
                      Time:<br>
                      <input class="w3-input w3-border" name="" type="time" >               

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


