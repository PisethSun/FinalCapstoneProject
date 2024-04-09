<?php
require_once('../../private/initialize.php');
require_login();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../login.php"); // Redirect to login page if not logged in
    exit;
}

// Initialize variables
$customerName = "Guest"; // Default name in case something goes wrong

if (isset($_SESSION['customer_id'])) {
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

// Ensure user ID is provided as a GET parameter
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    redirect_to('users.php'); // Redirect to users page if ID is not provided or is invalid
}

$user_id = $_GET['id'];

// Perform the deletion operation for associated invoices first
// Perform the deletion operation for associated invoices first
$invoice_delete_sql = "DELETE i FROM invoice i JOIN reservation r ON i.reservation_id = r.reservation_id WHERE r.customer_id = ?";
// Prepare the statement
$invoice_stmt = $db->prepare($invoice_delete_sql);

// Check if prepare() was successful
if (!$invoice_stmt) {
    echo "Error preparing invoice deletion query: " . $db->error; // Print out the error message
    exit;
}

// Bind parameters
$invoice_stmt->bind_param("i", $user_id);

// Execute the statement
if ($invoice_stmt->execute()) {
    // Now, delete the selected tasks associated with the reservations
    $selected_tasks_delete_sql = "DELETE s FROM selected_tasks s JOIN reservation r ON s.reservation_id = r.reservation_id WHERE r.customer_id = ?";
    $selected_tasks_stmt = $db->prepare($selected_tasks_delete_sql);
    $selected_tasks_stmt->bind_param("i", $user_id);

    if ($selected_tasks_stmt->execute()) {
        // Now, delete the reservations associated with the customer
        $reservation_delete_sql = "DELETE FROM reservation WHERE customer_id = ?";
        $reservation_stmt = $db->prepare($reservation_delete_sql);
        $reservation_stmt->bind_param("i", $user_id);

        if ($reservation_stmt->execute()) {
            // Now, delete the customer record
            $customer_delete_sql = "DELETE FROM customer WHERE customer_id = ?";
            $customer_stmt = $db->prepare($customer_delete_sql);
            $customer_stmt->bind_param("i", $user_id);

            if ($customer_stmt->execute()) {
                // Now, delete the account record associated with the customer
                $account_delete_sql = "DELETE FROM account WHERE customer_id = ?";
                $account_stmt = $db->prepare($account_delete_sql);
                $account_stmt->bind_param("i", $user_id);

                if ($account_stmt->execute()) {
                    // Redirect to success page after deletion
                    redirect_to('delete_success.php');
                } else {
                    // Error handling for account deletion
                    echo "Error deleting account: " . $account_stmt->error;
                }
            } else {
                // Error handling for customer deletion
                echo "Error deleting customer: " . $customer_stmt->error;
            }
        } else {
            // Error handling for reservation deletion
            echo "Error deleting reservations: " . $reservation_stmt->error;
        }
    } else {
        // Error handling for selected tasks deletion
        echo "Error deleting selected tasks: " . $selected_tasks_stmt->error;
    }
} else {
    // Error handling for invoice deletion
    echo "Error deleting invoices: " . $invoice_stmt->error;
}

// Close prepared statements
$invoice_stmt->close();
$selected_tasks_stmt->close();
$reservation_stmt->close();
$customer_stmt->close();
$account_stmt->close();
?>
