<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection
include '../../db_connect/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lunch Items - The Golden Grain</title>
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
                <div class="container-fluid py-4 flex-fill d-flex flex-column">

                    <!-- Page Header -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 flex-wrap">
                        <h1 class="h3 mb-0 text-gray-800">Lunch Items</h1>
                        <a href="add_lunch_item.php" class="btn btn-primary btn-sm shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Item
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

                    <!-- Lunch Items Grid -->
                    <div class="row">
                        <?php
                        // Fetch all lunch items with their categories
                        $query = "
                            SELECT li.*, mc.menu_category 
                            FROM lunch_items AS li
                            LEFT JOIN menu_category AS mc
                            ON li.menu_category_id = mc.menu_category_id
                            ORDER BY li.item_id DESC
                        ";
                        $result = $conn->query($query);

                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex">
                                    <div class="card flex-fill shadow-sm">
                                        <img src="uploads/lunch_items/<?= htmlspecialchars($row['photo']) ?>" class="card-img-top" style="object-fit: cover; height:200px;">
                                        <div class="card-body d-flex flex-column">
                                            <h6 class="card-title"><?= htmlspecialchars($row['item_name']) ?></h6>
                                            <p class="card-text mb-2">
                                                <small class="text-muted">
                                                    Category: <?= htmlspecialchars($row['menu_category']) ?><br>
                                                    <?= htmlspecialchars($row['veg_nonveg']) ?> | ₹<?= number_format($row['price'], 2) ?><br>
                                                </small>
                                            </p>
                                            <div class="mt-auto d-flex justify-content-between">
                                                <a href="edit_lunch_item.php?id=<?= $row['item_id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="delete_lunch_item.php?id=<?= $row['item_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<div class='col-12 text-center'><p>No lunch items added yet.</p></div>";
                        }
                        ?>
                    </div>

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
        </div>
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>
