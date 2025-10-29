<?php
// Database connection (replace with your actual database connection details)
include '../../db.connection/db_connection.php';

// Function to generate a unique file name
function generateUniqueFileName($fileName) {
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    return uniqid() . '_' . time() . '.' . $ext;
}

// Allowed image types
$allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data safely
    $blog_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $main_content = isset($_POST['main_content']) ? $_POST['main_content'] : '';
    $full_content = isset($_POST['full_content']) ? $_POST['full_content'] : '';
    $service = isset($_POST['service']) ? $_POST['service'] : '';
    $logo_link = isset($_POST['logo_link']) ? $_POST['logo_link'] : ''; // NEW

    // Ensure required fields are not empty
    if (empty($title) || empty($main_content) || empty($full_content) || empty($service)) {
        die("Error: Title, Main Content, Full Content, and Service cannot be empty.");
    }

    // Handle file uploads for title image
    $title_image_path = '';
    if (!empty($_FILES['title_image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['title_image']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed_extensions)) {
            die("Error: Only image files (JPG, JPEG, PNG, GIF, WEBP, SVG) are allowed for Title Image.");
        }

        $title_image_directory = __DIR__ . "/../uploads/photos/";
        if (!is_dir($title_image_directory)) {
            mkdir($title_image_directory, 0777, true);
        }
        $title_image_name = generateUniqueFileName($_FILES['title_image']['name']);
        $title_image_path = $title_image_name;

        if (!move_uploaded_file($_FILES['title_image']['tmp_name'], $title_image_directory . $title_image_name)) {
            die("Error uploading title image.");
        }
    }

    // Handle file uploads for main image
    $main_image_path = '';
    if (!empty($_FILES['main_image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['main_image']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed_extensions)) {
            die("Error: Only image files (JPG, JPEG, PNG, GIF, WEBP, SVG) are allowed for Main Image.");
        }

        $main_image_directory = __DIR__ . "/../uploads/photos/";
        if (!is_dir($main_image_directory)) {
            mkdir($main_image_directory, 0777, true);
        }
        $main_image_name = generateUniqueFileName($_FILES['main_image']['name']);
        $main_image_path = $main_image_name;

        if (!move_uploaded_file($_FILES['main_image']['tmp_name'], $main_image_directory . $main_image_name)) {
            die("Error uploading main image.");
        }
    }

    // Handle video upload
    $video_path = '';
    if (!empty($_FILES['video']['name'])) {
        $video_directory = __DIR__ . "/../uploads/videos/";
        if (!is_dir($video_directory)) {
            mkdir($video_directory, 0777, true);
        }
        $video_name = generateUniqueFileName($_FILES['video']['name']);
        $video_path = $video_name;

        if (!move_uploaded_file($_FILES['video']['tmp_name'], $video_directory . $video_name)) {
            die("Error uploading video.");
        }
    }

    // Handle logo upload
    $logo_path = '';
    if (!empty($_FILES['logo']['name'])) {
        $ext = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed_extensions)) {
            die("Error: Only image files (JPG, JPEG, PNG, GIF, WEBP, SVG) are allowed for Logo.");
        }

        $logo_directory = __DIR__ . "/../uploads/logos/";
        if (!is_dir($logo_directory)) {
            mkdir($logo_directory, 0777, true);
        }
        $logo_name = generateUniqueFileName($_FILES['logo']['name']);
        $logo_path = $logo_name;

        if (!move_uploaded_file($_FILES['logo']['tmp_name'], $logo_directory . $logo_name)) {
            die("Error uploading logo.");
        }
    }

    // Prepare SQL statement (Insert or Update)
    if ($blog_id > 0) {
        // Update existing blog post
        $stmt = $conn->prepare("UPDATE blogs 
            SET title = ?, main_content = ?, full_content = ?, 
                title_image = ?, main_image = ?, video = ?, 
                service = ?, logo = ?, logo_link = ?
            WHERE id = ?");
        $stmt->bind_param("sssssssssi", 
            $title, $main_content, $full_content, 
            $title_image_path, $main_image_path, $video_path, 
            $service, $logo_path, $logo_link, $blog_id
        );
    } else {
        // Insert new blog post
        $stmt = $conn->prepare("INSERT INTO blogs 
            (title, main_content, full_content, title_image, main_image, video, service, logo, logo_link, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssssssss", 
            $title, $main_content, $full_content, 
            $title_image_path, $main_image_path, $video_path, 
            $service, $logo_path, $logo_link
        );
    }

    // Execute SQL
    if ($stmt->execute()) {
        echo "Blog post published/updated successfully!";
        header("Location: allBlog.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
        header("Location: newBlog.php");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
