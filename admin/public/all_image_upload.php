<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection
include '../../db_connect/db_connect.php';

// Fetch categories for dropdown
$categories = [];
$cat_result = $conn->query("SELECT category_id, category_name FROM category ORDER BY category_name ASC");
if ($cat_result->num_rows > 0) {
    while ($row = $cat_result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];

    if (isset($_FILES['image_file']) && $_FILES['image_file']['size'] > 0) {
        $target_dir = __DIR__ . "/uploads/photos/";

        // Create folder if it doesn't exist
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $original_name = $_FILES['image_file']['name'];
        $extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (!in_array($extension, $allowed)) {
            $_SESSION['msg_error'] = "Invalid file type. Only JPG, PNG, GIF, WEBP allowed.";
        } else {
            $new_filename = pathinfo($original_name, PATHINFO_FILENAME) . '_' . uniqid() . '.' . $extension;
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $target_file)) {
                // Save to database
                $stmt = $conn->prepare("INSERT INTO image_uploads (title, image, category_id, updated_at) VALUES (?, ?, ?, NOW())");
                $stmt->bind_param("ssi", $title, $new_filename, $category_id);
                if ($stmt->execute()) {
                    $_SESSION['msg_success'] = "Image uploaded successfully!";
                } else {
                    $_SESSION['msg_error'] = "Database error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $_SESSION['msg_error'] = "Error uploading the file.";
            }
        }
    } else {
        $_SESSION['msg_error'] = "Please select an image to upload.";
    }

    header("Location: image_upload.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Upload Image - The Golden Grain</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top" class="bg-light">
    <div id="wrapper" class="d-flex flex-column min-vh-100">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- End Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="flex-fill d-flex flex-column">
            <!-- Main Content -->
            <div id="content" class="flex-fill d-flex flex-column">
                <div class="container-fluid py-4 flex-fill d-flex flex-column">

                    <!-- Page Header -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 flex-wrap">
                        <h1 class="h3 mb-0 text-gray-800">Upload Image</h1>
                        <a href="newPDF.php" class="btn btn-primary btn-sm shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Category
                        </a>
                    </div>

                    <!-- Messages -->
                    <?php
                    if (isset($_SESSION['msg_success'])) {
                        echo "<div class='alert alert-success text-center'>" . $_SESSION['msg_success'] . "</div>";
                        unset($_SESSION['msg_success']);
                    } elseif (isset($_SESSION['msg_error'])) {
                        echo "<div class='alert alert-danger text-center'>" . $_SESSION['msg_error'] . "</div>";
                        unset($_SESSION['msg_error']);
                    }
                    ?>

                    <!-- Uploaded Images Grid -->
                    <div class="row">
                        <?php
                        $result = $conn->query("SELECT i.*, c.category_name FROM image_uploads i LEFT JOIN category c ON i.category_id = c.category_id ORDER BY i.updated_at DESC");
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex">
                                    <div class="card flex-fill shadow-sm">
                                        <img src="uploads/photos/<?php echo $row['image']; ?>" class="card-img-top" style="object-fit: cover; height:200px;">
                                        <div class="card-body d-flex flex-column">
                                            <h6 class="card-title"><?php echo $row['title']; ?></h6>
                                            <p class="card-text mb-2">
                                                <small class="text-muted">
                                                    Category: <?php echo $row['category_name']; ?><br>
                                                    <?php echo date('d M Y H:i', strtotime($row['updated_at'])); ?>
                                                </small>
                                            </p>
                                            <div class="mt-auto d-flex justify-content-between">
                                                <a href="edit_image.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="delete_image.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this image?')">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<div class='col-12'><p class='text-center'>No images uploaded yet.</p></div>";
                        }
                        ?>
                    </div>

                    <div class="mt-auto"></div>
                </div>
                <!-- End Page Content -->

                <!-- Footer -->
                <footer class="bg-white text-center py-3 mt-auto">
                    <div class="container">
                        <p class="mb-0" style="color:black">
                            ©2025 The Golden Grain. All Rights Reserved. Designed & Developed by
                            <a href="https://bhavicreations.com/" target="_blank" style="text-decoration:none;color:black;">Bhavi Creations</a>
                        </p>
                    </div>
                </footer>
                <!-- End Footer -->
            </div>
            <!-- End Main Content -->
        </div>
        <!-- End Content Wrapper -->
    </div>
    <!-- End Wrapper -->

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>


</html>