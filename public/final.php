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
            <span class=" w3-tag w3-xlarge ">5</span>
            </p>
        </div>
    
<?php


if (!empty($_SESSION)) {
    $firstname = $_SESSION["inputs"][0];
    $midname   = $_SESSION["inputs"][1];
    $lastname  = $_SESSION["inputs"][2];
    $born      = $_SESSION["inputs"][3];
    $phone     = $_SESSION["inputs"][4];
    
    $specname  = $_SESSION["specname"];

    // может быть id или строка "не имеет значения"
    $doc_id    = $_SESSION["wanted_id"];

    $array_name_cost = doesnt_matter_or_id($doc_id);

    echo "<pre>";
    print_r($array_name_cost);
    echo "</pre>";

    $doc_name = $array_name_cost["fullname"];
    $safe_doc_name = mysqli_real_escape_string($connection, $doc_name);

    // 1 - Save into DB
    // - сохранить БД в архив
    // - создать новую версию БД,
    //   в ней планируется одна таблица со списком запросов вместо трёх,
    //   т.к. в этой lite версии нет необходимости
    //   создавать отдельные таблицы под клиентов и их запросы,
    //   т.к. используются только запросы и не используется лич.кабинет.
    // - создать функции для сохранения данных в разные таблицы

    // Mysqli real escape string
    
    $safe_firstname = mysqli_real_escape_string($connection, $firstname);
    $safe_midname   = mysqli_real_escape_string($connection, $midname);
    $safe_lastname  = mysqli_real_escape_string($connection, $lastname);

    $safe_phone     = mysqli_real_escape_string($connection, $phone);    
    $safe_specname  = mysqli_real_escape_string($connection, $specname);

    // 1. Create a database connection - работает в db_connection

    // 2. Perform database query
    // who_edited: 0 - client, остальные - id доков
    $query = "INSERT INTO client_requests 
        ( firstname, midname, surname, datebirth, phone,
        doc_name, spec_name, who_edited ) 
        VALUES (
        '$safe_firstname', '$safe_midname', '$safe_lastname', '$born', '$safe_phone',
        '$safe_doc_name', '$safe_specname', 0)";

    // Confirm

    $result = mysqli_query($connection, $query);

    // УБРАТЬ ИЗ ПРОДАКШН:
    echo $query."<br>";

    if (!$result) {
        die(
        "Database query failed. "."Код: ".mysqli_errno($connection). 
        // УБРАТЬ ИЗ ПРОДАКШН:
        ". Ошибка: ".mysqli_error($connection)    
        );
    }

    // 3. Use returned data (if any) - не нужно

    // 4. Release returned data - не нужен, 
    // т.к. это не select и
    // возвращает не объект mysqli, а true или false .
    // mysqli_free_result($result);

    // 5. Close database connection - отрабатывает в футере.
    
}

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
                            echo $array_name_cost['fullname'];
                             
                ?></b></p>
                <p><?php
                            echo $array_name_cost['cost'];
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
<?php
    // 2 - Erase Session
    $_SESSION["inputs"] = null;
    $_SESSION["specname"] = null;
    $_SESSION["wanted_id"] = null;

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