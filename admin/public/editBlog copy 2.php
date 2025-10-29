<?php
include __DIR__ . '/../../db.connection/db_connection.php';

// Get blog id
$blog_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch blog details
$stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
$stmt->bind_param("i", $blog_id);
$stmt->execute();
$result = $stmt->get_result();
$blog = $result->fetch_assoc();

if (!$blog) {
    die("Blog not found!");
}

// Function to generate unique file names
function generateUniqueFileName($fileName)
{
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    return uniqid() . '_' . time() . '.' . $ext;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $service = $_POST['service'] ?? '';
    $main_content = $_POST['main_content'] ?? '';
    $full_content = $_POST['full_content'] ?? '';
    $logo_link = $_POST['logo_link'] ?? '';

    // --- Handle Main Image ---
    $main_image = $_POST['old_main_image'] ?? '';
    if (!empty($_FILES['main_image']['name'])) {
        $target_dir = __DIR__ . "/../uploads/photos/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

        $new_file = generateUniqueFileName($_FILES['main_image']['name']);
        if (move_uploaded_file($_FILES['main_image']['tmp_name'], $target_dir . $new_file)) {
            $main_image = $new_file;
        }
    }

    // --- Handle Video ---
    $video = $_POST['old_video'] ?? '';
    if (!empty($_FILES['video']['name'])) {
        $target_dir = __DIR__ . "/../uploads/videos/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

        $new_file = generateUniqueFileName($_FILES['video']['name']);
        if (move_uploaded_file($_FILES['video']['tmp_name'], $target_dir . $new_file)) {
            $video = $new_file;
        }
    }

    // --- Handle Logo ---
    $logo = $_POST['old_logo'] ?? '';
    if (!empty($_FILES['logo']['name'])) {
        $target_dir = __DIR__ . "/../uploads/logos/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

        $new_file = generateUniqueFileName($_FILES['logo']['name']);
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $target_dir . $new_file)) {
            $logo = $new_file;
        }
    }

    // --- Update Database ---
    $stmt = $conn->prepare("UPDATE blogs SET title=?, service=?, main_content=?, full_content=?, main_image=?, video=?, logo=?, logo_link=? WHERE id=?");
    $stmt->bind_param("ssssssssi", $title, $service, $main_content, $full_content, $main_image, $video, $logo, $logo_link, $blog_id);

    if ($stmt->execute()) {
        header("Location: allBlog.php?updated=1");
        exit;
    } else {
        echo "Error updating blog: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Srinivasa Dental - Dashboard</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Include Quill CSS -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- End of Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                <?php include 'navbar.php'; ?>
                <!-- End of Topbar -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit BLOG</h1>
                    </div>
                    <div class="row">
                        <div class="col-xl-11">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">EDIT CONTENT</h6>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="old_main_image" value="<?= htmlspecialchars($blog['main_image']); ?>">
                                        <input type="hidden" name="old_video" value="<?= htmlspecialchars($blog['video']); ?>">
                                        <input type="hidden" name="old_logo" value="<?= htmlspecialchars($blog['logo']); ?>">

                                        <div class="mb-3">
                                            <label>Title</label>
                                            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($blog['title']); ?>" required>
                                        </div>

                                        <div class="mb-3">
                                            <label>Service</label>
                                            <input type="text" name="service" class="form-control" value="<?= htmlspecialchars($blog['service']); ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label>Main Content</label>
                                            <textarea name="main_content" class="form-control" rows="4"><?= htmlspecialchars($blog['main_content']); ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label>Full Content</label>
                                            <textarea name="full_content" class="form-control" rows="6"><?= htmlspecialchars($blog['full_content']); ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label>Main Image</label><br>
                                            <?php if (!empty($blog['main_image'])): ?>
                                                <img src="../uploads/photos/<?= htmlspecialchars($blog['main_image']); ?>" width="150" class="mb-2"><br>
                                            <?php endif; ?>
                                            <input type="file" name="main_image" class="form-control" accept="image/*">
                                        </div>

                                        <div class="mb-3">
                                            <label>Video</label><br>
                                            <?php if (!empty($blog['video'])): ?>
                                                <video src="../uploads/videos/<?= htmlspecialchars($blog['video']); ?>" width="200" controls class="mb-2"></video><br>
                                            <?php endif; ?>
                                            <input type="file" name="video" class="form-control" accept="video/*">
                                        </div>

                                        <div class="mb-3">
                                            <label>Logo</label><br>
                                            <?php if (!empty($blog['logo'])): ?>
                                                <img src="../uploads/logos/<?= htmlspecialchars($blog['logo']); ?>" width="100" class="mb-2"><br>
                                            <?php endif; ?>
                                            <input type="file" name="logo" class="form-control" accept="image/*">
                                        </div>

                                        <div class="mb-3">
                                            <label>Logo Link</label>
                                            <input type="url" name="logo_link" class="form-control" value="<?= htmlspecialchars($blog['logo_link']); ?>">
                                        </div>

                                        <button type="submit" class="btn btn-success">Update Blog</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <!-- End of Footer -->
    </div>
    </div>

    <!-- Include Quill JS -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <!-- Initialize Quill Editors and Load Existing Data -->
    <script>
        // Initialize Quill editors with color options in the toolbar
        const quillMain = new Quill('#mainEditor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{
                        'header': '1'
                    }, {
                        'header': '2'
                    }, {
                        'font': []
                    }],
                    [{
                        'size': []
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }], // Color and background color options
                    ['link', 'blockquote'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    [{
                        'script': 'sub'
                    }, {
                        'script': 'super'
                    }],
                    [{
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }],
                    [{
                        'direction': 'rtl'
                    }],
                    [{
                        'align': []
                    }],
                    ['clean'] // Remove formatting button
                ]
            },
            placeholder: 'Enter main content...',
        });

        const quillFull = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{
                        'header': '1'
                    }, {
                        'header': '2'
                    }, {
                        'font': []
                    }],
                    [{
                        'size': []
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }], // Color and background color options
                    ['link', 'blockquote'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    [{
                        'script': 'sub'
                    }, {
                        'script': 'super'
                    }],
                    [{
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }],
                    [{
                        'direction': 'rtl'
                    }],
                    [{
                        'align': []
                    }],
                    ['clean'] // Remove formatting button
                ]
            },
            placeholder: 'Compose full content...',
        });

        // Load existing data into Quill editors
        quillMain.root.innerHTML = <?php echo json_encode($main_content); ?>;
        quillFull.root.innerHTML = <?php echo json_encode($full_content); ?>;

        // On form submission, set Quill content into hidden input fields
        document.querySelector('#editblogform').onsubmit = function() {
            document.querySelector('#mainContentData').value = quillMain.root.innerHTML;
            document.querySelector('#formcontentdata').value = quillFull.root.innerHTML;
        };
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>