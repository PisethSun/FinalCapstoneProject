<?php require_once('../private/initialize.php');?>
<?php $page_title = 'Explore Our Gallery'; ?>
<?php include(SHARED_PATH .'/public_header.php');?>

<section class="products">
<section class="pgallery">

   <h1 class="title" > <?=GALLERY_NAME?>  </h1>
   <p class= "titlep"> SEE ALL WE HAVE TO OFFER & MORE</p>
</section>

</section>

<hr class="uk-divider-vertical">
<hr class="uk-divider-icon">

<div uk-slider>
    
<ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-light uk-grid-collapse uk-text-center">

<?php

$imageDirectory = 'images/galleryImages/*.jpg'; 


$images = glob($imageDirectory);

if (!empty($images)) {
    foreach ($images as $image) {
  
        $imageName = basename($image); 
?>

<li style="margin-left: 10px;" class="uk-transition-toggle" tabindex="0">
    <img src="<?= $image; ?>" width="400" height="450"  overflow: hidden; display: flex; justify-content: center; align-items: center; alt="<?= $imageName; ?>">
 
    <div class="uk-position-center uk-panel uk-text-center"><h1 class="uk-transition-slide-bottom-small"></h1></div>
</li>

<?php
    }
} else {
    echo "<li>No images found.</li>";
}
?>

</ul>

    </ul>

    <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>

</div>

<hr class="uk-divider-icon">
   <div class="uk-container">
<div class="uk-child-width-1-2@m" uk-grid>
    <div>
        <div class="uk-card uk-card-default">
            <div class="uk-card-media-top">
                <img src="<?php echo url_for('/images/store2.jpg');?>" width="730" height="520" alt="">
            </div>
            <div class="uk-card-body">
                <h1  class="uk-card-title uk-text-bolder" style="font-size: 30px">Our Office</h1>
                <p  style="font-size:20px;">
Step into a world of pristine beauty at <?=APP_NAME?>. Our nail salon is not just a space for impeccable manicures and pedicures; it's a commitment to cleanliness and hygiene. Your safety is our priority, and our immaculate office reflects that dedication. We adhere to the highest industry standards, maintaining a spotless environment to ensure your well-being. Our tools are sterilized, and our staff follows stringent hygiene protocols. Revel in the luxury of a clean, serene atmosphere where you can relax and enjoy a flawless nail experience. At <?=APP_NAME?>, we redefine beauty with cleanliness, ensuring your visit is as refreshing as your stunning nails.</p>
            </div>
        </div>
    </div>
    <div>
        <div class="uk-card uk-card-default">
            <div class="uk-card-body">
                <h1  class="uk-card-title uk-text-bolder" style="font-size: 30px;">Luxury Ambersphere</h1>
                <p style="font-size:20px;">
Indulge in a haven of hygiene and tranquility at <?=APP_NAME?>. Our nail salon goes beyond beauty – it's a sanctuary of cleanliness and order. Immerse yourself in a spotless office where every surface gleams, and every tool is meticulously sanitized. We pride ourselves on upholding the highest standards of cleanliness, creating an environment where you can unwind with confidence. Your well-being is paramount to us, and our commitment to a pristine space reflects that. Discover the perfect blend of luxury and cleanliness at <?=APP_NAME?>, where each visit promises not just flawless nails, but an experience of pure serenity.</p>
            </div>
            <div class="uk-card-media-bottom">
                <img src="<?php echo url_for('images/store.jpg');?>" width="1800" height="1200" alt="">
            </div>
        </div>
    </div>
</div>

</div>

<script src="js/script.js"></script>

<hr class="uk-divider-icon ">

    <?php include(SHARED_PATH .'/public_footer.php');?>