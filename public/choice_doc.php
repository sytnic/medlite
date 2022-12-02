<?php require_once("../includes/session.php");
      require_once("../includes/db_connection.php");
      require_once("../includes/functions.php"); 
        // если нет Сессии 
        // (она используется и при шаге вперед, и при шаге назад),
        // то есть пришли сюда напрямки,
        // то редирект.
        // Точнее, если Сессия пуста, т.к. она есть 
        // и задана с помощью session.php
        if (empty($_SESSION)) {
            redirect_to("index.php");
        }
        // если я вернулся с прошлого шага,
        // стереть выбранного ранее дока
        if (!isset($_GET["wanted_id"])) {
            $_SESSION["wanted_id"] = null;
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
            <a class=" w3-button w3-hover-black " style="margin-bottom: 7px;" href="choice_spec.php">&laquo;</a>
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
    // получи $specname из Get-Url,
    // иначе из сессии,
    // чтобы ниже можно было заполнить страницу данными из БД (шаг 0.)
    if (isset($_GET["specname"])) {
        // echo $_GET["specname"];
        // тут хорошее место для ю-эр-эл-энкодинга
        $specname = $_GET["specname"];
        $_SESSION["specname"] = $specname;        
    } else {
        $specname = $_SESSION["specname"];
    }
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


<?php       // gettig list of active docs via specname
            // mysqli_result | false
            $result_set = get_active_docs_via_specname($specname);

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
            <a href="choice_time.php?wanted_id=doesnt_matter" class="w3-button w3-border">Doesn't matter</a>            
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