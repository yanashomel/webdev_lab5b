<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card mx-auto shadow-sm" style="max-width: 400px;">
            <div class="card-header bg-success text-white text-center">
                <h3>Login</h3>
            </div>
            <div class="card-body">
                <form action="authenticate.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Matric</label>
                        <input type="text" name="matric" class="form-control" placeholder="Enter Matric Number" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success w-100">Login</button>
                </form>
            </div>
            <div class="card-footer text-center">
                Don't have an account? <a href="registration_page.php" class="text-success">Register here</a>
            </div>
        </div>
    </div>
</body>
</html>
