<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/validation_functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php
if (isset($_POST['submit'])) {
	// Process the form

	$specname = mysql_prep($_POST["specname"]);
             
    // validations
	$required_fields = array("specname");
	validate_presences($required_fields);
	// здесь $errors[] - global
	
	// Return true || $errors[]
	validate_uniqname($specname, 'specs', 'specname');   
    
        if (empty($errors)) {		
       
		$query  = "INSERT INTO specs (";
		$query .= " specname ";
		$query .= ") VALUES (";
		$query .= " '{$specname}' ";
		$query .= ")";
		
		$result = mysqli_query($connection, $query);

		//echo $query; // But It Will cause - Cannot modify header

		if ($result) {
			// Success
			$_SESSION["message"] = "Spec created.";
			redirect_to("spec_create.php");
		} else {
			// Failure
			$_SESSION["message"] = "Spec creation failed.";
			redirect_to("spec_create.php");
		}    
			
	} else {
		// Вероятно, GET запрос
		// 
	}	
}
?>
<?php   include("layout/top.php"); ?>
<?php echo message();   ?>
<?php echo form_errors($errors); ?>

        <h2>Spec Create</h2>
        <p>Please, configure this.</p>  
        
        <div>
            <form action="spec_create.php" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">
                <h2 class="w3-center">Spec Create</h2>
                
                    Spec:<br>
                    <input class="w3-input w3-border" name="specname" type="text" placeholder="New Spec">

                    <p>
                    <input type="submit" name="submit" class="w3-button w3-teal" value="Save Changes">
                    </p>
            </form>

			<p><a href="spec_list.php" class="w3-button w3-border">&laquo; Spec List</a></p>
        </div>        
                        
<?php include("layout/bottom.php"); ?>


