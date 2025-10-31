<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// include '../../db.connection/db_connection.php';
include '../../db_connect/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = trim($_POST['category_name']);
    if (!empty($category_name)) {
        $stmt = $conn->prepare("INSERT INTO category (category_name, created_at, updated_at) VALUES (?, NOW(), NOW())");
        $stmt->bind_param("s", $category_name);
        if ($stmt->execute()) {
            $_SESSION['msg_success'] = "Category '$category_name' created successfully!";
        } else {
            $_SESSION['msg_error'] = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['msg_error'] = "Category name cannot be empty!";
    }
    $conn->close();
}

header("Location: index.php
");
exit();
?>
