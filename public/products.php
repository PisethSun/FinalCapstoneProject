<?php require_once('../private/initialize.php');?>
<?php $page_title = 'Explore Our Products'; ?>
<?php include(SHARED_PATH .'/public_header.php');?>


<div class="uk-height-medium uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light uk-height-large" data-src="images/homebackground.jpg" uk-img="loading: eager">
    
    <div class="uk-container uk-text-center uk-text-large">
  <h1 class =" uk-text-bold" >SELF-LOVE CLUB</h1>
  
   <h1 class =" uk-text-bold uk-text-capitalize " style="font-size: 35px; color: #7743DB;" >Bringing fashion to</h1>
   
<h1 class =" uk-text-bolder uk-text-capitalize " style="font-size: 35px; color: #7743DB;" > your fingertips.</h1>
<p uk-margin>
     <button onclick="location.href='login.php';" class="uk-button uk-button-secondary uk-button-large ">BOOK AN APPOINTMENT</button>
</p>

</div>
  
</div>
<hr class="uk-divider-icon">
<!-- UL Slider -->

<div class="uk-container uk-container-large">

<div class="uk-child-width-1-2@m" uk-grid>
    <div>
        <div class="uk-card uk-card-default">
            <div class="uk-card-media-top">
                <img src="images/productImg.jpeg" width="630" height="420" alt="">
            </div>
            <div class="uk-card-body">
                <h1 class="uk-card-title uk-text-bolder" style="font-size: 20px">Our Services</h1>
                <p style="font-size: 25px">
Embark on a journey of opulent nail care at  <?=APP_NAME?>. Our services are meticulously crafted, providing an experience that transcends traditional pampering. Immerse yourself in a carefully curated selection of high-quality products, ensuring enduring beauty and optimal nail health. From precision manicures to lavish pedicures, each service at Crystal's is a celebration of individual style and self-love. </p>
            </div>
        </div>
    </div>
    <div>
        <div class="uk-card uk-card-default">
            <div class="uk-card-body">
                 <h1 class="uk-card-title uk-text-bolder" style="font-size: 20px">Your Experince is Important To Us</h1>
                
                <p style="font-size: 25px">
Experience the pinnacle of nail care at <?=APP_NAME?>. Our services blend expertise with indulgence, offering a range of treatments that cater to your every nail need. Immerse yourself in a world of quality products, curated to enhance and nourish your nails. Step into elegance and let our services redefine your nail journey. Discover the art of exquisite nail care at <?=APP_NAME?>.</p>
            </div>
            <div class="uk-card-media-bottom">
                <img src="images/productImg2.jpeg" width="630" height="420" alt="">
            </div>
        </div>
    </div>
</div>
</div>
<!--end of slider-->


 <h1 class="title uk-text-bold"><?=APP_PINK?></h1>

<div class="uk-container uk-container-small">

<div class="uk-slider-container-offset" uk-slider>

<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">
    <ul class="uk-slider-items uk-child-width-1-2@s uk-grid">
        <?php
        $directory = "images/galleryImages"; 
        $images = glob($directory . "/*.{jpg,jpeg,png,gif}", GLOB_BRACE); 

        foreach ($images as $image) {
        ?>
            <li>
                <div class="uk-card uk-card-default uk-animation-scale-down">
                    <div class="uk-card-media-top uk-animation-scale-down uk-animation-slide-bottom-small">
                        <img class="uk-text-center" src="<?= $image; ?>" width="730" height="520" alt="">
                    </div>
                    <div class="uk-card-body">
                        <p>
                            <input type="hidden" name="p_image" value="<?= $image; ?>">
                        </p>
                    </div>
                </div>
            </li>
        <?php
        }
        ?>
    </ul>
</div>



    <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>

</div>
</div>


<script src="js/script.js"></script>
<hr class="uk-divider-icon">
   <div class="uk-container">
<div class="uk-child-width-1-2@m" uk-grid>
    <div>
        <div class="uk-card uk-card-default">
            <div class="uk-card-media-top">
                <img src="images/store2.jpg" width="730" height="520" alt="">
            </div>
            <div class="uk-card-body">
                <h1  class="uk-card-title uk-text-bolder" style="font-size: 20px">Our Office</h1>
                <p  style="font-size:20px;">
Step into a world of pristine beauty at <?=APP_NAME?>. Our nail salon is not just a space for impeccable manicures and pedicures; it's a commitment to cleanliness and hygiene. Your safety is our priority, and our immaculate office reflects that dedication. We adhere to the highest industry standards, maintaining a spotless environment to ensure your well-being. Our tools are sterilized, and our staff follows stringent hygiene protocols. Revel in the luxury of a clean, serene atmosphere where you can relax and enjoy a flawless nail experience. At <?=APP_NAME?>, we redefine beauty with cleanliness, ensuring your visit is as refreshing as your stunning nails.</p>
            </div>
        </div>
    </div>
    <div>
        <div class="uk-card uk-card-default">
            <div class="uk-card-body">
                <h1  class="uk-card-title uk-text-bolder" style="font-size: 20px;">Luxury Ambersphere</h1>
                <p style="font-size:20px;">
Indulge in a haven of hygiene and tranquility at <?=APP_NAME?>. Our nail salon goes beyond beauty – it's a sanctuary of cleanliness and order. Immerse yourself in a spotless office where every surface gleams, and every tool is meticulously sanitized. We pride ourselves on upholding the highest standards of cleanliness, creating an environment where you can unwind with confidence. Your well-being is paramount to us, and our commitment to a pristine space reflects that. Discover the perfect blend of luxury and cleanliness at <?=APP_NAME?>, where each visit promises not just flawless nails, but an experience of pure serenity.</p>
            </div>
            <div class="uk-card-media-bottom">
                <img src="images/store.jpg" width="1800" height="1200" alt="">
            </div>
        </div>
    </div>
</div>

</div>

<script src="js/script.js"></script>
<hr class="uk-divider-icon ">


    <?php include(SHARED_PATH .'/public_footer.php');?>