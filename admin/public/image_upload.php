<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection
// include '../../db.connection/db_connection.php';
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

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="flex-fill d-flex flex-column">
            <!-- Topbar -->
         
            <!-- End Topbar -->

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

                    <!-- Upload Form (centered, responsive) -->
                    <div class="row flex-fill">
                        <div class="col-12 col-md-10 col-lg-8 mx-auto d-flex flex-column">
                            <div class="card shadow-sm flex-fill">
                                <div class="card-header py-3 bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Add New Image</h6>
                                </div>
                                <div class="card-body flex-fill d-flex flex-column">
                                    <form method="POST" enctype="multipart/form-data" class="flex-fill d-flex flex-column justify-content-between">
                                        <div class="form-group">
                                            <label for="title" class="text-dark font-weight-bold">Title</label>
                                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter image title" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="category_id" class="text-dark font-weight-bold">Select Category</label>
                                            <select class="form-control" name="category_id" id="category_id" required>
                                                <option value="">-- Select Category --</option>
                                                <?php foreach ($categories as $cat): ?>
                                                    <option value="<?php echo $cat['category_id']; ?>"><?php echo htmlspecialchars($cat['category_name']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="image_file" class="text-dark font-weight-bold">Select Image</label>
                                            <input type="file" class="form-control-file" name="image_file" id="image_file" accept="image/*" required>
                                        </div>

                                        <div class="mt-3 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success">Upload</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Optional Uploaded Images Section -->
                    <!--
                    <div class="row mt-4">
                        // Image cards go here
                    </div>
                    -->

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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>



</html>