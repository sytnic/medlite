<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php   include("layout/top.php"); ?>
<?php echo message(); ?>
        <h2>Config Specializations</h2>
        <p>Please, configure your docs in specializations.</p>  
        
        <div>
        <p>
           <a href="spec_create.php" class="w3-button w3-circle w3-xlarge w3-teal"> + </a>
        </p>        
        <?php   output_all_specs('spec_config.php');  ?>            
        </div> 
                        
<?php include("layout/bottom.php"); ?>