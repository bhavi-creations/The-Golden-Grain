<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The Golden Grain</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <?php if (isset($page_header_content)) {
        echo $page_header_content;
    } ?>

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center bg-light text-primary" href="./index.php">
                <div class="sidebar-brand-text mx-3">The Golden Grain</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Blog Management
            </div>

            <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'categories.php') ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-list-alt"></i>
                    <span>Categories</span>
                </a>
            </li>

            <!-- Blogs Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlogs" aria-expanded="true" aria-controls="collapseBlogs">
                    <i class="fas fa-fw fa-blog"></i>
                    <span>Image Uploads</span>
                </a>
                <div id="collapseBlogs" class="collapse" aria-labelledby="headingBlogs" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">image uploads</h6>
                        <a class="collapse-item" href="image_upload.php"><i class="fas fa-fw fa-plus"></i>Image Upload</a>
                        <a class="collapse-item" href="all_image_upload.php"><i class="fas fa-fw fa-list"></i>All Image Upload</a>
                    </div>
                </div>
            </li>






            <!-- PDF Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="index.php" data-toggle="collapse" data-target="#collapsePDFs" aria-expanded="true" aria-controls="collapsePDFs">
                    <i class="fas fa-fw fa-file-pdf"></i>
                    <span>category</span>
                </a>
                <div id="collapsePDFs" class="collapse" aria-labelledby="headingPDFs" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Enter category</h6>
                        <a class="collapse-item" href="newPDF.php"><i class="fas fa-fw fa-upload"></i> Upload category</a>
                        <a class="collapse-item" href="allPDF.php"><i class="fas fa-fw fa-list"></i> All category</a>
                    </div>
                </div>
            </li>




            <li class="nav-item">
                <a class="nav-link collapsed" href="index.php" data-toggle="collapse" data-target="#collapsemenu" aria-expanded="true" aria-controls="collapsePDFs">
                    <i class="fas fa-fw fa-file-pdf"></i>
                    <span>Menu</span>
                </a>
                <div id="collapsemenu" class="collapse" aria-labelledby="headingmenu" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Enter Menu</h6>
                        <a class="collapse-item" href="create_menu_category.php"><i class="fas fa-fw fa-upload"></i> Upload menu category</a>
                        <a class="collapse-item" href="all_menu_categories.php"><i class="fas fa-fw fa-list"></i> All category</a>
                    </div>
                </div>
            </li>





            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include 'navbar.php'; ?>