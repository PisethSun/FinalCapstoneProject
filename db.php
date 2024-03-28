<?php
$host = 'localhost'; // or your host, e.g., a remote database server
$dbUser = 'psun01';
$dbPassword = 'Psun781';
$dbName = 'small_salon';

// Create a connection using MySQLi
$mysqli = new mysqli($host, $dbUser, $dbPassword, $dbName);

// Check the connection
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// Optionally, you can set the charset, which is recommended for consistency
$mysqli->set_charset("utf8mb4");

// Now, $mysqli is available for use in your other PHP scripts


