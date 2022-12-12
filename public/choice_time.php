<?php require_once("../includes/session.php");
      require_once("../includes/db_connection.php");
      require_once("../includes/functions.php"); 
        // если вся Сессия пуста, то редирект
        if (empty($_SESSION)) {
            redirect_to("index.php");
        }

        // очищение сессии при переходе назад из след. шага
        if (isset($_GET["fromnext"])) {
            $_SESSION["date"] = null;
            $_SESSION["time"] = null;
        }

        // если мы получили в Гете wanted_id,
        // присвоить его в сессию.
        // Лучше Дока получать по id, т.к. возможны однофамильцы.
        if (isset($_GET["wanted_id"])) {
            // подразумевается id или строка 'seeall',
            // но нужны проверки на другие значения
            $wanted = $_GET["wanted_id"];
            $_SESSION["wanted_id"] = $wanted; 
        }

        // присвоение переменных
        $spec_id =  $_SESSION["spec_id"];
        
        $wanted_id = $_SESSION["wanted_id"];

        if (is_numeric($wanted_id)) {
            $doc_id = $wanted_id;
            $result_set = get_times_by_docid($doc_id);
        } elseif($wanted_id == "seeall") {
            $seeall = $wanted_id;
            $result_set = get_times_by_specid($spec_id);
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
    <a class=" w3-button w3-hover-black " style="margin-bottom: 7px;" href="choice_doc.php?fromnext=1">&laquo;</a>
    <span class=" w3-tag w3-xlarge w3-teal">1</span>
    <span class=" w3-tag w3-xlarge w3-teal">2</span>
    <span class=" w3-tag w3-xlarge w3-teal">3</span>
    <span class=" w3-tag w3-xlarge ">4</span>
    <span class=" w3-tag w3-xlarge w3-teal">5</span>
    <span class=" w3-tag w3-xlarge w3-teal">6</span>
    </p>
</div>

<p>Please, choose the time.</p>   

<?php
      echo "<pre>";
      print_r($_SESSION);
      echo "</pre>";
?>

<table class="w3-table w3-bordered" style="width: 50%;">
    <tr>
      <th>Date</th>          
      <th>Day</th>
      <th>Time</th>
      <th>Doc</th>
      <th>Action</th>      
    </tr>    
<?php
      

      while($row = mysqli_fetch_assoc($result_set)) {      
?>    
          <tr> 
            <td><?php echo date("d.m.y", strtotime($row["date"])); ?></td>
            <td><?php echo date("l", strtotime($row["date"]));  ?></td>
            <td><?php echo substr($row["time"], 0, -3);  ?></td>
            <td><?php echo $row["firstname"]." ".$row["surname"]; ?></td>
            <td><a href="confirm.php?time_id=<?php echo $row["id_time"]; ?>" 
                   class="w3-button w3-border">Choose</a></td>                             
          </tr>
<?php  
      }
?>    
<!--   
    <tr>       
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
-->    
</table>

<!--
already is set

  </div> -- End of Main Content --  
</div> -- End of Main Div --
-->        
<?php       
include("layouts/footer.php");                        
?>    