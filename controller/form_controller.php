<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    require("../config.php"); 
    require_once("../model/database.php"); 


    $db = new Database();
    $pdo = $db->getPdo(); 

    $name = $_POST["name"];
    $roll_number = $_POST["roll_number"];
    $subject = $_POST["subject"];
    $mark = $_POST["mark"];

    try {

        $stmt = $pdo->prepare("INSERT INTO students (name, roll_number, subject, marks) VALUES (?, ?, ?, ?)");
    

        $stmt->bindParam(1, $name, PDO::PARAM_STR);
        $stmt->bindParam(2, $roll_number, PDO::PARAM_INT);
        $stmt->bindParam(3, $subject, PDO::PARAM_STR);
        $stmt->bindParam(4, $mark, PDO::PARAM_INT);
        

        if ($stmt->execute()) {
            // echo "Record inserted successfully.";
        } else {
            echo "Error: Unable to execute statement.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


?>                 
                
                
                
                
           
