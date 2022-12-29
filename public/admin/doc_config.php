<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php 
      $doc_id = (int)$_GET["docid"];
      // если doc_id нет в БД:
      // redirect if false
      // or 1 row from DB
      $row = confirm_get_docid($doc_id);
?>      
<?php
        $message = "";
        // processing form
        if(isset($_POST["submit"])) {

            $value_activity = (int)$_POST["activity"];
            $id = (int)$row["id"];

            $query = "UPDATE docs SET";
            $query.= " active = {$value_activity}"; 
            $query.= " WHERE id = {$id}";
            $query.= " LIMIT 1";

            $result = mysqli_query($connection, $query);

            // не использую эту часть
            // && mysqli_affected_rows($connection) == 1
            // для адекватного поведения при перезаписи одного и того же значения
            if ($result) {
                // Success
                $message = "Activity updated succefull. Now - ";
                //if($row["active"] == 1) { echo "active"; } else { echo 'not active'};

                // необходимо для перезаписи $row["active"],
                // пока не придумал лучше
                $row = confirm_doc_id($doc_id);
                
                // дописка в message
                $active = "<b> active </b>";
                $no_act = "<b> no active </b>";
                if($row["active"] == 1) { $message.= $active; } else { $message.= $no_act; };
            } else {
                // Failure
                $message = "Activity updating is fell.";            
            }
        }
?>
<?php   include("layout/top.php"); ?>
<p><?php echo $message; ?></p>
        <h2>Overall for doc: <?php echo $row["firstname"]." ".$row["surname"];  ?> </h2>
        <p>Предложения от неактивного дока не отображаются в публичной части.</p>

        <div class="w3-card w3-light-grey w3-responsive w3-mobile w3-margin-bottom " style="width:80%; float:left;">
        
            <form action="doc_config.php?docid=<?php echo $row["id"]; ?>" 
                  method="post" class="w3-container w3-padding w3-text-teal">
                  
                <input class="w3-radio" type="radio" name="activity" value="1" 
                    <?php if($row["active"] == 1) {echo "checked";} ?>  >
                <label>Active doc</label>                    
                <br>
                
                <input class="w3-radio" type="radio" name="activity" value="0"
                    <?php if($row["active"] == 0) {echo "checked";} ?>  >
                <label>Not Active doc</label>
                <br>

                <p>
                <input type="submit" name="submit" class="w3-button w3-teal" value="Save Changes">
                </p>            
            </form>
        </div>

        <div class="w3-container w3-card w3-margin-bottom" style="width:80%; float:left;">     
            <p><i class="fa fa-gear"> </i> <a href="doc_edit.php?docid=<?php echo $doc_id; ?>">Edit doc</a></p>
            <p><i class="fa fa-clock-o"> </i> <a href="doc_time.php?docid=<?php echo $doc_id; ?>">Edit doc's time</a></p>        
        </div>
    
<?php include("layout/bottom.php"); ?>