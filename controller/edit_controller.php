<?php
// Include necessary files and create database connection
require("../config.php"); 
require_once("../model/database.php");

$db = new Database();
$pdo = $db->getPdo(); 

$id = $_GET['id'];

if(isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $roll_number = htmlspecialchars($_POST['roll_number']);
    $marks = htmlspecialchars($_POST['marks']);
    $subject = htmlspecialchars($_POST['subject']);

    // Prepare the update query using prepared statement
    $query = "UPDATE students SET name = :name, roll_number = :roll_number, marks = :marks, subject = :subject WHERE id = :id";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':roll_number', $roll_number);
    $stmt->bindParam(':marks', $marks);
    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if($stmt->execute()) {
        echo "Record updated successfully";
        header("Location: ../view/form_view.php"); 
        exit(); 
    } else {
        echo "Error: Unable to update record.";
    }
}


if(isset($id)) {
    $query = "SELECT * FROM students WHERE id = :id LIMIT 1";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if($row = $stmt->fetch()) {
        
    } else {
        echo "Error: Unable to fetch data.";
    }
} else {
    echo "Error: 'id' parameter is missing.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4 text-center">Update Record</h1>

    <form method="post" action="../controller/form_controller.php?id=<?php echo htmlspecialchars($id); ?>">

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="mb-4">
            <label for="roll_number" class="block text-gray-700">Roll Number</label>
            <input type="text" id="roll_number" name="roll_number" value="<?php echo htmlspecialchars($row['roll_number']); ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="mb-4">
            <label for="marks" class="block text-gray-700">Marks</label>
            <input type="number" id="marks" name="marks" value="<?php echo htmlspecialchars($row['marks']); ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="mb-4">
            <label for="subject" class="block text-gray-700">Subject</label>
            <input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($row['subject']); ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="flex justify-center">
            <button type="submit" name="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Submit</button>
        </div>
    </form>
</div>

</body>
</html>
