<?php
    class PriceTable {
        // Database connection and table name
        private $conn;
        private $table_name = "price";

        // Object Properties
        public $id;
        public $name;
        public $price;

        public function __construct($db){
            $this->conn = $db->connect();
        }

        public function read()
        {
            // Select all data
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->query($sql) or die("Error in $sql");
            
            return $stmt;
        }

        public function updatePrice($_price, $_id)
        {
            $price = $_price;
            $sql = "UPDATE `" . $this->table_name . "` SET price = " . $price . " WHERE id = '" . $_id . "'";

            $this->conn->query($sql) or die("Error in $sql");
        }
    }

?>