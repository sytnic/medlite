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

        <h2>Doc choosing</h2>

        <div class="w3-container">
            <p>
            <a class=" w3-button w3-hover-black " style="margin-bottom: 7px;" href="choice_spec.html">&laquo;</a>
            <span class=" w3-tag w3-xlarge w3-teal">1</span>
            <span class=" w3-tag w3-xlarge w3-teal">2</span>
            <span class=" w3-tag w3-xlarge ">3</span>
            <span class=" w3-tag w3-xlarge w3-teal">4</span>
            <span class=" w3-tag w3-xlarge w3-teal">5</span>
            </p>
        </div>

        <p>Please, choose the doc. </p>  
        
        <div>
            <p><b>ASpecBtn</b></p>

            <a href="#" class="w3-button w3-border">A LinkButton</a>  <small>~ 1100</small><br>
            <a href="#" class="w3-button w3-border">A LinkButton</a>  <small>~ 1100</small><br>
            <a href="#" class="w3-button w3-border">A LinkButton A LinkButton</a> <small>~ 1100</small><br>

            <p>It doesn't matter</p>
            <a href="confirm.html?matter=doesnt" class="w3-button w3-border">Doesn't matter</a>            
        </div>    
    

<!--
already is set

  </div> -- End of Main Content --  
</div> -- End of Main Div --
-->
<?php       
include("layouts/footer.php");                        
?>    