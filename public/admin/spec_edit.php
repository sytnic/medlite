<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/validation_functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php $spec_id = confirm_getparam();  ?>
<?php
        if (isset($_GET["specname"])) {
              $specname = $_GET["specname"];
        }        
?>
<?php

if (isset($_POST['submit'])) {
	// Process the form

	$post_specname = mysql_prep($_POST["specname"]);
             
     // validations
	$required_fields = array("specname");
	validate_presences($required_fields);
	// здесь $errors[] - global
	
	// Return true || $errors[]
	validate_uniqname($post_specname, 'specs', 'specname');   
    
        if (empty($errors)) {		
       
		$query  = "UPDATE specs SET ";
		$query .= " specname = '{$post_specname}'";
		$query .= " WHERE id = {$spec_id}";
		$query .= " LIMIT 1";
		
		$result = mysqli_query($connection, $query);

		//echo $query; // But It Will cause - Cannot modify header

		if ($result && mysqli_affected_rows($connection) >= 0) {
                        // Success
                        $_SESSION["message"] = "Spec updated.";
                        redirect_to("spec_list.php");
                } else {
                        // Failure
                        $message = "Spec updation failed.";
                } 
			
	} else {
		// Вероятно, GET запрос
		// 
	}	
}

?>
<?php   include("layout/top.php"); ?>
<?php echo $message; ?>
<?php echo form_errors($errors); ?>

        <h2>Spec Edit: <?php echo $specname; ?></h2>
        <p>Please, configure this.</p>  
        
        <div>
            <form action="spec_edit.php?specname=<?php echo $specname; ?>" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">
                <h2 class="w3-center">Spec Edit</h2>
                
                Spec:<br>
                <input class="w3-input w3-border" name="specname" type="text" value="<?php echo $specname; ?>">

                <p>
                  <input type="submit" name="submit" class="w3-button w3-teal" value="Save Changes">
                </p>

                <hr style="height: 1px; background-color: darkgrey;">                
                <p>
                  <a href="spec_delete.php?specname=<?php echo $specname; ?>" class="w3-button w3-border w3-border-red"
                     onclick="return confirm('Are you sure?');">Delete</a>
                </p>
            </form>

                <p><a href="spec_config.php?specname=<?php echo $specname; ?>" class="w3-button w3-border">&laquo; Назад</a></p>
        </div>          
                        
<?php include("layout/bottom.php"); ?>


