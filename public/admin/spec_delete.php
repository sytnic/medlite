<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php $spec_id = confirm_getparam();  ?>
<?php  

$query = "DELETE FROM specs WHERE id = {$spec_id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Spec deleted.";
    redirect_to("spec_list.php");
} else {
    // Failure
    $_SESSION["message"] = "Spec deletion failed. Возможно, есть доки в его составе.";
    redirect_to("spec_list.php");
}

?>