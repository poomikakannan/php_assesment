<?php

class Database {
    private $pdo;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        require("../config.php");  // Ensure the path to config.php is correct
        
        $host = HOST;
        $database = DATABASE;
        $username = USERNAME;
        $password = PASSWORD;
        
        $dsn = "mysql:host=".$host.";dbname=".$database;
        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connection Successful<br>";
        } catch (PDOException $e) {
            echo "Connection Failed: " . $e->getMessage();
            die();
        }
    }

    public function getPdo() {
        return $this->pdo;
    }
}


// Example usage
$db = new Database();
$pdo = $db->getPdo();


?>
