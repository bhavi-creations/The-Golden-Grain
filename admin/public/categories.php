<?php
// Database connection must be first for CRUD operations
// include '../../db_connect/db_connect.php'; 
include '../../db_connect/db_connect.php';

$message = '';
$message_type = ''; // 'success' or 'danger'
$categories = [];
$edit_category = null;

// --- C: CREATE Operation ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    if (!empty($name)) {
        // Prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO categories (name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $description);

        if ($stmt->execute()) {
            $message = "Category '{$name}' added successfully!";
            $message_type = 'success';
        } else {
            // Check for unique constraint violation
            if ($conn->errno == 1062) {
                $message = "Error: A category with the name '{$name}' already exists.";
            } else {
                $message = "ERROR: Could not execute query. " . $stmt->error;
            }
            $message_type = 'danger';
        }
        $stmt->close();
    } else {
        $message = "Category Name cannot be empty.";
        $message_type = 'danger';
    }
}

// --- U: UPDATE Operation ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_category'])) {
    $category_id = intval($_POST['category_id']);
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    if (!empty($name) && $category_id > 0) {
        $stmt = $conn->prepare("UPDATE categories SET name = ?, description = ?, updated_at = CURRENT_TIMESTAMP WHERE category_id = ?");
        $stmt->bind_param("ssi", $name, $description, $category_id);

        if ($stmt->execute()) {
            $message = "Category ID {$category_id} updated successfully!";
            $message_type = 'success';
        } else {
            if ($conn->errno == 1062) {
                $message = "Error: A category with the name '{$name}' already exists.";
            } else {
                $message = "ERROR: Could not execute update query. " . $stmt->error;
            }
            $message_type = 'danger';
        }
        $stmt->close();
    } else {
        $message = "Category Name and ID are required for update.";
        $message_type = 'danger';
    }
}

// --- D: DELETE Operation ---
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    if ($delete_id > 0) {
        $stmt = $conn->prepare("DELETE FROM categories WHERE category_id = ?");
        $stmt->bind_param("i", $delete_id);

        if ($stmt->execute()) {
            $message = "Category ID {$delete_id} deleted successfully (and all linked posts via CASCADE)!";
            $message_type = 'success';
        } else {
            $message = "ERROR: Could not delete category. " . $stmt->error;
            $message_type = 'danger';
        }
        $stmt->close();
        // Redirect to clean the URL after deletion
        header("Location: categories.php?message=" . urlencode($message) . "&type=" . urlencode($message_type));
        exit();
    }
}

// --- R: READ (Fetch All) Operation ---
$sql_read = "SELECT category_id, name, description, created_at, updated_at FROM categories ORDER BY name ASC";
$result = mysqli_query($conn, $sql_read);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row;
    }
    mysqli_free_result($result);
} else {
    $message = "ERROR: Could not retrieve categories. " . mysqli_error($conn);
    $message_type = 'danger';
}

// Handle GET for messages after redirect (like after delete or update)
if (isset($_GET['message']) && isset($_GET['type'])) {
    $message = htmlspecialchars($_GET['message']);
    $message_type = htmlspecialchars($_GET['type']);
}

// --- R: READ (Fetch Single for Edit) Operation ---
if (isset($_GET['edit_id'])) {
    $edit_id = intval($_GET['edit_id']);
    $stmt = $conn->prepare("SELECT category_id, name, description FROM categories WHERE category_id = ?");
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result_edit = $stmt->get_result();
    
    if ($result_edit->num_rows == 1) {
        $edit_category = $result_edit->fetch_assoc();
    } else {
        $message = "Error: Category to edit not found.";
        $message_type = 'danger';
    }
    $stmt->close();
}

// IMPORTANT: Close connection before HTML output, but only if not redirected (handled above)
mysqli_close($conn); 

// --- Include the updated sidebar file here! ---
include 'sidebar.php'; 
?>

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Blog Categories</h1>
    </div>

    <?php if ($message): ?>
        <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <?php echo $edit_category ? 'Edit Category: ' . htmlspecialchars($edit_category['name']) : 'Add New Category'; ?>
            </h6>
        </div>
        <div class="card-body">
            <form method="POST" action="categories.php">
                <?php if ($edit_category): ?>
                    <input type="hidden" name="category_id" value="<?php echo htmlspecialchars($edit_category['category_id']); ?>">
                    <input type="hidden" name="update_category" value="1">
                <?php else: ?>
                    <input type="hidden" name="add_category" value="1">
                <?php endif; ?>

                <div class="form-group">
                    <label for="name">Category Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" required 
                           value="<?php echo $edit_category ? htmlspecialchars($edit_category['name']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="description">Description (Optional)</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?php echo $edit_category ? htmlspecialchars($edit_category['description']) : ''; ?></textarea>
                </div>
                
                <?php if ($edit_category): ?>
                    <button type="submit" class="btn btn-success">Update Category</button>
                    <a href="categories.php" class="btn btn-secondary">Cancel Edit</a>
                <?php else: ?>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                <?php endif; ?>

            </form>
        </div>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Existing Categories</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $cat): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($cat['category_id']); ?></td>
                                    <td><?php echo htmlspecialchars($cat['name']); ?></td>
                                    <td><?php echo htmlspecialchars($cat['description']); ?></td>
                                    <td><?php echo date('Y-m-d H:i', strtotime($cat['created_at'])); ?></td>
                                    <td><?php echo date('Y-m-d H:i', strtotime($cat['updated_at'])); ?></td>
                                    <td>
                                        <a href="categories.php?edit_id=<?php echo $cat['category_id']; ?>" class="btn btn-info btn-sm">Edit</a>
                                        <a href="categories.php?delete_id=<?php echo $cat['category_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('WARNING: Are you sure you want to delete this category? All associated blog posts will also be deleted!');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No categories found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>