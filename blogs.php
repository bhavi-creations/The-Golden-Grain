     <?php include 'header.php' ?>

     <!--Breadcrubs start-->
     <div class="breadcrubs">
         <div class="container">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="breadcurbs-inner text-center">
                         <h3 class="breadcrubs-title">
                             Our blog
                         </h3>
                         <ul>
                             <li><a href="index.php">home <span>//</span> </a></li>
                             <li>Our blog</li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!--Breadcrubs end-->


     <!--our blog section start-->


     <div class="our-blog-pages ptb-80">
         <div class="bg-mg-1">


             <div class="container">

                 <?php
                    // include 'db.connection/db_connection.php';
                    include 'db_connect/db_connect.php';


                    // Fetch categories for dropdown
                    $categories = [];
                    $cat_result = $conn->query("SELECT category_id, category_name FROM category ORDER BY category_name ASC");
                    if ($cat_result->num_rows > 0) {
                        while ($row = $cat_result->fetch_assoc()) {
                            $categories[] = $row;
                        }
                    }

                    // Check if a category filter is applied
                    $selected_category = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

                    // Build query
                    $sql = "SELECT i.*, c.category_name 
        FROM image_uploads i 
        LEFT JOIN category c ON i.category_id = c.category_id";

                    if ($selected_category > 0) {
                        $sql .= " WHERE i.category_id = $selected_category";
                    }

                    $sql .= " ORDER BY i.updated_at DESC";

                    $result = $conn->query($sql);
                    ?>

                 <div class="mb-4">
                     <div class="room_section mt-5">
                         <!-- Blogs Heading + Category Filter in One Row -->
                         <div class="row align-items-center mb-4">
                             <!-- Heading -->
                             <div class="">
                                 <div class="about-title text-center room_section mt-5">
                                     <h2>Blogs</h2>
                                 </div>

                             </div>

                             <!-- Category Dropdown -->
                             <div class=" text-md-end text-start mt-3 mt-md-0">
                                 <form method="GET" id="categoryFilter" class="d-inline-block">
                                     <select name="category_id" class="form-control d-inline-block w-auto"
                                         onchange="document.getElementById('categoryFilter').submit()">
                                         <option value="0">All Categories</option>
                                         <?php foreach ($categories as $cat): ?>
                                             <option value="<?= $cat['category_id'] ?>" <?= ($selected_category == $cat['category_id']) ? 'selected' : '' ?>>
                                                 <?= htmlspecialchars($cat['category_name']) ?>
                                             </option>
                                         <?php endforeach; ?>
                                     </select>
                                 </form>
                             </div>
                         </div>
                     </div>



                 </div>


                 <style>
                     .single-blog {
                         position: relative;
                         overflow: hidden;
                         margin-bottom: 30px;
                     }

                     .single-blog .blog-thumbnail img {
                         width: 100%;
                         height: auto;
                         display: block;
                     }

                     .single-blog .blog-desc {
                         position: absolute;
                         bottom: 0;
                         left: 0;
                         width: 100%;
                         background: #ffffff9e;
                         /* semi-transparent background */
                         color: #000;
                         display: flex;
                         align-items: center;
                         padding: 10px;
                     }

                     .single-blog .publish-date {
                         background: #ff4d4d;
                         /* colored box for date */
                         padding: 5px 8px;
                         text-align: center;
                         margin-right: 10px;
                         font-weight: bold;
                         border-radius: 3px;
                         min-width: 50px;
                     }

                     .single-blog .publish-date p {
                         margin: 0;
                         font-size: 14px;
                         line-height: 1;
                     }

                     .single-blog .publish-date span {
                         display: block;
                         font-size: 12px;
                     }

                     .single-blog .blog-title h3 {
                         margin: 0;
                         font-size: 16px;
                         line-height: 1.2;
                         cursor: pointer;
                     }

                     .plus-btn {
                         color: #000;
                         font-weight: bold;
                         margin-left: 5px;
                         cursor: pointer;
                         font-size: 18px;
                     }
                 </style>

                 <div class="row">
                     <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $image = './admin/public/uploads/photos/' . $row['image'];
                                $title = $row['title'];
                                $date = date('d', strtotime($row['updated_at']));
                                $month = date('M', strtotime($row['updated_at']));

                                $words = explode(' ', $title);
                                $short_title = implode(' ', array_slice($words, 0, 10)); // Show first 10 words
                                $remaining_title = implode(' ', array_slice($words, 10)); // Remaining words
                        ?>
                             <div class="col-lg-4 col-md-6">
                                 <div class="single-blog">
                                     <div class="blog-thumbnail">
                                         <img src="<?= $image ?>" alt="<?= htmlspecialchars($title) ?>">
                                     </div>
                                     <div class="blog-desc">
                                         <div class="publish-date">
                                             <p><?= $date ?><span><?= $month ?></span></p>
                                         </div>
                                         <div class="blog-title">
                                             <h3>
                                                 <?= htmlspecialchars($short_title) ?>
                                                 <?php if (!empty($remaining_title)): ?>
                                                     <!-- <span class="plus-btn">+</span> -->
                                                     <span class="remaining-text" style="display:none;"><?= ' ' . htmlspecialchars($remaining_title) ?></span>
                                                 <?php endif; ?>
                                             </h3>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                     <?php
                            }
                        } else {
                            echo "<p>No images found in this category.</p>";
                        }
                        ?>
                 </div>

                 <script>
                     // Toggle full title on clicking anywhere in the title
                     document.querySelectorAll('.blog-title h3').forEach(function(titleEl) {
                         titleEl.addEventListener('click', function() {
                             const remaining = this.querySelector('.remaining-text');
                             const plusBtn = this.querySelector('.plus-btn');
                             if (remaining) {
                                 if (remaining.style.display === 'none') {
                                     remaining.style.display = 'inline';
                                     plusBtn.textContent = '−'; // Change + to −
                                 } else {
                                     remaining.style.display = 'none';
                                     plusBtn.textContent = '';
                                 }
                             }
                         });
                     });
                 </script>





             </div>
         </div>
     </div>
     <!--our blog section end-->


     <?php include 'footer.php' ?>