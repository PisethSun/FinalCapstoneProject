<?php
session_start();
include '../db.php'; // Adjust path as necessary

// Ensure user is logged in and has a customer ID in session
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['customer_id'])) {
    header("location: ../login.php"); // Redirect to login page if not logged in
    exit;
}

$customer_id = $_SESSION['customer_id'];

// Fetch invoice details including technician, task, and price
$query = "SELECT i.invoice_id, i.invoice_date, i.invoice_status, e.employee_first_name, e.employee_last_name, t.task_name, t.task_description, t.task_price, t.task_estimate_time
          FROM invoice i
          JOIN reservation r ON i.reservation_id = r.reservation_id
          JOIN employee e ON r.employee_id = e.employee_id
          JOIN selected_tasks st ON r.reservation_id = st.reservation_id
          JOIN task t ON st.task_id = t.task_id
          WHERE r.customer_id = ?";

$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display invoice details
        echo "Invoice ID: " . $row['invoice_id'] . "<br>";
        echo "Date: " . $row['invoice_date'] . "<br>";
        echo "Status: " . $row['invoice_status'] . "<br>";
        echo "Technician: " . $row['employee_first_name'] . " " . $row['employee_last_name'] . "<br>";
        echo "Task: " . $row['task_name'] . "<br>";
        echo "Description: " . $row['task_description'] . "<br>";
        echo "Price: $" . $row['task_price'] . "<br>";
        echo "Estimated Time: " . $row['task_estimate_time'] . "<br><br>";
    }

    // Calculate total price
    $totalQuery = "SELECT SUM(t.task_price) AS total_price
                   FROM invoice i
                   JOIN reservation r ON i.reservation_id = r.reservation_id
                   JOIN selected_tasks st ON r.reservation_id = st.reservation_id
                   JOIN task t ON st.task_id = t.task_id
                   WHERE r.customer_id = ?";
    $totalStmt = $mysqli->prepare($totalQuery);
    $totalStmt->bind_param("i", $customer_id);
    $totalStmt->execute();
    $totalResult = $totalStmt->get_result();
    $totalRow = $totalResult->fetch_assoc();

    echo "Total Price: $" . $totalRow['total_price'];
} else {
    echo "No invoices found.";
}

$stmt->close();
$totalStmt->close();
$mysqli->close();
?>
