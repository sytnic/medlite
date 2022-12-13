<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php
// Vars for html output

// Catch GET
if (isset($_GET["id"])) {
    $req_id = (int)$_GET["id"];
}

// query
$query = "SELECT * FROM client_reqs WHERE id = {$req_id} LIMIT 1";

// Confirm
$result = mysqli_query($connection, $query);
if (!$result) {
    die(
    "Database query failed. "."Код: ".mysqli_errno($connection) 
    );
}

// if($row) {
//     Prepare variables for output
// }
if($row = mysqli_fetch_assoc($result)) {
    // client
    $firstname = $row["firstname"];
    $midname = $row["midname"];
    $surname = $row["surname"];    
    $datebirth = $row["datebirth"];
    $phone = $row["phone"];

    // doc
    $doc_id = $row["doc_id"];
    // get doc by his id
    $docrow = get_doc_by_id($row['doc_id']);

    // get specname by its id
    // string
    $specname = get_specname_by_specid($row['spec_id']);

    // date meet
    // get date by id of doctime
    $doctimerow = get_doctimerow_by_doctimeid($row['doctime_id']);
    $date_raw =  $doctimerow["date"];
    // $datemeet = date("d.m.y", strtotime($date_raw));

    // time meet
    // get time by id of doctime
    $time_raw = $doctimerow["time"];
    $timemeet = substr($time_raw, 0, -3);

}
?>
<?php   include("layout/top.php"); ?>

    <h2>Edit client's request</h2>
    <p>Please, configure this.</p>

    <div class="w3-container w3-light-grey w3-responsive w3-mobile" style="width:100%; float:left;">      
        
        <form action="#" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">
            <h2 class="w3-center">Client data</h2>
            
            Client:<br>
            <input class="w3-input w3-border" name="first" type="text" value="<?php echo $firstname; ?>">
            <input class="w3-input w3-border" name="last" type="text"  value="<?php echo $midname; ?>">
            <input class="w3-input w3-border" name="email" type="text" value="<?php echo $surname; ?>">
            <input class="w3-input w3-border" name="born" type="date"  value="<?php echo $datebirth; ?>">
            <input class="w3-input w3-border" name="phone" type="text" value="<?php echo $phone; ?>">
            Spec Name:<br>
            <input class="w3-input w3-border" name="" type="text" value="<?php echo $specname; ?>" disabled>   
            Doc Name:<br>
            <input class="w3-input w3-border" name="" type="text" 
            value="<?php echo $docrow['firstname']." ".$docrow['surname']; ?>" disabled>
            Date Meet:<br>
            <input class="w3-input w3-border" name="" type="date" 
            value="<?php 
            // сырая строка с датой из БД вписывается в html без доп. обработки
            echo $date_raw; 
            ?>" disabled>
            Time Meet:<br>
            <input class="w3-input w3-border" name="" type="time" value="<?php echo $timemeet; ?>" disabled>               

            <p>
            <input type="submit" name="submit" class="w3-button w3-teal" value="Save Changes">
            </p>            
        </form>   

        <p>
          <a href="client_reqdelete.php?docid=<?php echo $req_id; ?>" class="w3-button w3-border w3-border-red"
             onclick="return confirm('Are you sure?');">Delete All</a>
        </p>       
    </div> 

<?php include("layout/bottom.php"); ?>


