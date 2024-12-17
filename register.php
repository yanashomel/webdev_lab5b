<?php
// Database connection configuration
$servername = "localhost";
$username = "root"; // Your database username
$password = "";     // Your database password
$dbname = "Lab_5b";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password_input = $_POST['password'];
    $role = $_POST['role'];

    // Hash the password for security
    $hashed_password = password_hash($password_input, PASSWORD_DEFAULT);

    // Insert data into the users table
    $sql = "INSERT INTO users (matric, name, password, role) VALUES ('$matric', '$name', '$hashed_password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully. <a href='display.php'>View Records</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
