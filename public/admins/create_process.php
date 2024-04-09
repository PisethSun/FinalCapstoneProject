<?php
require_once('../../private/initialize.php');
require_login();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $customer_first_name = $_POST["customer_first_name"];
    $customer_last_name = $_POST["customer_last_name"];
    $customer_email = $_POST["customer_email"];
    $customer_phone = $_POST["customer_phone"];
    $account_username = $_POST["username"];
    $account_password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
    $access_level = 1; // Default access level
    $account_status = 1; // Default account status

    // Insert data into the customer table
    $stmt_customer = $db->prepare("INSERT INTO customer (customer_first_name, customer_last_name, customer_email, customer_phone) VALUES (?, ?, ?, ?)");
    $stmt_customer->bind_param("ssss", $customer_first_name, $customer_last_name, $customer_email, $customer_phone);

    if ($stmt_customer->execute()) {
        // Insert data into the account table
        $stmt_account = $db->prepare("INSERT INTO account (account_username, account_email, account_password, access_level, account_status) VALUES (?, ?, ?, ?, ?)");
        $stmt_account->bind_param("sssss", $account_username, $customer_email, $account_password, $access_level, $account_status);

        if ($stmt_account->execute()) {
            // Redirect to a success page or display a success message
            header("location: create_success.php");
            exit;
        } else {
            // Handle error
            echo "Error: " . $stmt_account->error;
        }

        $stmt_account->close();
    } else {
        // Handle error
        echo "Error: " . $stmt_customer->error;
    }

    $stmt_customer->close();
} else {
    // If the form hasn't been submitted, redirect to the create page
    header("location: create.php");
    exit;
}
?>
