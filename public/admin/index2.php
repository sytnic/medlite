<?php include("../../includes/functions.php");
      include("../../includes/session.php");  ?>
<?php confirm_logged_in(); ?>
<?php include("layout/top.php"); ?>

    <h2>Header Index</h2>
<!--
    <p>Please, choose your choice.</p> 
    
    <p>Next step</p>
    <a href="#" class="w3-button w3-border">Next</a>   
    
    <hr style="background-color:grey; height:1px; width: 40%;">

    <p style="color:grey;">:before login</p>
-->

    <p>Please, login.</p>
    <a href="login.php" class="w3-button w3-border">Login</a>
    <hr>

    <?php
    // Пример хэширования паролей. 
    // Длина хэша для blowfish должна быть 22 или больше знаков.  
    
        $password = "secret";
        $hash_format = "$2y$10$";  // 2y - blowfish, 10 - параметр стоимости (повторяемости)
        $salt = "Salt22CharactersOrMore";
        echo "Lenght: ".strlen($salt);  // длина соли

        // Шифрование+соль + пароль == результат для БД
        $format_and_salt = $hash_format . $salt;
        $hash = crypt($password, $format_and_salt);
        echo "<br>";
        echo $hash;

        // Новый вход: 
        // сохранённый хэш (в БД) плюс введённый правильный пароль
        // дают тот же хэш, к-рый был сохранён
        $hash2 = crypt("secret", $hash);
        echo "<br>";
        echo $hash2;

        // c php 5.5 используются аналогично
        // password_hash($password, PASSWORD_DEFAULT)
        // или
        // password_hash($password, PASSWORD_BCRYPT, ['cost'=>10])
        // и
        // password_verify($password, $existing_hash)



    ?>
<?php include("layout/bottom.php"); ?>


