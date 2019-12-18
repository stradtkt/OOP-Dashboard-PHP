<?php 
require_once("new_config.php");

class Database {
    public $con;

    function __construct() {
        $this->open_db_connection();
    }


    public function open_db_connection() {
        $this->con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if(mysqli_connect_errno()) {
            die("Connection Failed" . mysqli_error());
        }
    }

    public function query($sql) {
        $result = mysqli_query($this->con, $sql);
        return $result;
    }

    private function confirm_query($result) {
        if(!$result) {
            die('Query Failed');
        }
    }

    public function escape_string($string) {
        $escaped_string = mysqli_real_escape_string($this->con, $string);
        return $escaped_string;
    }
}

$db = new Database();

?>