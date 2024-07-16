
<?php require ("../controller/form_controller.php")?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
            

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-center">Student Management</h1>
        
        <div class="bg-white p-4 rounded shadow-md mb-6 max-w-md mx-auto">
            <h2 class="text-xl font-semibold mb-4 text-center">Form</h2>
            <form id="student-form" method="post" action="">
                <input type="hidden" id="student-id" name="student-id">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                    <input type="text" id="name" name="name" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="roll-number" class="block text-sm font-medium text-gray-700">Roll Number:</label>
                    <input type="text" id="roll_number" name="roll_number" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="mark" class="block text-sm font-medium text-gray-700">Mark:</label>
                    <input type="number" id="mark" name="mark" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700">Subject:</label>
                    <input type="text" id="subject" name="subject" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="flex justify-center">
                    <button type="submit" name="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto sm:text-sm">Submit</button>
                </div>
            </form>
            <p id="message" class="mt-4 text-green-600 text-center"></p>
        </div>

        <div class="bg-white p-4 rounded shadow-md max-w-4xl mx-auto">
            <h2 class="text-xl font-semibold mb-4 text-center">Students List</h2>
            <input type="text" id="search" placeholder="Search by name or roll number" class="mb-4 p-2 border border-gray-300 rounded-md shadow-sm w-full">
            
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Roll Number</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mark</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="students-tbody" class="bg-white divide-y divide-gray-200">
                    <?php

                    require("../config.php"); 
                    require_once("../model/database.php"); 


                    $db = new Database();
                    $pdo = $db->getPdo();

                    $query = "SELECT * FROM students";
                    $stmt = $pdo->query($query);

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        // echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['roll_number']) . "</td>";
                        echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['marks']) . "</td>";
                        echo "<td class='border border-gray-300 p-2'>" . htmlspecialchars($row['subject']) . "</td>";
                        echo "<td class='border border-gray-300 p-2'><a href='edit_controller.php?id=" . $row['id'] . "' class='bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2'>Edit</a>";
                        echo "<a href='delete_controller.php?id=" . $row['id'] . "' class='bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded'>Delete</a></td>";

                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>

