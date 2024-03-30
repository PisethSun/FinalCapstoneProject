<?php require_once('../../private/initialize.php'); ?>
<?php
function displayNoInvoicesFound() {
    echo "You have not made any reservations yet.";
}

function echoInvoiceDetailsWithTime($row) {
    echo "Date: " . $row['invoice_date'] . "<br>";
    echo "Status: " . $row['invoice_status'] . "<br>";
    echo "Technician: " . $row['employee_first_name'] . " " . $row['employee_last_name'] . "<br>";
    echo "Task: " . $row['task_name'] . "<br>";
    echo "Description: " . $row['task_description'] . "<br>";
    echo "Price: $" . $row['task_price'] . "<br>";

    if ($row['task_estimate_time'] < 60) {
        echo "Estimated Time: " . $row['task_estimate_time'] . " mins<br><br>";
    } else {
        $hours = floor($row['task_estimate_time'] / 60);
        $minutes = $row['task_estimate_time'] % 60;
        echo "Estimated Time: " . $hours . " hours ";
        if ($minutes > 0) {
            echo $minutes . " mins";
        }
        echo "<br><br>";
    }
}

// Ensure user is logged in and has a customer ID in session
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../login.php"); // Redirect to login page if not logged in
    exit;
}

$customerName = "Guest"; // Default name in case something goes wrong
$customerEmail = ""; // Default email

if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];

    // Fetch the customer's information from the database
    $stmt = $db->prepare("SELECT customer_first_name, customer_last_name, customer_email FROM customer WHERE customer_id = ?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Assign fetched data to variables
        $customerName = $row['customer_first_name'] . " " . $row['customer_last_name'];
        $customerEmail = $row['customer_email'];
    }

    $stmt->close();
}

// Fetch invoice details including technician, task, and price
$query = "SELECT i.invoice_date, i.invoice_status, e.employee_first_name, e.employee_last_name, t.task_name, t.task_description, t.task_price, t.task_estimate_time
          FROM invoice i
          JOIN reservation r ON i.reservation_id = r.reservation_id
          JOIN employee e ON r.employee_id = e.employee_id
          JOIN selected_tasks st ON r.reservation_id = st.reservation_id
          JOIN task t ON st.task_id = t.task_id
          WHERE r.customer_id = ?";

$stmt = $db->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Invoice</title>
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

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echoInvoiceDetailsWithTime($row);
        }

        // Calculate total price
        $totalQuery = "SELECT SUM(t.task_price) AS total_price
                   FROM invoice i
                   JOIN reservation r ON i.reservation_id = r.reservation_id
                   JOIN selected_tasks st ON r.reservation_id = st.reservation_id
                   JOIN task t ON st.task_id = t.task_id
                   WHERE r.customer_id = ?";
        $totalStmt = $db->prepare($totalQuery);
        $totalStmt->bind_param("i", $customer_id);
        $totalStmt->execute();
        $totalResult = $totalStmt->get_result();
        $totalRow = $totalResult->fetch_assoc();

        // Display total price if invoices are found
        if ($totalRow['total_price'] !== null) {
            echo "<p>Total Price: $" . $totalRow['total_price'] . "</p>";
        }
    } else {
        displayNoInvoicesFound();
    }

    $stmt->close();
    if (isset($totalStmt)) {
        $totalStmt->close();
    }
    $db->close();
    ?>
</main>
</body>
</html>
