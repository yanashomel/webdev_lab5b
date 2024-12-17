<?php
session_start(); // Start the session to maintain login state

include 'Database.php';
include 'User.php';

if (isset($_POST['submit']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
    // Create database connection
    $database = new database();
    $db = $database->getConnection();

    // Sanitize inputs to prevent SQL injection
    $matric = $db->real_escape_string(trim($_POST['matric']));
    $password = $db->real_escape_string(trim($_POST['password']));

    // Validate inputs
    if (!empty($matric) && !empty($password)) {
        $user = new User($db);
        $userDetails = $user->getUser($matric);

        // Check if user exists and verify password
        if ($userDetails && password_verify($password, $userDetails['password'])) {
            // Set session variables for user
            $_SESSION['matric'] = $matric;
            $_SESSION['name'] = $userDetails['name'];
            $_SESSION['role'] = $userDetails['role'];

            // Redirect to a secure dashboard or display page
            header("Location: display.php");
            exit();
        } else {
            // Login failed, display error message
            echo "<p style='color:red; text-align:center;'>Invalid matric or password. Please try again.</p>";
            echo "<p style='text-align:center;'><a href='login_page.php'>Back to Login</a></p>";
        }
    } else {
        // Missing fields, display error message
        echo "<p style='color:red; text-align:center;'>Please fill in all required fields.</p>";
        echo "<p style='text-align:center;'><a href='login_page.php'>Back to Login</a></p>";
    }
} else {
    // Invalid access method
    echo "<p style='color:red; text-align:center;'>Invalid request method.</p>";
    echo "<p style='text-align:center;'><a href='login_page.php'>Back to Login</a></p>";
}
?>
