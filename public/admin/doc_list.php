<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php   include("layout/top.php"); ?>

    <h2>Doc's list</h2>  

    <p>Please, choose doc.</p>  
    
    <div class="w3-bar-block">
        <p>A</p>
        
        <p><a href="#" class="w3-button w3-border">A LinkButton</a></p>
        <p><a href="doc_overall.php" class="w3-button w3-border">ALinkBtn Click Here</a></p>
        <p><a href="#" class="w3-button w3-border">A LinkButton A LinkButton</a></p>        

        <p>B</p>
        <p><a href="#" class="w3-button w3-border">B LinkButton</a></p>
        <p><a href="#" class="w3-button w3-border">B Button</a></p>
        <p><a href="#" class="w3-button w3-border">B LinkButton B LinkButton</a></p>
        <p><a href="#" class="w3-button w3-border">B LinkButton B LinkButton</a></p>
        <p><a href="#" class="w3-button w3-border">B Link</a></p>
        <p><a href="#" class="w3-button w3-border">B LinkButton</a></p>

        <p>C</p>
        <p><a href="#" class="w3-button w3-border">C LinkButton C LinkButton</a></p>
        <p><a href="#" class="w3-button w3-border">C Link</a></p>

        <p>D</p>
        <p><a href="#" class="w3-button w3-border">D LinkButton D LinkButton</a></p>
        <p><a href="#" class="w3-button w3-border">D Button</a></p>

        <p>
            <a href="doc_create.php" class="w3-button w3-circle w3-xlarge w3-teal"> + </a>
        </p>

    </div>       
                    
<?php include("layout/bottom.php"); ?>