<?php
    class Database{
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "policedb";
        private $conn;

        function connect(){
        
            $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
            if (!$this->conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            return $this->conn;
        }
    }
?>