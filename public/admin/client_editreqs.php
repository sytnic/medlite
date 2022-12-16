<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/validation_functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php
// Catch GET
if (isset($_GET["id"])) {
    $req_id = (int)$_GET["id"];
}
?>
<?php
// POST processing

$message = "";

if (isset($_POST["submit"])) {
    //processing form

    // vars 
    $first_name = mysql_prep($_POST["firstname"]);
    $mid_name = mysql_prep($_POST["midname"]);
    $sur_name = mysql_prep($_POST["surname"]);
    $date_birth = mysql_prep($_POST["born"]);
    $phone_num = mysql_prep($_POST["phone"]);

    // admin var
    if (isset($_SESSION["admin_id"])) {
        $admin_id = (int)$_SESSION["admin_id"];
    }

    // validation    
    $required_fields = ["firstname", "surname", "born", "phone"];
    validate_presences($required_fields);

    // query
    if (empty($errors)) {		
       
        $query  = "UPDATE client_reqs SET ";
        $query .= " firstname = '{$first_name}' ,";
        $query .= " midname = '{$mid_name}'     ,";
        $query .= " surname = '{$sur_name}'     ,";
        $query .= " datebirth = '{$date_birth}' ,";
        $query .= " phone = '{$phone_num}'      ,";

        $query .= " who_edited = {$admin_id}";
        $query .= " WHERE id = {$req_id}";
        $query .= " LIMIT 1";
        
            $result = mysqli_query($connection, $query);

            //echo $query; // But It Will cause - Cannot modify header

            if ($result && mysqli_affected_rows($connection) == 1) {
                // Success
                $message = '<div class="w3-panel w3-pale-yellow w3-border" style="width:300px;"><p>';
                $message.= "CLient request updated successful.";
                $message.= '</p></div>';               
            } else {
                // Failure
                $message = '<div class="w3-panel w3-pale-yellow w3-border" style="width:300px;"><p>';
                $message.= "CLient request updation failed.";
                $message.= '</p></div>';
            } 
          
    } else {
            // Вероятно, GET запрос
            // 
    }	    
}
?>
<?php
// Vars for html output

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
<?php
    echo $message;
    echo form_errors($errors);
?>
    <h2>Edit client's request</h2>
    <p>Please, configure this.</p>

    <div class="w3-container w3-light-grey w3-responsive w3-mobile" style="width:100%; float:left;">      
        
        <form action="client_editreqs.php?id=<?php echo $req_id; ?>" method="post" class="w3-container w3-card w3-light-grey w3-text-teal w3-margin">
            <h2 class="w3-center">Client data</h2>
            
            Client:<br>
            <input class="w3-input w3-border" name="firstname" type="text" value="<?php echo $firstname; ?>">
            <input class="w3-input w3-border" name="midname" type="text"  value="<?php echo $midname; ?>">
            <input class="w3-input w3-border" name="surname" type="text" value="<?php echo $surname; ?>">
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
          <a href="client_reqs.php" class="w3-button w3-border">
          &laquo; List of Requests</a>
        </p>   

        <p>
          <a href="client_reqdelete.php?req_id=<?php echo $req_id; ?>" class="w3-button w3-border w3-border-red"
             onclick="return confirm('Are you sure?');">Delete All</a>
        </p>       
    </div> 

<?php include("layout/bottom.php"); ?>


