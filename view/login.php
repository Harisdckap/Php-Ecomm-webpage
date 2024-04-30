<?php
// session store
session_start();

// errorhandling
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include files
$db = require("databaseConnection.php");
require("config.php");

// Create database connection
$databaseConnection = new DatabaseConnection($config);
$conn = $databaseConnection->dbConnection();

// check if the user clicked submit btn
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);

    $sql = "INSERT INTO userTable (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";

    // Execute query
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['email'] = $email;
        header("location:index.php");
        exit(); // Stop further execution
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
