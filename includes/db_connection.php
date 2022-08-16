<?php
  // 1. Create a database connection
  /*
  $dbhost = "localhost";
  $dbuser = "widget_user";
  $dbpass = "secretpassword";
  $dbname = "widget_db";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  */
  define("DB_SERVER", "localhost");
	define("DB_USER", "medlite");
	define("DB_PASS", "medlite");
	define("DB_NAME", "medlite");
 
$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);  
  
  // Test if connection occurred.
  if(mysqli_connect_errno()) { // return error code or 0
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
?>