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