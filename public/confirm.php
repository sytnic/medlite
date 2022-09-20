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
        <h2>Header</h2>

        <div class="w3-container">
            <p>
            <a class=" w3-button w3-hover-black " style="margin-bottom: 7px;" href="choice_doc.php">&laquo;</a>
            <span class=" w3-tag w3-xlarge w3-teal">1</span>
            <span class=" w3-tag w3-xlarge w3-teal">2</span>
            <span class=" w3-tag w3-xlarge w3-teal">3</span>
            <span class=" w3-tag w3-xlarge ">4</span>
            <span class=" w3-tag w3-xlarge w3-teal">5</span>
            </p>
        </div>

<?php
        // если мы получили в Гете wanted_id,
        // присвоить его в сессию.
        // Лучше Дока получать по id, т.к. возможны однофамильцы.
        if (isset($_GET["wanted_id"])) {
            $wanted = $_GET["wanted_id"];
            $_SESSION["wanted_id"] = $wanted; 
        }

        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";

        $specname  = $_SESSION["specname"];

        $firstname = $_SESSION["inputs"][0];
        $lastname  = $_SESSION["inputs"][2];
        $phone     = $_SESSION["inputs"][4];

        // 1. Here Create function doesnt_matter_or_id()

        $array = doesnt_matter_or_id($_SESSION["wanted_id"]);

        echo "<pre>";
        print_r($array);
        echo "</pre>";

        /*
        // если не "doesnt_matter"
        if ($_SESSION["wanted_id"] != "doesnt_matter") {
            // значит имеем дело с id
            $doc_id     = $_SESSION["wanted_id"];
            // array
            $doc_row = get_doc_by_id($doc_id);

            $output_name = $doc_row['firstname'].' '.$doc_row['surname'];
            $output_cost = "~ ".$doc_row["cost"];
            // иначек, если имеем дело с doesnt_matter
        } else { 
            $output_name = "Не имеет значения";
            $output_cost = "~ 1200";
        }
        */

        

?>

        <p>This is final step. </p>
        <p>If all right, register it, and we will to call you for confirming.</p>

        
        <div style="width: 50%;">

            <div class="w3-container w3-card-4" style="margin-bottom: 25px;" >
                <h3>Confirm Your Choice</h3> 
                <hr style="height: 2px; width: 40%; background-color: grey;">
                <p><b><?php echo $specname; ?></b></p>

                <p><b>
                <?php //echo $output_name;
                        echo  $array['fullname'];                
                ?>
                </b></p>

                <small>
                <?php //echo $output_cost;
                        echo  $array['cost'];                
                ?>
                </small><br>                
                
                <hr style="height: 2px; width: 40%; background-color: grey;">
                <h4>Your Data</h4>
                <p><?php echo $firstname; ?></p>                
                <p><?php echo $lastname; ?></p>                
                <p><?php echo $phone; ?></p>

            <p><a href="final.php" class="w3-btn w3-teal">Register Request</a></p>
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