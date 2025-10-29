<?php
// Database connection
include '../../db.connection/db_connection.php';

// Check if the id is set in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // First, fetch the video file path to delete the actual file
    $stmt = $conn->prepare("SELECT video_path FROM videos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($videoPath);
    $stmt->fetch();
    $stmt->close();

    // Delete the video from database
    $stmt = $conn->prepare("DELETE FROM videos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // If video exists in folder, delete it
        if (!empty($videoPath) && file_exists($videoPath)) {
            unlink($videoPath);
        }

        // Redirect after success
        header("Location: list_videos.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting video: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No video ID provided.";
    header("Location: allVideos.php");
    exit();
}

// Close connection
$conn->close();
?>
