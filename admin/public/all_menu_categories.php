<?php
// Include database connection
include '../../db_connect/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Menu Categories Dashboard</title>

    <!-- Custom fonts and styles -->
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
                        <h2 class="h2 mb-0 text-info mx-2">All Menu Categories</h2>
                        <a href="create_menu_category.php" class="btn btn-primary btn-sm shadow-sm my-2">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Category
                        </a>
                    </div>

                    <!-- Categories Row -->
                    <div class="row g-3 flex-fill">
                        <?php
                        $menu_sql = "SELECT menu_category_id, menu_category, created_at FROM menu_category ORDER BY created_at DESC";
                        $menu_result = $conn->query($menu_sql);

                        if ($menu_result->num_rows > 0) {
                            while ($menu_row = $menu_result->fetch_assoc()) {
                        ?>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                                    <div class="card shadow-sm w-100">
                                        <div class="card-body d-flex flex-column justify-content-between">
                                            <h5 class="card-title text-truncate"><?= htmlspecialchars($menu_row['menu_category']); ?></h5>
                                            <small class="text-muted">Created: <?= date("d M Y", strtotime($menu_row['created_at'])); ?></small>
                                            <div class="mt-3 d-flex justify-content-between flex-wrap">
                                                <a href="edit_menu_category.php?id=<?= $menu_row['menu_category_id']; ?>" class="btn btn-warning btn-sm flex-fill mx-1 my-1">Edit</a>
                                                <a href="delete_menu_category.php?id=<?= $menu_row['menu_category_id']; ?>" class="btn btn-danger btn-sm flex-fill mx-1 my-1" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p class='text-center mt-3'>No menu categories found.</p>";
                        }
                        $conn->close();
                        ?>
                    </div>

                    <div class="mt-auto"></div>
                </div>
                <!-- End Page Content -->

                <!-- Footer -->
                <footer class="bg-white text-center py-3 mt-auto">
                    <div class="container">
                        <p class="mb-0" style="color:black">
                            ©2025 Menu Management. Designed & Developed by
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
    <!-- End Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top" style="display:none;">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
