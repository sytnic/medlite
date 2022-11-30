<?php require_once("../includes/session.php");
      require_once("../includes/db_connection.php");
      require_once("../includes/functions.php"); 
?>
<?php
include("layouts/header.php");
include("layouts/sidebar.php");
        // если я вернулся с прошлого шага (нет в url-параметрах "specname"),
        // стереть выбранную спец-ть
        // (вероятно, отрабатывает и при шаге вперёд, стирая то, чего нет ($_SESSION["specname"]))
        // (вероятно, можно убрать условие и оставить стирание null, п.что 
        //  всегда заходишь сюда без параметров и всегда нужно чистое значение спец-сти)
        if (!isset($_GET["specname"])) {
            $_SESSION["specname"] = null;
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
            <p><b>Displaying in Arrays</b></p>

            <p>Док общей практики</p>
            <a href="choice_doc.php?specname=terapevt" class="w3-button w3-border">
                Terapevt
            </a>

        <?php   output_all_specs('choice_doc.php');  ?>

        </div>
<?php       
include("layouts/footer.php");                        
?>    