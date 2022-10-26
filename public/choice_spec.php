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

<?php       // 0 Получение массива специальностей

        $result_set = get_all_specs();
        // пустой массив
        $specs = [];
        // получение массива,
        // т.к. нельзя сразу выводить на экран через while,
        // для вывода на экран сначала нужно 
        // разложить все специальности по их буквам по алфавиту.
        while($row = mysqli_fetch_assoc($result_set)) {
            $specs[] = htmlentities($row["specname"]);            
        }
        // освобождение результата
        mysqli_free_result($result_set);
?>
        <div style="margin-bottom:20px;">
            <p><b>Displaying in Arrays</b></p>
<?php   
            // 1 Отсортированный по алфавиту массив специальностей из БД.
            // Если это не сделать, в итоге
            // внутри букв ("A"=>) значения будут выровнены не по алфавиту,
            // а так, как они были вытащены из БД.
            sort($specs);

            // 2 Алфавитный массив
            $nested = ["A"=>[], "B"=>[], "C"=>[], "D"=>[], "E"=>[], "F"=>[], "G"=>[],
                       "H"=>[], "I"=>[], "J"=>[], "K"=>[], "L"=>[], "M"=>[], "N"=>[],
                       "O"=>[], "P"=>[], "Q"=>[], "R"=>[], "S"=>[], "T"=>[], "U"=>[],
                       "V"=>[], "W"=>[], "X"=>[], "Y"=>[], "Z"=>[],

                       "А"=>[], "Б"=>[], "В"=>[], "Г"=>[], "Д"=>[], "Е"=>[], "Ё"=>[],
                       "Ж"=>[], "З"=>[], "И"=>[], "Й"=>[], "К"=>[], "Л"=>[], "М"=>[],
                       "Н"=>[], "О"=>[], "П"=>[], "Р"=>[], "С"=>[], "Т"=>[], "У"=>[],
                       "Ф"=>[], "Х"=>[], "Ц"=>[], "Ч"=>[], "Ш"=>[], "Щ"=>[], "Ъ"=>[],
                       "Ы"=>[], "Ь"=>[], "Э"=>[], "Ю"=>[], "Я"=>[]                       
            ]; 

            // 3 Выяснение первой буквы каждого значения в массиве из БД.
            // 4 Добавление значения в соответствующее место в алфавитном массиве.
            foreach($specs as $value) {
                $first = mb_substr($value, 0, 1);
                // возможное использование:
                // mb_substr($value, 0, 1, 'utf-8');

                // как $nested["C"][] = "Center";
                $nested[$first][] = $value;
            }

            // 5 Вывод на экран
            foreach($nested as $key => $value){
                // $key - это строка, обозначение вложенного массива, "A"=>
                // $value - это вложенный массив, =>[]

                // если вложенный массив не пустой, не нулевой длины, выводим его данные.
                // сработает и if($value), потому что
                // что-то внутри - есть истина, отсутствие всего (пустота) - есть ложь.
                if (!empty($value)) {
                    echo "<p>".$key."</p> \r\n";
                    
                    // для каждого массива $value выводим его значения $meaning
                    foreach ($value as $meaning) { 
                        $output = '<a href="choice_doc.php?specname='.$meaning.'" class="w3-button w3-border">';
                        $output.= $meaning;
                        $output.= '</a>'."\r\n";
                        echo $output;
                    }
                }
            }
?>
    <a href="choice_doc.php?specname=terapevt" class="w3-button w3-border">
        Terapevt
    </a>
        </div>
<?php       
include("layouts/footer.php");                        
?>    