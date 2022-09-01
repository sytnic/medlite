<?php

function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit;
}

function mysql_prep($string) {
    global $connection;
    
    $escaped_string = mysqli_real_escape_string($connection, $string);
    return $escaped_string;
}

function confirm_query($result_set) {
    if (!$result_set) {
        die("Database query failed. Function confirm_query() failed,
         or its using in another func-s failed.");
    }
}
/**
 * @return mysqli_result
 */
function get_all_specs() {
    global $connection;

    $query = "SELECT * FROM specs";
    $result_set = mysqli_query($connection, $query);
    confirm_query($result_set);

    return $result_set;
}


?>