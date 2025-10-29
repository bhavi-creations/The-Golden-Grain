<?php
// Database connection (replace with your actual database connection details)
include '../../db.connection/db_connection.php';

// Check if PDF ID is provided via GET parameter
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $pdf_id = intval($_GET['id']);

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL to delete PDF record
    $delete_sql = "DELETE FROM pdf_uploads WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $pdf_id);

    if ($stmt->execute()) {
        // Deletion successful, now delete the file from server (assuming pdf_path is stored as a filename)
        $select_path = "SELECT pdf_path FROM pdf_uploads WHERE id = ?";
        $stmt1 = $conn->prepare($select_path);
        $stmt1->bind_param("i", $pdf_id);
        $stmt1->execute();
        $stmt1->bind_result($pdf_path);
        $stmt1->fetch();
        $stmt1->close();

        $file_path = "admin/public/uploads/pdfs/" . $pdf_path;
        if (file_exists($file_path)) {
            unlink($file_path); // Delete the file from server
        }

        // Close database connection
        $conn->close();

        // Redirect to index.php
        header("Location: index.php");
        exit(); // Ensure no further code is executed after the redirect
    } else {
        // Error occurred while deleting
        http_response_code(500); // Internal server error
        echo "Error deleting PDF: " . $conn->error;
    }
} else {
    // No PDF ID provided or invalid ID
    http_response_code(400); // Bad request
    echo "Invalid PDF ID.";
}
?>
