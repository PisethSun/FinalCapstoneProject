<?php
// index.php

require_once('../private/initialize.php');

// Get the path from the URL
$path = $_GET['path'] ?? 'home';

// Map the path to a function or include a file
switch ($path) {
    case 'home':
        include('home.php');
        break;
    case 'contact':
        include('contact.php');
        break;
    case 'gallery':
        include('gallery.php');
        break;
    // Add other cases for each route
    default:
        include('404.php'); // Create a 404.php for handling not found pages
        break;
}

// Rest of the shared footer
include(SHARED_PATH . '/users_footer.php');
