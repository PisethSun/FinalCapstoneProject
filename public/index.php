<?php require_once('../private/initialize.php');?>
<?php $page_title = 'Welcome You';?>
<?php include(SHARED_PATH .'/public_header.php');?>


<section class="products">
<section class="pgallery">

   <h1 class="title" > Welcome to <?=APP_NAME?>  </h1>
   <p class= "titlep"> SEE ALL WE HAVE TO OFFER & MORE</p>
</section>

</section>



<div class="home-bg">

   <section class="home">





<video src="video/nail.mp4" width="1800" height="1200" loop muted playsinline uk-video="autoplay: inview"></video>


   </section>

</div>
<hr class="uk-divider-vertical">
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
                <img src="<?php echo url_for('/images/store.jpg');?>" width="1800" height="1200" alt="">
            </div>
        </div>
    </div>
</div>

</div>
<hr class="uk-divider-icon">
<div class="uk-container uk-container-large uk-align-center">
<div class="uk-child-width-1-2@s uk-text-center uk-align-center uk-flex" >
   
        <div class="uk-background-secondary uk-light uk-padding uk-panel" style="color:black;">
            <p class="uk-h4 uk-align-center">Treat Yourself Today</p>
            <p uk-margin>
     <button onclick="location.href='?<?php url_for('/login.php');?>" class="uk-button uk-button-secondary uk-button-large ">BOOK AN APPOINTMENT</button>
     
     
    
</p>

 
        </div>
        
         <div class="uk-background-secondary uk-light uk-padding uk-panel" style="color:black;">
            <p class="uk-h4 uk-align-center">Sign Up Today</p>
          <p uk-margin>
   <p uk-margin>
     <button onclick="location.href='<?php echo url_for('/register.php');?>" class="uk-button uk-button-secondary uk-button-large ">Sign Up Today</button>
</p>

 
        </div>
    </div>
</div>




</div>

<hr class="uk-divider-icon">
<!-- UL Slider -->

<div class="uk-container uk-container-large">

<div class="uk-child-width-1-2@m" uk-grid>
    <div>
        <div class="uk-card uk-card-default">
            <div class="uk-card-media-top">
                <img src="<?php echo url_for('/images/sliderPic.jpg');?>" width="630" height="420" alt="">
            </div>
            <div class="uk-card-body">
                <h1 class="uk-card-title uk-text-bolder" style="font-size: 30px">Our Services</h1>
                <p style="font-size: 25px">
Embark on a journey of opulent nail care at  <?=APP_NAME?>. Our services are meticulously crafted, providing an experience that transcends traditional pampering. Immerse yourself in a carefully curated selection of high-quality products, ensuring enduring beauty and optimal nail health. From precision manicures to lavish pedicures, each service at Crystal's is a celebration of individual style and self-love. </p>
            </div>
        </div>
    </div>
    <div>
        <div class="uk-card uk-card-default">
            <div class="uk-card-body">
                 <h1 class="uk-card-title uk-text-bolder" style="font-size: 30px">Your Experince is Important To Us</h1>
                
                <p style="font-size: 25px">
Experience the pinnacle of nail care at <?=APP_NAME?>. Our services blend expertise with indulgence, offering a range of treatments that cater to your every nail need. Immerse yourself in a world of quality products, curated to enhance and nourish your nails. Step into elegance and let our services redefine your nail journey. Discover the art of exquisite nail care at <?=APP_NAME?>.</p>
            </div>
            <div class="uk-card-media-bottom">
                <img src="<?php echo url_for('/images/sliderPic2.jpg');?>" width="630" height="420" alt="">
            </div>
        </div>
    </div>
</div>
</div>
<!--end of slider-->

<hr class="uk-divider-icon ">

<div class="uk-container uk-container-xlarge" style="background-color: aliceblue;"></p>">
<h1 class="uk-h4 uk-align-center uk-text-bolder" style="font-size: 35px; text-align: center;">They're Talking</h1>
<div class="uk-child-width-expand@s uk-text-center" uk-grid uk-height-match="target: > div > .uk-card">
    <div>
      <div class="uk-card uk-card-default uk-card-body"><p style="font-size: 20px">“Services are SUPERB! Now with COVID-19, the staff checks your temperature and direct you to wash your hands before receiving services. All nail tools are new and only used once per customer. Appointments can be made via phone or their website.”
    — MARLENNE E.</p></div>
     </div>
    <div>
      <div class="uk-card uk-card-default uk-card-body"> <p  style="font-size: 20px">“This is by far the best nail salon in Westchester County. I can confidently say that between myself and my three sisters we have visited 50 nail salons over the years and Nail Spa blows them all away.”
— LIANNA K. </p></div>
    </div>
    <div>
      <div class="uk-card uk-card-default uk-card-body"><p style="font-size: 20px">“I LOVED this nail salon! It was modern, clean, and sanitation forward during the pandemic. They have endless options of nail preferences, colors, and types of manicures. The receptionist is super sweet and has knowledge of all the different types of services offered. Sue did my nails and did EXACTLY what I asked for! She was efficient and thorough and my nails came out awesome!! Definitely a 10/10 would recommend!”
— AMY C. </p></div>
    </div>
</div>

</div>
<script src="js/script.js"></script>

<hr class="uk-divider-icon ">

<?php include(SHARED_PATH .'/public_footer.php');?>

   


