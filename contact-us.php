     <?php include 'header.php' ?>

     <!--Breadcrubs start-->
     <div class="breadcrubs">
         <div class="container">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="breadcurbs-inner text-center">
                         <h3 class="breadcrubs-title">
                             Contact us
                         </h3>
                         <ul>
                             <li><a href="index.php">home <span>//</span> </a></li>
                             <li>Contact us</li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!--Breadcrubs end-->

     <!--contact us pages start-->
     <div class="contact-us">
         <div class="contact-information text-center ptb-100">
             <div class="container">
                 <div class="row">
                     <div class="col-md-4">
                         <div class="single-contact-information">
                             <div class="contact-icon">
                                 <a><i class="mdi mdi-phone"></i></a>
                             </div>
                             <p>012345678</p>
                             <p>012345678</p>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="single-contact-information">
                             <div class="contact-icon">
                                 <a><i class="mdi mdi-dribbble"></i></a>
                             </div>
                             <p> email@demo.com</p>
                             <p>info@example.com</p>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="single-contact-information">
                             <div class="contact-icon">
                                 <a><i class="mdi mdi-map-marker"></i></a>
                             </div>
                             <p>Address goes here,</p>
                             <p>street,Crossroad123.</p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!--Contact bottom section-->
         <div class="contact-bottom-section ptb-100">
             <div class="bg-img"></div>
             <div class="container-fluid">
                 <div class="row">
                     <div class="col-lg-6 contact-form-div">
                         <div class="contact-form">
                             <div class="contact-form-title">
                                 <h2>Get In Touch</h2>
                             </div>
                             <div class="contact-form-box">
                                 <p class="form-messege"></p>
                                 <form class="ul-inner-contact-form" action="contactform.php" method="post" role="form" class="php-email-form">
                                     <div class="row g-lg-4 g-3 row-cols-sm-2">
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label for="ul-contact-name" class="form-label">Your Name *</label>
                                                 <input type="text" name="name" id="ul-contact-name" placeholder="Full Name">
                                             </div>
                                         </div>
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                                 <label for="ul-contact-email" class="form-label">Your Email *</label>
                                                 <input type="email" name="email" id="ul-contact-email" placeholder="Email Address">
                                             </div>
                                         </div>
                                         <div class="col-sm-12 col-12">
                                             <div class="form-group">
                                                 <label for="ul-contact-subject" class="form-label">Number</label>
                                                 <input type="text" name="number" id="ul-contact-subject" placeholder="Number">
                                             </div>
                                         </div>
                                         <div class="col-sm-12 col-12">
                                             <div class="form-group">
                                                 <label for="ul-contact-message" class="form-label">Message</label>
                                                 <textarea name="message" id="ul-contact-message" placeholder="Messages"></textarea>
                                             </div>
                                         </div>
                                         <div class="col-sm-12 col-12">
                                             <button type="submit" class="ul-btn"> Submit Now <i class="flaticon-arrow-up-right"></i></button>
                                         </div>
                                     </div>
                                 </form>
                             </div>
                         </div>
                     </div>
                     <div class="col-lg-6 map-div">
                         <div id="contact-map" class="map-area">
                             <div id="googleMap" style="width:100%;height:480px;">
                                
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!--Contact bottom section end-->

     </div>
     <!--contact us pages end-->

     <?php include 'footer.php' ?>