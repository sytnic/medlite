<?php require_once("../includes/session.php");
      require_once("../includes/db_connection.php");
      require_once("../includes/functions.php"); 
        // Если вся Сессия пуста, redirect
        if (empty($_SESSION)) {
            redirect_to("index.php");
        }

        // очищение сессии при переходе назад из след. шага
        if (isset($_GET["fromnext"])) {
            $_SESSION["wanted_id"] = null;
        }

        // При переходе вперёд.
        // проверить значение GET["specid"] на наличие в БД
        // и если он есть, то
        // записать в сессию значение из гет-параметра
        // иначе - стереть значения и редирект
        
        if (isset($_GET["specid"])) {

            $spec_id = (int)$_GET["specid"];
            // array|false
            $row_spec = confirm_get_specid($spec_id);

            if($row_spec) {
                $_SESSION["spec_id"] = $_GET["specid"];
            } else {
                $_SESSION["spec_id"] = null;
                redirect_to("index.php");
            }
        } else { // При переходе назад.
            $spec_id = $_SESSION["spec_id"];
        }

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
            <a class=" w3-button w3-hover-black " style="margin-bottom: 7px;" href="choice_spec.php?fromnext=1">&laquo;</a>
            <span class=" w3-tag w3-xlarge w3-teal">1</span>
            <span class=" w3-tag w3-xlarge w3-teal">2</span>
            <span class=" w3-tag w3-xlarge ">3</span>
            <span class=" w3-tag w3-xlarge w3-teal">4</span>
            <span class=" w3-tag w3-xlarge w3-teal">5</span>
            <span class=" w3-tag w3-xlarge w3-teal">6</span>
            </p>
        </div>

        <p>Please, choose the doc. </p>  
<?php
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";

?>  
<!--      
        <div>
            <p><b>From HTML</b></p>

            <a href="#" class="w3-button w3-border">A LinkButton</a>  <small>~ 1100</small><br>
            <a href="#" class="w3-button w3-border">A LinkButton</a>  <small>~ 1100</small><br>
            <a href="#" class="w3-button w3-border">A LinkButton A LinkButton</a> <small>~ 1100</small><br>

            <p>It doesn't matter</p>
            <a href="confirm.html?matter=doesnt" class="w3-button w3-border">Doesn't matter</a>            
        </div>
-->        
        <div>
            <p><b>From DB</b></p>


<?php       // gettig list of active docs
            // int: mysqli_result|false
            // Получаемые в результате запроса столбцы:
            // spec_id,	doc_id,	doc_name, doc_surname, cost, specname
            $result_set = get_active_docs_by_specid($spec_id);

            // var_dump($result_set);
            
            // если result_set не false, то выводим данные...
            if ($result_set) {

                // 2. Перевод результирующего набора в массив и Вывод данных на экран
                while($row = mysqli_fetch_assoc($result_set)) {         
    ?>
                <a href="choice_time.php?wanted_id=<?php echo $row["doc_id"]; ?>" class="w3-button w3-border">
                    <?php echo $row["doc_name"]." ".$row["doc_surname"]; ?>
                </a>            
                <small><?php echo (isset($row["cost"])) ? "~ ".$row["cost"] : ""; ?></small><br>
    <?php
                }
                // 3. освобождение результата
                mysqli_free_result($result_set);
            
            } else { // ...а если false
                echo "No active docs in here place.";
            }
            
?>

            <p>It doesn't matter</p>
            <a href="choice_time.php?wanted_id=seeall" class="w3-button w3-border">See all</a>            
        </div>
        <br><br>  
    

<!--
already is set

  </div> -- End of Main Content --  
</div> -- End of Main Div --
-->
<?php       
include("layouts/footer.php");                        
?>