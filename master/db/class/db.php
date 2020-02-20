<?php
    class Database{
        private $servername = "cybergo.cl3klxoe7ycy.us-east-2.rds.amazonaws.com";
        private $username = "cybergo";
        private $password = "aaa11111";
        private $database = "cybergo";
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