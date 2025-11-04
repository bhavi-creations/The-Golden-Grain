<?php include 'header.php'; ?>
<?php
include './db_connect/db_connect.php';

// Fetch all menu categories
$categories = [];
$cat_result = $conn->query("SELECT menu_category_id, menu_category FROM menu_category ORDER BY menu_category ASC");
if ($cat_result && $cat_result->num_rows > 0) {
    while ($row = $cat_result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// Fetch all active menu items
$items = [];
$item_result = $conn->query("SELECT mi.*, mc.menu_category 
                             FROM menu_items AS mi 
                             LEFT JOIN menu_category AS mc ON mi.menu_category_id = mc.menu_category_id 
                             WHERE mi.status='Active' 
                             ORDER BY mi.item_id DESC");
if ($item_result && $item_result->num_rows > 0) {
    while ($row = $item_result->fetch_assoc()) {
        $items[] = $row;
    }
}
?>

<!--Breadcrumbs start-->
<div class="breadcrubs ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcurbs-inner text-center">
                    <h3 class="breadcrubs-title">Menu</h3>
                    <ul>
                        <li><a href="index.php">home <span>//</span> </a></li>
                        <li>Menu</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Breadcrumbs end-->

<!--Menu Items start-->
<div class="elements ptb-100">
    <div class="container">
        <div class="row">
            <div class="food-item-tab home-page row">
                <div class="col-lg-12 ">
                    <div class="foode-item-box fix mb-60 ">
                        <ul class="nav foode-item_nav d-flex flex-wrap justify-content-start mx-5 px-5" role="tablist" style="gap:10px;">
                            <li role="presentation" style="flex: 0 0 32%;"><a class="active w-100 text-center py-2" href="#tab_all" data-bs-toggle="tab">All Items</a></li>
                            <?php foreach ($categories as $cat): ?>
                                <li role="presentation" style="flex: 0 0 32%;"><a class="w-100 text-center py-2" href="#tab_<?= $cat['menu_category_id'] ?>" data-bs-toggle="tab"><?= htmlspecialchars($cat['menu_category']) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>


                <div class="tab-content w-100">
                    <!-- All Items Tab -->
                    <div role="tabpanel" class="tab-pane fade show active" id="tab_all">
                        <div class="row">
                            <?php foreach ($items as $item): ?>
                                <div class="col-md-6 mb-30">
                                    <div class="single-food-inner">
                                        <div class="food-img">
                                            <img src="admin/public/uploads/menu_items/<?= htmlspecialchars($item['photo']) ?>"
                                                alt="<?= htmlspecialchars($item['item_name']) ?>"
                                                style="width:100%; height:auto;">
                                        </div>
                                        <div class="single-food-item-desc">
                                            <div class="single-food-item-title">
                                                <h2><a href="#"><?= htmlspecialchars($item['item_name']) ?></a></h2>
                                                <p><?= htmlspecialchars($item['veg_nonveg']) ?> / <?= htmlspecialchars($item['menu_category']) ?></p>
                                            </div>
                                            <div class="single-food-price">
                                                <p>₹<?= number_format($item['price'], 2) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Category Tabs -->
                    <?php foreach ($categories as $cat): ?>
                        <div role="tabpanel" class="tab-pane fade" id="tab_<?= $cat['menu_category_id'] ?>">
                            <div class="row">
                                <?php foreach ($items as $item):
                                    if ($item['menu_category_id'] != $cat['menu_category_id']) continue; ?>
                                    <div class="col-md-6 mb-30">
                                        <div class="single-food-inner">
                                            <div class="food-img img-hover">
                                                <img src="admin/public/uploads/menu_items/<?= htmlspecialchars($item['photo']) ?>"
                                                    alt="<?= htmlspecialchars($item['item_name']) ?>"
                                                    style="width:100%; height:auto; transition: transform 0.3s ease;">
                                            </div>
                                            <div class="single-food-item-desc">
                                                <div class="single-food-item-title">
                                                    <h2><a href="#"><?= htmlspecialchars($item['item_name']) ?></a></h2>
                                                    <p><?= htmlspecialchars($item['veg_nonveg']) ?> / <?= htmlspecialchars($item['menu_category']) ?></p>
                                                </div>
                                                <div class="single-food-price">
                                                    <p>₹<?= number_format($item['price'], 2) ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>


            </div>
        </div>
    </div>
</div>
<!--Menu Items end-->

<?php include 'footer.php'; ?>