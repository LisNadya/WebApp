<?php
    class Promotiontable {
        // Database connection and table name
        private $conn;
        private $table_name = "promotion";

        // Object Properties
        public $id;
        public $event;
        public $date;
        public $description;
        public $status;
        public $image;

        // The directory where the file is going to be placed
        private $target_dir = "img/events";

        public function __construct($db){
            $this->conn = $db->connect();
            date_default_timezone_set("Asia/Kuala_Lumpur");
        }

        public function closeCon($db){
            $this->conn = $db->close();
        }

        public function read()
        {
            // Select all data
            $sql = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->query($sql) or die("Error in $sql");
            
            return $stmt;
        }

        public function addEvent($formArray)
        {
            // Extract the input from the user
            $event = $_POST['event'];
            $description = $_POST['desc'];
            $image = $_FILES["myFile"]["name"];
            $date = date('Y-m-d');
            $status = 0;

            $sql = "INSERT INTO `" . $this->table_name . "`(`event`, `date_created`, `description`, `image`, `status`) VALUES ('" . $event . "','" . $date . "','" . $description . "','" . $image . "','" . $status . "')";
            
            $this->conn->query($sql) or die("Error in $sql");
        }

        public function currStat($id)
        {
            $sql = "SELECT status FROM " . $this->table_name . " WHERE id = '" . $id . "' limit 1";
            $result = $this->conn->query($sql) or die("Error in $sql");
            $value = $result->fetch_object();
            return $value;
        }

        public function delete($id){
            $sql = "DELETE FROM " . $this->table_name . " WHERE id = " . $id;

            return $this->conn->query($sql) or die("Error in $sql");
        }

        public function recordById($id)
        {
            // Select data
            $sql = "SELECT * FROM " . $this->table_name . " WHERE id = " . $id;
            $result =  $this->conn->query($sql) or die("Error in $sql");
            return $result->fetch_assoc();
        }

        public function updatePromo($formArray, $_id)
        {
            // Extract the input from the user
            $event = $_POST['eventTitle'];
            $description = $_POST['descriptionPromo'];
            
            if($_FILES["mynewfile"]["name"] != ""){
                $image = $_FILES["mynewfile"]["name"];
                $sql = "UPDATE `" . $this->table_name . "` SET event = '" . $event . "', description = '" . $description . "', image = '" . $image . "' WHERE id = '" . $_id . "'";
            } else {
                $sql = "UPDATE `" . $this->table_name . "` SET event = '" . $event . "', description = '". $description . "' WHERE id = '" . $_id . "'";
            }
            
            $this->conn->query($sql) or die("Error in $sql");
        }

        public function changeStatus($eventId)
        {
            $currStat = $this->currStat($eventId);
            ChromePhp::log($currStat->status);
            if($currStat->status == 1){
                $newStatus = 0;
                $sql = "UPDATE `" . $this->table_name . "` SET status = '" . $newStatus . "' WHERE id = '" . $eventId . "'";
                ChromePhp::log("IF");
            } else {
                $newStatus = 1;
                $sql = "UPDATE `" . $this->table_name . "` SET status = '" . $newStatus . "' WHERE id = '" . $eventId . "'";
                ChromePhp::log("ELSE");
            }

             die("Error in $sql");
        }
    }
?>