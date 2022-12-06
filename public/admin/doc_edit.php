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

  // Process the form
  if (isset($_POST['submit'])) {

      $firstname = mysql_prep($_POST["firstname"]);
      $middlename = mysql_prep($_POST["middlename"]);
      $lastname = mysql_prep($_POST["lastname"]);

      $phone = mysql_prep($_POST["phone"]);
      $cost = mysql_prep($_POST["cost"]);     
	
      $id = $row["id"];
	
             
        // validations
      $required_fields = array("firstname", "lastname" );
      validate_presences($required_fields);
      // здесь $errors[] - global
         
      if (empty($errors)) {		
       
          $query  = "UPDATE docs SET ";
          $query .= " firstname = '{$firstname}',";
          $query .= " midname = '{$middlename}',";
          $query .= " surname = '{$lastname}',";
          $query .= " phone = '{$phone}',";
          $query .= " cost = '{$cost}'";
          $query .= " WHERE id = {$id}";
          $query .= " LIMIT 1";
          
		      $result = mysqli_query($connection, $query);

		      //echo $query; // But It Will cause - Cannot modify header

		      if ($result && mysqli_affected_rows($connection) == 1) {
                // Success
                $message = "Doc updated successful.";
                // чтоб перезаписать массив
                $row = confirm_doc_id($doc_id);               
          } else {
                // Failure
                $message = "Doc updation failed.";
          } 
			
	    } else {
        // Вероятно, GET запрос
        // 
    	}	
  }
?>
<?php   include("layout/top.php"); ?>

        <h2>Edit doc (Delete doc)</h2>

<?php
        echo $message;
        echo form_errors($errors);
?>

        <p>Please, configure this.</p>

      <div class="w3-container w3-light-grey w3-responsive w3-mobile" style="width:100%; float:left;">      
          
          <form action="#" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">
              <h2 class="w3-center">Doc data</h2>
              
                    <p>Doc:</p>
                    Name * <input class="w3-input w3-border" name="firstname" type="text" value="<?php echo $row["firstname"]; ?>">
                    Midname <input class="w3-input w3-border" name="middlename" type="text" value="<?php echo $row["midname"]; ?>">
                    Surname * <input class="w3-input w3-border" name="lastname" type="text" value="<?php echo $row["surname"]; ?>">

                    Phone <input class="w3-input w3-border" name="phone" type="text" value="<?php echo $row["phone"]; ?>">
                    Cost <input class="w3-input w3-border" name="cost" type="text" value="<?php echo $row["cost"]; ?>">
                    <br>

                  <p>
                  <input type="submit" name="submit" class="w3-button w3-teal" value="Save Changes">
                  </p>

                  <hr style="height: 1px; background-color: darkgrey;">
                  <p>Specializations:</p>
                  <ul>
<?php   
                // array | false
                $spec_array =  get_specnames_by_docid($row["id"]);
                // var_dump($spec_array);

                if (!$spec_array) {
                    echo "Specialties are not specified.";
                } else {
                    foreach ($spec_array as $specs) {
                      echo '<li class="w3-text-black"> '.$specs.' </li>';
                  }
                }
?>
<!--                <li class="w3-text-black">Option 4 <a href="##" class="w3-text-teal">Edit</a></li>   -->
                  </ul> 
                  <p>
                    <a href="doc_editspec.php?docid=<?php echo $row["id"]; ?>" class="w3-text-black" > Change It </a> 
                  </p>            
          </form>
          
          <p>
          <a href="doc_delete.php?docid=<?php echo $row["id"]; ?>" class="w3-button w3-border w3-border-red"
          onclick="return confirm('Are you sure?');"> Delete Doc </a>
          </p>
      </div>

<?php include("layout/bottom.php"); ?>