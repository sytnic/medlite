<?php

$errors = array();

// работает, но не задействована, т.к. нет подчеркиваний
function fieldname_as_text($fieldname) {
    $fieldname = str_replace("_", " ", $fieldname);
    $fieldname = ucfirst($fieldname);
    return $fieldname;
}

// * presence
// use trim() so empty spaces don't count
// use === to avoid false positives
// empty() would consider "0" to be empty
function has_presence($value) {
	return isset($value) && $value !== "";
}

function validate_presences($required_fields) {
    global $errors;

    foreach($required_fields as $field) {  
        $value = trim($_POST[$field]);  
        if (!has_presence($value)) {
            $errors[$field] = fieldname_as_text($field) . " can't be blank";
        }
    }
}

function form_errors($errors=array()) {
    $output = "";
    if (!empty($errors)) {
      $output .= "<div class=\"error\">";
      $output .= "Please fix the following errors:";
      $output .= "<ul>";
      foreach ($errors as $key => $error) {
        $output .= "<li>";
        $output .= htmlentities($error);
        $output .= "</li>";
      }
      $output .= "</ul>";
      $output .= "</div>";
    }
    return $output;
}

/**
 * auxiliary function
 * @param string $value
 * @param int $max
 * @return bool
 * 
 */
function has_max_length($value, $max) {
	return strlen($value) <= $max;
}

/**
 * @param array $fields_with_max_lengths
 * @return do_job if true
 */
function validate_max_lengths($fields_with_max_lengths) {
	global $errors;
	// Expects an assoc. array
	foreach($fields_with_max_lengths as $field => $max) {
		$value = trim($_POST[$field]);
    // Если предлагаемые поля большие по длине,
    // то заполняется массив $errors
	  if (!has_max_length($value, $max)) {
	    $errors[$field] = fieldname_as_text($field) . " is too long";
	  }
	}
}

/**
 * Проверка на уникальность имени пользователя.  
 * Специфические данные внутри:
 * Таблица и поле в запросе SELECT,  
 * массив errors и соединение с БД connection .
 * 
 * @param string $username
 * @return true|array $errors
 */
function validate_uniqname($username) {
    global $errors;
    global $connection;
    
    $safe_username = mysqli_real_escape_string($connection, $username);
    
    $query  = "SELECT * ";
    $query .= " FROM docadmins ";
    $query .= " WHERE username = '{$safe_username}' ";
    $query .= " LIMIT 10";
    $admin_set = mysqli_query($connection, $query);
    // Test if there was a query error
    confirm_query($admin_set);

    if ($admin_set && mysqli_affected_rows($connection) > 0) {      
      return $errors["uniq"] = "Username '$username' is not unique.";
    } else {
      return true;
    }
}

?>