<?php
// Database connection
include '../../db_connect/db_connect.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menu_category_id = isset($_POST['menu_category_id']) ? intval($_POST['menu_category_id']) : 0;
    $menu_category = isset($_POST['menu_category']) ? trim($_POST['menu_category']) : '';

    if ($menu_category_id > 0 && $menu_category != '') {
        $stmt = $conn->prepare("UPDATE menu_category SET menu_category = ? WHERE menu_category_id = ?");
        $stmt->bind_param("si", $menu_category, $menu_category_id);

        if ($stmt->execute()) {
            // Redirect to all menu categories page after successful update
            header("Location: all_menu_categories.php");
            exit();
        } else {
            $error_msg = "Error updating menu category: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $error_msg = "Invalid Menu Category ID or empty category name.";
    }
}

// Get Menu Category ID from URL (for initial form population)
$menu_category_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($menu_category_id > 0) {
    $stmt = $conn->prepare("SELECT menu_category FROM menu_category WHERE menu_category_id = ?");
    $stmt->bind_param("i", $menu_category_id);
    $stmt->execute();
    $stmt->bind_result($menu_category);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "Invalid Menu Category ID.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edit Menu Category</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top" class="bg-light">
    <div id="wrapper" class="d-flex flex-column min-vh-100">

        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="flex-fill d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="flex-fill d-flex flex-column">

                <!-- Begin Page Content -->
                <div class="container-fluid py-4 flex-fill d-flex flex-column">

                    <!-- Page Header -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 flex-wrap">
                        <h1 class="h3 mb-0 text-gray-800">Edit Menu Category</h1>
                        <a href="all_menu_categories.php" class="btn btn-primary btn-sm shadow-sm my-2">
                            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Menu Categories
                        </a>
                    </div>

                    <!-- Edit Form Card -->
                    <div class="row flex-fill justify-content-center">
                        <div class="col-12 col-md-8 col-lg-6 d-flex flex-column">
                            <div class="card shadow-sm flex-fill">
                                <div class="card-header py-3 bg-success text-white">
                                    <h6 class="m-0 font-weight-bold">Edit Menu Category Details</h6>
                                </div>
                                <div class="card-body flex-fill d-flex flex-column">
                                    <?php if (isset($error_msg)) { ?>
                                        <div class='alert alert-danger text-center mb-3'><?= $error_msg ?></div>
                                    <?php } ?>
                                    <form action="" method="POST" class="flex-fill d-flex flex-column justify-content-between">
                                        <div class="mb-3">
                                            <label for="menuCategoryName" class="form-label text-dark font-weight-bold">Menu Category Name</label>
                                            <input type="text" class="form-control" id="menuCategoryName" name="menu_category" value="<?= htmlspecialchars($menu_category); ?>" required>
                                        </div>

                                        <input type="hidden" name="menu_category_id" value="<?= $menu_category_id; ?>">

                                        <div class="d-flex justify-content-end flex-wrap mt-3">
                                            <button type="reset" class="btn btn-danger mx-1 my-1">Clear</button>
                                            <button type="submit" class="btn btn-success mx-1 my-1">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto"></div>
                </div>
                <!-- End Page Content -->

                <!-- Footer -->
                <footer class="bg-white text-center py-3 mt-auto">
                    <div class="container">
                        <p class="mb-0" style="color:black">
                            ©2025 Menu Management. Developed by
                            <a href="https://bhavicreations.com/" target="_blank" style="color:black;text-decoration:none;">Bhavi Creations</a>
                        </p>
                    </div>
                </footer>
                <!-- End Footer -->

            </div>
            <!-- End Main Content -->

        </div>
        <!-- End Content Wrapper -->

    </div>
    <!-- End Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
