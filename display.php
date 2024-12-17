<?php
session_start();
include 'session_check.php';
include 'Database.php';

// Create a database connection
$database = new Database();
$db = $database->getConnection();

// Fetch all users
$query = "SELECT matric, name, role FROM users";
$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }
        table {
            background-color: #fff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .action-btns a {
            margin: 0 5px;
        }
        .logout-btn {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Heading -->
        <h1>User List</h1>
        
        <!-- User Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Matric</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['matric']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['role']}</td>
                                    <td class='action-btns'>
                                        <a href='update.php?matric={$row['matric']}' class='btn btn-sm btn-primary'>
                                            <i class='bi bi-pencil-square'></i> Update
                                        </a>
                                        <a href='delete.php?matric={$row['matric']}' onclick=\"return confirm('Are you sure you want to delete this record?');\" class='btn btn-sm btn-danger'>
                                            <i class='bi bi-trash'></i> Delete
                                        </a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-muted'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <!-- Logout Button -->
        <div class="logout-btn">
            <a href="logout.php" class="btn btn-danger btn-lg">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
