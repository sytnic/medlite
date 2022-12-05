<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/validation_functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php
        $message = "";
        // processing form
        if (isset($_POST['submit'])) {
                // Process the form
        
                $firstname = mysql_prep($_POST["firstname"]);
                $middlename = mysql_prep($_POST["middlename"]);
                $lastname = mysql_prep($_POST["lastname"]);

                $phone = mysql_prep($_POST["phone"]);
                $cost = mysql_prep($_POST["cost"]);                
                     
            // validations
                $required_fields = array("firstname", "lastname");
                validate_presences($required_fields);
                // здесь $errors[] - global 
                //var_dump($errors); 
            
                if (empty($errors)) {		
               
                        $query  = "INSERT INTO docs (";
                        $query .= " firstname, midname, surname, phone, cost  ";
                        $query .= ") VALUES (";
                        $query .= " '{$firstname}', '{$middlename}', '{$lastname}', '{$phone}', '{$cost}' ";
                        $query .= ")";
                        
                        $result = mysqli_query($connection, $query);

                        //var_dump($result);
        
                        echo $query; // But It Will cause - Cannot modify header
        
                        if ($result) {
                                // Success
                                $message = "Doc created succefull.";
                        } else {
                                // Failure
                                $message = "Doc creation failed.";
                        }    
                                
                } else {
                        // Вероятно, GET запрос
                        // 
                }	
        }

?>
<?php   include("layout/top.php"); ?>

        <h2>Create doc</h2>
<?php
        echo $message;
        echo form_errors($errors);
?>
        <p>Please, configure this.</p>


        <div class="w3-container w3-light-grey w3-responsive w3-mobile" style="width:80%; float:left;">      
            
            <form action="doc_create.php" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">
                <h2 class="w3-center">Doc data</h2>
                
                    Doc:<br>
                    <input class="w3-input w3-border" name="firstname" type="text" placeholder="First Name *">
                    <input class="w3-input w3-border" name="middlename" type="text" placeholder="Middle Name">
                    <input class="w3-input w3-border" name="lastname"  type="text" placeholder="Last Name *">

                    <input class="w3-input w3-border" name="phone" type="text" placeholder="Phone">
                    <input class="w3-input w3-border" name="cost"  type="text" placeholder="Cost">   
                    

<!--   
                    <input class="w3-input w3-border" name="spec1" type="text" placeholder="Specialization 1">
                    <input class="w3-input w3-border" name="spec2" type="text" placeholder="Specialization 2">
                    <input class="w3-input w3-border" name="spec3" type="text" placeholder="Specialization 3">
-->

                    <p>
                    <input type="submit" name="submit" class="w3-button w3-teal" value="Create Doc">
                    </p>            

            </form>
        </div>        
                        
<?php include("layout/bottom.php"); ?>