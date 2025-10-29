<?php
// Enable error reporting (for debugging, remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
include '../../db.connection/db_connection.php';

// Function to generate a unique file name
function generateUniqueFileName($fileName) {
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    return uniqid() . '_' . time() . '.' . $ext;
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';

    // Validate
    if (empty($title)) {
        die("❌ Error: Title cannot be empty.");
    }

    // Handle video upload
    $video_path = '';
    if (!empty($_FILES['video']['name'])) {
        $video_directory = __DIR__ . "/../uploads/video_reviews/";
        $video_name = generateUniqueFileName($_FILES['video']['name']);
        $video_path = $video_name; // Save only file name in DB

        // Ensure the video upload folder exists
        if (!is_dir($video_directory)) {
            if (!mkdir($video_directory, 0777, true)) {
                die("❌ Error: Failed to create video upload directory.");
            }
        }

        // Move uploaded file
        if (!move_uploaded_file($_FILES['video']['tmp_name'], $video_directory . $video_name)) {
            die("❌ Error uploading video. Check folder permissions.");
        }
    } else {
        die("❌ Error: No video file selected.");
    }

    // Insert into videos table
    $stmt = $conn->prepare("INSERT INTO videos (title, video_path) VALUES (?, ?)");
    if (!$stmt) {
        die("❌ Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $title, $video_path);

    if ($stmt->execute()) {
        // Redirect without echo (fixes header already sent issue)
        header("Location: list_videos.php?success=1");
        exit();
    } else {
        die("❌ Database Error: " . $stmt->error);
    }

    $stmt->close();
}

$conn->close();
?>
