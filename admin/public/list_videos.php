<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Srinivasa Dental - Video Dashboard</title>

    <!-- Custom fonts -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <!-- Topbar -->
                <?php include 'navbar.php'; ?>
                <!-- End of Topbar -->

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h2 class="h2 mb-0 text-info mx-2"> Uploaded Videos </h2>
                        <a href="upload_video.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-upload fa-sm text-white-50"></i> Upload New Video
                        </a>
                    </div>

                    <div class='row'>
                        <?php
                        include '../../db.connection/db_connection.php';

                        $sql = "SELECT id, title, video_path FROM videos ORDER BY created_at DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $video_path = "../uploads/video_reviews/" . $row['video_path'];
                                echo "
                                <div class='col-12 col-md-4 mb-4'>
                                    <div class='card shadow'>
                                        <div class='card-body'>
                                            <h5 class='card-title' style='color:black;'>{$row['title']}</h5>
                                            <video width='100%' height='240' controls>
                                                <source src='{$video_path}' type='video/mp4'>
                                                Your browser does not support the video tag.
                                            </video>
                                            <div class='row mt-3'>
                                                <a href='editVideo.php?id={$row['id']}' class='btn btn-warning col mx-2'>Edit</a>
                                                <a href='delete_video.php?id={$row['id']}' class='btn btn-danger col mx-2'>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ";
                            }
                        } else {
                            echo "<p>No videos uploaded yet.</p>";
                        }

                        $conn->close();
                        ?>
                    </div>

                </div>
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <p class="mini_text" style="color:black">
                            ©2024 Srinivasa Dental. All Rights Reserved. Designed & Developed by 
                            <a href="https://bhavicreations.com/" target="_blank" style="text-decoration:none;color:black">Bhavi Creations</a>
                        </p>
                    </div>
                </div>
            </footer>

        </div>
    </div>

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>
