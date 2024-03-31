<?php require_once('../private/initialize.php'); ?>

<?php
// Assuming $errors array and validation functions are available through included files
$errors = [];
if (is_post_request()) {
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Validation
    if(is_blank($email)) {
        $errors[] = "Email cannot be blank.";
    } elseif (!has_valid_email_format($email)) {
        $errors[] = "Email format is not valid.";
    }
    
    if(is_blank($password)) {
        $errors[] = "Password cannot be blank.";
    }
    
    // Proceed with authentication if there are no errors
    if(empty($errors)) {
        $login_failure_msg = "Log in was unsuccessful.";
        $user = find_user_by_email($email);

        if ($user) {
            // Check password
            if (password_verify($password, $user['account_password'])) {
                // Log in the user
                log_in_user($user);

                // Redirect based on access_level
                if ($user['access_level'] == 1) {
                    redirect_to(url_for('/users/index.php'));
                    exit;
                } else {

                    $errors[] = $login_failure_msg;
                }
            } 
        } else {
      // no email found
      $errors[] = $login_failure_msg;
    }
    }
    

}


?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<h2>Login</h2>
<?php 
// Displaying errors if any
if(!empty($errors)) {
    foreach($errors as $error) {
        echo '<div style="color: red;">' . htmlspecialchars($error) . '</div>';
    }
}
?>
<form action="login.php" method="post">
    Email: <input type="email" name="email" ><br>
    Password: <input type="password" name="password" ><br>
    <input type="submit" value="Login">
</form>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
