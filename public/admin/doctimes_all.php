<?php   include("../../includes/db_connection.php");    // constants needed
        include("../../includes/database.php");         // oop
        include("../../includes/functions.php");
        include("../../includes/session.php");        
        include("../../includes/database_object.php");  // oop
        include("../../includes/mytraits.php");         // trait
        include("../../includes/doctimes.php");         // oop
?>
<?php confirm_logged_in(); ?>
<?php
// Prepare vars

// массив объектов
$alltimes = Doctimes::find_all();


?>
<?php   include("layout/top.php"); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.6.2.js" 
        integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<?php  echo message();  ?>

        <h2>List of clients</h2>
        <p>Please, configure this.</p>

        <div class="w3-container w3-light-grey w3-responsive w3-mobile" style="width:100%; float:left;">            
            <table id="myTable" class="">
            <thead>
              <tr>
                <th>Doc name</th>               
                <th>Date </th>
                <th>Day</th>
                <th>Time</th>
                <th>Status</th>
                <th>Client Reqs</th>
              </tr>
            </thead>
            <tbody>

<?php foreach($alltimes as $onereq): ?>

                <tr class="item">
                    <td><?php echo $onereq->doc_fullname();  ?></td>                    
                    <td><?php echo $onereq->humandate(); ?></td>
                    <td><?php echo $onereq->day();; ?></td>
                    <td><?php echo $onereq->time(); ?></td>
                    <td><?php echo $onereq->status_str(); ?></td>
                    <td><?php echo $onereq->clientreq_link(); ?></td>
                </tr>                

<?php endforeach; ?>

<?php
/*
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
*/
?>

<!--
            <tr>
                <td>Аскаменто Фридрих</td>
                <td>Генезис</td>           
                <td>24-03-2022  </td>
                <td>Mon</td>
                <td>15:14</td>
                <td>Free</td>
                <td>Client_reqs</td>
                <td class="w3-text-grey">Delete</td>
              </tr>
              <tr>
                <td>Эстудианто Монарх</td>
                <td>Энезис</td>           
                <td>23-03-2022 </td>
                <td>Tue</td>
                <td>10:30</td>
                <td>Busy</td>
                <td>Client_reqs</td>
                <td class="w3-text-grey">Delete</td>
              </tr>
-->
            </tbody>
            </table>
        </div>

<script>              
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
<?php include("layout/bottom.php"); ?>