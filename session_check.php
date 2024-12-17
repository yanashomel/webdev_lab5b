<?php
// Start the session only if it is not already active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is not logged in
if (!isset($_SESSION['matric'])) {
    header("Location: login.html"); // Redirect to login page
    exit();
}
?>

