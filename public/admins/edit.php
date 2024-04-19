<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>
<?php include(SHARED_PATH . '/admins_header.php'); ?>

<div class="uk-container uk-container-xsmall uk-flex uk-flex-center uk-flex-middle uk-height-viewport">
    <div class="uk-width-1-1 uk-width-1-2@s">
        <h2 class="uk-text-center">Edit User</h2>

    <?php
    // Check if user ID is provided in the URL
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        redirect_to('users.php'); // Redirect if ID is not provided or is invalid
    }

    $user_id = $_GET['id'];

    // Fetch user data from the database
    $stmt = $db->prepare("SELECT * FROM customer WHERE customer_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    } else {
        redirect_to('users.php'); // Redirect if user does not exist
    }

    $stmt->close();

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize and prepare data for update
        $first_name = db_escape($db, $_POST['first_name']);
        $last_name = db_escape($db, $_POST['last_name']);
        $email = db_escape($db, $_POST['email']);

        // Call the function to update the customer record
        if (updateCustomer($db, $user_id, $first_name, $last_name, $email)) {
            redirect_to('users.php'); // Redirect on successful update
        } else {
            // Handle the case where the update failed
            echo "Error updating record.";
        }
    }
    ?>

    <!-- HTML form for editing user information -->
    <form action="edit.php?id=<?php echo $user_id; ?>" method="post" class="uk-form-stacked">
            <div class="uk-margin">
                <label for="first_name" class="uk-form-label">First Name</label>
                <input type="text" class="uk-input" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['customer_first_name']); ?>" maxlength="50">
            </div>
            <div class="uk-margin">
                <label for="last_name" class="uk-form-label">Last Name</label>
                <input type="text" class="uk-input" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['customer_last_name']); ?>" maxlength="50">
            </div>
            <div class="uk-margin">
                <label for="email" class="uk-form-label">Email</label>
                <input type="email" class="uk-input" id="email" name="email" value="<?php echo htmlspecialchars($user['customer_email']); ?>" maxlength="100">
            </div>

            <div class="uk-text-center uk-margin">
                <button type="submit" class="uk-button uk-button-primary">Submit</button>
            </div>
        </form>
</div>
