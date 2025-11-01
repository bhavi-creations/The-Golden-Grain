<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include '../../db_connect/db_connect.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: all_dinner_items.php");
    exit();
}

$item_id = intval($_GET['id']);

// Fetch categories
$categories = [];
$cat_result = $conn->query("SELECT menu_category_id, menu_category FROM menu_category ORDER BY menu_category ASC");
if ($cat_result->num_rows > 0) {
    while ($row = $cat_result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// Fetch existing item
$stmt = $conn->prepare("SELECT * FROM dinner_items WHERE item_id = ?");
$stmt->bind_param("i", $item_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    $_SESSION['msg_error'] = "Dinner item not found.";
    header("Location: all_dinner_items.php");
    exit();
}
$item = $result->fetch_assoc();
$stmt->close();

// Map old status values to Active/Inactive
if ($item['status'] == 'Available') $item['status'] = 'Active';
if ($item['status'] == 'Unavailable') $item['status'] = 'Inactive';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_name = $_POST['item_name'];
    $menu_category_id = $_POST['menu_category'];
    $veg_nonveg = $_POST['veg_nonveg'];
    $status = $_POST['status'];
    $price = $_POST['price'];

    $photo_filename = $item['photo'];

    if (isset($_FILES['photo']) && $_FILES['photo']['size'] > 0) {
        $target_dir = __DIR__ . "/uploads/dinner_items/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

        $original_name = $_FILES['photo']['name'];
        $extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (!in_array($extension, $allowed)) {
            $_SESSION['msg_error'] = "Invalid file type. Only JPG, PNG, GIF, WEBP allowed.";
        } else {
            $new_filename = pathinfo($original_name, PATHINFO_FILENAME) . '_' . uniqid() . '.' . $extension;
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
                $photo_filename = $new_filename;
                if (!empty($item['photo']) && file_exists($target_dir . $item['photo'])) {
                    unlink($target_dir . $item['photo']);
                }
            } else {
                $_SESSION['msg_error'] = "Error uploading the file.";
            }
        }
    }

    $stmt = $conn->prepare("UPDATE dinner_items SET menu_category_id = ?, item_name = ?, veg_nonveg = ?, status = ?, price = ?, photo = ? WHERE item_id = ?");
    $stmt->bind_param("isssdsi", $menu_category_id, $item_name, $veg_nonveg, $status, $price, $photo_filename, $item_id);

    if ($stmt->execute()) {
        $_SESSION['msg_success'] = "Dinner item updated successfully!";
    } else {
        $_SESSION['msg_error'] = "Database error: " . $stmt->error;
    }

    $stmt->close();
    header("Location: all_dinner_items.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit Dinner Item - The Golden Grain</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top" class="bg-light">
<div id="wrapper" class="d-flex flex-column min-vh-100">

    <?php include 'sidebar.php'; ?>

    <div id="content-wrapper" class="flex-fill d-flex flex-column">
        <div id="content" class="flex-fill d-flex flex-column">
            <div class="container-fluid py-4 flex-fill d-flex flex-column">

                <div class="d-sm-flex align-items-center justify-content-between mb-4 flex-wrap">
                    <h1 class="h3 mb-0 text-gray-800">Edit Dinner Item</h1>
                    <a href="all_dinner_items.php" class="btn btn-secondary btn-sm shadow-sm">
                        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
                    </a>
                </div>

                <?php
                if (isset($_SESSION['msg_success'])) {
                    echo "<div class='alert alert-success text-center'>" . $_SESSION['msg_success'] . "</div>";
                    unset($_SESSION['msg_success']);
                } elseif (isset($_SESSION['msg_error'])) {
                    echo "<div class='alert alert-danger text-center'>" . $_SESSION['msg_error'] . "</div>";
                    unset($_SESSION['msg_error']);
                }
                ?>

                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">

                                    <div class="mb-3">
                                        <label class="form-label">Item Name</label>
                                        <input type="text" name="item_name" class="form-control" required value="<?= htmlspecialchars($item['item_name']) ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <select name="menu_category" class="form-control" required>
                                            <option value="">--Select Category--</option>
                                            <?php foreach ($categories as $cat): ?>
                                                <option value="<?= $cat['menu_category_id'] ?>" <?= $cat['menu_category_id'] == $item['menu_category_id'] ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($cat['menu_category']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Veg / Non-Veg</label>
                                        <select name="veg_nonveg" class="form-control" required>
                                            <option value="Veg" <?= $item['veg_nonveg'] == 'Veg' ? 'selected' : '' ?>>Veg</option>
                                            <option value="Non-Veg" <?= $item['veg_nonveg'] == 'Non-Veg' ? 'selected' : '' ?>>Non-Veg</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="Active" <?= $item['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                                            <option value="Inactive" <?= $item['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="number" step="0.01" name="price" class="form-control" required value="<?= htmlspecialchars($item['price']) ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Photo</label>
                                        <input type="file" name="photo" class="form-control">
                                        <?php if (!empty($item['photo']) && file_exists(__DIR__ . "/uploads/dinner_items/" . $item['photo'])): ?>
                                            <img src="uploads/dinner_items/<?= $item['photo'] ?>" class="img-fluid mt-2" style="max-height: 150px;">
                                        <?php endif; ?>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Item</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

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

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
</body>
</html>
