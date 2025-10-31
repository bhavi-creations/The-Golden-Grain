<?php
session_start();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> The Golden Grain - Dashboard</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top" class="bg-light">
    <div id="wrapper" class="d-flex flex-column min-vh-100">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="flex-fill d-flex flex-column">
            <div id="content" class="flex-fill d-flex flex-column">
                <div class="container-fluid py-4 flex-fill d-flex flex-column">

                    <!-- Success/Error Messages -->
                    <?php
                    if (isset($_SESSION['msg_success'])) {
                        echo "<div class='alert alert-success text-center'>" . $_SESSION['msg_success'] . "</div>";
                        unset($_SESSION['msg_success']);
                    } elseif (isset($_SESSION['msg_error'])) {
                        echo "<div class='alert alert-danger text-center'>" . $_SESSION['msg_error'] . "</div>";
                        unset($_SESSION['msg_error']);
                    }
                    ?>

                    <!-- Page Heading -->
                    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap">
                        <h1 class="h3 mb-0 text-gray-800">Create Menu Category</h1>
                    </div>

                    <!-- Create Category Form -->
                    <div class="row flex-fill">
                        <div class="col-12 col-md-10 col-lg-8 mx-auto d-flex flex-column">
                            <div class="card shadow-sm flex-fill">
                                <div class="card-header py-3 bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Add New Category</h6>
                                </div>
                                <div class="card-body flex-fill d-flex flex-column justify-content-between">
                                    <form method="POST" action="update_menu.php" class="flex-fill d-flex flex-column justify-content-between">
                                        <div class="form-group">
                                            <label for="categoryName" class="text-dark font-weight-bold">Category Name</label>
                                            <input type="text" class="form-control" name="menu_category" id="categoryName"
                                                placeholder="Enter category name" required>
                                        </div>
                                        <div class="mt-3 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto"></div>
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
                <!-- End Footer -->
            </div>
        </div>
    </div>
</body>
</html>