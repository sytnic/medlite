<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php 
    if (isset($_GET["req_id"])) {
        $req_id = (int)$_GET["req_id"];
    }
?>
<?php

$query = "UPDATE doctime SET
status = 0,
clientreqs_id = NULL
WHERE clientreqs_id = {$req_id};"
;

$result = mysqli_query($connection, $query);

confirm_query($result);

$query = "DELETE FROM client_reqs WHERE id = {$req_id} LIMIT 1";

$result = mysqli_query($connection, $query);

confirm_query($result);

if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Client's request is deleted successful.";
    redirect_to("client_reqs.php");
} else {
    // Failure
    $_SESSION["message"] = "Client's request deletion is failed.";
    redirect_to("client_reqs.php");
}


?>