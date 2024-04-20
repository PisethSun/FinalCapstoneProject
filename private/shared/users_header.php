<?php require_once('../../private/initialize.php'); ?>

<?php require_login(); ?>

<?php
if(!isset($page_title)) { $page_title = 'Welcome';}
?> 

<?php 

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
   header("location: ../login.php"); // Redirect to login page if not logged in
   exit;
}

$customerName = "Guest"; // Default name in case something goes wrong
$customerEmail = ""; // Default email

if (isset($_SESSION['customer_id'])) {
   $customer_id = $_SESSION['customer_id'];

   // Fetch the customer's information from the database
   $stmt = $db->prepare("SELECT customer_first_name, customer_last_name FROM customer WHERE customer_id = ?");
   $stmt->bind_param("i", $customer_id);
   $stmt->execute();
   $result = $stmt->get_result();

   if ($row = $result->fetch_assoc()) {
       // Assign fetched data to variables
       $customerName = $row['customer_first_name'] ;
      
   }

   $stmt->close();
}

?>
<!DOCTYPE html>

<html lang="en">
<head>  
    <title>Helen's - <?php echo $page_title;?></title>
    <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/css/uikit.min.css" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <!-- font awesome cdn link  -->
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">
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
    <style>
  .button-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
  }

  .button {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 5px;
    padding: 10px;
    background-color: #FFD1E3; /* Adjust color as needed */
    color: black; /* Adjust text color as needed */
    border-radius: 50%; /* This makes it round */
    width: 50px; /* Adjust size as needed */
    height: 50px; /* Adjust size as needed */
    text-decoration: none;
  }

  .button:hover {
    background-color: lightgreen; /* Color when hovered */
  }

  .icon {
    font-size: 20px; /* Adjust icon size as needed */
  }

  .card:hover {
            background-color: #FFD1E3; /* Replace with the shade of purple you prefer */
            transition: background-color 0.3s ease; /* Smooth transition for the color change */
            cursor: pointer; /* Changes the mouse cursor to indicate the item is clickable */
        }
</style>

   
</head>
<body >

<header class="header style:box-shadow:none">

   <div class="flex">
        <nav class="navbar">

        <a href="index.php">Home</a>
         <a href="invoice.php">Invoice</a>
         <a style="background-color: #add8e6; border-radius: 20px; color: white; padding: 5px 20px; text-decoration: none; display: inline-block;" href="reservation.php">Reservation</a>

        

          </nav>

      <a href="index.php" class="logo"><?=APP_NAME?><span>&trade;</span></a>
      <nav class="navbar">
    <a><?php echo "Hi, " . htmlspecialchars($customerName); ?></a>
    <a href="../logout.php">Logout</a>
</nav>

      <?php echo display_session_message();?>

  <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>
   </div>

</header>

