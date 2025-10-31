<?php
// Database connection
include '../../db.connection/db_connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
    $category_name = isset($_POST['category_name']) ? trim($_POST['category_name']) : '';

    if ($category_id > 0 && $category_name != '') {
        // Update category name in the database
        $stmt = $conn->prepare("UPDATE category SET category_name = ? WHERE category_id = ?");
        $stmt->bind_param("si", $category_name, $category_id);

        if ($stmt->execute()) {
            // Redirect to all_categories.php after successful update
            header("Location: all_categories.php");
            exit();
        } else {
            echo "Error updating category: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid Category ID or empty category name.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
