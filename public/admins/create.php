<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>
<?php include(SHARED_PATH . '/admins_header.php'); ?>

<?php
// Check if the user is logged in
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../login.php"); // Redirect to login page if not logged in
    exit;
}

// Initialize variables
$customerName = "Guest"; // Default name in case something goes wrong

if(isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];

    // Fetch the customer's name from the database
    $stmt = $db->prepare("SELECT customer_first_name FROM customer WHERE customer_id = ?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Concatenate the first name
        $customerName = $row['customer_first_name'];
    }

    $stmt->close();
}
?>

<!-- HTML form for creating a new customer or account -->
<div class="container-md mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Create New Customer</h2>
            <form action="create_process.php" method="POST">
                <div class="row mb-3 justify-content-center">
                    <div class="col-md-4">
                        <label for="customer_first_name">First Name:</label>
                        <input type="text" class="form-control" id="customer_first_name" name="customer_first_name" maxlength="50" required>
                    </div>
                </div>
                <div class="row mb-3 justify-content-center">
                    <div class="col-md-4">
                        <label for="customer_last_name">Last Name:</label>
                        <input type="text" class="form-control" id="customer_last_name" name="customer_last_name" maxlength="50" required>
                    </div>
                </div>
                <div class="row mb-3 justify-content-center">
                    <div class="col-md-4">
                        <label for="customer_email">Email:</label>
                        <input type="email" class="form-control" id="customer_email" name="customer_email" maxlength="100" required>
                    </div>
                </div>
                <div class="row mb-3 justify-content-center">
                    <div class="col-md-4">
                        <label for="customer_phone">Phone:</label>
                        <input type="text" class="form-control" id="customer_phone" name="customer_phone" maxlength="20" required>
                    </div>
                </div>
                <div class="row mb-3 justify-content-center">
                    <div class="col-md-4">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" maxlength="255" required>
                    </div>
                </div>
                <div class="row mb-3 justify-content-center">
                    <div class="col-md-4">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" maxlength="255" required>
                    </div>
                </div>
                <div class="row mb-3 justify-content-center">
                    <div class="col-md-4">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" maxlength="255" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


