<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php 
      $time_id = (int)$_GET["timeid"];

?>
<?php

$query = "DELETE FROM doctime WHERE id = {$time_id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Time deleted successful.";
    redirect_to("doctimes_all.php");
} else {
    // Failure
    $_SESSION["message"] = "Time deletion failed. <br>".
        "Not for production:  " .mysqli_error($connection) ;
    redirect_to("doctimes_all.php");
}


?>