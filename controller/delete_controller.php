<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require("../config.php"); 
require_once("../model/database.php");

$db = new Database();
$pdo = $db->getPdo(); 

$id = $_GET['id'];

try {
    $query = "DELETE FROM students WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
        header("Location: ../view/form_view.php");
        exit();
    } else {
        echo "Record not deleted successfully";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
