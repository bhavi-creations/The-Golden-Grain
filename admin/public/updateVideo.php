<?php
// Database connection
include '../../db.connection/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $video_id = intval($_POST['id']);
    $title = trim($_POST['title']);

    // Fetch current video
    $stmt = $conn->prepare("SELECT video_path FROM videos WHERE id = ?");
    $stmt->bind_param("i", $video_id);
    $stmt->execute();
    $stmt->bind_result($old_video);
    $stmt->fetch();
    $stmt->close();

    $video_path = $old_video; // keep old video unless replaced

    // Handle new video upload
    if (!empty($_FILES['video']['name'])) {
        $upload_dir = __DIR__ . "/../uploads/video_reviews/";

        // Create directory if not exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $video_name = uniqid() . "_" . basename($_FILES['video']['name']);
        $target_file = $upload_dir . $video_name;

        if (move_uploaded_file($_FILES['video']['tmp_name'], $target_file)) {
            // Delete old video file if exists
            if (!empty($old_video) && file_exists($upload_dir . $old_video)) {
                unlink($upload_dir . $old_video);
            }
            $video_path = $video_name;
        } else {
            die("Error uploading video.");
        }
    }

    // Update video record
    $stmt = $conn->prepare("UPDATE videos SET title = ?, video_path = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $video_path, $video_id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: list_videos.php?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
