<?php
// Get user input from HTML form
$first_name = $_POST['fname'];
$last_name = $_POST['lname'];
$email = $_POST['email'];
$user_password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validate user input
if (empty($first_name) || empty($last_name) || empty($email) || empty($user_password) || empty($confirm_password)) {
    die("<p style='text-align:center; color:red;'>Error: All fields are required</p>");
}

if ($user_password != $confirm_password) {
    die("<p style='text-align:center; color:red;'>Error: Passwords do not match</p>");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("<p style='text-align:center; color:red;'>Error: Invalid email format</p>");
}

// Check password length
if (strlen($user_password) < 4) {
    die("<p style='text-align:center; color:red;'>Error: Password must be at least 4 characters long</p>");
}

// Connect to database
$host = "localhost";
$username = "Lab8";
$password = "password";
$dbname = "dbmslab8";
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("<p style='text-align:center; color:red;'>Error: Connection failed</p>");
}

// Insert user data into database
$sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$user_password')";

if (mysqli_query($conn, $sql)) {
    // Display success message and button to redirect to login.php
    echo "<div style='text-align:center; margin-top: 40px;'>";
    echo "<h1 style='color:#333333; font-size:36px;'>Registered Successfully</h1><br><br>";
    echo "<button style='background-color:#008CBA; border:none; color:white; padding:20px 40px; text-align:center; text-decoration:none; display:inline-block; font-size:24px; margin:20px; cursor:pointer; border-radius:10px; box-shadow:0px 5px 10px rgba(0, 0, 0, 0.2); transition:background-color 0.3s ease;' onclick='window.location.href=\"login.html\"'>Go to Login Page</button>";
    echo "</div>";
} else {
    echo "<p style='text-align:center; color:red;'>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
}

mysqli_close($conn);
?>
