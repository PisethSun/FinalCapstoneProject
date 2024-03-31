<?php require_once('../../private/initialize.php'); ?>

<?php include(SHARED_PATH . '/admins_header.php'); ?>

<?php
// Ensure user is logged in as an admin
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

function displayNoInvoicesFound() {
    echo "No invoices found.";
}

function echoInvoiceDetailsWithTime($row) {
    echo "<tr>";
    echo "<td>" . $row['invoice_id'] . "</td>";
    echo "<td>" . $row['customer_name'] . "</td>";
    echo "<td>" . $row['invoice_date'] . "</td>";
    echo "<td>" . $row['invoice_status'] . "</td>";
    echo "<td>" . $row['task_name'] . "</td>";
    echo "<td>" . $row['task_description'] . "</td>";
    echo "<td>" . $row['task_price'] . "</td>";
    echo "<td>" . $row['task_estimate_time'] . "</td>";
    echo "<td>";
    echo "<form action='update_invoice_status.php' method='post'>";
    echo "<input type='hidden' name='invoice_id' value='" . $row['invoice_id'] . "'>";
    echo "<select name='invoice_status'>";
    echo "<option value='Accept'>Accept</option>";
    echo "<option value='Decline'>Decline</option>";
    echo "</select>";
    echo "<button type='submit' name='submit'>Update</button>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}

// Fetch invoice details including customer, task, and price
$query = "SELECT i.invoice_id, CONCAT(c.customer_first_name, ' ', c.customer_last_name) AS customer_name, i.invoice_date, i.invoice_status, t.task_name, t.task_description, t.task_price, t.task_estimate_time
          FROM invoice i
          JOIN reservation r ON i.reservation_id = r.reservation_id
          JOIN customer c ON r.customer_id = c.customer_id
          JOIN selected_tasks st ON r.reservation_id = st.reservation_id
          JOIN task t ON st.task_id = t.task_id";

$result = mysqli_query($db, $query);
if (!$result) {
    exit("Database query failed."); // Handle the error appropriately
}

$done_query = "SELECT * FROM invoice"; // Adjust the query as needed
$done_result = mysqli_query($db, $done_query);
if (!$done_result) {
    exit("Database query failed."); // Handle the error appropriately
}
?>

<div class="container">
    <h2>Invoices</h2>
    <table>
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Status</th>
                <th>Task</th>
                <th>Description</th>
                <th>Price</th>
                <th>Estimate Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echoInvoiceDetailsWithTime($row);
                }
            } else {
                displayNoInvoicesFound();
            }
            mysqli_free_result($result);
            ?>
        </tbody>
    </table>
</div>

<div class="container">
    <!-- Display invoices marked as "Done" in a separate table -->

    <h1>Approved Invoices</h1>
    <table>
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Date</th>
                <th>Status</th>
                <!-- Add more table headers as needed -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch and display invoices marked as "Done"
            while ($row = $done_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['invoice_id']}</td>";
                // echo "<td>{$row['customer_first_name']}</td>";
                echo "<td>{$row['invoice_date']}</td>";
                echo "<td>{$row['invoice_status']}</td>";
                // Add more table cells with invoice details as needed
                echo "</tr>";
            }
            
            ?>
        </tbody>
    </table>
</div>


</div>



