<?php   include("../../includes/db_connection.php");
        include("../../includes/functions.php");
        include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php   include("layout/top.php"); ?>

    <h2>Admin Menu</h2>
	<p>Welcome to the admin area, <?php echo htmlentities($_SESSION["username"]); ?>.</p>
	<ul>
	  <li><a href="admin_list.php">List of Admins</a></li>
	  <li><a href="logout.php">Logout</a></li>
	</ul>

<?php include("layout/bottom.php"); ?>