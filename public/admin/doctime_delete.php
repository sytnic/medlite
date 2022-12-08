<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php 
      $time_id = (int)$_GET["timeid"];
      
      $doc_id = (int)$_GET["docid"];
      // array|redirect
      confirm_get_docid($doc_id);
?>
<?php

$query = "DELETE FROM doctime WHERE id = {$time_id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Time deleted successful.";
    redirect_to("doc_time.php?docid={$doc_id}");
} else {
    // Failure
    $_SESSION["message"] = "Time deletion failed.";
    redirect_to("doc_time.php?docid={$doc_id}");
}


?>