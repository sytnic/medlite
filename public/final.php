<?php require_once("../includes/session.php");
      require_once("../includes/db_connection.php");
      require_once("../includes/functions.php"); 
      // На этом шаге, и только на этом, совершается запись данных в БД. 
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
            <span class=" w3-tag w3-xlarge w3-teal">5</span>
            <span class=" w3-tag w3-xlarge ">6</span>
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

    // array of 1 row | null
    $doc = get_doc_by_id($doc_id);
    $first_docname = $doc["firstname"];
    $last_docname  = $doc["surname"];
    $cost = $doc["cost"];

    // array of 1 row | null
    $doctimerow = get_doctimerow_by_doctimeid($time_id);
    $date = $doctimerow["date"];
    $time = $doctimerow["time"];

?>
<?php
    // Query for DB

        // Mysqli real escape string
    
        $safe_firstname = mysql_prep($firstname);
        $safe_midname   = mysql_prep($midname);
        $safe_lastname  = mysql_prep($lastname);
        $safe_birthday  = mysql_prep($birthday);
        $safe_phone     = mysql_prep($phone);

        $safe_doc_id  = mysql_prep($doc_id);
        $safe_spec_id = mysql_prep($spec_id);
        $safe_doctime_id = mysql_prep($time_id);

    
        // Create a database connection - работает в db_connection
    
        // Perform database query
        // who_edited: 0 - client, остальные - id доков
        $query = "INSERT INTO client_reqs 
            ( firstname, midname, surname, datebirth, phone,
            doc_id, spec_id, doctime_id, who_edited, when_edited ) 
            VALUES (
            '$safe_firstname', '$safe_midname', '$safe_lastname', '$safe_birthday', '$safe_phone',
            '$safe_doc_id', '$safe_spec_id', '$safe_doctime_id', 0, NOW()
            )";
    
        // Confirm    
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die(
            "Database query failed. "."Код: ".mysqli_errno($connection). 
            // УБРАТЬ ИЗ ПРОДАКШН:
            ". Ошибка: ".mysqli_error($connection)    
            );
        }

    // еще раз проверка массива
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";

    // и нет ли в Посте что-нибудь
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
?>
        <p>Thanks for register.</p>  
        
        <div class="w3-mobile" style="width: 50%;">

            <div class="w3-container w3-card-4" >
                <h3>This is Your Data</h3> 
                <hr style="height: 2px; width: 40%; background-color: grey;">

                <p><b><?php echo $specname; ?></b></p>
                <p><b><?php echo "<p>".$first_docname." ".$last_docname."</p>"; ?></b></p>
                <p><?php echo "<p>".$cost."</p>";?></p>
                
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
<?php
    // Erase Session
    $_SESSION["inputs"] = null;
    $_SESSION["spec_id"] = null;
    $_SESSION["wanted_id"] = null;
    $_SESSION["time_id"] = null;
    
    // проверка массива
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
?>
<!--
already is set

  </div> -- End of Main Content --  
</div> -- End of Main Div --
-->
<?php
include("layouts/footer.php");
?>