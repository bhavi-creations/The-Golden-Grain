<?php include 'header.php'; ?>


<style>
.card-container {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    justify-content: center;
}

.card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
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

<div class="card-container">

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

    <div class="card">
        <img src="images/rooms/2.jpg" alt="Standard Deluxe">
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

    <div class="card">
        <img src="images/rooms/3.jpg" alt="The Penthouse">
        <div class="price-tag">From <del>$250</del> $200 / night</div>
        <div class="discount-tag">20% OFF</div>
        <div class="card-content">
            <h3>The Penthouse</h3>
            <div class="features">
                <div><i class="fa fa-bed"></i>2 King Beds</div>
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
            <!-- <a href="#">BOOK NOW <i class="fa fa-arrow-right"></i></a> -->
        </div>
    </div>

</div>

<?php include 'footer.php';  ?>


