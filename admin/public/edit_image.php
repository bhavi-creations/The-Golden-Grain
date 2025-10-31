<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection
// include '../../db.connection/db_connection.php';
include '../../db_connect/db_connect.php';

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['msg_error'] = "Invalid request!";
    header("Location: all_image_upload.php");
    exit();
}

$id = intval($_GET['id']);

// Fetch image data
$stmt = $conn->prepare("SELECT title, image, category_id FROM image_uploads WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($title, $image_name, $category_id);
$stmt->fetch();
$stmt->close();

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
    $new_title = $_POST['title'];
    $new_category_id = $_POST['category_id'];
    $new_image_name = $image_name; // default existing image

    // Check if new file uploaded
    if (isset($_FILES['image_file']) && $_FILES['image_file']['size'] > 0) {
        $target_dir = __DIR__ . "/uploads/photos/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $original_name = $_FILES['image_file']['name'];
        $extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($extension, $allowed)) {
            $new_filename = pathinfo($original_name, PATHINFO_FILENAME) . '_' . uniqid() . '.' . $extension;
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $target_file)) {
                // Delete old image
                $old_file_path = $target_dir . $image_name;
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
                $new_image_name = $new_filename;
            } else {
                $_SESSION['msg_error'] = "Error uploading new image.";
            }
        } else {
            $_SESSION['msg_error'] = "Invalid file type. Only JPG, PNG, GIF, WEBP allowed.";
        }
    }

    // Update database
    $stmt = $conn->prepare("UPDATE image_uploads SET title = ?, image = ?, category_id = ?, updated_at = NOW() WHERE id = ?");
    $stmt->bind_param("ssii", $new_title, $new_image_name, $new_category_id, $id);
    if ($stmt->execute()) {
        $_SESSION['msg_success'] = "Image updated successfully!";
        header("Location: all_image_upload.php");
        exit();
    } else {
        $_SESSION['msg_error'] = "Database error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edit Image - Admin</title>
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
                        <h1 class="h3 mb-0 text-gray-800">Edit Image</h1>
                        <a href="all_image_upload.php" class="btn btn-secondary btn-sm shadow-sm">Back to Images</a>
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

                    <!-- Edit Image Form Card -->
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header py-3 bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Edit Image Details</h6>
                                </div>
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="title" class="text-dark font-weight-bold">Title</label>
                                            <input type="text" class="form-control" name="title" id="title" value="<?= htmlspecialchars($title) ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="category_id" class="text-dark font-weight-bold">Category</label>
                                            <select class="form-control" name="category_id" id="category_id" required>
                                                <option value="">-- Select Category --</option>
                                                <?php foreach ($categories as $cat): ?>
                                                    <option value="<?= $cat['category_id'] ?>" <?= $cat['category_id'] == $category_id ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($cat['category_name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="image_file" class="text-dark font-weight-bold">Replace Image (optional)</label>
                                            <input type="file" class="form-control-file" name="image_file" id="image_file" accept="image/*">
                                            <?php if (!empty($image_name)): ?>
                                                <div class="mt-2">
                                                    <small>Current Image:</small><br>
                                                    <img src="uploads/photos/<?= htmlspecialchars($image_name) ?>" class="img-fluid rounded" style="max-width:150px;">
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="d-flex justify-content-between mt-3">
                                            <button type="submit" class="btn btn-success">Update</button>
                                            <a href="all_image_upload.php" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto pt-3"></div>
                </div>

                <!-- Footer -->
                <footer class="bg-white text-center py-3 mt-auto">
                    <div class="container">
                        <p class="mb-0" style="color:black">
                            ©2025 The Golden Grain. All Rights Reserved. Designed & Developed by
                            <a href="https://bhavicreations.com/" target="_blank" style="text-decoration:none;color:black;">Bhavi Creations</a>
                        </p>
                    </div>
                </footer>
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