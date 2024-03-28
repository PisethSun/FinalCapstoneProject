<?php
include_once 'db.php';
// Your PHP code to interact with the database goes here
?>

<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: index.php");
exit;
?>
