<?php

session_start();
$_SESSION = []; // Clear all session data

if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params['path'], $params['domain'],
        $params['secure'], $params['httponly']
        
    ); // Delete the session cookie
}

session_destroy(); // Destroy the session

// Redirect to login page
header('Location: /login/index.php');
exit;
?>