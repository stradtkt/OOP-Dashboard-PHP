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
        if(!$result) {
            die('Query Failed');
        }
        return $result;
    }
}

$db = new Database();
$db->open_db_connection();

?>