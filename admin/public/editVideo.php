<?php
// Database connection
include '../../db.connection/db_connection.php';

// Get video ID from URL
$video_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($video_id > 0) {
    // Fetch video data
    $stmt = $conn->prepare("SELECT title, video_path FROM videos WHERE id = ?");
    $stmt->bind_param("i", $video_id);
    $stmt->execute();
    $stmt->bind_result($title, $video_path);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "Invalid video ID.";
    exit;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Srinivasa Dental - Dashboard</title>
    <!-- Custom fonts -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <!-- SB Admin CSS -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- End Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                <?php include 'navbar.php'; ?>
                <!-- End Topbar -->

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Video</h1>
                    </div>

                    <div class="row">
                        <div class="col-xl-11">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-success">EDIT VIDEO</h6>
                                </div>
                                <div class="card-body">
                                    <form style='color:black;' id="editvideoform" action="updateVideo.php" method="POST" enctype="multipart/form-data">
                                        <!-- Title Input -->
                                        <div class="mb-3">
                                            <label class="form-label text-primary">Enter Title</label>
                                            <input type="text" class="form-control text-grey-900" name="title" value="<?php echo htmlspecialchars($title); ?>" required>
                                        </div>

                                        <!-- Current Video Preview -->
                                        <div class="mb-3">
                                            <label class="form-label text-primary">Current Video</label><br>
                                            <?php if (!empty($video_path)) { ?>
                                                <video width="320" height="240" controls>
                                                    <source src="../uploads/videos/<?php echo htmlspecialchars($video_path); ?>" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            <?php } else { ?>
                                                <p>No video uploaded</p>
                                            <?php } ?>
                                        </div>

                                        <!-- Upload New Video -->
                                        <div class="mb-3">
                                            <label class="form-label text-primary">Upload New Video (optional)</label>
                                            <input class="form-control" name="video" type="file" accept="video/*">
                                        </div>

                                        <!-- Hidden Input for Video ID -->
                                        <input type="hidden" name="id" value="<?php echo $video_id; ?>">

                                        <!-- Buttons -->
                                        <div class="row p-3">
                                            <div class="col-xl-7 col-sm-2"></div>
                                            <button type="reset" class="btn btn-danger mx-1 my-2 col-xl-2">Clear</button>
                                            <button type="submit" class="btn btn-success mx-1 my-2 col-xl-2">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- SB Admin scripts -->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
