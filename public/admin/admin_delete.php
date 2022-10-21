<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");    ?>
<?php confirm_logged_in(); ?>
<?php 
    // array of 1 row
	$admin_row = find_admin_by_id($_GET["id"]);
   	
    if (!$admin_row) {
		// admin ID was missing or invalid or 
		// admin couldn't be found in database
		redirect_to("manage_admins.php");
	}

    $id = $admin_row["id"];
	$query = "DELETE FROM docadmins WHERE id = {$id} LIMIT 1";
	$result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
		// Success
		$_SESSION["message"] = "Admin deleted.";
		redirect_to("admin_list.php");
	} else {
		// Failure
		$_SESSION["message"] = "Admin deletion failed.";
		redirect_to("admin_list.php");
	}

?>