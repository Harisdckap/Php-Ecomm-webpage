<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include configuration and database connection
$config = require("config.php");
$db = require("databaseConnection.php");
$databaseConnection = new DatabaseConnection($config);
$conn = $databaseConnection->dbConnection();

// Check if search query parameter is set
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$searchQuery = mysqli_real_escape_string($conn, $searchQuery);

// Define the base query
$query = "SELECT * FROM product_details";


if (!empty($searchQuery)) {
    $query = "SELECT * FROM product_details WHERE name LIKE '%$searchQuery%'";
}

$result = mysqli_query($conn, $query);
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
    <title>Search Products</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php require("header.php"); ?>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-8">Products</h1>
        <div class="grid grid-cols-3 gap-4 p-4">
            <?php
            // Loop through the query result
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="product bg-white rounded-lg overflow-hidden shadow-md">
                    <img class="w-full h-32 object-cover" src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>" alt="<?php echo $row['name']; ?>">
                    <div class="p-4">
                        <p class="text-lg font-semibold"><?php echo $row['name']; ?></p>
                        <p class="text-gray-600"><?php echo $row['description']; ?></p>
                        <div class="flex justify-between items-center mt-2">
                            <p class="text-gray-800">$<?php echo $row['price']; ?></p>
                            <a href="/view/viewproduct.php?id=<?php echo $row['Id']; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php require("footer.php"); ?>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
