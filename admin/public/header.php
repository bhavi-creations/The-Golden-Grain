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

        <?php include 'sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include 'navbar.php'; /* Assuming you have navbar.php */ ?>
                ```
                > **Note:** I've added a PHP check (`<?php if (isset($page_header_content)) {
                                                            echo $page_header_content;
                                                        } ?>`) in the `

                <head>`. This is an advanced technique that lets you define variables *before* including `header.php` to inject page-specific CSS or scripts into the head section when needed.

                    ---

                    ## 2. 🏠 Updated Index File (`index.php`)

                    Your `index.php` is now extremely compact and clean!

                    ### `C:\xampp\htdocs\Admin-penal-ready\admin\public\index.php` (UPDATED)

                    ```php
                    <?php
                    // 1. Database Connection (Index page doesn't strictly need it unless fetching dynamic data)
                    // include '../../db_connect/db_connect.php'; 

                    // 2. Include Header (Contains <!DOCTYPE html> up to <?php include 'navbar.php'; 
                    ?>)
                    include 'header.php';

                    // 3. Optional: Define page-specific CSS if needed (Uncomment and add if you need custom styles on this page)
                    /*
                    $page_header_content = '
                    <style>
                        .card-custom {
                            margin: 6px;
                        }
                    </style>';
                    */
                    ?>

                    <div class="container-fluid">

                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        </div>

                        <div class="row">

                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    TOTAL BLOGS</div>
                                                <div class="h5 mb-0 font-weight-bold ">@ 10</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-blog fa-2x text-primary"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    TOTAL VIDEOS</div>
                                                <div class="h5 mb-0 font-weight-bold ">@ 10</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-video fa-2x text-success"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">TOTAL PHOTOS
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold ">@ 10</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-image fa-2x text-info"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <style>
                                .card-custom {
                                    margin: 6px;
                                }
                            </style>
                            <div class="container">
                                <div class="row">
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <h2 class="h2 mb-0 text-info mx-2">Recently Published Blogs</h2>
                                    </div>
                                    <div class="row row-custom no-gutters">
                                        <div class="col-12 col-md-4 col-custom">
                                            <div class="card card-custom">
                                                <img style='height:200px; object-fit: cover;' src="https://via.placeholder.com/300x200?text=Blog+Image+1" class="card-img-top p-2" alt="Blog Image 1">
                                                <div class="card-body">
                                                    <h5 class="card-title" style='color:black;'>Blog title</h5>
                                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                    <a href="#" class="btn btn-warning">Edit Blog</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-custom">
                                            <div class="card card-custom">
                                                <img style='height:200px; object-fit: cover;' src="https://via.placeholder.com/300x200?text=Blog+Image+2" class="card-img-top p-2" alt="Blog Image 2">
                                                <div class="card-body">
                                                    <h5 class="card-title" style='color:black;'>Blog title</h5>
                                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                    <a href="#" class="btn btn-warning">Edit Blog</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 col-custom">
                                            <div class="card card-custom">
                                                <img style='height:200px; object-fit: cover;' src="https://via.placeholder.com/300x200?text=Blog+Image+3" class="card-img-top p-2" alt="Blog Image 3">
                                                <div class="card-body">
                                                    <h5 class="card-title" style='color:black;'>Blog title</h5>
                                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                    <a href="#" class="btn btn-warning">Edit Blog</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php include 'footer.php'; ?>