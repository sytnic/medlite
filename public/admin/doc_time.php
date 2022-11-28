<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php   include("layout/top.php"); ?>

        <h2>Doc time</h2>
        <p>Please, configure this.</p>  


        <div class="w3-container w3-light-grey w3-responsive w3-mobile" style="width:100%; float:left;">      
            
            <form action="##" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">
                <p>
                  <label for="birthdaytime">Meet (date and time):</label>
                  <input type="datetime-local" id="birthdaytime" name="birthdaytime">
                  <input type="submit" value="Submit">
                </p>
            </form>

            <table class="w3-table w3-bordered" style="width: 50%;">
                <tr>
                  <th>Date</th>          
                  <th>Day</th>
                  <th>Time</th>
                  <th>Status</th>          
                </tr>
                <tr>
                  <td>11.06</td>
                  <td>Tue</td>
                  <td>10:30</td>              
                  <td class="w3-text-teal">Free</td>
                </tr>
                <tr>              
                  <td>11.12</td>
                  <td>Mon</td>
                  <td>10:50</td>
                  <td>Busy</td>
                </tr>
                <tr>
                  <td>27.07</td>
                  <td>Sun</td>
                  <td>12:00</td>
                  <td class="w3-text-teal">Free</td>
                </tr>
            </table> 
            
        </div>             
                            
<?php include("layout/bottom.php"); ?>