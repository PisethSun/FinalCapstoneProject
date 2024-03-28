<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php';

    // Account information
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password
    $accessLevel = 1; // Example: 1 for customers
    $accountStatus = 1; // Example: 1 for active
    $creationDate = date('Y-m-d H:i:s'); // Current datetime

    // Customer information
    $firstName = mysqli_real_escape_string($mysqli, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($mysqli, $_POST['lastName']);
    $customerEmail = $email; // Assume it's the same as the account email
    $phone = mysqli_real_escape_string($mysqli, $_POST['phone']);

    // Transaction start
    mysqli_begin_transaction($mysqli);

    try {
        // Insert into account table
        $stmt = mysqli_prepare($mysqli, "INSERT INTO account (account_username, account_email, account_password, access_level, account_status, account_creation_date) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssiii", $username, $email, $password, $accessLevel, $accountStatus, $creationDate);
        mysqli_stmt_execute($stmt);

        // Get the last inserted account_id
        $accountId = mysqli_insert_id($mysqli);

        // Insert into customer table
        $stmt = mysqli_prepare($mysqli, "INSERT INTO customer (customer_first_name, customer_last_name, customer_email, customer_phone) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $customerEmail, $phone);
        mysqli_stmt_execute($stmt);

        // Commit transaction
        mysqli_commit($mysqli);
        
        // Redirect to index.php after successful signup
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        mysqli_rollback($mysqli);
        echo "Error: " . $e->getMessage();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($mysqli);
}
?>

<!-- HTML Form remains the same -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
</head>
<body>
    <h2>Sign Up</h2>
    <form action="signup.php" method="post">
        Username: <input type="text" name="username" required><br>
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        First Name: <input type="text" name="firstName" required><br>
        Last Name: <input type="text" name="lastName" required><br>
        Phone: <input type="text" name="phone" required><br>
        <input type="submit" value="Sign Up">
    </form>
</body>
</html>
