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
 

<script src="js/script.js"></script>

<hr class="uk-divider-icon ">

    <?php include(SHARED_PATH .'/public_footer.php');?>