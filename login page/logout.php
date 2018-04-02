<?php

// Inialize session
 session_start();

// Delete certain session
 unset($_SESSION['username']);
 // Delete all session variables
 // session_destroy();

// Jump to login page
 header('Location:/soft_e/htdocs/login%20page/admin.php');

?>