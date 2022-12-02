<?php require_once("../includes/session.php");
      require_once("../includes/db_connection.php");
      require_once("../includes/functions.php"); 
        
?>
<?php
include("layouts/header.php");
include("layouts/sidebar.php");
?>
<?php    // sandbox
    /*
        $sped = '5';
        if ((int)$sped) {
          echo "yes, this num";  // 5, '5'
        } else {
            echo "no, this not num";  // 'str'
        }
        die;
    */
    /*
                $fal = false;

                if (!$fal) {
                    echo "if not false, then here we go <br>";
                }
    */

    $query = "SELECT id FROM specs WHERE specname = 'Эспозито' LIMIT 1";
    echo $query."<br>";
     // если запрос без ошибки, но не вернул записей, 
     // то вернётся пустой объект mysqli_result $result_set
    $result_set = mysqli_query($connection, $query);
    var_dump($result_set);  // пустой object(mysqli_result)
    echo "<br>";    

    // поведение функции задумано с возвратом false вместо возможного null
    $spec_name = "Эспозито";
    $poiman = get_id_by_specname($spec_name);
    echo "<br>";
    var_dump($poiman);  // false
    echo "<br>";    
    
?>
<?php       
include("layouts/footer.php");                        
?>