<?php require_once("../includes/session.php");
      require_once("../includes/db_connection.php");
      require_once("../includes/functions.php");
      require_once("../includes/validation_functions.php");
?>
<?php
// Стираю сессию по get-запросу.
// Работает совместно с Кнопкой стирания сессии,
// но в текущей версии 
// (возврат со следующего шага и автоматическое стирание сессии)
// этот блок не нужен.
if (isset($_GET["sess"]) && $_GET["sess"] == "zero") {
    // echo $_GET["sess"];
    $_SESSION["inputs"] = null;
}

// инициализация переменных для html
$firstname = "";
$midname = "";
$lastname = "";
$birthday = "";
$phone = "";

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

      $_SESSION["inputs"] = [$firstname, $midname, $lastname, $birthday, $phone];
      redirect_to("choice_spec.php");
  
    /*  
      // query  
        $query  = "INSERT INTO clients (";
        $query .= "first_name, middle_name, surname, datebirth, phone";
        $query .= ") VALUES (";
        $query .= " '{$firstname}', '{$midname}', '{$lastname}', '{$birthday}', '{$phone}'";
        $query .= ")";
        $result = mysqli_query($connection, $query);

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
    */

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

<?php  // Кнопка стирания сессии,
      // появляется, если есть сессия на странице

      // if(isset($_SESSION["inputs"])) { ?>
      <!--      <p><a href="client_data.php?sess=zero" class="w3-button w3-brown">Erase my data</a></p>  -->
<?php // } ?>

<p>
  <?php
      /*
        var_dump($_SESSION["inputs"]);
        var_dump($_SESSION["inputs"][0]);      
        if(isset($_SESSION["inputs"])) {echo $_SESSION["inputs"][0]; } 
        echo "<br>" ; 
      */
        // нужно инициализировать пустые строки выше под эти переменные, 
        // раз эти переменные используются
        echo "Var name: $firstname. <br>";
        echo "Var lastname: $lastname. <br>" ;
        echo "Var birthday: $birthday. <br>" ;
        echo "Var phone: $phone. <br>" ;  
        
        echo "<pre>";
        print_r($_SESSION["inputs"]);
        echo "</pre>";

  ?>
  <?php echo form_errors($errors); 
        
        /*
        проблема #1.
        текущее поведение (Step 1. v1): 
          если заполнить форму, вернуться на неё, стереть значение и отправить форму,
          то отправка будет предотвращена php-валидацией, 
          но значение будет заполнено из сессии
        */  
  ?>
  
</p>

  <form action="client_data.php" method="post" class="w3-container w3-card-4 w3-light-grey w3-text-green w3-margin">
    <h2 class="w3-center">Your data</h2>
    
    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
        <div class="w3-rest">
          <input class="w3-input w3-border" name="firstname" type="text" placeholder="First Name *" 
          value="<?php  if(isset($_SESSION["inputs"])) {
                            echo $_SESSION["inputs"][0]; 
                        } else { 
                            echo $firstname;
                        } ?>" >
        </div>
    </div>
    
    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
        <div class="w3-rest">
          <input class="w3-input w3-border" name="midname" type="text" placeholder="Middle Name"
          value="<?php echo (isset($_SESSION["inputs"])) ? $_SESSION["inputs"][1] : $midname; ?>" >
        </div>
    </div>
    
    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
        <div class="w3-rest">
          <input class="w3-input w3-border" name="lastname" type="text" placeholder="Last Name *" 
          value="<?php echo (isset($_SESSION["inputs"])) ? $_SESSION["inputs"][2] : $lastname; ?>" >
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
          <input class="w3-input w3-border" name="birthday" type="date" 
          value="<?php if(isset($_SESSION["inputs"])) {echo $_SESSION["inputs"][3]; } else { echo $birthday; } ?>" >
          <label for="birthday">Birthday *</label>
        </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-phone"></i></div>
        <div class="w3-rest">
          <input class="w3-input w3-border" name="phone" type="text" placeholder="Phone *" required 
          value="<?php echo (isset($_SESSION["inputs"])) ? $_SESSION["inputs"][4] : $phone; ?>" >
          <small>Real number, please</small><br>
        </div>                        
    </div>        
    
    <button class="w3-button w3-block w3-section w3-green w3-ripple w3-padding" type="submit" name="submit">Next &raquo;</button>
  </form>    

<?php
    // Стираю сессию по get-запросу,
    // если вернулся со следующего шага.
    // Это нужно для решения проблемы #1.
    if (isset($_GET["from"]) && $_GET["from"] == "step2") {
      $_SESSION["inputs"] = null;
    }
?>
<?php       
include("layouts/footer.php");                        
?>    