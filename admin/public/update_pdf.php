<?php
// Database connection (replace with your actual database connection details)
include '../../db.connection/db_connection.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to safely get the file extension
function getFileExtension($filename) {
    return pathinfo($filename, PATHINFO_EXTENSION);
}

// Function to safely generate a unique filename
function generateUniqueFilename($filename) {
    $extension = getFileExtension($filename);
    $basename = pathinfo($filename, PATHINFO_FILENAME);
    $new_filename = $basename . '_' . uniqid() . '.' . $extension;
    return $new_filename;
}

// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pdf_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $title = $_POST['title'];

    // Check if a new file is uploaded
    if ($_FILES['new_pdf_file']['size'] > 0) {
        // Handle file upload
        $target_dir = "uploads/";
        $new_pdf_file = $_FILES['new_pdf_file']['name'];
        $target_file = $target_dir . generateUniqueFilename($new_pdf_file);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file size
        if ($_FILES["new_pdf_file"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($fileType != "pdf") {
            echo "Sorry, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["new_pdf_file"]["tmp_name"], $target_file)) {
                // Update PDF details including path
                $stmt = $conn->prepare("UPDATE pdf_uploads SET title = ?, pdf_path = ? WHERE id = ?");
                $stmt->bind_param("ssi", $title, $target_file, $pdf_id);
                if ($stmt->execute()) {
                    // Redirect to index.php after successful update
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Error updating PDF details: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // Update PDF details without changing the file
        $stmt = $conn->prepare("UPDATE pdf_uploads SET title = ? WHERE id = ?");
        $stmt->bind_param("si", $title, $pdf_id);
        if ($stmt->execute()) {
            // Redirect to index.php after successful update
            header("Location: index.php");
            exit();
        } else {
            echo "Error updating PDF details: " . $stmt->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>
