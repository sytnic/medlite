<?php require_once("../includes/session.php");
      require_once("../includes/db_connection.php");
      require_once("../includes/functions.php"); 
        // если пришли сюда напрямки (Сессия пуста),
        // то редирект.
        if (empty($_SESSION)) {
            redirect_to("index.php");
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
<h2>Time choosing</h2>

<div class="w3-container">
    <p>
    <a class=" w3-button w3-hover-black " style="margin-bottom: 7px;" href="choice_doc.php">&laquo;</a>
    <span class=" w3-tag w3-xlarge w3-teal">1</span>
    <span class=" w3-tag w3-xlarge w3-teal">2</span>
    <span class=" w3-tag w3-xlarge w3-teal">3</span>
    <span class=" w3-tag w3-xlarge ">4</span>
    <span class=" w3-tag w3-xlarge w3-teal">5</span>
    <span class=" w3-tag w3-xlarge w3-teal">6</span>
    </p>
</div>

<p>Please, choose the time. </p>   

<?php
      // если мы получили в Гете wanted_id,
        // присвоить его в сессию.
        // Лучше Дока получать по id, т.к. возможны однофамильцы.
      if (isset($_GET["wanted_id"])) {
          $wanted = $_GET["wanted_id"];
          $_SESSION["wanted_id"] = $wanted; 
      }

      echo "<pre>";
      print_r($_SESSION);
      echo "</pre>";
?>

<table class="w3-table w3-bordered" style="width: 50%;">
    <tr>
      <th>Date <small>(Year-Month-Date)</small></th>          
      <th>Day</th>
      <th>Time</th>
      <th>Action</th>          
    </tr>
    <tr>
    <!-- Эти значения будут получены из БД -->
      <td>2022-11-23</td>
      <td>Tue</td>
      <td>10:30</td>              
      <td><a href="confirm.php?date=2022-11-23&time=10:30" class="w3-button w3-border">Choose</a></td>
    </tr>
    <tr>              
      <td>2022-06-23</td>
      <td>Mon</td>
      <td>10:50</td>
      <td><a href="confirm.php?date=2022-06-23&time=10:50" class="w3-button w3-border">Choose</a></td>
    </tr>
    <tr>
      <td>27.07.22</td>
      <td>Sun</td>
      <td>12:00</td>
      <td><a href="confirm.php?date=27/07/22&time=12:00" class="w3-button w3-border">Choose</a></td>
    </tr>
</table>                
<!--
already is set

  </div> -- End of Main Content --  
</div> -- End of Main Div --
-->        
<?php       
include("layouts/footer.php");                        
?>    