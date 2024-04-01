<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>
<?php include(SHARED_PATH . '/admins_header.php'); ?>
<?php
// Check if the user is logged in
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../login.php"); // Redirect to login page if not logged in
    exit;
}

$customerName = "Guest"; // Default name in case something goes wrong

if(isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];

    // Fetch the customer's name from the database
    $stmt = $db->prepare("SELECT customer_first_name, customer_last_name FROM customer WHERE customer_id = ?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Concatenate the first and last name
        $customerName = $row['customer_first_name'];
    }

    $stmt->close();
}
?>

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Total Order</h5>
    <h6 class="card-subtitle mb-2 text-muted">Summary</h6>
    <p class="card-text">
      Total Items: <?php echo $total_items; ?><br>
      Total Price: $<?php echo $total_price; ?><br>
      <!-- Add more order summary details as needed -->
    </p>
  </div>
</div>












