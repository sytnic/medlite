<?php require_once("../includes/session.php");
      require_once("../includes/db_connection.php");
      require_once("../includes/functions.php"); 
      // На этом шаге нет записи в БД. 
      // Запись происходит при загрузке следующего шага final,
      // после к-рого нет шага назад. 
      // Запись в БД производится только один раз.  
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
    if (isset($_GET["time_id"])) {
        $date = (int)$_GET["time_id"];
        $_SESSION["time_id"] = $date; 
    }
?>
      <h2>Header</h2>

        <div class="w3-container">
            <p>
            <a class=" w3-button w3-hover-black " style="margin-bottom: 7px;" href="choice_time.php">&laquo;</a>
            <span class=" w3-tag w3-xlarge w3-teal">1</span>
            <span class=" w3-tag w3-xlarge w3-teal">2</span>
            <span class=" w3-tag w3-xlarge w3-teal">3</span>
            <span class=" w3-tag w3-xlarge w3-teal">4</span>
            <span class=" w3-tag w3-xlarge ">5</span>
            <span class=" w3-tag w3-xlarge w3-teal">6</span>
            </p>
        </div>
<?php

        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";

        $firstname = $_SESSION["inputs"][0];
        $midname   = $_SESSION["inputs"][1];
        $lastname  = $_SESSION["inputs"][2];
        $birthday  = $_SESSION["inputs"][3];
        $phone     = $_SESSION["inputs"][4];

        $spec_id   = (int)$_SESSION["spec_id"];
        $time_id   = (int)$_SESSION["time_id"];
        // int or string
        $doc_id    = $_SESSION["wanted_id"];

        // overwright doc_id, if doc_id is string
        if ($_SESSION["wanted_id"] == 'seeall') {
            // int|null
            $doc_id = get_docid_by_timeid($time_id);
        }

        // Vars for html output
        // str|null
        $specname = get_specname_by_specid($spec_id);

        // array | null
        $doc = get_doc_by_id($doc_id);
        $first_docname = $doc["firstname"];
        $last_docname  = $doc["surname"];
        $cost = $doc["cost"];

        // array of 1 row | null
        $doctimerow = get_doctimerow_by_doctimeid($time_id);
        $date = $doctimerow["date"];
        $time = $doctimerow["time"];

?>
        <p>This is final step. </p>
        <p>If all right, register it, and we will call you for confirming.</p>
        
        <div style="width: 50%;">

            <div class="w3-container w3-card-4" style="margin-bottom: 25px;" >
                <h3>Confirm Your Choice</h3> 
                <hr style="height: 2px; width: 40%; background-color: grey;">
<?php        
                // Specname
                echo "<p>".$specname."</p>";
                // Doc name
                echo "<p>".$first_docname." ".$last_docname."</p>";
                // Date
                echo "<p>".date("d.m.y", strtotime($date))."</p>";
                // Day
                echo "<p>".date("l", strtotime($date))."</p>";
                // Time
                echo "<p>".substr($time, 0, -3)."</p>";
                // Cost
                echo "<p>".$cost."</p>";
?>

                <hr style="height: 2px; width: 40%; background-color: grey;">
                <h4>Your Data</h4>
                <p><?php echo $firstname; ?></p>
                <p><?php echo $lastname; ?></p> 
                <p><?php echo date("d.m.y", strtotime($birthday)); ?></p>  
                <p><?php echo $phone; ?></p>

            <p><a href="final.php" class="w3-btn w3-teal">Register Request</a></p>
            </div>
            
        </div>
<!--
already is set

  </div> -- End of Main Content --  
</div> -- End of Main Div --
-->
<?php include("layouts/footer.php"); ?>