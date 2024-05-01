<?php
require_once('../private/initialize.php');


$path = $_GET['path'] ?? 'home';


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
    
    default:
        include('404.php'); 
        break;
}


include(SHARED_PATH . '/users_footer.php');
