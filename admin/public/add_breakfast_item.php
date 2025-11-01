<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection
include '../../db_connect/db_connect.php';

// Fetch menu categories for dropdown
$categories = [];
$cat_result = $conn->query("SELECT menu_category_id, menu_category FROM menu_category ORDER BY menu_category ASC");
if ($cat_result && $cat_result->num_rows > 0) {
    while ($row = $cat_result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_name = trim($_POST['item_name']);
    $veg_nonveg = $_POST['veg_nonveg'];
    $status = $_POST['status'];
    $price = floatval($_POST['price']);
    $menu_category_id = intval($_POST['menu_category']);

    if (isset($_FILES['photo']) && $_FILES['photo']['size'] > 0) {
        $target_dir = __DIR__ . "/uploads/breakfast_items/";

        // Create folder if not exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $original_name = $_FILES['photo']['name'];
        $extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (!in_array($extension, $allowed)) {
            $_SESSION['msg_error'] = "Invalid file type. Only JPG, PNG, GIF, WEBP allowed.";
        } else {
            $new_filename = pathinfo($original_name, PATHINFO_FILENAME) . '_' . uniqid() . '.' . $extension;
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
                // ✅ Corrected query (removed updated_at since not in table)
                $stmt = $conn->prepare("INSERT INTO breakfast_items (menu_category_id, photo, item_name, veg_nonveg, status, price) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("issssd", $menu_category_id, $new_filename, $item_name, $veg_nonveg, $status, $price);
                
                if ($stmt->execute()) {
                    $_SESSION['msg_success'] = "Breakfast item added successfully!";
                } else {
                    $_SESSION['msg_error'] = "Database error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $_SESSION['msg_error'] = "Error uploading the file.";
            }
        }
    } else {
        $_SESSION['msg_error'] = "Please select an image.";
    }

    header("Location: add_breakfast_item.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Add Breakfast Item - The Golden Grain</title>
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
                        <h1 class="h3 mb-0 text-gray-800">Add Breakfast Item</h1>
                        <a href="all_breakfast_items.php" class="btn btn-primary btn-sm shadow-sm">
                            <i class="fas fa-eye fa-sm text-white-50"></i> View All Items
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

                    <!-- Form -->
                    <div class="row flex-fill">
                        <div class="col-12 col-md-10 col-lg-8 mx-auto d-flex flex-column">
                            <div class="card shadow-sm flex-fill">
                                <div class="card-header py-3 bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Add New Breakfast Item</h6>
                                </div>
                                <div class="card-body flex-fill d-flex flex-column">
                                    <form method="POST" enctype="multipart/form-data" class="flex-fill d-flex flex-column justify-content-between">

                                        <!-- Menu Category -->
                                        <div class="form-group">
                                            <label class="text-dark font-weight-bold">Menu Category</label>
                                            <select name="menu_category" class="form-control" required>
                                                <option value="">-- Select Category --</option>
                                                <?php foreach ($categories as $cat): ?>
                                                    <option value="<?= $cat['menu_category_id'] ?>"><?= htmlspecialchars($cat['menu_category']) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- Item Name -->
                                        <div class="form-group">
                                            <label class="text-dark font-weight-bold">Item Name</label>
                                            <input type="text" name="item_name" class="form-control" placeholder="Enter item name" required>
                                        </div>

                                        <!-- Veg/Non-Veg -->
                                        <div class="form-group">
                                            <label class="text-dark font-weight-bold">Veg / Non-Veg</label>
                                            <select name="veg_nonveg" class="form-control" required>
                                                <option value="">-- Select Type --</option>
                                                <option value="Veg">Veg</option>
                                                <option value="Non-Veg">Non-Veg</option>
                                            </select>
                                        </div>

                                        <!-- Status -->
                                        <div class="form-group">
                                            <label class="text-dark font-weight-bold">Status</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" value="Active" checked>
                                                <label class="form-check-label">Active</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" value="Inactive">
                                                <label class="form-check-label">Inactive</label>
                                            </div>
                                        </div>

                                        <!-- Price -->
                                        <div class="form-group">
                                            <label class="text-dark font-weight-bold">Price (₹)</label>
                                            <input type="number" step="0.01" name="price" class="form-control" placeholder="Enter price" required>
                                        </div>

                                        <!-- Photo Upload -->
                                        <div class="form-group">
                                            <label class="text-dark font-weight-bold">Upload Photo</label>
                                            <input type="file" name="photo" class="form-control-file" accept="image/*" required>
                                        </div>

                                        <!-- Submit -->
                                        <div class="mt-3 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success">Add Item</button>
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
