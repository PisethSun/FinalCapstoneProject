<?php
session_start();
include '../db.php'; // Adjust the path as needed to point to your db.php

// Check if the user is logged in
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../login.php"); // Redirect to login page if not logged in
    exit;
}

$customerName = "Guest"; // Default name in case something goes wrong

if(isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];

    // Fetch the customer's name from the database
    $stmt = $mysqli->prepare("SELECT customer_first_name, customer_last_name FROM customer WHERE customer_id = ?");
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
</head>
<body>
    <header>
        <h1>Welcome to Your Dashboard</h1>
        <nav>
            <ul>
                <li>Hi, <?php echo htmlspecialchars($customerName); ?></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="invoice.php">Invoices</a></li>
                <li><a href="reservation.php">Reservations</a></li>
                <!-- You can add more navigation links as needed -->
                <li><a href="../logout.php">Logout</a></li> <!-- Adjust the path to logout.php as needed -->
            </ul>
        </nav>
    </header>
    
    <main>
        <p>This is your user dashboard. From here, you can navigate to view your invoices or reservations.</p>
    </main>
</body>
</html>
