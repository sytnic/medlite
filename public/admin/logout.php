<?php include("../../includes/functions.php");
      include("../../includes/session.php");  ?>
<?php
	// v1: simple logout
	// session_start();
	$_SESSION["admin_id"] = null;
	$_SESSION["username"] = null;
	redirect_to("login.php");
?>
<?php
	// v2: destroy session
	// assumes nothing else in session to keep
    
    // // Где-то в начале скриптов стартует сессия
	// session_start();
	
    // // Здесь задаётся пустая сессия, т.е. стираются все значения из массива $_SESSION[]
    // $_SESSION = array();
    
    // // Если в браузере остались Куки от сессии, то этим кукам присваивается пустое значение 
    // // и с присвоением того же имени кукам переносится в прошлое
	// if (isset($_COOKIE[session_name()])) {
	//   setcookie(session_name(), '', time()-42000, '/');
	// }
    
    // // Уничтожить файл Сессии на сервере
	// session_destroy(); 

	// redirect_to("login.php");
?>