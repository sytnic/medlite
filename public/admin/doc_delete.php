<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php 
      $doc_id = (int)$_GET["docid"];
      confirm_get_docid($doc_id);
?>
<?php

$query = "DELETE FROM docs WHERE id = {$doc_id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Doc deleted successful.";
    redirect_to("doc_list.php");
} else {
    // Failure
    $_SESSION["message"] = "Doc deletion failed.";
    redirect_to("doc_list.php");
}


?>