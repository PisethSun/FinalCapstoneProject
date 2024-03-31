<?php require_once('../../private/initialize.php'); ?>

<?php require_login(); ?>
<?php
if (!is_admin()) {
    redirect_to(url_for('/login.php')); // Or to a 'not authorized' page
    exit;
}
// Check if the user is logged in
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../login.php"); // Redirect to login page if not logged in
    exit;
}

$adminName = "Guest"; // Default name in case something goes wrong

if(isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];

    // Fetch the customer's name from the database
    $stmt = $db->prepare("SELECT customer_first_name, customer_last_name FROM customer WHERE customer_id = ?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Concatenate the first and last name
        $adminName = $row['customer_first_name'];
    }

    $stmt->close();
}
?>
<?php 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helen's Nail Salon</title>
    <link rel="stylesheet" media="all" href="<?php echo url_for('/assets/css/styles.css'); ?>" />
 
</head>
<body>
    <header>
    <h1>Admin: Dashboard - Welcome, <?php echo htmlspecialchars($adminName); ?></h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Update</a></li>
                <li><a href="signup.php">Order</a></li>
                <li><a href="../logout.php">Logout</a></li> <!-- Adjust the path to logout.php as needed -->

                
            </ul>
        </nav>
    </header>

    

