<?php
// Database connection
// include '../../db.connection/db_connection.php';
include '../../db_connect/db_connect.php';

// Check if Category ID is provided via GET parameter
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $category_id = intval($_GET['id']);

    // Prepare SQL to delete the category
    $delete_sql = "DELETE FROM category WHERE category_id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $category_id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();

        // Redirect to all_categories.php after successful deletion
        header("Location: allPDF.php");
        exit(); // Ensure no further code is executed after the redirect
    } else {
        // Error occurred while deleting
        http_response_code(500); // Internal server error
        echo "Error deleting category: " . $conn->error;
    }
} else {
    // No Category ID provided or invalid ID
    http_response_code(400); // Bad request
    echo "Invalid Category ID.";
}
?>
