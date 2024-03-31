<?php require_once('../private/initialize.php'); ?>
<?php
if (is_post_request() == "POST") {
    
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Prepare user_input array for validation function
    $user_input = [
        'email' => $email,
        'password' => $password
    ];
    $errors = validate_login_input($user_input);
    
    $stmt = $db->prepare("SELECT account_id, account_password, access_level FROM account WHERE account_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['account_password'])) {
            // Session assignments for login status and account_id
            $_SESSION['loggedin'] = true;
            $_SESSION['account_id'] = $row['account_id'];
            $_SESSION['access_level'] = $row['access_level'];

            // Fetching customer_id - adjust this query based on your actual database schema
            $customerQuery = "SELECT customer_id FROM customer WHERE customer_email = ?";
            $customerStmt = $db->prepare($customerQuery);
            $customerStmt->bind_param("s", $email);
            $customerStmt->execute();
            $customerResult = $customerStmt->get_result();
            
            if ($customerRow = $customerResult->fetch_assoc()) {
                $_SESSION['customer_id'] = $customerRow['customer_id']; // Set customer_id in session
            }

            $customerStmt->close();

            // Redirect based on access_level
            if ($row['access_level'] == 1) {
                // Assuming access_level 1 is for customers
                header("location: users/index.php");
                exit; // Ensure no further script execution after redirect
            } else {
                // Redirect to a different page for other access levels
                header("location: welcome.php");
                exit;
            }
        } else {
            $errors[] = "Invalid password.";
        }
    } else {
        $errors[] = "No account found with that email.";
    }

    $stmt->close();
   
}
?>
<?php include(SHARED_PATH . '/public_header.php'); ?>
    <h2>Login</h2>

    <?php if (!empty($errors)): ?>
<div class="error-container">
    <?php foreach ($errors as $error): ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endforeach; ?>
</div>
<?php endif; ?>
    <form action="login.php" method="post">
        Email: <input type="email" name="email" ><br>
        Password: <input type="password" name="password" ><br>
        <input type="submit" value="Login">
    </form>
    <?php include(SHARED_PATH . '/public_footer.php'); ?>