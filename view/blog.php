<?php
// Include necessary files
$config = require("config.php");
$db = require("databaseConnection.php");
$databaseConnection = new DatabaseConnection($config);
$conn = $databaseConnection->dbConnection();

// Check if search query parameter is set
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$searchQuery = mysqli_real_escape_string($conn, $searchQuery);

// Define the base query
$query = "SELECT Blogs.*, userTable.name AS AuthorName FROM Blogs LEFT JOIN userTable ON Blogs.AuthorId = userTable.ID WHERE Blogs.status='published'";

// Add search condition if search query is provided
if (!empty($searchQuery)) {
    $query .= " AND (Blogs.Title LIKE '%$searchQuery%' OR Blogs.Content LIKE '%$searchQuery%')";
}

$result = mysqli_query($conn, $query);
// print_r($result);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Webpage</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <?php require("header.php"); ?>
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-8">List of Blogs</h1>
        <div class="overflow-x-auto">
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-900 text-white">
                        <th class="px-4 py-2">Id</th>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Content</th>
                        <th class="px-4 py-2">Author Name</th>
                        <th class="px-4 py-2">Created At</th>
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    // Loop through the query result
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr class='hover:bg-gray-100'>";
                        echo "<td class='border px-4 py-2'>" . $row['ID'] . "</td>";
                        echo "<td class='border px-4 py-2'>" . $row['Title'] . "</td>";
                        echo "<td class='border px-4 py-2'>" . $row['Content'] . "</td>";
                        echo "<td class='border px-4 py-2'>" . $row['AuthorName'] . "</td>";
                        echo "<td class='border px-4 py-2'>" . $row['CreatedAt'] . "</td>";
                        echo "<td class='border px-4 py-2'>" . $row['Status'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php require("footer.php"); ?>
</body>

</html>