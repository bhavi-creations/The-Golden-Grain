<?php
// Database connection
include '../../db.connection/db_connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $pdf = $_FILES['pdf'];

    // Check if file was uploaded without errors
    if ($pdf['error'] == 0) {
        $pdf_name = basename($pdf['name']); // ✅ Store only filename
        $pdf_tmp_name = $pdf['tmp_name'];
        $pdf_ext = pathinfo($pdf_name, PATHINFO_EXTENSION);

        // Ensure the file is a PDF
        if (strtolower($pdf_ext) == 'pdf') {
            $upload_dir = __DIR__ . '/../../admin/uploads/pdf/'; // ✅ Absolute path for moving file
            $upload_path = $upload_dir . $pdf_name;

            // Move the uploaded file to the server
            if (move_uploaded_file($pdf_tmp_name, $upload_path)) {
                // Insert into database (only filename)
                $sql = "INSERT INTO pdf_uploads (title, pdf_path) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ss', $title, $pdf_name); // ✅ Store only filename

                if ($stmt->execute()) {
                    // Redirect to index.php after successful upload
                    header('Location: index.php');
                    exit();
                } else {
                    echo "Database error: " . $conn->error;
                }
            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            echo "Only PDF files are allowed.";
        }
    } else {
        echo "File upload error: " . $pdf['error'];
    }
}

$conn->close();
?>
