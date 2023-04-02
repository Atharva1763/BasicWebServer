<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Get user input from HTML form
$user_id = $_SESSION["user_id"];
$current_name = $_POST['current_name'];
$new_name = $_POST['new_name'];

// Validate user input
if (empty($current_name) || empty($new_name)) {
    die("All fields are required");
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

// Check current name is correct
$sql = "SELECT first_name FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!($current_name == $row['first_name'])) {
    die("Current name is incorrect");
}

$sql = "UPDATE users SET first_name='$new_name' WHERE id='$user_id'";

if (mysqli_query($conn, $sql)) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Name changed successfully</title>
        <style>
            body {
                background-color: #f2f2f2;
                font-family: Arial, sans-serif;
                text-align: center;
            }
            
            h1 {
                color: #333333;
                font-size: 36px;
                margin-top: 40px;
            }
            
            button {
                background-color: #008CBA;
                border: none;
                color: white;
                padding: 20px 40px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 24px;
                margin: 20px;
                cursor: pointer;
                border-radius: 10px;
                box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
                transition: background-color 0.3s ease;
            }
            
            button:hover {
                background-color: #005f6b;
            }
        </style>
    </head>
    <body>
        <h1>Name changed successfully</h1>
        <button onclick="window.location.href='profile.php'">Go to User Profile</button>
    </body>
    </html>
    <?php
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
