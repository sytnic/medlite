<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php confirm_getparam();  ?>
<?php
        if (isset($_GET["specname"])) {
              $specname = $_GET["specname"];
        }        
?>
<?php   include("layout/top.php"); ?>

        <h2>Value of The Specializations</h2>
        <p>Please, configure your docs in specializations.</p>  
        
        <div>
            <p>Docs in spec: <?php echo $specname; ?></p>
            <p>Doc number One  <a href="#" class="w3-text-red">Delete</a></p>
            <p>Doc number Two  <a href="#" class="w3-text-red">Delete</a></p>
            <p>Doc number Three  <a href="#" class="w3-text-red">Delete</a></p>
            <p>
                <a href="spec_plusdoc.php?specname=<?php echo $specname; ?>" class="w3-button w3-tag w3-teal"> + Plus doc </a>
            </p>

            <p><a href="spec_config.php?specname=<?php echo $specname; ?>" class="w3-button w3-border">&laquo; Назад</a></p>
        </div>        
                        
<?php include("layout/bottom.php"); ?>