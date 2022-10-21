<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/validation_functions.php");
        include("../../includes/session.php");
?>
<?php
    $admin = find_admin_by_id($_GET["id"]);
    if (!$admin) {
        redirect_to("admin_list.php");
    }

    if (isset($_POST['submit'])) {
        // Process the form
                 
        // validations
        $required_fields = array("username", "password");
        validate_presences($required_fields);
        // здесь $errors[] - global
    
        $fields_with_max_lengths = array("username" => 30);
        validate_max_lengths($fields_with_max_lengths);
        // здесь $errors[] - global
   
      if(empty($errors)){
        $username = mysql_prep($_POST["username"]);
        $password = mysql_prep($_POST["password"]);
        $id = $admin["id"];

        $query  = "UPDATE docadmins SET ";
        $query .= " username = '{$username}', ";
        $query .= " password = '{$password}' ";
        $query .= " WHERE id = {$id} ";
        $query .= " LIMIT 1";
        $result = mysqli_query($connection, $query);

        // echo $query; // But It Will cause - Cannot modify header
        // echo "affected_rows ".mysqli_affected_rows($connection);
        // var_dump($result);
        // But It Will cause - Cannot modify header

        if ($result && mysqli_affected_rows($connection) >= 0) {
            // Success
            $_SESSION["message"] = "Admin updated.";
            redirect_to("admin_list.php");
        } else {
            // Failure
            $_SESSION["message"] = "Admin update failed.";
        }
                    
      } else {
        // Вероятно, GET запрос
        // 
      }

    }
?>
<?php include("layout/top.php"); ?>
<?php echo message();   ?>
<?php echo form_errors($errors); ?>

<h2>Edit Admin <?php echo htmlentities($admin["username"]); ?></h2>

    <form action="admin_edit.php?id=<?php echo urlencode($admin['id']); ?>" method="post" >       
        Username:       <input type="text"     name="username" value="<?php echo htmlentities($admin['username']); ?>" /> <br><br>     
        Password:&nbsp; <input type="password" name="password" value="" /> <br><br><br>
                        <input type="submit"   name="submit"   value="Edit Admin" />
    </form>
    
    <br><br>
    <a href="admin_list.php">Cancel</a>
    <br><br>

