<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include '../../db_connect/db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $row = $conn->query("SELECT photo FROM breakfast_items WHERE item_id = $id")->fetch_assoc();
    if ($row && !empty($row['photo'])) {
        @unlink(__DIR__.'/uploads/breakfast_items/'.$row['photo']);
    }

    $conn->query("DELETE FROM breakfast_items WHERE item_id = $id");
    $_SESSION['msg_success'] = "Breakfast item deleted successfully!";
}

header("Location: all_breakfast_items.php");
exit();
