<?php
include '../../db_connect/db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "UPDATE lunch_items SET veg_nonveg = IF(veg_nonveg='Veg','Non-Veg','Veg') WHERE item_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->close();
}

header("Location: all_lunch_items.php");
exit;
?>
