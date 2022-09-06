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
function confirm_query($result_set, $function_name) {
    if (!$result_set) {        
        die("Database query failed. Function confirm_query() failed in $function_name.");
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
 * @return int
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


?>