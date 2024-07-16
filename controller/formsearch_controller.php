<?php
require("../config.php");
require_once("../model/database.php");

$db = new Database();
$pdo = $db->getPdo();


// Sorting
$sortField = isset($_GET['sortField']) ? $_GET['sortField'] : 'name';
$sortOrder = isset($_GET['sortOrder']) && in_array(strtoupper($_GET['sortOrder']), ['ASC', 'DESC']) ? strtoupper($_GET['sortOrder']) : 'ASC';
$validSortFields = ['name', 'roll_number', 'marks', 'subject']; // Define valid sorting fields


$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

try {
    $query = "SELECT * FROM students";

    if (!empty($searchQuery)) {
        $query .= " WHERE name LIKE :searchQuery OR roll_number LIKE :searchQuery";
    }

    if (in_array($sortField, $validSortFields)) {
        $query .= " ORDER BY $sortField $sortOrder";
    }

    $stmt = $pdo->prepare($query);

    if (!empty($searchQuery)) {
        $searchTerm = "%$searchQuery%";
        $stmt->bindParam(':searchQuery', $searchTerm, PDO::PARAM_STR);
    }

    $stmt->bindParam(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

    $stmt->execute();
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $countStmt = $pdo->query("SELECT COUNT(*) as total FROM students");
    $totalRecords = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>
