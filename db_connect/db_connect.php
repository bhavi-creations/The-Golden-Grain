<?php
// Configuration for Database Connection (Update these details!)
define('DB_SERVER', 'localhost'); // Usually 'localhost' for XAMPP
define('DB_USERNAME', 'root');    // Default XAMPP username
define('DB_PASSWORD', '');        // Default XAMPP password (often empty)
define('DB_NAME', value: 'thegoldengrain'); // Replace with your actual database name

// Attempt to establish a connection using MySQLi Procedural style
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>




<?php
// Database connection details
$servername = "localhost";
// Determine if the server is localhost
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $username = "root";
    $password = "";
    $dbname = "thegoldengrain";
} else {
    $username = "bhavicreations";
    $password = "d8Az75YlgmyBnVM";
    $dbname = "thegoldengrain";
    
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
