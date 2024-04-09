<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>
<?php include(SHARED_PATH . '/admins_header.php'); ?>

<div class="uk-container uk-container-xsmall">
    <h2>Edit User</h2>

    <?php
    // Check if user ID is provided in the URL
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        // Redirect to users.php if ID is not provided or is invalid
        redirect_to('users.php');
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
        // Redirect to users.php if user does not exist
        redirect_to('users.php');
    }

    $stmt->close();

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];

        // Update the user record in the database
        $stmt = $db->prepare("UPDATE customer SET customer_first_name = ?, customer_last_name = ?, customer_email = ? WHERE customer_id = ?");
        $stmt->bind_param("sssi", $first_name, $last_name, $email, $user_id);
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->affected_rows === 1) {
            // Redirect back to users.php page after successful editing
            redirect_to('users.php');
        } else {
            // Handle the case where the update failed
            // You can display an error message or redirect the user to an error page
        }

        $stmt->close();
    }
    ?>

    <!-- HTML form for editing user information -->
    <form action="edit.php?id=<?php echo $user_id; ?>" method="post">
    <div class="form-group">
    <label for="first_name" class="uk-text-large">First Name</label>
    <input type="text" class="form-control uk-text-large" id="first_name" name="first_name" value="<?php echo $user['customer_first_name']; ?>" maxlength="50" style="width: 200px;">
</div>
<div class="form-group">
    <label for="last_name" class="uk-text-large">Last Name</label>
    <input type="text" class="form-control uk-text-large" id="last_name" name="last_name" value="<?php echo $user['customer_last_name']; ?>" maxlength="50" style="width: 200px;">
</div>
<div class="form-group">
    <label for="email" class="uk-text-large">Email</label>
    <input type="email" class="form-control uk-text-large" id="email" name="email" value="<?php echo $user['customer_email']; ?>" maxlength="100" style="width: 300px;">
</div>


    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


</div>
<?php include(SHARED_PATH . '/admins_footer.php'); ?>
