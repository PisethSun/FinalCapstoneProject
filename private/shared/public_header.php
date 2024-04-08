
<?php
if(!isset($page_title)) { $page_title = 'Welcome';}
?> 
<!DOCTYPE html>

<html lang="en">
<head>  
    <title>Helen's - <?php echo $page_title;?></title>
    <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/x-icon" href="images/icon/helenlogo.ico">
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/css/uikit.min.css" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <!-- font awesome cdn link  -->
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
      <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      rel="stylesheet"/>
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
      rel="stylesheet"
    />
    <!-- MDB -->
     <link
      href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.css"
      rel="stylesheet"
    />
    
</head>
<body>

<header class="header style:box-shadow:none">

   <div class="flex">
        <nav class="navbar">

           
           <a href="gallery.php">Gallery</a>
           <a href="products.php">Products</a>
           <a href="services.php">Services</a>
           <a href="contact.php">Contact</a>
           
         </nav>
         
         <!-- <a href="index.php" class="logo"><?=APP_NAME?><span>&trade;</span></a> -->
         <a href="index.php" class="logo"><img src="images/icon/helenlogo.png" alt="Helen Logo" style="width: 120px; height: auto;"></a>



      <nav class="navbar">
         <a href="login.php">Login</a>
         <a href="signup.php">Sign Up</a>
    
      

      </nav>

      <?php echo display_session_message();?>

  <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>
   </div>

</header>

