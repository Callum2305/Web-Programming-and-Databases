<?php

// Include this file at the top of every restricted page.
// If the user is not logged in, they are redirected to the login screen.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: loginScreen.php");
    exit();
}
?>
