<?php
// Don't start session here - it's already started in the main files

// Set inactivity timeout (in seconds)
$timeout = 900; // 15 minutes

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: index.php?message=Session expired! Please log in again.");
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity time
