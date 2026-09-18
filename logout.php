<?php

// Logout: unset all session variables, destroy the session, redirect to login screen.

session_start();

// Remove all session variables
$_SESSION = array();

// Destroy the session cookie if one exists
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Redirect to the login screen
header("Location: loginScreen.php");
exit();
?>
