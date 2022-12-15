<?php
class MySQLDatabase {
  
    private $connection;
    public $last_query;
    
    function __construct() {
      $this->open_connection();
    }
    
    public function open_connection() {
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        mysqli_set_charset($this->connection, 'utf8'); 
        if(mysqli_connect_errno()) {
            die("Database connection failed: " . 
                mysqli_connect_error() . 
                " (" . mysqli_connect_errno() . ")"
            );
        }
    }

    public function query($sql) {
          $this->last_query = $sql;
        $result = mysqli_query($this->connection, $sql);
        $this->confirm_query($result);
        return $result;
    }

    private function confirm_query($result) {
        if (!$result) {
            $output = "Database query failed:". mysqli_error($this->connection) . "<br><br>" ;
            $output.= "Last SQL query: ".$this->last_query;
          die($output);
        }
    }

    public function escape_value($string) {
        $escaped_string = mysqli_real_escape_string($this->connection, $string);
        return $escaped_string;
    }

    // "database neutral" functions
    
    public function fetch_array($result_set) {
        // применение процедурного подхода
        return mysqli_fetch_array($result_set);
    }

}

$database = new MySQLDatabase();
$db =& $database;

?>