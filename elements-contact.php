     <?php include 'header.php' ?>

       
        <!--Breadcrubs start-->
        <div class="breadcrubs ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcurbs-inner text-center">
                            <h3 class="breadcrubs-title">
                               Elements
                            </h3>
                            <ul>
                                <li><a href="index.php">home <span>//</span>  </a></li>
                                <li>map</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Breadcrubs end-->
        <!--elements start-->
        <div class="elements ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="contact-form">
                            <div class="contact-form-title">
                                <h2>Get In Touch</h2>
                            </div>
                            <div class="contact-form-box">
                                <form id="contact-form" action="mail.php" method="post">
                                    <p class="form-messege"></p>
                                    <input name="name" type="text" placeholder="Name">
                                    <input name="email" type="text" placeholder="Email">
                                    <textarea name="message" placeholder="Message"></textarea>
                                    <button type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--elements end-->
              <?php include 'footer.php' ?>
