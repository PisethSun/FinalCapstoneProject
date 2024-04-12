<?php
require_once('../../private/initialize.php');
require_login();

// Ensure user ID is provided as a GET parameter
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    redirect_to('users.php'); // Redirect to users page if ID is not provided or is invalid
}

$user_id = $_GET['id'];

// Perform the deletion operation for associated invoices first
$invoice_delete_sql = "DELETE i FROM invoice i JOIN reservation r ON i.reservation_id = r.reservation_id WHERE r.customer_id = ?";
$invoice_stmt = $db->prepare($invoice_delete_sql);

// Check if prepare() was successful
if (!$invoice_stmt) {
    echo "Error preparing invoice deletion query: " . $db->error;
    exit;
}

// Bind parameters
$invoice_stmt->bind_param("i", $user_id);

// Execute the statement
if ($invoice_stmt->execute()) {
    // Now, delete the reservations associated with the customer
    $reservation_delete_sql = "DELETE FROM reservation WHERE customer_id = ?";
    $reservation_stmt = $db->prepare($reservation_delete_sql);
    $reservation_stmt->bind_param("i", $user_id);

    // Check if prepare() was successful
    if (!$reservation_stmt) {
        echo "Error preparing reservation deletion query: " . $db->error;
        exit;
    }

    // Execute the statement
    if ($reservation_stmt->execute()) {
        // Now, delete the customer record
        $customer_delete_sql = "DELETE FROM customer WHERE customer_id = ?";
        $customer_stmt = $db->prepare($customer_delete_sql);
        $customer_stmt->bind_param("i", $user_id);

        // Check if prepare() was successful
        if (!$customer_stmt) {
            echo "Error preparing customer deletion query: " . $db->error;
            exit;
        }

        // Execute the statement
        if ($customer_stmt->execute()) {
            // Now, delete the account record associated with the customer
            $account_delete_sql = "DELETE FROM account WHERE customer_id = ?";
            $account_stmt = $db->prepare($account_delete_sql);
            $account_stmt->bind_param("i", $user_id);

            // Check if prepare() was successful
            if (!$account_stmt) {
                echo "Error preparing account deletion query: " . $db->error;
                exit;
            }

            // Execute the statement
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
    // Error handling for invoice deletion
    echo "Error deleting invoices: " . $invoice_stmt->error;
}

// Close prepared statements
$invoice_stmt->close();
$reservation_stmt->close();
$customer_stmt->close();
$account_stmt->close();
