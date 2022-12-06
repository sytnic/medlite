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
                $active = "active";
                $no_act = "no active";
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
            <p>Please, configure this.</p>

        <div class="w3-container w3-light-grey w3-responsive w3-mobile" style="width:80%; float:left;">      
            
            <form action="doc_config.php?docid=<?php echo $row["id"]; ?>" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">
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

            <p><a href="doc_edit.php?docid=<?php echo $doc_id; ?>">Edit doc</a></p>

            <p><a href="doc_time.php?docid=<?php echo $doc_id; ?>">Edit doc's time</a></p>
        
        </div>

<?php include("layout/bottom.php"); ?>