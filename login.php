<?php
session_start(); // Start the session to track user login state

// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_5b";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $password_input = $_POST['password'];

    // Fetch user data based on matric
    $sql = "SELECT password, name, role FROM users WHERE matric = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verify the result
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify password using password_verify()
        if (password_verify($password_input, $hashed_password)) {
            $_SESSION['matric'] = $matric;
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];

            // Redirect to display.php
            header("Location: display.php");
            exit();
        } else {
            // Invalid password
            echo "Invalid username or password, try <a href='login_page.php'>login</a> again.";
        }
    } else {
        // Matric not found
        echo "Invalid username or password, try <a href='login_page.php'>login</a> again.";
    }
}

$conn->close();
?>
