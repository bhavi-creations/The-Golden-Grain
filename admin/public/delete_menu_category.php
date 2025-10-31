<?php
// Database connection
include '../../db_connect/db_connect.php';

// Check if Menu Category ID is provided via GET parameter
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $menu_category_id = intval($_GET['id']);

    // Prepare SQL to delete the menu category
    $delete_sql = "DELETE FROM menu_category WHERE menu_category_id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $menu_category_id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();

        // Redirect to all_menu_categories.php after successful deletion
        header("Location: all_menu_categories.php");
        exit(); // Ensure no further code is executed after redirect
    } else {
        // Error occurred while deleting
        http_response_code(500); // Internal server error
        echo "Error deleting menu category: " . $conn->error;
    }
} else {
    // No Menu Category ID provided or invalid ID
    http_response_code(400); // Bad request
    echo "Invalid Menu Category ID.";
}
?>
