<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php

$firstname = "";
$birthday = "";

if (isset($_POST['submit'])) {

  // get variables
    $firstname = mysql_prep($_POST["firstname"]);
    $midname = mysql_prep($_POST["midname"]);
    $lastname = mysql_prep($_POST["lastname"]);

    $birthday = $_POST["birthday"];    
    $phone = mysql_prep($_POST["phone"]);

  // validations.
  // Значения массива берутся из $_POST,
  // $_POST берётся из html-формы.
	  $required_fields = ["firstname", "lastname", "birthday", "phone"];
	  validate_presences($required_fields);

  if (empty($errors)) {
  
    // query  
      $query  = "INSERT INTO clients (";
      $query .= "first_name, middle_name, surname, datebirth, phone";
      $query .= ") VALUES (";
      $query .= " '{$firstname}', '{$midname}', '{$lastname}', '{$birthday}', '{$phone}'";
      $query .= ")";
      $result = mysqli_query($connection, $query);

      //var_dump($firstname);  // string(0) ""
      //die();
      /*
        $value = trim($_POST["firstname"]);  
          if (!has_presence($value)) {
            //var_dump($value);
            echo "!has_presence.<br>";  // !has_presence.
            var_dump($value);           // string(0) ""
          }
      */
      // echo $query;

    // check query
      if ($result) {
        // Success
        redirect_to("choice_spec.php");
      } else {
        // Failure
          if(mysqli_errno($connection)) {
            echo "Error: " . 
                // not for production:
                mysqli_error($connection) . 
                // for production:
                " (" . mysqli_errno($connection) . "). "
            ;
            // not for production:
            echo $query;
          }
      }

  }  // end of - if (empty($errors))
    
} else {
  // Вероятно, GET запрос
}

?>

<?php
include("layouts/header.php");
include("layouts/sidebar.php");
?>
    <h2>Client data</h2>

<div class="w3-container">
    <p>
    <a class=" w3-button w3-hover-black " style="margin-bottom: 7px;" href="index.php">&laquo;</a>
    <span class=" w3-tag w3-xlarge ">1</span>
    <span class=" w3-tag w3-xlarge w3-teal">2</span>
    <span class=" w3-tag w3-xlarge w3-teal">3</span>
    <span class=" w3-tag w3-xlarge w3-teal">4</span>
    <span class=" w3-tag w3-xlarge w3-teal">5</span>
    </p>
</div>

<p>Please, fill the form.</p>
<p>
<?php
    // нужно инициализировать пустые строки, 
    // если эти переменные используются тут 
      echo "Your name: $firstname <br>" ; 
      echo "Your birthday: $birthday" ;
?>
<?php echo form_errors($errors); ?>
</p>

  <form action="client_data.php" method="post" class="w3-container w3-card-4 w3-light-grey w3-text-green w3-margin">
    <h2 class="w3-center">Your data</h2>
    
    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
        <div class="w3-rest">
          <input class="w3-input w3-border" name="firstname" type="text" placeholder="First Name *" >                
        </div>
    </div>
    
    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
        <div class="w3-rest">
          <input class="w3-input w3-border" name="midname" type="text" placeholder="Middle Name">
        </div>
    </div>
    
    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
        <div class="w3-rest">
          <input class="w3-input w3-border" name="lastname" type="text" placeholder="Last Name *" >
        </div>
    </div>        
    
    <!--
    <div class="w3-row w3-section">
      <div class="w3-col " style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
        <div class="w3-rest" style="width: 50%;">
          <input class="w3-input w3-border" name="message" type="number" min="1" max="99" placeholder="Age">
        </div>
    </div>
    -->
              
    <div class="w3-row w3-section">
      <div class="w3-col " style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
        <div class="w3-rest" style="width: 50%;">              
          <input class="w3-input w3-border" name="birthday" type="date" >
          <label for="birthday">Birthday *</label>
        </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-phone"></i></div>
        <div class="w3-rest">
          <input class="w3-input w3-border" name="phone" type="text" placeholder="Phone *" required>
          <small>Real number, please</small><br>
        </div>                        
    </div>        
    
    <button class="w3-button w3-block w3-section w3-green w3-ripple w3-padding" type="submit" name="submit">Next &raquo;</button>
  </form>    

<?php       
include("layouts/footer.php");                        
?>    