<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php 
      $doc_id = (int)$_GET["docid"];
      // redirect or getting 1 row from DB
      $row = confirm_get_docid($doc_id);

      if (isset($_GET["specid"])) {
          $spec_id = (int)$_GET["specid"];
      }
      // Можно было бы проверить действительность spec_id,
      // но просто выдам Failure ниже в сессию.
      // При недействительном spec_id происходит успешное:
      // "Запрос завершён, изменено 0 записей"
?>
<?php

$query = "DELETE FROM `docspec`
        WHERE `doc_id` = {$doc_id} AND `spec_id` = {$spec_id}
        LIMIT 1";

$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Spec of this doc deleted successfully.";
    redirect_to("doc_editspec.php?docid=".$row['id']);
} else {
    // Failure
    $_SESSION["message"] = "Spec of this doc deletion failed.";
    redirect_to("doc_editspec.php?docid=".$row['id']);
}


?>