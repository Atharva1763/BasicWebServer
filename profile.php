<?php
$servername = "localhost";
$username = "Lab8";
$password = "password";
$dbname = "dbmslab8";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $email = $row["email"];
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
	<style>
		body {
			background-color: #f2f2f2;
			font-family: Arial, sans-serif;
		}
		
		.card {
			background-color: white;
			padding: 40px;
			margin: 50px auto;
			max-width: 500px;
			box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
			border-radius: 10px;
			text-align: center;
			font-size: 24px;
			line-height: 1.5;
		}
		
		h1 {
			margin-top: 0;
			font-size: 36px;
			color: #333333;
			text-align: center;
			margin-bottom: 20px;
			font-family: 'Montserrat', sans-serif;
		}

		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			padding: 8px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}

		tr:hover {
			background-color:#f5f5f5;
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
			margin: 20px auto;
			cursor: pointer;
			border-radius: 10px;
			box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
			transition: background-color 0.3s ease;
			display: block;
		}
		
		button:hover {
			background-color: #005f6b;
		}
	</style>
</head>
<body>
	<div class="card">
		<h1>User Profile</h1>
		<table>
			<tr>
				<th>First Name:</th>
				<td><?php echo $first_name ?></td>
			</tr>
			<tr>
				<th>Last Name:</th>
				<td><?php echo $last_name ?></td>
			</tr>
			<tr>
				<th>Email:</th>
				<td><?php echo $email ?></td>
			</tr>
		</table>
	</div>
	
	<button onclick="location.href='welcome.html'">Back</button>
</body>
</html>
