<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php   include("layout/top.php"); ?>

        <h2>List of clients</h2>
        <p>Please, configure this.</p>

        <div class="w3-container w3-light-grey w3-responsive w3-mobile" style="width:100%; float:left;">      
            
            <table class="w3-table w3-bordered">
                <tr>
                  <th>Name</th>          
                  <th>Age</th>
                  <th>Phone</th>
                  <th>Spec</th>
                  <th>Doc</th>
                  <th>Date</th>          
                  <th>Day</th>
                  <th>Time</th>
                  <th class="w3-text-grey">Action</th>          
                </tr>
                <tr>
                  <td>Jill Smith</td>
                  <td>55</td>
                  <td>8-950-123-4567</td>
                  <td>Jillington</td>
                  <td>Jill Smith</td>
                  <td>--</td>
                  <td>--</td>
                  <td>--</td>
                  <td><a href="client_editreqs.php?id=1" class="">Edit</a></td>
                </tr>
                <tr>
                  <td>Eve Jackson</td>
                  <td>44</td>
                  <td>8-950-123-4567</td>
                  <td>Jillington</td>
                  <td>Jill Smith</td>
                  <td>11.12</td>
                  <td>Mon</td>
                  <td>10:50</td>
                  <td><a href="client_editreqs.php?id=2" class="">Edit</a></td>
                </tr>
                <tr>
                  <td>Adam Johnson</td>
                  <td>33</td>
                  <td>8-950-123-4567</td>
                  <td>Jillington</td>
                  <td>Smith Morfeus</td>
                  <td>--</td>
                  <td>--</td>
                  <td>--</td>
                  <td><a href="client_editreqs.php?id=3" class="">Edit</a></td>
                </tr>
              </table>
              
        </div>
          
<?php include("layout/bottom.php"); ?>