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
<?php
        $message = "";

        // processing Post
        if (isset($_POST['submit'])) {
                // Process the form
        
                $option_id = (int)$_POST["select"];
                $spec_id = get_id_by_specname($specname);
            
                if ((int)$option_id && (int)$spec_id) {		
               
                        $query  = "INSERT INTO docspec (";
                        $query .= " doc_id, spec_id  ";
                        $query .= ") VALUES (";
                        $query .= " '{$option_id}', '{$spec_id}' ";
                        $query .= ")";
                        
                        $result = mysqli_query($connection, $query);
        
                        //echo $query; // But It Will cause - Cannot modify header
        
                        if ($result) {
                                // Success
                                $_SESSION["message"] = "Doc and spec inserted succefull.";
                                redirect_to("spec_value.php?specname=$specname");
                        } else {
                                // Failure
                                $_SESSION["message"] = "Doc and spec insertion failed. Perhaps, not unique";
                                redirect_to("spec_value.php?specname=$specname");
                        }    
                                
                } else {
                        $message = "Empty inserting. Do your choice, please."; 
                }	
        }
       

?>
<?php   include("layout/top.php"); ?>
<?php echo $message; ?>

        <h2>Spec One plus doc</h2>
        <p>Please, configure this.</p> 
        
        <p>Current Spec: <?php echo $specname; ?></p> 
        
        <div>
            <form action="spec_plusdoc.php?specname=<?php echo $specname; ?>" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">
                <h2 class="w3-center">Spec One Plus Doc</h2>
                
                    <p>Only Active Docs:</p>
                    <select class="w3-select w3-border" name="select">
                        <option value="" disabled selected>Choose your option</option>
<?php
                        // mysqli_result | false
                        // согласно функции вернётся false, если нет строк в запросе
                        $result_set = get_all_active_docs();
                        // 
                        
                        // если получим объект, а не ложь
                        if($result_set) {
                        
                                while($row = mysqli_fetch_assoc($result_set)) {
?>
                <option value="<?php echo $row["id"]; ?>"><?php echo $row["firstname"]." ".$row["surname"]; ?></option>
<?php
                                }
                                mysqli_free_result($result_set);
                        }
?>
                <!--    <option value="1">Doc 1</option>   -->
                    </select>

                    <p>
                    <input type="submit" name="submit" class="w3-button w3-teal" value="Save Changes">
                    </p>
            </form>

            <p><a href="spec_value.php?specname=<?php echo $specname; ?>" class="w3-button w3-border">&laquo; Назад</a></p>
        </div>

<?php include("layout/bottom.php"); ?>