<?php
include 'session_check.php';
include 'Database.php';

// Create database connection
$database = new Database();
$db = $database->getConnection();

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    // Delete user
    $deleteQuery = "DELETE FROM users WHERE matric = ?";
    $stmt = $db->prepare($deleteQuery);
    $stmt->bind_param("s", $matric);

    if ($stmt->execute()) {
        header("Location: display.php");
        exit();
    } else {
        echo "Error deleting record.";
    }
}
?>
