<div class="button-container">
  <!-- Phone Button -->
  <a href="tel:123-456-7890" class="button" title="Call us!">
    <span class="icon">📞</span>
  </a>
<noscript>Enable JavaScript to ensure <a href="https://userway.org">website accessibility</a></noscript>

  
  <!-- Google Translate Widget -->
  <div id="google_translate_element"></div>
</div>

<!-- Google Translate Script -->
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
  }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<!-- UserWay Accessibility Widget Script -->
<script>
(function(){
  var s = document.createElement("script");
  s.setAttribute("data-account", "CAQ9sEFDAm");
  s.setAttribute("src", "https://cdn.userway.org/widget.js");
  document.body.appendChild(s);
})();
</script>


<footer class="text-white text-center text-lg-start bg-light.bg-gradient fs-3">
    <!-- Grid container -->
    <div class="container p-4 ">
      <!--Grid row-->
      <div class="row mt-4">
        <!--Grid column-->
        <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
          <h5 class="text-uppercase mb-4"><?=APP_NAME?></h5>
  
          <p>
           Our main priority is you
          </p>
  
          <p>
            Book an appointment today or Give Us a call
          </p>
  
          <div class="mt-4">
            <!-- Facebook -->
            <a type="button " class="btn btn-floating btn-primary btn-lg src =" onclick="location.href=' https://www.facebook.com/p/Crystal-Nails-Spa-100066426356961/';"><i class="fab fa-facebook-f"></i></a>
            
           
           
            <!-- Instagram + -->
         
            
             <a type="button " class="btn btn-floating btn-primary btn-lg src =" onclick="location.href=' https://www.instagram.com/crystalnailslynn/?hl=en';"><i class="fab fa-instagram"></i></a>
            <!-- Linkedin -->
          </div>
        </div>
        <!--Grid column-->
  
        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4 mb-md-0 fs-5">
         
          <div class="form-outline form-white mb-4">
            <input type="text" id="formControlLg" class="form-control form-control-lg" />
           
          </div>
  
          <ul class="fa-ul" style="margin-left: 1.65em; ">
         
      
        
            <li class="mb-3">
              <span class="fa-li"><i class="fas fa-home"></i></span><span class="ms-2">30 Boston St #5, Lynn, MA 01904</span>
            </li>
            <li class="mb-3">
              <span class="fa-li"><i class="fas fa-envelope"></i></span><span class="ms-2">info@example.com</span>
            </li>
            <li class="mb-3">
              <span class="fa-li"><i class="fas fa-phone"></i></span><span class="ms-2">+ (781) 592-0992</span>
            </li>
           
          </ul>
        </div>
        <!--Grid column-->
  
        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4 mb-md-0 fs-1">
          <h5 class="text-uppercase mb-4">Opening hours</h5>
  
          <table class="table text-center text-white ">
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
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>




    <p id="copyright" style="text-align: center; line-height:80px; " >© Helen's Nails & Spa, 2024</p>


    </footer>

    <?php db_disconnect($db);?>
