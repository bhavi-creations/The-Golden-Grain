<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection
include '../../db_connect/db_connect.php';

// Get item ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['msg_error'] = "Invalid request.";
    header("Location: all_lunch_items.php");
    exit();
}

$item_id = intval($_GET['id']);

// Fetch existing item to get photo filename
$stmt = $conn->prepare("SELECT photo FROM lunch_items WHERE item_id = ?");
$stmt->bind_param("i", $item_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['msg_error'] = "Lunch item not found.";
    $stmt->close();
    header("Location: all_lunch_items.php");
    exit();
}

$item = $result->fetch_assoc();
$stmt->close();

// Delete the record from database
$stmt = $conn->prepare("DELETE FROM lunch_items WHERE item_id = ?");
$stmt->bind_param("i", $item_id);

if ($stmt->execute()) {
    // Delete photo file if exists
    $photo_path = __DIR__ . "/uploads/lunch_items/" . $item['photo'];
    if (!empty($item['photo']) && file_exists($photo_path)) {
        unlink($photo_path);
    }

    $_SESSION['msg_success'] = "Lunch item deleted successfully!";
} else {
    $_SESSION['msg_error'] = "Error deleting item: " . $stmt->error;
}

$stmt->close();
header("Location:all_lunch_items.php");
exit();
