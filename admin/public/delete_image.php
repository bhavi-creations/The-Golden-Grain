<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection
// include '../../db.connection/db_connection.php';
include '../../db_connect/db_connect.php';

// Check if id is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Get the image file name from database
    $stmt = $conn->prepare("SELECT image FROM image_uploads WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($image_name);
    $stmt->fetch();
    $stmt->close();

    if ($image_name) {
        // File path
        $file_path = __DIR__ . "/uploads/photos/" . $image_name;

        // Delete file if exists
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Delete record from database
        $stmt = $conn->prepare("DELETE FROM image_uploads WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $_SESSION['msg_success'] = "Image and its data deleted successfully!";
        } else {
            $_SESSION['msg_error'] = "Database error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['msg_error'] = "Image not found in database!";
    }
} else {
    $_SESSION['msg_error'] = "Invalid request!";
}

// Redirect back to image upload page
header("Location: all_image_upload.php");
exit();
?>
