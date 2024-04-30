<?php
// Error handler
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Include configuration and database connection
$config = require("config.php");
$db = require("databaseConnection.php");
$databaseConnection = new DatabaseConnection($config);
$conn = $databaseConnection->dbConnection();


// retrive the table values
$id = $_GET['id'];
$sql = "SELECT * FROM product_details WHERE Id=$id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
?>


<!-- Single Product View Page -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Product</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .custom-width {
            width: 35%;
            border-radius: 20px;
        }

        .container.mx-auto.p-4.custom-width.w-3\/5 {
            width: 38%;
            height: 410px;
        }
    </style>
</head>

<body>
    <?php require("header.php"); ?>
    <div class="container mx-auto p-4">
        <div class="container mx-auto p-4 custom-width w-3/5">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img class="w-full h-32 object-cover" src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>" alt="<?php echo $row['name']; ?>">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2"><?php echo $row['name']; ?></h2>
                    <p class="text-gray-600 mb-4"><?php echo $row['description']; ?></p>
                    <p class="text-gray-800 font-bold">$<?php echo $row['price']; ?></p>
                    <!-- Add to cart button or any other actions -->
                </div>
            </div>
        </div>
     <!-- footer -->
        <?php require("footer.php"); ?>
</body>

</html>