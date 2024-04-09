<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>
<?php include(SHARED_PATH . '/admins_header.php'); ?>

<div class="container">
    <div class="alert alert-success mt-5" role="alert">
        <h4 class="alert-heading">User Created Successfully!</h4>
        <p>The new user has been created successfully.</p>
        <hr>
        <p class="mb-0">You can <a href="users.php">view all users</a> or <a href="create.php">create another user</a>.</p>
    </div>
</div>

