<?php require_once("../includes/session.php");
      require_once("../includes/db_connection.php");
      require_once("../includes/functions.php"); 
?>
<?php
include("layouts/header.php");
include("layouts/sidebar.php");
?>
<!--
already is set
 
-- Main Content --
<div class="w3-container w3-light-grey w3-mobile" style="width: 80%; float:left;">

-->
    
<?php
// 1 - Save into DB

// 2 - Erase Session

echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>

<!--
already is set

  </div> -- End of Main Content --  
</div> -- End of Main Div --
-->
<?php
include("layouts/footer.php");
?>