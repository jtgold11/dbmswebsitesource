<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Database {
    public $sql;
    private static $sqlConn;

//just connects to my database
    public function __construct() {
        if (self::$sqlConn === NULL) {
            self::$sqlConn = new mysqli("mysql1.cs.clemson.edu", "dbms_nx0t", "dbmsjtgold1", "dbms_a8qs");

            if (self::$sqlConn->connect_errno != 0) {
                throw new Exception("Failed to connect to DB: ".$this->sql->connect_error);
            }
        }

        $this->sql = self::$sqlConn;
    }

    public function __destruct() {
    }
}

?>
