<?php
include 'session_check.php';
include 'Database.php';

// Create database connection
$database = new Database();
$db = $database->getConnection();

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    // Fetch user details
    $query = "SELECT * FROM users WHERE matric = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

// Update user details on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $updateQuery = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
    $stmt = $db->prepare($updateQuery);
    $stmt->bind_param("sss", $name, $role, $matric);

    if ($stmt->execute()) {
        header("Location: display.php");
        exit();
    } else {
        echo "Error updating record.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin: 50px auto;
            max-width: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            font-size: 1.5rem;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .btn {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Update User
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="matric" class="form-label">Matric:</label>
                        <input type="text" name="matric" id="matric" class="form-control" 
                               value="<?php echo htmlspecialchars($user['matric']); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" 
                               value="<?php echo htmlspecialchars($user['name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Access Level:</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="student" <?php echo ($user['role'] == 'student') ? 'selected' : ''; ?>>Student</option>
                            <option value="lecturer" <?php echo ($user['role'] == 'lecturer') ? 'selected' : ''; ?>>Lecturer</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Update
                        </button>
                        <a href="display.php" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

