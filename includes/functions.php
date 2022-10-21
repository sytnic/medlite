<?php

function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit;
}

/**
 * @param string $string
 * @return string
 */
function mysql_prep($string) {
    global $connection;
    
    $escaped_string = mysqli_real_escape_string($connection, $string);
    return $escaped_string;
}

/**
 * @param mysqli_result $result_set
 * @param string $function_name
 */
function confirm_query($result_set, $function_name="another function") {
    global $connection;

    if (!$result_set) {        
        die("Database query failed. Function confirm_query() failed in $function_name. ".
            "Error: ".mysqli_errno($connection).". ".
            "Connect Error: ".mysqli_connect_errno($connection).". ".
            "SQL State: ".mysqli_sqlstate($connection)
            );
        // хотя не очень хорошо всё рассказывать в продакшене
    }
}

/**
 * @return mysqli_result
 */
function get_all_specs() {
    global $connection;

    $query = "SELECT * FROM specs";
    $result_set = mysqli_query($connection, $query);
    confirm_query($result_set, "get_all_specs");

    return $result_set;
}

/**
 * @param  int $spec_id
 * @return mysqli_result
 */
function get_all_docs_by_specid($spec_id) {
    global $connection;

    $query = "SELECT * 
                FROM docs 
                WHERE spec_id = {$spec_id}
                LIMIT 50";
    $result_set = mysqli_query($connection, $query);
    confirm_query($result_set, "get_all_docs_by_specid");

    return $result_set;
}

/**
 * @param  int $spec_id
 * @return mysqli_result
 */
function get_active_docs_by_specid($spec_id) {
    global $connection;

    $query = "SELECT * 
                FROM docs 
                WHERE spec_id = $spec_id
                AND active = 1
                LIMIT 50";
    $result_set = mysqli_query($connection, $query);
    confirm_query($result_set, "get_active_docs_by_specid");

    return $result_set;
}

/**
 * @param  string $spec_name
 * @return int $id
 */
function get_id_by_specname($spec_name) {
    global $connection;

    $query = "SELECT id FROM specs WHERE specname = '$spec_name' LIMIT 1";

    $result_set = mysqli_query($connection, $query);
    confirm_query($result_set, "get_id_by_specname");

    // используется if, а не while, п.что 
    // ожидается только одно значение
    if ($row = mysqli_fetch_assoc($result_set)) {
        $id = $row['id'];
    }

    return $id;
}

/**
 * @param  int $doc_id
 * @return array||null
 * 
 */
function get_doc_by_id($doc_id) {
    global $connection;

    $safe_doc_id = mysqli_real_escape_string($connection, $doc_id);

    $query = "SELECT * FROM docs where id = {$safe_doc_id} LIMIT 1";

    $result_set = mysqli_query($connection, $query);
    // Test if there was a query error
    confirm_query($result_set, "get_doc_by_id");

    if ($doc_row = mysqli_fetch_assoc($result_set)) {
        return $doc_row;
    } else {
        return null;
    }
}

/**
 * @param int|string $session_wantedid
 * @return array ['fullname' => , 'cost' => ]
 * 
 */
function doesnt_matter_or_id($session_wantedid) {

    
    // если не "doesnt_matter"
    if ($session_wantedid != "doesnt_matter") {
        // значит имеем дело с id
        $doc_id     = $session_wantedid;
        // array
        $doc_row = get_doc_by_id($doc_id);

        $output_name = $doc_row['firstname'].' '.$doc_row['surname'];
        $output_cost = "~ ".$doc_row["cost"];
        // иначе, если имеем дело с doesnt_matter
    } else { 
        $output_name = "Не имеет значения";
        $output_cost = "~ 1200";
    }

    $my_array = ['fullname' => $output_name, 'cost' => $output_cost];

    return $my_array;

}
/**
 *  
 */
function find_all_admins() {
    global $connection;
		
    $query  = "SELECT * ";
    $query .= " FROM docadmins ";
    $query .= " ORDER BY username ASC";
    $admin_set = mysqli_query($connection, $query);
    // Test if there was a query error
    confirm_query($admin_set);
    
    return $admin_set;
}

/**
 * @param  int $admin_id
 * @return array||null
 */
function find_admin_by_id($admin_id) {
    global $connection;
    
    $safe_admin_id = mysqli_real_escape_string($connection, $admin_id);
    
    $query  = "SELECT * ";
    $query .= " FROM docadmins ";
    $query .= " WHERE id = {$safe_admin_id} ";
    $query .= " LIMIT 1";
    $admin_set_row = mysqli_query($connection, $query);
    // Test if there was a query error
    confirm_query($admin_set_row);
    
    if ($admin_row = mysqli_fetch_assoc($admin_set_row)) {
        return $admin_row;
    } else {
        return null;
    }		
}

/**
 * Functions of login
 * 
 * Работают с хэшем. Могут возвращать ошибку, если хэши не используются. 
 * Уникальность username не проработана.  
 */


/**
 * Попытка получения массива пользователя из БД по имени или null.
 * Специфические данные внутри:
 * запрос SELECT с таблицей и полем username.
 * 
 * @param string $username
 * @return array|null
 */

function find_admin_by_username($username) {
    global $connection;
    
    $safe_username = mysqli_real_escape_string($connection, $username);
    
    $query  = "SELECT * ";
    $query .= " FROM docadmins ";
    $query .= " WHERE username = '{$safe_username}' ";
    $query .= " LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    // Test if there was a query error
    confirm_query($admin_set);
    
    if ($admin_row = mysqli_fetch_assoc($admin_set)) {
        return $admin_row;
    } else {
        return null;
    }		
}

/**
 * Сравнение хранимого хэша с хэшем от предложенного пароля.  
 * Специфические данные внутри:
 * отсутствуют.
 * 
 */
    // аналог встроенной php-функции password_verify() 
function password_check($password, $existing_hash) {
        // existing hash contains format and salt at start
      $hash = crypt($password, $existing_hash);
      if ($hash === $existing_hash) {
        return true;
      } else {
        return false;
      }
}

/**
* Вернёт массив "строку админа" из БД или false.  
* Специфические данные внутри:
* поле password (хэш-пароль) из БД для админа.
*
*/	 
function attempt_login($username, $password) {
      $admin = find_admin_by_username($username);
      // вернётся $admin_row

      // если $admin_row есть
      if ($admin) {
          // admin found, now check password
          // предоставляется хранимый хэш-пароль во 2 аргументе
          if (password_check($password, $admin["password"])) {
              // password matches
              return $admin;
          } else {
              // password does not match
              return false;
          }
      } else {
          // admin not found
          return false;
      }
}

/**** */

/**
 * Hash, salt
 */

 /**
  * Создание соли из указанной длины.  
  * Возвращается случайная соль, приемлемая для Блоуфиш.  
  * @param integer $length
  * @return string $salt
  */
function generate_salt($length) {
    // Генерируется любая случайная строка
    // Not 100% unique, not 100% random, but good enough for a salt
    // MD5 returns 32 characters
  $unique_random_string = md5(uniqid(mt_rand(), true));
  
    // Довести строку до приемлемой соли в Блоуфиш
    // Valid characters for a salt are [a-zA-Z0-9./]
    // https://www.php.net/manual/ru/function.crypt.php  "./0-9A-Za-z"
  $base64_string = base64_encode($unique_random_string);
  
    // Заменить созданные base64_encode плюсы в соли на точки для приемлемой соли согласно "./0-9A-Za-z"
    // But not '+' which is valid in base64 encoding
  $modified_base64_string = str_replace('+', '.', $base64_string);
  
    // Обрезать строку для приемлемой длины соли в Блоуфиш (22 символа или больше)
    // Truncate string to the correct length
  $salt = substr($modified_base64_string, 0, $length);
  
    // Возвращается случайная соль, приемлемая для Блоуфиш
    return $salt;
}

/**
 * Зашифровывает пароль (хэширует).
 * Аналог встроенной php-функции password_hash().
 * @param string $password
 * @return string  $hash 
 */
function password_encrypt($password) {
    $hash_format = "$2y$10$";           // Tells PHP to use Blowfish with a "cost" of 10
    $salt_length = 22; 					// Blowfish salts should be 22-characters or more
    $salt = generate_salt($salt_length);
    $format_and_salt = $hash_format . $salt;
    $hash = crypt($password, $format_and_salt);
    return $hash;
}

/**** */

?>