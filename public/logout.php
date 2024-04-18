<?php require_once('../private/initialize.php'); ?>
<!-- Redirect to main page after logout -->

<?php

session_start();
$_SESSION = array(); // Clear session variables
session_destroy(); // Destroy the session
redirect_to(url_for('/home.php')); // Redirect to login page

?>
