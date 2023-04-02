<?php
// Start session
session_start();

// Get user input from HTML form
$email = $_POST['email'];
$user_password = $_POST['password'];

// Validate user input
if (empty($email) || empty($user_password)) {
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

// Fetch user data from database
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $hashed_password = $row['password'];
    echo $row['password'];
    echo $user_password;
    // Verify password
    if ($user_password == $row['password']) {
        // Store user data in session
        $_SESSION["user_id"] = $row['id'];
        $_SESSION["first_name"] = $row['first_name'];
        $_SESSION["last_name"] = $row['last_name'];
        
        // Redirect to main page
        header("Location: welcome.html");
        exit();
    }
    else {
        die("Invalid password");
    }
} else {
    die("User not found");
}

mysqli_close($conn);
?>
