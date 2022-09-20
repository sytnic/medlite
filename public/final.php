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

        <div class="w3-container">
            <p>            
            <span class=" w3-tag w3-xlarge w3-teal">1</span>
            <span class=" w3-tag w3-xlarge w3-teal">2</span>
            <span class=" w3-tag w3-xlarge w3-teal">3</span>
           
            <span class=" w3-tag w3-xlarge w3-teal">4</span>
            <span class=" w3-tag w3-xlarge ">5</span>
            </p>
        </div>
    
<?php
// 1 - Save into DB

if (!empty($_SESSION)) {
    $firstname = $_SESSION["inputs"][0];
    $midname   = $_SESSION["inputs"][1];
    $lastname  = $_SESSION["inputs"][2];
    $born      = $_SESSION["inputs"][3];
    $phone     = $_SESSION["inputs"][4];
    
    $specname  = $_SESSION["specname"];

    $doc_id    = $_SESSION["wanted_id"];

    // 1. Here Create function doesnt_matter_or_id()

    $array = doesnt_matter_or_id($_SESSION["wanted_id"]);

    echo "<pre>";
    print_r($array);
    echo "</pre>";
    
    
}

// 2 - Erase Session

echo "<pre>";
print_r($_POST);
echo "</pre>";

echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>





        <p>Thanks for register.</p>  
        
        <div class="w3-mobile" style="width: 50%;">

            <div class="w3-container w3-card-4" >
                <h3>This is Your Data</h3> 
                <hr style="height: 2px; width: 40%; background-color: grey;">

                <p><b><?php echo $specname; ?></b></p>
                <p><b><?php //echo $doc_id;
                            echo $array['fullname'];
                             
                ?></b></p>
                <p><?php
                            echo $array['cost'];
                ?></p>
                
                <hr style="height: 2px; width: 40%; background-color: grey;">
                <h4>Your Data</h4>

                <p><?php echo $firstname; ?></p>
                <p><?php echo $lastname; ?></p>                
                <p><?php echo $phone; ?></p>
            </div>

            <div class="w3-panel w3-pale-green">         
                <p >Thanks for your request.</p>
                <p>In few time it will new call to you. If necessary, you can dial 505-505-60. </p>
            </div>
            
        </div>



<!--
already is set

  </div> -- End of Main Content --  
</div> -- End of Main Div --
-->
<?php
include("layouts/footer.php");
?>