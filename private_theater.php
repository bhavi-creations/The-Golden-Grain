<?php include 'header.php'; ?>
<div class="breadcrubs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcurbs-inner text-center">
                    <h3 class="breadcrubs-title">
                        Private Theater
                    </h3>
                    <ul>
                        <li><a href="index.php">home <span>//</span> </a></li>
                        <li>Private Theater</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="container p-3">
    <div class="about-title text-center room_section mt-5">
        <h2>Private Theater</h2>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 mt-5">
            <div class="img-container">
                <img src="images/theater/1.png" alt="">
                <div class="overlay">Private Theater</div>
            </div>
        </div>
        <div class="col-12 col-md-6 mt-5">
            <div class="img-container">
                <img src="images/theater/2.png" alt="">
                <div class="overlay">Private Theater</div>
            </div>
        </div>
        <div class="col-12 col-md-6 mt-5">
            <div class="img-container">
                <img src="images/theater/3.png" alt="">
                <div class="overlay">Private Theater</div>
            </div>
        </div>
        <div class="col-12 col-md-6 mt-5">
            <div class="img-container">
                <img src="images/theater/4.png" alt="">
                <div class="overlay">Private Theater</div>
            </div>
        </div>
    </div>

    <!-- Popup / Lightbox -->
    <div id="popup" class="popup">
        <span class="close">&times;</span>
        <img class="popup-img" src="" alt="">
    </div>
</div>

<script>
    // Get all images
    const imgContainers = document.querySelectorAll('.img-container');
    const popup = document.getElementById('popup');
    const popupImg = document.querySelector('.popup-img');
    const closeBtn = document.querySelector('.close');

    imgContainers.forEach(container => {
        container.addEventListener('click', () => {
            const imgSrc = container.querySelector('img').src;
            popupImg.src = imgSrc;
            popup.style.display = 'flex'; // ✅ use flex for perfect centering
        });
    });

    closeBtn.addEventListener('click', () => {
        popup.style.display = 'none';
    });

    // Close popup when clicking outside image
    popup.addEventListener('click', (e) => {
        if (e.target === popup) {
            popup.style.display = 'none';
        }
    });
</script>






<?php include  'footer.php'; ?>