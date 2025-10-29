<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Srinivasa Dental - Reviews</title>

    <!-- Fonts -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- End of Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Navbar -->
                <?php include 'navbar.php'; ?>
                <!-- End Navbar -->

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Comment</h1>
                    </div>

                    <!-- Review Form -->
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-success">Add Comment</h6>
                                </div>
                                <div class="card-body">
                                    <form action="add_review.php" method="POST">
                                        <div class="mb-3">
                                            <label class="form-label text-primary">Name</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-primary">Email</label>
                                            <input type="email" name="email" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-primary">Rating</label>
                                            <select name="rating" class="form-control" required>
                                                <option value="5">⭐⭐⭐⭐⭐</option>
                                                <option value="4">⭐⭐⭐⭐</option>
                                                <option value="3">⭐⭐⭐</option>
                                                <option value="2">⭐⭐</option>
                                                <option value="1">⭐</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-primary">Comment</label>
                                            <textarea name="comment" class="form-control" rows="3" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success">Submit Review</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reviews List -->
                    <!-- <div class="row">
                        <div class="col-xl-11">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">All Reviews</h6>
                                </div>
                                <div class="card-body" id="reviews-list">
                                    <?php
                                    include 'db_connection.php';
                                    function fetchReviews($parent_id = NULL, $conn, $level = 0) {
                                        $condition = is_null($parent_id) ? "IS NULL" : "= $parent_id";
                                        $sql = "SELECT * FROM reviews WHERE parent_id $condition ORDER BY created_at DESC";
                                        $result = $conn->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<div style='margin-left:".($level*30)."px;border-left:2px solid #ccc;padding:10px;margin-bottom:10px;'>";
                                            echo "<strong>{$row['name']}</strong> ({$row['rating']}⭐) <br>";
                                            echo "<p>{$row['comment']}</p>";
                                            echo "<small>{$row['created_at']}</small>";

                                            // Reply Form
                                            echo "<form action='add_review.php' method='POST' class='mt-2'>";
                                            echo "<input type='hidden' name='parent_id' value='{$row['id']}'>";
                                            echo "<input type='text' name='name' class='form-control mb-2' placeholder='Your Name' required>";
                                            echo "<input type='email' name='email' class='form-control mb-2' placeholder='Your Email'>";
                                            echo "<textarea name='comment' class='form-control mb-2' rows='2' placeholder='Reply...' required></textarea>";
                                            echo "<button type='submit' class='btn btn-sm btn-primary'>Reply</button>";
                                            echo "</form>";

                                            // Recursive fetch
                                            fetchReviews($row['id'], $conn, $level + 1);
                                            echo "</div>";
                                        }
                                    }
                                    fetchReviews(NULL, $conn);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </div>
                <!-- End Container -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <p class="mini_text" style="color:black">©2024 Srinivasa Dental . All Rights Reserved. Designed by <a href="https://bhavicreations.com/" target="_blank" style="text-decoration:none;color:black">Bhavi Creations</a></p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

</body>
</html>
