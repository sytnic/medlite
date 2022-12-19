<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");
        include("../../includes/database.php");         // oop
        include("../../includes/database_object.php");  // oop
        include("../../includes/mytraits.php");         // trait
        include("../../includes/requests.php");         // oop
        include("../../includes/pagination.php");       // oop
?>
<?php confirm_logged_in(); ?>
<?php
// Prepare of pagination

// 1. the curent page number ($current_page)
$page = !empty($_GET["page"]) ? (int)$_GET["page"] : 1 ;

// 2. record per page ($per_page)
$per_page = 5;

// 3. total record count ($total_count)
$total_count = Requests::count_all();

// Find all requests
// use pagination instead
// $requests = Requests::find_all();

$pagination = new Pagination($page, $per_page, $total_count);

// Instead of finding all records, just find the records 
// for this page
$sql = "SELECT * FROM client_reqs ";
$sql .= " LIMIT {$per_page} ";
// offset uses $page and $per_page
$sql .= " OFFSET {$pagination->offset()}";

// массив из объектов
// выбирается на основе гет-параметра
// используется в пагинации
$requests = Requests::find_by_sql($sql);

// массив объектов
// используется при выводе всех без пагинации
$reqs = Requests::find_all();

// Need to add ?page=$page to all links we want to 
// maintain the current page (or store $page in $session)


?>
<?php   include("layout/top.php"); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.6.2.js" 
        integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<?php  
    echo message();
    // <script src="https://www.w3schools.com/lib/w3.js"></script>
    // w3-table w3-bordered
    // onclick="w3.sortHTML('#myTable', '.item', 'td:nth-child(6)')" style="cursor:pointer"
?>

        <h2>List of clients</h2>
        <p>Please, configure this.</p>

        <div class="w3-container w3-light-grey w3-responsive w3-mobile" style="width:100%; float:left;">            
            <table id="myTable" class="">
            <thead>
              <tr>
                <th>Client Name</th>          
                <th>Date Born</th>
                <th>Client Phone</th>
                <th>Specname</th>
                <th>Doc name</th>
                <th>Date</th>          
                <th>Day</th>
                <th>Time</th>
                <th class="w3-text-grey">Action</th>
              </tr>
            </thead>
            <tbody>
<?php
// Объектно-ориентированный вывод на страницу

// работа с массивом объектов

// если выводить все без навигации:
// foreach($reqs as $onereq):

// если выводить с навигацией:
// foreach($requests as $onereq):

foreach($reqs as $onereq): ?>

              <tr class="item">
                <td><?php echo $onereq->fullname();  ?></td>
                <td><?php echo $onereq->humandate(); ?></td>
                <td><?php echo $onereq->phone; ?></td>
                <td><?php echo $onereq->get_specname(); ?></td>
                <td><?php echo $onereq->doc_fullname(); ?></td>
                <td><?php echo $onereq->date_meet(); ?></td>
                <td><?php echo $onereq->day_meet();  ?></td>
                <td><?php echo $onereq->time_meet(); ?></td>
                <td><?php echo "<a href=\"client_editreqs.php?id=".$onereq->id."\" class=\"\">Edit</a>"; ?></td>
              </tr>

<?php endforeach; ?>
              </tbody>
            </table>
        </div>

<div class="w3-bar" style="clear: both;">
<br>

<?php
// Пагинация. Pagination

// если количество пагинационных страниц больше одной, то
// выводим навигацию

/* Пагинация на ооп отключена из-за применения Datatables и jquery.

  if($pagination->total_pages() > 1) {
		
    // Если есть предыдущая страница
    // if(bool)
		if($pagination->has_previous_page()) { 
    	echo "<a href=\"client_reqs.php?page=";
      echo $pagination->previous_page();
      echo "\" class='w3-button w3-sand'";
      echo " >&laquo; Previous</a> "; 
    }

    for($i=1; $i <= $pagination->total_pages(); $i++) {
      // если число $i, по к-рому мы проходим, равна числу $page (основана на $_GET['page']),
      // то выводим span class
      if($i == $page) {
			  	echo " <span class='w3-button w3-border'>{$i}</span> ";
			} else {
      // иначе, в остальных случаях, выводим ссылку
          echo  "<a href=\"client_reqs.php?page={$i}\" class='w3-button w3-sand'>{$i}</a> ";
      }
    }

    // Если есть следующая страница
    // if(bool)
    if($pagination->has_next_page()) { 
			echo " <a href=\"client_reqs.php?page=";
			echo $pagination->next_page();
      echo "\" class='w3-button w3-sand'";
			echo " >Next &raquo;</a> "; 
    }
  }
  */
?>
</div>

<?php
// Процедурный вывод всех записей на страницу
// Закомментировать полностью

/*
      // SELECT all FROM client_reqs

      $query = "SELECT * FROM client_reqs";

      // Confirm
      $result = mysqli_query($connection, $query);

      if (!$result) {
          die(
          "Database query failed. "."Код: ".mysqli_errno($connection) 
          );
      }

      // while($row) {
      //     Prepare variables for output
      //     and output
      // }
      while($row = mysqli_fetch_assoc($result)){
          echo "<tr>";
          // client fullname
          echo "<td>".$row['firstname']." ".$row['surname']."</td>";

          // date born
          // prepare of var
          $born = date("d.m.y", strtotime($row['datebirth']));
          echo "<td>".$born."</td>";

          // client phone
          echo "<td>".$row['phone']."</td>";  

          // specname
          // prepare of var
          $specname = get_specname_by_specid($row['spec_id']);
          echo "<td>".$specname."</td>"; 

          // doc fullname
          // prepare of var
          $docrow = get_doc_by_id($row['doc_id']);
          echo "<td>".$docrow['firstname']." ".$docrow['surname']."</td>"; 

          // date meet
          // prepare of var
          $doctimerow = get_doctimerow_by_doctimeid($row['doctime_id']);
          $date_raw =  $doctimerow["date"];
          $datemeet = date("d.m.y", strtotime($date_raw));
          echo "<td>".$datemeet."</td>";

          // day meet
          // prepare of var
          $daymeet = date("l", strtotime($date_raw));
          echo "<td>".$daymeet."</td>"; 

          // time meet
          // prepare of var
          $time_raw = $doctimerow["time"];
          $timemeet = substr($time_raw, 0, -3);
          echo "<td>".$timemeet."</td>"; 

          // action
          echo "<td>";
          echo "<a href=\"client_editreqs.php?id=".$row['id']."\" class=\"\">Edit</a>";
          echo "</td>"; 

          echo "</tr>";
      }

      // mysqli_free_result()
      mysqli_free_result($result);

*/
?>
<!--
                <tr>
                  <td>Eve Jackson</td>
                  <td>12.01.2000</td>
                  <td>8-950-123-4567</td>
                  <td>Jillington</td>
                  <td>Jill Smith</td>
                  <td>11.12.22</td>
                  <td>Monday</td>
                  <td>10:50</td>
                  <td><a href="client_editreqs.php?id=2" class="">Edit</a></td>
                </tr>
-->
<script>              
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
<?php include("layout/bottom.php"); ?>