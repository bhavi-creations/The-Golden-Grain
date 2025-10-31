<?php 
// This file now includes ALL opening HTML tags, body, wrapper, and the sidebar itself.
include 'sidebar.php'; 
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
            .card-custom { margin: 6px; }
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