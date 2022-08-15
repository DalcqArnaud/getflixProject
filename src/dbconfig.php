<?php






$host = '';

// Database use name
$user = '';

//database user password
$pass = '';

$mydatabase = '';

// check the MySQL connection status
$conn = @new mysqli($host, $user, $pass, $mydatabase);
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } else {
//     header("location: main.php");
// }
// ?> 