<?php


    namespace app\contract;

    require '../app/config/Database.php';

    abstract class ConnectionManager {
        private $servername;
        private $username;
        private $password;
        private $dbname;

        public function __construct() {

            $database = Database();

            $this->servername = $database['servername'];
            $this->username = $database['username'];
            $this->password = $database['password'];
            $this->dbname = $database['dbname'];
            
        }

        public function getConnection() {
            $conn = new \mysqli($this->servername, $this->username, $this->password, $this->dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            return $conn;
        }
    }