<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/validation_functions.php");
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
<?php echo form_errors($errors); ?>


        <h2>Value of The Specializations</h2>
        <p>Please, configure your docs in specializations.</p>  
        
        <div>
            <p>Docs in spec: <?php echo $specname; ?></p>

<?php       // gettig list of active docs via specname
            // mysqli_result | false
            $result_set = get_active_docs_via_specname($specname);
            
            // если result_set не false, то выводим данные...
            if ($result_set) {   

                // 2. Перевод результирующего набора в массив и Вывод данных на экран
                while($row = mysqli_fetch_assoc($result_set)) {            
    ?>
                  <p>
                     <?php echo $row["doc_name"]." ".$row["doc_surname"]; ?> 
                    <a href="spec_value_delete.php?doc_id=<?php  echo $row["doc_id"]; ?>&specname=<?php echo $specname; ?>" 
                        class="w3-text-red"
                        onclick="return confirm('Are you sure?');">
                        Delete
                    </a>
                  </p>
    <?php
                }
                // 3. освобождение результата
                mysqli_free_result($result_set);
            } else {
                echo "No active docs in this spec.";
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