<?php include 'header.php'; ?>

<div class="breadcrubs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcurbs-inner text-center">
                    <h3 class="breadcrubs-title">
                        Rooms
                    </h3>
                    <ul>
                        <li><a href="index.php">home <span>//</span> </a></li>
                        <li>Rooms</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .room_section {
        margin-top: 40px !important;
    }

    .card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        position: relative;
        transition: transform 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .price-tag {
        position: absolute;

        bottom: 10px;
        left: 10px;
        background: #451107;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
    }

    .discount-tag {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #e74c3c;
        color: #fff;
        padding: 5px 8px;
        font-size: 12px;
        border-radius: 5px;
    }

    .card-content {
        padding: 15px;
    }

    .card-content h3 {
        margin: 0 0 10px 0;
        font-weight: 900 !important; 
      
    }

    .features {
        display: flex;
        gap: 10px;
        font-size: 14px;
        color: #555;
        margin-bottom: 10px;
    }

    .features i {
        margin-right: 5px;
        font-weight: 900 !important;
    }

    .reviews {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 10px;
    }

    .reviews span {
        font-size: 14px;
        color: #777;
    }

    .card-content a {
        text-decoration: none;
        color: #000;
        font-weight: bold;
        font-size: 14px;
    }

    .stars {
        color: #f1c40f;
    }
</style>
</head>

<body>




    <div class="about-title text-center  room_section py-5">
        <h2> Luxury Rooms</h2>
    </div>
    <div class="card-container container">

        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 py-2">

                <div class="card">
                    <img src="images/rooms/1.jpg" alt="Luxury Suite">
                    <div class="price-tag">From $90 / night</div>
                    <div class="card-content">
                        <h3>Luxury Suite</h3>
                        <div class="features">
                            <div><i class="fa fa-bed"></i>1 King Bed</div>
                            <div><i class="fa fa-users"></i>4 Guests</div>
                        </div>
                        <div class="reviews">
                            <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span>1 Review</span>
                        </div>
                        <a href="#">BOOK NOW <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 py-2">
                <div class="card">
                    <img src="images/rooms/2.jpg" alt="Standard Deluxe" class="img-fluid text-center">
                    <div class="price-tag">From $75 / night</div>
                    <div class="card-content">
                        <h3>Standard Deluxe</h3>
                        <div class="features">
                            <div><i class="fa fa-bed"></i>2 Single Beds</div>
                            <div><i class="fa fa-users"></i>6 Guests</div>
                        </div>
                        <div class="reviews">
                            <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-alt"></i>
                            </div>
                            <span>2 Reviews</span>
                        </div>
                        <a href="#">BOOK NOW <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>



            <div class="col-12 col-md-6 col-lg-4 py-2">
                <div class="card">
                    <img src="images/rooms/2.jpg" alt="Standard Deluxe" class="img-fluid text-center">
                    <div class="price-tag">From $75 / night</div>
                    <div class="card-content">
                        <h3>The Penthouse</h3>
                        <div class="features">
                            <div><i class="fa fa-bed"></i>2 Single Beds</div>
                            <div><i class="fa fa-users"></i>6 Guests</div>
                        </div>
                        <div class="reviews">
                            <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-alt"></i>
                            </div>
                            <span>2 Reviews</span>
                        </div>
                        <a href="#">BOOK NOW <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>


           




            <div class="col-12 col-md-6 col-lg-4 py-2">

                <div class="card">
                    <img src="images/rooms/r1.webp" alt="Luxury Suite">
                    <div class="price-tag">From $90 / night</div>
                    <div class="card-content">
                        <h3>Luxury Suite</h3>
                        <div class="features">
                            <div><i class="fa fa-bed"></i>1 King Bed</div>
                            <div><i class="fa fa-users"></i>4 Guests</div>
                        </div>
                        <div class="reviews">
                            <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span>1 Review</span>
                        </div>
                        <a href="#">BOOK NOW <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 py-2">
                <div class="card">
                    <img src="images/rooms/r2.webp" alt="Standard Deluxe">
                    <div class="price-tag">From $75 / night</div>
                    <div class="card-content">
                        <h3>Standard Deluxe</h3>
                        <div class="features">
                            <div><i class="fa fa-bed"></i>2 Single Beds</div>
                            <div><i class="fa fa-users"></i>6 Guests</div>
                        </div>
                        <div class="reviews">
                            <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-alt"></i>
                            </div>
                            <span>2 Reviews</span>
                        </div>
                        <a href="#">BOOK NOW <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 py-2">
                <div class="card">
                    <img src="images/rooms/r3.webp" alt="Standard Deluxe" class="img-fluid text-center">
                    <div class="price-tag">From $75 / night</div>
                    <div class="card-content">
                        <h3>The Penthouse</h3>
                        <div class="features">
                            <div><i class="fa fa-bed"></i>2 Single Beds</div>
                            <div><i class="fa fa-users"></i>6 Guests</div>
                        </div>
                        <div class="reviews">
                            <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-alt"></i>
                            </div>
                            <span>2 Reviews</span>
                        </div>
                        <a href="#">BOOK NOW <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>




            <div class="col-12 col-md-6 col-lg-4 py-2">

                <div class="card">
                    <img src="images/rooms/r4.webp" alt="Luxury Suite">
                    <div class="price-tag">From $90 / night</div>
                    <div class="card-content">
                        <h3>Luxury Suite</h3>
                        <div class="features">
                            <div><i class="fa fa-bed"></i>1 King Bed</div>
                            <div><i class="fa fa-users"></i>4 Guests</div>
                        </div>
                        <div class="reviews">
                            <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span>1 Review</span>
                        </div>
                        <a href="#">BOOK NOW <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 py-2">
                <div class="card">
                    <img src="images/rooms/r5.webp" alt="Standard Deluxe">
                    <div class="price-tag">From $75 / night</div>
                    <div class="card-content">
                        <h3>Standard Deluxe</h3>
                        <div class="features">
                            <div><i class="fa fa-bed"></i>2 Single Beds</div>
                            <div><i class="fa fa-users"></i>6 Guests</div>
                        </div>
                        <div class="reviews">
                            <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-alt"></i>
                            </div>
                            <span>2 Reviews</span>
                        </div>
                        <a href="#">BOOK NOW <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 py-2">
                <div class="card">
                    <img src="images/rooms/r6.webp" alt="Standard Deluxe" class="img-fluid text-center">
                    <div class="price-tag">From $75 / night</div>
                    <div class="card-content">
                        <h3>The Penthouse</h3>
                        <div class="features">
                            <div><i class="fa fa-bed"></i>2 Single Beds</div>
                            <div><i class="fa fa-users"></i>6 Guests</div>
                        </div>
                        <div class="reviews">
                            <div class="stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-alt"></i>
                            </div>
                            <span>2 Reviews</span>
                        </div>
                        <a href="#">BOOK NOW <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

        </div>





    </div>
    <!-- <div class="read-more">
        <a>read more</a>
    </div> -->

    <?php include 'footer.php';  ?>