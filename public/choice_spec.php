<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php




?>

<?php
include("layouts/header.php");
include("layouts/sidebar.php");
?>
    
    <h2>Spec choosing</h2>

        <div class="w3-container">
            <p>
            <a class=" w3-button w3-hover-black " style="margin-bottom: 7px;" href="client_data.php">&laquo;</a>
            <span class=" w3-tag w3-xlarge w3-teal">1</span>
            <span class=" w3-tag w3-xlarge ">2</span>
            <span class=" w3-tag w3-xlarge w3-teal">3</span>
            <span class=" w3-tag w3-xlarge w3-teal">4</span>
            <span class=" w3-tag w3-xlarge w3-teal">5</span>
            </p>
        </div>

        <p>Please, choose your doc. If you dont know, choose doc o.p. (ter.).</p>  
        
        <div>
            <p>A</p>
            <a href="#" class="w3-button w3-border">A LinkButton</a>
            <a href="choice_doc.html?name=alinkbtn" class="w3-button w3-border">ALinkBtn</a>
            <a href="#" class="w3-button w3-border">A LinkButton A LinkButton</a>

            <p>B</p>
            <a href="#" class="w3-button w3-border">B LinkButton</a>
            <a href="#" class="w3-button w3-border">B Button</a>
            <a href="#" class="w3-button w3-border">B LinkButton B LinkButton</a>
            <a href="#" class="w3-button w3-border">B LinkButton B LinkButton</a>
            <a href="#" class="w3-button w3-border">B Link</a>
            <a href="#" class="w3-button w3-border">B LinkButton</a>

            <p>C</p>
            <a href="#" class="w3-button w3-border">C LinkButton C LinkButton</a>
            <a href="#" class="w3-button w3-border">C Link</a>

            <p>D</p>
            <a href="#" class="w3-button w3-border">D LinkButton D LinkButton</a>
            <a href="#" class="w3-button w3-border">D Button</a>

        </div>

     

<?php       
include("layouts/footer.php");                        
?>    