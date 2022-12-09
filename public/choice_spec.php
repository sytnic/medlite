<?php require_once("../includes/session.php");
      require_once("../includes/db_connection.php");
      require_once("../includes/functions.php"); 
?>
<?php
include("layouts/header.php");
include("layouts/sidebar.php");

        // очищение сессии при переходе назад из след. шага
        if (isset($_GET["fromnext"])) {
            $_SESSION["spec_id"] = null;
        }
?>
    
    <h2>Spec choosing</h2>

        <div class="w3-container">
            <p>
            <a class=" w3-button w3-hover-black " style="margin-bottom: 7px;" href="client_data.php?from=step2">&laquo;</a>
            <span class=" w3-tag w3-xlarge w3-teal">1</span>
            <span class=" w3-tag w3-xlarge ">2</span>
            <span class=" w3-tag w3-xlarge w3-teal">3</span>
            <span class=" w3-tag w3-xlarge w3-teal">4</span>
            <span class=" w3-tag w3-xlarge w3-teal">5</span>
            <span class=" w3-tag w3-xlarge w3-teal">6</span>
            </p>
        </div>

        <p>Please, choose your doc. If you dont know, choose doc o.p. (ter.).</p> 

<?php  
       echo "<pre>";
       print_r($_SESSION);
       echo "</pre>";
?>         
<!--        
        <div>
        <p><b>HTML Displaying</b></p>
            <p>A</p>
            <a href="#" class="w3-button w3-border">A LinkButton</a>
            <a href="choice_doc.html?name=alinkbtn" class="w3-button w3-border">ALinkBtn</a>
            <a href="#" class="w3-button w3-border">A LinkButton A LinkButton</a>
   
        </div>
-->

        <div style="margin-bottom:20px;">
            <p><b>Specs</b></p>

<?php
        // mysqli_result
        $result_set = get_all_specs_asc();

        while($row = mysqli_fetch_assoc($result_set)) {  
            $output = "<a href=\"choice_doc.php?specid=".$row["id"].'" class="w3-button w3-border">';
            $output.= $row["specname"];
            $output.= '</a>'."<br><br>";
            echo $output;
        }


?>

        </div>

<?php  include("layouts/footer.php");  ?>    