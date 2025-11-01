<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include '../../db_connect/db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the photo filename to delete
    $row = $conn->query("SELECT photo FROM dinner_items WHERE item_id = $id")->fetch_assoc();

    if ($row && !empty($row['photo'])) {
        @unlink(__DIR__.'/uploads/dinner_items/'.$row['photo']);
    }

    // Delete the record from database
    $conn->query("DELETE FROM dinner_items WHERE item_id = $id");

    $_SESSION['msg_success'] = "Dinner item deleted successfully!";
}

header("Location: all_dinner_items.php");
exit();
?>
