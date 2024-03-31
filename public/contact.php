<?php require_once('../private/initialize.php');?>
<?php $page_title = 'Contact Us '; ?>
<?php include(SHARED_PATH .'/public_header.php');?>




<div class="uk-container uk-container text-center">
    <h1 class="title" style="font-size:50px; font-family: 'Faustina', serif;">FEEL FREE TO CONTACT US</h1>
    <h1 style="font-size:20px;font-family: 'Faustina', serif;">Our information Below</h1>

    <div class="d-flex flex-wrap justify-content-center">
        <!-- Added 'me-lg-5' for right margin on large screens -->
        <div class="col-lg-4 col-md-6 mb-4 mb-md-0 fs-3 text-center me-lg-5">
            <h5 class="text-uppercase mb-4">Opening hours</h5>
            <table class="table text-center text-white">
                <tbody class="font-weight-normal fs-3">
                    <tr>
                        <td>Mon - Thu:</td>
                        <td>10am - 7pm</td>
                    </tr>
                    <tr>
                        <td>Fri - Sat:</td>
                        <td>10am - 6pm</td>
                    </tr>
                    <tr>
                        <td>Sunday:</td>
                        <td>10am - 4pm</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 mb-md-0 fs-3">
            <div class="form-outline form-white mb-4">
                <input type="text" id="formControlLg" class="form-control form-control-lg" />
            </div>

            <ul class="fa-ul" style="margin-left: 1.65em;">
                <li class="mb-3">
                    <span class="fa-li"><i class="fas fa-home"></i></span><span class="ms-2">30 Boston St #5, Lynn, MA 01904</span>
                </li>
                <li class="mb-3">
                    <span class="fa-li"><i class="fas fa-envelope"></i></span><span class="ms-2"><a href="mailto:<?=APP_EMAIL?>"><?=APP_EMAIL?></a></span>
                </li>
                <li class="mb-3">
                    <span class="fa-li"><i class="fas fa-phone"></i></span><span class="ms-2">+ (781) 592-0992</span>
                </li>
            </ul>
        </div>
    </div>
</div>

 
 


   <div class="box-container">
      <section class="products">
<section class="pgallery">

   <h1 class="title" style="font-family: 'Faustina', serif;"> You can find  <?=APP_NAME?> at Location Below </h1>
  
</section>
<div class="map" style="width:100%; height: 100vh; display: flex; align-items: center; justify-content: center; flex-direction: column; overflow: hidden; padding-bottom: 56.25%;position: relative;height: 100;">
   
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2942.602000004859!2d-70.95823012388458!3d42.478752771182116!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e36d2f3a4feab1%3A0xb62e9630bc875f5b!2sCrystal%20Nails%20%26%20Spa!5e0!3m2!1sen!2sus!4v1696345659125!5m2!1sen!2sus" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" style="width:120%; height: 800px; height: 100%;width: 100%;position: absolute;"></iframe>

</div>

</section>

   </div>




    <?php include(SHARED_PATH .'/public_footer.php');?>