<?php
// ================================
// BLOG ADD / UPDATE SCRIPT
// ================================

// Database connection
include '../../db.connection/db_connection.php';

// Function to generate a unique file name
function generateUniqueFileName($fileName) {
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    return uniqid() . '_' . time() . '.' . $ext;
}

// =============== FILE SIZE SAFETY CHECK ==================
if (!empty($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH'] > 120 * 1024 * 1024) { 
    die("Error: File size exceeds the server limit (120MB). Please upload a smaller file.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blog_id      = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $title        = trim($_POST['title'] ?? '');
    $main_content = trim($_POST['main_content'] ?? '');
    $full_content = trim($_POST['full_content'] ?? '');
    $service      = trim($_POST['service'] ?? '');
    $logo_link    = trim($_POST['logo_link'] ?? ''); 

    // Validation
    if (empty($title) || empty($main_content) || empty($full_content) || empty($service)) {
        die("Error: Title, Main Content, Full Content, and Service cannot be empty.");
    }

    // ================= FILE UPLOAD DIRECTORIES =================
    $upload_photo_dir = __DIR__ . "/../uploads/photos/";
    $upload_video_dir = __DIR__ . "/../uploads/videos/";

    if (!is_dir($upload_photo_dir)) mkdir($upload_photo_dir, 0777, true);
    if (!is_dir($upload_video_dir)) mkdir($upload_video_dir, 0777, true);

    // --- Get existing record if updating ---
    $existing = [];
    if ($blog_id > 0) {
        $res = $conn->query("SELECT * FROM blogs WHERE id = $blog_id");
        $existing = $res->fetch_assoc();
    }

    // Title image
    $title_image_path = $existing['title_image'] ?? '';
    if (!empty($_FILES['title_image']['name'])) {
        $title_image_name = generateUniqueFileName($_FILES['title_image']['name']);
        move_uploaded_file($_FILES['title_image']['tmp_name'], $upload_photo_dir . $title_image_name);
        $title_image_path = $title_image_name;
    }

    // Main image
    $main_image_path = $existing['main_image'] ?? '';
    if (!empty($_FILES['main_image']['name'])) {
        $main_image_name = generateUniqueFileName($_FILES['main_image']['name']);
        move_uploaded_file($_FILES['main_image']['tmp_name'], $upload_photo_dir . $main_image_name);
        $main_image_path = $main_image_name;
    }

    // Video
    $video_path = $existing['video'] ?? '';
    if (!empty($_FILES['video']['name'])) {
        $video_name = generateUniqueFileName($_FILES['video']['name']);
        move_uploaded_file($_FILES['video']['tmp_name'], $upload_video_dir . $video_name);
        $video_path = $video_name;
    }

    // Logo
    $logo_path = $existing['logo'] ?? '';
    if (!empty($_FILES['logo']['name'])) {
        $logo_name = generateUniqueFileName($_FILES['logo']['name']);
        move_uploaded_file($_FILES['logo']['tmp_name'], $upload_photo_dir . $logo_name);
        $logo_path = $logo_name;
    }

    // ================= SQL SAVE =================
    if ($blog_id > 0) {
        // UPDATE
        $stmt = $conn->prepare("UPDATE blogs 
            SET title = ?, main_content = ?, full_content = ?, 
                title_image = ?, main_image = ?, video = ?, 
                logo = ?, logo_link = ?, service = ? 
            WHERE id = ?");
        $stmt->bind_param("sssssssssi", $title, $main_content, $full_content, 
            $title_image_path, $main_image_path, $video_path, 
            $logo_path, $logo_link, $service, $blog_id);
    } else {
        // INSERT
        $stmt = $conn->prepare("INSERT INTO blogs 
            (title, main_content, full_content, title_image, main_image, video, logo, logo_link, service, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssssssss", $title, $main_content, $full_content, 
            $title_image_path, $main_image_path, $video_path, 
            $logo_path, $logo_link, $service);
    }

    if ($stmt->execute()) {
        header("Location: allBlog.php?msg=success");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
