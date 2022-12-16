<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/validation_functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php 
      $doc_id = (int)$_GET["docid"];
      // redirect or getting 1 row from DB
      $row = confirm_get_docid($doc_id);
?>
<?php
  $message = "";

  // Process the form
  if (isset($_POST['submit'])) {
    // variables
      $select = (int)$_POST["select"];
      $doc_id = (int)$row["id"];	
             
    // validations
      $required_fields = array("select");
      validate_presences($required_fields);
      // здесь $errors[] - global
    
    // query
      if (empty($errors)) {		
       
          // int, int
          $query  = "INSERT INTO docspec ( doc_id, spec_id) ";
          $query .= " VALUES ( {$doc_id}, {$select} )";
          
          $result = mysqli_query($connection, $query);

          //echo $query; // But It Will cause - Cannot modify header

          if ($result) {
            // Success
            $message = '<div class="w3-panel w3-pale-yellow w3-border" style="width:300px;"><p>';
            $message.= "Spec inserted successfully.";
            $message.= '</p></div>';
          } else {
            // Failure
            $message = '<div class="w3-panel w3-pale-yellow w3-border" style="width:300px;"><p>';
            $message.= "Spec insertion failed. <br>".
            " (" . mysqli_errno($connection) . ") <br>".
            // "Not for production:  " .mysqli_error($connection)
            "Вероятно, не уникальное значение."           
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

        <h2>Doc edit specs: <?php echo $row["firstname"]." ".$row["surname"]; ?> </h2>

<?php   echo $message;  ?>
<?php   echo message();  ?>
<?php   echo form_errors($errors);  ?>
        
        <p>Please, configure this.</p>

        <div class="w3-container w3-light-grey w3-responsive w3-mobile" style="width:100%; float:left;">      
          
          <form action="doc_editspec.php?docid=<?php echo $row["id"]; ?>" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">
                <h2 class="w3-center">Doc specs</h2>

                <p>Specs:</p>

                <select class="w3-select w3-border" name="select">
                        <option value="" disabled selected>Choose your option</option>
<?php
                        // mysqli_result | false
                        // согласно функции вернётся false, если нет строк в запросе
                        $result_set = get_all_specs();
                        // 
                        
                        // если получим объект, а не ложь
                        if($result_set) {
                        
                                while($row_spec = mysqli_fetch_assoc($result_set)) {
?>
                <option value="<?php echo $row_spec["id"]; ?>"><?php echo $row_spec["specname"]; ?></option>
<?php                           
                                }
                                mysqli_free_result($result_set);
                        }

?>
                <!--    <option value="1">Doc 1</option>   -->
                </select>

                <p>
                  <input type="submit" name="submit" class="w3-button w3-teal" value="Add Spec">
                </p>

                <hr style="height: 1px; background-color: darkgrey;">
                  <p>Specializations:</p>

                <ul>
<?php   
                // mysqli_result | empty mysqli_result
                $spec_set =  get_specdata_by_docid($row["id"]);
                //var_dump($spec_set);

                // if mysqli_result will be empty, than output will be empty.
                while($spec = mysqli_fetch_assoc($spec_set)) {
                  echo '<li class="w3-text-black"> '.$spec["specname"].' ';                      
                  echo '<a href="doc_editspec_delete.php?specid=';
                  echo $spec["spec_id"];
                  echo '&docid=';
                  echo $row["id"];
                  echo '"';
                  echo ' class="w3-text-red" ';
                  echo " onclick=\"return confirm('Are you sure?');\"> ";
                  echo ' Detach </a>';

                  echo '</li>';
                }

?>
                </ul>                                     
          </form>
          <p><a href="doc_edit.php?docid=<?php echo $row["id"]; ?>" class="w3-button w3-border">&laquo; Doc Edit</a></p>      
        </div>

<?php include("layout/bottom.php"); ?>