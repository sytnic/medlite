<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php confirm_getparam();  ?>
<?php
        if (isset($_GET["specname"])) {
              $specname = $_GET["specname"];
        }        
?>
<?php   include("layout/top.php"); ?>
<?php echo message(); ?>


        <h2>Value of The Specializations</h2>
        <p>Please, configure your docs in specializations.</p>  
        
        <div>
            <p>Docs in spec: <?php echo $specname; ?></p>

<?php   // gettig list of docs via specname

            // 0. Получение номера id по специмени specname или false
            $specid = get_id_by_specname($specname);

            // если $specid число, а не false, то выполняем все манипуляции из БД
            if($specid) {

                // 1. Получение результирующего набора из БД
                $result_set = get_active_docs_by_specid($specid);            

                // 2. Перевод результирующего набора в массив и Вывод данных на экран
                while($row = mysqli_fetch_assoc($result_set)) {
                    // лучше передавать id, а не surname,
                    // и получать по id любые данные             
    ?>
                  <p>
                     <?php echo $row["doc_name"]." ".$row["doc_surname"]; ?> 
                     <a href="spec_value_delete.php?doc_id=<?php  echo $row["doc_id"]; ?>&specname=<?php echo $specname; ?>" 
                        class="w3-text-red"
                        onclick="return confirm('Are you sure?');">
                        Delete</a>
                  </p>
    <?php
                }
                // 3. освобождение результата
                mysqli_free_result($result_set);
            }
?>

            <p>
                <a href="spec_plusdoc.php?specname=<?php echo $specname; ?>" 
                class="w3-button w3-tag w3-teal"> + Plus doc </a>
            </p>

            <p>
                <a href="spec_config.php?specname=<?php echo $specname; ?>" 
                class="w3-button w3-border">&laquo; Config Spec</a>
            </p>
        </div>        
                        
<?php include("layout/bottom.php"); ?>