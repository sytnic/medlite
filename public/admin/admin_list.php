<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");   ?>
<?php confirm_logged_in(); ?>
<?php   include("layout/top.php"); ?>

<?php echo message();?>
<h2>Manage Admins</h2>
    <table style="width: 300px;">
        <tr  style="text-align: left;">
            <th>Username</th>
            <th>Actions</th>
        </tr>
        <!-- 
        <tr>
            <td>Jill</td>
            <td>Smith</td>
        </tr>
        -->

        <?php 
            $admin_set = find_all_admins();

            while($admin = mysqli_fetch_assoc($admin_set)) {
              
              //var_dump($admin);

              $output = "<tr>";

              $output.= "<td>";
              $output.= htmlentities($admin["username"]);
              $output.= "</td>";

              $output.= "<td>";

              $output.= '<a href="admin_edit.php?id=';
              $output.= urlencode($admin['id']);
              $output.= '">';
              $output.= 'Edit</a> ';

              $output.= '<a href="admin_delete.php?id=';
              $output.= urlencode($admin['id']);                  
              $output.= '"';  // закрыли кавычку после id
              $output.= ' onclick="return confirm';
              $output.= "('Are you sure to delete admin?');";
              $output.= '"';  // закрыли кавычку после return confirm
              $output.= '>';  // закрыли открывающий тег <a>
              $output.= 'Delete</a>';

              $output.= "</td>";

              $output.= "</tr>";
              echo $output;  
            }
        ?>
    </table>

    <br> 
    <a href="admin_new.php">Add new admin</a>
    <br>
    <br>
    <a href="index.php">Cancel</a>

<?php include("layout/bottom.php"); ?>