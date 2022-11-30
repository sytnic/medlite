<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php   include("layout/top.php"); ?>

        <h2>Value of The Specializations</h2>
        <p>Please, configure your docs in specializations.</p>  
        
        <div>
            <p>Docs in spec</p>
            <p>Doc number One  <a href="#" class="w3-text-red">Delete</a></p>
            <p>Doc number Two  <a href="#" class="w3-text-red">Delete</a></p>
            <p>Doc number Three  <a href="#" class="w3-text-red">Delete</a></p>
            <p>
                <a href="spec_plusdoc.php" class="w3-button w3-tag w3-teal"> + Plus doc </a>
            </p>
        </div>        
                        
<?php include("layout/bottom.php"); ?>