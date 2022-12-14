<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/validation_functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php 
      $doc_id = (int)$_GET["docid"];
      $row = confirm_get_docid($doc_id);
?>
<?php
  $message = "";
  // processing the form
  if(isset($_POST["submit"])) {
    // variables
    $doc_id = (int)$doc_id;

    $date = mysql_prep($_POST["date"]);
    $time = mysql_prep($_POST["time"]);
    
    //$message = $date." ".$time;
    
    // validations
    $required_fields = array("date", "time");
    validate_presences($required_fields);
    
    // query
    if (empty($errors)) {		
    
      // int, date, time, int
      // 0 == Free
      // 1 == Busy 
      $query  = "INSERT INTO doctime ( doc_id, date, time, status) ";
      $query .= " VALUES ( {$doc_id}, '{$date}', '{$time}', 0 )";
      
      $result = mysqli_query($connection, $query);

      //echo $query; // But It Will cause - Cannot modify header

      if ($result) {
        // Success
        $message = '<div class="w3-panel w3-pale-yellow w3-border" style="width:500px;"><p>';
        $message.= "Time inserted successfully.";
        $message.= '</p></div>';
      } else {
        // Failure
        $message = '<div class="w3-panel w3-pale-yellow w3-border" style="width:500px;"><p>';
        $message.= "Time insertion failed. <br>".
        " (" . mysqli_errno($connection) . ") <br>".
        "Not for production:  " .mysqli_error($connection)   
        //"Вероятно, дубликат. "      
        ;
        $message.= '</p></div>';
      }    
  
    } else {
      // Вероятно, GET запрос
      // 
  
    }	
  }

?>
<?php   include("layout/top.php"); ?>
<?php
    $doc_row = get_doc_by_id($doc_id);
    $output_name = $doc_row['firstname'].' '.$doc_row['surname'];
?>
        <h2>Doc time: <?php  echo $output_name; ?></h2>
<?php
  echo $message;
  echo message();
  echo form_errors($errors);
?>
        <p>Please, configure this.</p>
        <p>Добавленное время в публичной части отобразится у каждой из специальностей дока. 
           Время здесь отобразится забронированным при первом запросе по той или иной специальности. 
           В публичной части у всех специальностей оно перестанет отображаться.</p>
        <p>In public part the time will be displayed for each of the doc's specialties.
           The time will be booked at the first request for a particular specialty. In other specialties, it will no longer be displayed.</p>

        <div class="w3-container w3-light-grey w3-responsive w3-mobile" style="width:100%; float:left;">      
            
            <form action="doc_time.php?docid=<?php echo $row["id"];  ?>" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">
                <p>
                  <label for="birthdaytime">Meet (date and time):</label>
                  <input type="date" name="date">
                  <input type="time" name="time">
                  <input type="submit" name="submit" value="Submit">
                </p>
            </form>

            <table class="w3-table w3-bordered" style="width: 100%;">
                <tr>
                  <th>Date</th>
                  <th>Day</th>
                  <th>Time</th>
                  <th>Status</th>
                  <th>Client Request</th>
                  <th>Req Id</th>
                  <th>Delete</th>
                </tr>
                
<?php
      $result_set = get_times_by_docid($row["id"], 30, "all");  

      while($row_time = mysqli_fetch_assoc($result_set)) {       
        if ($row_time["status"] == 0) {
          $status = '<td class="w3-text-teal">';
          $status.= "Free";
          $status.= '</td>';
          $status.= '<td class="w3-text-teal">';
          $status.= "No Request";
          $status.= '</td>';
        }

        if ($row_time["status"] == 1) {
          $status = '<td>';
          $status.= "Busy";
          $status.= '</td>';
          $status.= '<td>';
          $status.= "<a href=\"client_editreqs.php?id=".$row_time["clientreqs_id"]."\">Request Link</a>";
          $status.= '</td>';
        }

        // если дата в прошлом, подготовить "серый" класс
        $grey_class = grey_class_for_past($row_time["date"]);

?>                <tr  class="<?php echo $grey_class; ?>" > 
                    <td><?php echo date("d.m.y", strtotime($row_time["date"])); ?></td>
                    <td><?php echo date("l", strtotime($row_time["date"]));  ?></td>
                    <td><?php echo substr($row_time["time"], 0, -3);  ?></td>
                    <?php echo $status; ?>
                    <td><?php echo "# ".$row_time["clientreqs_id"]; ?></td>


                  <?php  
                  // Ссылка Delete отображается не всегда,
                  // но, тем не менее, БД настроена на запрет удаления, 
                  // если есть связанные внешние ключи.
                        if(empty($row_time["clientreqs_id"])) {  ?>
                    <td><a href="doctime_delete.php?timeid=<?php echo $row_time["id_time"]; ?>&docid=<?php echo $row["id"]; ?>"
                         onclick="return confirm('Are you sure?');"> Delete </a></td>
                <?php  } else {   ?>
                    <td> </td>
                <?php  } ?>      
                  </tr>
<?php  
      }
?>
<!--                
                <tr>
                  <td>27.07</td>
                  <td>Sun</td>
                  <td>12:00</td>
                  <td class="w3-text-teal">Free</td>
                </tr>
-->                
            </table>            
        </div>             
                            
<?php include("layout/bottom.php"); ?>