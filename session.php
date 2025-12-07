<?php
session_start();

// Set inactivity timeout (in seconds)
$timeout = 900; // 15 minutes

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: login.php?message=Session expired! Please log in again.");
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity time
