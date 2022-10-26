<?php
  // 1. Create a database connection
  /*
  $dbhost = "localhost";
  $dbuser = "widget_user";
  $dbpass = "secretpassword";
  $dbname = "widget_db";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  */
  define("DB_SERVER", "db");
	define("DB_USER", "root");
	define("DB_PASS", "123");
	define("DB_NAME", "medlite_db");

  
 
$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME); 
//printf("Начальный набор символов: %s\n", mysqli_character_set_name($connection));
// для сохранения русских букв в БД как надо:
mysqli_set_charset($connection, 'utf8'); 

//printf("Текущий набор символов: %s\n", mysqli_character_set_name($connection));
  
  // Test if connection occurred.
  if(mysqli_connect_errno()) { // return error code or 0
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
?>