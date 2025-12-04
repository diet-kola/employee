<?php 
session_start();

$_SESSION = [];
session_unset();
session_destroy();

if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// Prevent caching even on logout page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// Redirect to login page
header("Location: ../login/");
exit;
?>


