<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Connect to database
$host = "localhost";
$username = "Lab8";
$password = "password";
$dbname = "dbmslab8";
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get user ID
$user_id = $_SESSION["user_id"];

// Delete user account from database
$sql = "DELETE FROM users WHERE id='$user_id'";

if (mysqli_query($conn, $sql)) {
    // Destroy session and redirect to login page
    session_destroy();
    header("Location: after_delete.html");
    exit();
} else {
    echo "Error deleting account: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
