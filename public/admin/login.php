<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/validation_functions.php");
        include("../../includes/session.php");
?>
<?php
$username = "";

if (isset($_POST['submit'])) {
	// Process the form
             
    // validations
	$required_fields = array("username", "password");
	validate_presences($required_fields);
	// здесь $errors[] - global
    
    if (empty($errors)) {
		// Attempt login 
		
		$username = $_POST["username"];
		$password = $_POST["password"];

		// вернёт массив, строку админа из БД или false
		$found_admin = attempt_login($username, $password);
		// Может вызывать false, если возможно наличие в БД 
		// нескольких пользователей с одинаковым именем.  
		// Но была внедрена уникальность в функциях валидации.

		// var_dump($found_admin);
		
		if ($found_admin) {
			// Success
			// Mark user as logged in

			// Можно пометить юзера в куки
			//$_COOKIE["admin_id"] = $found_admin["id"];
			// но лучше в сессии (куки видны и могут быть подделаны)
			$_SESSION["admin_id"] = $found_admin["id"];
			$_SESSION["username"] = $found_admin["username"];
			
			redirect_to("index.php");
		} else {
			// Failure
			$_SESSION["message"] = "Username/password not found.";
			// Может ошибочно вызываться, если возможно наличие в БД 
			// нескольких пользователей с одинаковым именем.  
			// Но была внедрена уникальность в функциях валидации.
		}     
			
	} else {
		// Вероятно, GET запрос
		// 
	}	
}
?>
<?php include("layout/top.php"); ?>
<?php echo message();   ?>
<?php echo form_errors($errors); ?>  

<h2>Login</h2>

<form action="login.php" method="post">       
    Username:       <input type="text"     name="username" value="<?php echo htmlentities($username); ?>"><br><br>     
    Password:&nbsp; <input type="password" name="password" value=""><br><br><br>
                    <input type="submit"   name="submit"   value="Submit">
</form>

<?php include("layout/bottom.php"); ?>