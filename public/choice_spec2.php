<?php require_once("../includes/session.php");
      require_once("../includes/db_connection.php");
      require_once("../includes/functions.php");
      // Эта страница - сэйв черновика. 
      // Эта страница отображает простые данные
      // и не обрабатывает данные (по алфавиту, по буквам),
      // пришедшие из БД.
?>
<?php
include("layouts/header.php");
include("layouts/sidebar.php");
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
            </p>
        </div>

        <p>Please, choose your doc. If you dont know, choose doc o.p. (ter.).</p> 

<?php  echo message(); 
       // if(isset($SESSION["message"])) {echo $_SESSION["message"][0]; }
       echo "<pre>";
       print_r($_SESSION["inputs"]);
       echo "</pre>";
?>         
        
        <div>
        <p><b>HTML Displaying</b></p>
            <p>A</p>
            <a href="#" class="w3-button w3-border">A LinkButton</a>
            <a href="choice_doc.html?name=alinkbtn" class="w3-button w3-border">ALinkBtn</a>
            <a href="#" class="w3-button w3-border">A LinkButton A LinkButton</a>

            <p>B</p>
            <a href="#" class="w3-button w3-border">B LinkButton</a>
            <a href="#" class="w3-button w3-border">B Button</a>
            <a href="#" class="w3-button w3-border">B LinkButton B LinkButton</a>
            <a href="#" class="w3-button w3-border">B LinkButton B LinkButton</a>
            <a href="#" class="w3-button w3-border">B Link</a>
            <a href="#" class="w3-button w3-border">B LinkButton</a>

            <p>C</p>
            <a href="#" class="w3-button w3-border">C LinkButton C LinkButton</a>
            <a href="#" class="w3-button w3-border">C Link</a>

            <p>D</p>
            <a href="#" class="w3-button w3-border">D LinkButton D LinkButton</a>
            <a href="#" class="w3-button w3-border">D Button</a>
        </div>

<?php   $result_set = get_all_specs(); ?>

        <div>
        <p><b>Simple from DB Displaying</b></p>
<?php   
        $specs = [];
        // getting array
        while($row = mysqli_fetch_assoc($result_set)) {
?>
          <a href="#" class="w3-button w3-border">
            <?php  echo htmlentities($row["specname"]);  ?>
          </a>
<?php
            // 0
            $specs[] = htmlentities($row["specname"]);
            
        } // end while
        mysqli_free_result($result_set); 
?>        
        </div>

        <div style="margin-bottom:20px;">
            <p><b>Displaying in Arrays</b></p>
    <?php   // Display specialties alphabetically
            // 0. Создать массив специальностей.
            // 1. Создать массив алфавита.
            // 1.1 Отсортировать массив специальностей по алфавиту,
            // чтобы избежать шаг 4.
            // 2. Выяснять первую букву каждой специальности
            // 3. Добавлять каждую специальность 
            // согласно первой букве в алфавитный массив, 
            // создавая тем самым вложенный массив.
            // (4. Отсортировать вложенный массив по алфавиту).
            // 5. Выводить на экран буквы, которые заполнены значениями, 
            // и их значения.

            // 0
            //var_dump($specs);
            echo "<br>";

            // 1.1
            sort($specs);

            //var_dump($specs);
            echo "<br>";

            // 5
            $nested = ["A"=>[], "B"=>[], "C"=>[], "D"=>[], "E"=>[], "F"=>[] ];

            $nested["A"][] = "Abakan";
            $nested["A"][] = "Australia";

            //$nested["B"][] = "";
            
            $nested["C"][] = "City";
            $nested["C"][] = "Center";

            $nested["E"][] = "Elabuga";
            $nested["E"][] = "Ekaterinburg";

            var_dump($nested);
            echo "<hr>"."\r\n";

            foreach($nested as $key => $value){
                // $key - это строка, обозначение вложенного массива.
                // $value - это вложенный массив.
                //var_dump($value);

                // если вложенный массив не пустой, не нулевой длины,
                // выводим его данные.
                // сработает и if ($value), потому что
                // что-то внутри - есть истина, отсутствие всего (пустота) - есть ложь.
                if (!empty($value)) {
                    echo "<p>".$key."</p> \r\n";
                    /*
                    echo "<pre>";            
                    print_r($value)."<br>";
                    echo "</pre>";
                    */
                    // для каждого массива $value
                    // выводим его значения meaning
                    foreach ($value as $meaning) { 
                        $output = '<a href="choice_doc.html?name='.$meaning.'" class="w3-button w3-border">';
                        $output.= $meaning;
                        $output.= '</a>'."\r\n";
                        echo $output;
                    }
                    echo "";
                }
            }
    ?>
        </div>

<?php       
include("layouts/footer.php");                        
?>    