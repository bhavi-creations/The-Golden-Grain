toggle_status.php<?php
include '../../db_connect/db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "UPDATE lunch_items SET status = IF(status='Active','Inactive','Active') WHERE item_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->close();
}

header("Location: all_lunch_items.php");
exit;
?>
