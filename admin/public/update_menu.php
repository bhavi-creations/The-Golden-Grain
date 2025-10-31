<?php
// Database connection
include '../../db_connect/db_connect.php'; // Make sure this path is correct

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menu_category = isset($_POST['menu_category']) ? trim($_POST['menu_category']) : '';

    if ($menu_category != '') {
        // Insert new menu category
        $stmt = $conn->prepare("INSERT INTO menu_category (menu_category) VALUES (?)");
        $stmt->bind_param("s", $menu_category);

        if ($stmt->execute()) {
            // Redirect to create page with success message
            session_start();
            $_SESSION['msg_success'] = "Menu category added successfully!";
            header("Location: create_menu_category.php");
            exit();
        } else {
            echo "Error adding menu category: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Category name cannot be empty.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
