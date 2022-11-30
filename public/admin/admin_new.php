<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/validation_functions.php");
        include("../../includes/session.php");   ?>
<?php confirm_logged_in(); ?>
<?php
if (isset($_POST['submit'])) {
	// Process the form

	$username = mysql_prep($_POST["username"]);
	$hashed_password = password_encrypt($_POST["password"]);
             
    // validations
	$required_fields = array("username", "password");
	validate_presences($required_fields);
	// здесь $errors[] - global

	$fields_with_max_lengths = array("username" => 30);
	validate_max_lengths($fields_with_max_lengths);
	// здесь $errors[] - global

	// Return true || $errors[]
	validate_uniqname($username, 'docadmins', 'username');   
    
    if (empty($errors)) {		
       
		$query  = "INSERT INTO docadmins (";
		$query .= "  username, password ";
		$query .= ") VALUES (";
		$query .= "  '{$username}', '{$hashed_password}' ";
		$query .= ")";
		
		$result = mysqli_query($connection, $query);

		// echo $query; // But It Will cause - Cannot modify header

		if ($result) {
			// Success
			$_SESSION["message"] = "Admin created.";
			redirect_to("admin_list.php");
		} else {
			// Failure
			$_SESSION["message"] = "Admin's creation failed.";
			redirect_to("admin_new.php");
		}    
			
	} else {
		// Вероятно, GET запрос
		// 
	}	
}
?>
<?php  include("layout/top.php"); ?>
<?php echo message();   ?>
<?php echo form_errors($errors); ?>  

<h2>Create Admin</h2>

<form action="admin_new.php" method="post">       
    Username:       <input type="text"     name="username" value=""><br><br>     
    Password:&nbsp; <input type="password" name="password" value=""><br><br><br>
                    <input type="submit"   name="submit"   value="Create Admin">
</form>

<br><br>
<a href="admin_list.php">Cancel</a>

<?php include("layout/bottom.php"); ?>