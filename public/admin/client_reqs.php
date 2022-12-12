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
                  <th>Client Name</th>          
                  <th>Date Born</th>
                  <th>Client Phone</th>
                  <th>Specname</th>
                  <th>Doc name</th>
                  <th>Date</th>          
                  <th>Day</th>
                  <th>Time</th>
                  <th class="w3-text-grey">Action</th>
                </tr>
<?php
      // SELECT all FROM client_reqs

      $query = "SELECT * FROM client_reqs";

      // Confirm
      $result = mysqli_query($connection, $query);

      if (!$result) {
          die(
          "Database query failed. "."Код: ".mysqli_errno($connection) 
          );
      }

      // while($row) {
      //     Prepare variables for output
      //     and output
      // }
      while($row = mysqli_fetch_assoc($result)){
          echo "<tr>";
          // client fullname
          echo "<td>".$row['firstname']." ".$row['surname']."</td>";

          // date born
          // prepare of var
          $born = date("d.m.y", strtotime($row['datebirth']));
          echo "<td>".$born."</td>";

          // client phone
          echo "<td>".$row['phone']."</td>";  

          // specname
          // prepare of var
          $specname = get_specname_by_specid($row['spec_id']);
          echo "<td>".$specname."</td>"; 

          // doc fullname
          // prepare of var
          $docrow = get_doc_by_id($row['doc_id']);
          echo "<td>".$docrow['firstname']." ".$docrow['surname']."</td>"; 

          // date meet
          // prepare of var
          $doctimerow = get_doctimerow_by_doctimeid($row['doctime_id']);
          $date_raw =  $doctimerow["date"];
          $datemeet = date("d.m.y", strtotime($date_raw));
          echo "<td>".$datemeet."</td>";

          // day meet
          // prepare of var
          $daymeet = date("l", strtotime($date_raw));
          echo "<td>".$daymeet."</td>"; 

          // time meet
          // prepare of var
          $time_raw = $doctimerow["time"];
          $timemeet = substr($time_raw, 0, -3);
          echo "<td>".$timemeet."</td>"; 

          // action
          echo "<td>";
          echo "<a href=\"client_editreqs.php?id=".$row['id']."\" class=\"\">Edit</a>";
          echo "</td>"; 

          echo "</tr>";
      }

      // mysqli_free_result()
      mysqli_free_result($result);
?>
<!--
                <tr>
                  <td>Eve Jackson</td>
                  <td>12.01.2000</td>
                  <td>8-950-123-4567</td>
                  <td>Jillington</td>
                  <td>Jill Smith</td>
                  <td>11.12.22</td>
                  <td>Monday</td>
                  <td>10:50</td>
                  <td><a href="client_editreqs.php?id=2" class="">Edit</a></td>
                </tr>
-->
              </table>
        </div>
          
<?php include("layout/bottom.php"); ?>