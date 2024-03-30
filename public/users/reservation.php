<?php require_once('../../private/initialize.php'); ?>
<?php


// Ensure user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['customer_id'])) {
    header("location: ../login.php"); // Redirect to login page if not logged in
    exit;
}

$customerName = "Guest"; // Default name in case something goes wrong
$customer_id = $_SESSION['customer_id'];

// Fetch the customer's name from the database
$stmt = $db->prepare("SELECT customer_first_name, customer_last_name FROM customer WHERE customer_id = ?");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $customerName = $row['customer_first_name']; // Fetching only the first name for the greeting
}

$stmt->close();

// Fetch technicians (employees)
$technicians = $db->query("SELECT employee_id, employee_first_name, employee_last_name FROM employee");

// Fetch tasks
$tasks = $db->query("SELECT task_id, task_name, task_description, task_price, task_estimate_time FROM task");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book a Service</title>
    <script>
        function validateForm() {
            var checkedCount = document.querySelectorAll('input[name="tasks[]"]:checked').length;
            if (checkedCount < 1 || checkedCount > 2) {
                alert("Please select between 1 and 2 tasks.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<header>
        <h1>Welcome to Your Reservations</h1>
        <nav>
            <ul>
                <li>Hi, <?php echo htmlspecialchars($customerName); ?></li>
                <li><a href="index.php">Home</a></li>
                <li><a href="invoice.php">Invoices</a></li>
                <li><a href="reservation.php">Reservations</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <h2>Book a Service</h2>
    <form action="submit_booking.php" method="post" onsubmit="return validateForm();"> <!-- Adjust action as necessary -->
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br>
        
        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required><br>
        
        <label for="technician">Technician:</label>
        <select id="technician" name="technician" required>
            <?php while ($tech = $technicians->fetch_assoc()): ?>
                <option value="<?= $tech['employee_id'] ?>"><?= $tech['employee_first_name'] . ' ' . $tech['employee_last_name'] ?></option>
            <?php endwhile; ?>
        </select><br>
        
        <fieldset>
            <legend>Select Tasks:</legend>
            <?php while ($task = $tasks->fetch_assoc()): ?>
                <div>
                    <input type="checkbox" id="task_<?= $task['task_id'] ?>" name="tasks[]" value="<?= $task['task_id'] ?>">
                    <label for="task_<?= $task['task_id'] ?>"><?= $task['task_name'] . " - " . $task['task_description'] . " - $" . $task['task_price'] . " - Estimated Time: " . $task['task_estimate_time'] ?></label>
                </div>
            <?php endwhile; ?>
        </fieldset>

        <input type="submit" value="Book Now">
    </form>
</body>
</html>

