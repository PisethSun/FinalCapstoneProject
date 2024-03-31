<?php 
require_once('../private/initialize.php'); 

$errors = [];

if (is_post_request()== "POST") {
    // Collect and sanitize user input
    $user_input = sanitize_and_collect_user_input($db, $_POST);

    // Perform validation checks
    if (is_blank($user_input['username'])) {
        $errors[] = "Username cannot be blank.";
    } elseif (!has_length($user_input['username'], ['min' => 4, 'max' => 255])) {
        $errors[] = "Username must be between 4 and 255 characters.";
    }

    if (is_blank($user_input['email'])) {
        $errors[] = "Email cannot be blank.";
    } elseif (!has_valid_email_format($user_input['email'])) {
        $errors[] = "Email must be a valid format.";
    }

    if (is_blank($user_input['password'])) {
        $errors[] = "Password cannot be blank.";
    } elseif (!has_length($user_input['password'], ['min' => 8])) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    if (is_blank($user_input['firstName'])) {
        $errors[] = "First name cannot be blank.";
    } elseif (!has_length($user_input['firstName'], ['min' => 2, 'max' => 255])) {
        $errors[] = "First name must be between 2 and 255 characters.";
    }

    if (is_blank($user_input['lastName'])) {
        $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($user_input['lastName'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Last name must be between 2 and 255 characters.";
    }

    if (is_blank($user_input['phone'])) {
        $errors[] = "Phone cannot be blank.";
    } elseif (!preg_match('/^[0-9]{10}$/', $user_input['phone'])) {
        $errors[] = "Phone must be 10 digits long.";
    }

    // If no errors, proceed with signup
    if (empty($errors)) {
        $signup_result = process_signup($db, $user_input['username'], $user_input['email'], $user_input['password'], $user_input['firstName'], $user_input['lastName'], $user_input['phone']);

        if ($signup_result['success']) {
            $success_message = "Sign up was successful. Redirecting to login...";
            echo "<script>
                    alert('{$success_message}');
                    window.location.href='index.php';
                  </script>";
            exit;
        }
        
        else {
            $errors = array_merge($errors, $signup_result['errors']);
        }
    }
}

include(SHARED_PATH . '/public_header.php'); 
?>

<h2>Sign Up</h2>
<?php if (!empty($errors)): ?>
    <div class="error-container">
        <?php foreach ($errors as $error): ?>
            <p><?php echo htmlspecialchars($error); ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form action="signup.php" method="post">
    Username: <input type="text" name="username" ><br>
    Email: <input type="email" name="email" ><br>
    Password: <input type="password" name="password" ><br>
    First Name: <input type="text" name="firstName" ><br>
    Last Name: <input type="text" name="lastName" ><br>
    Phone: <input type="text" name="phone" ><br>
    <input type="submit" value="Sign Up">
</form>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
