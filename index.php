<!-- index.php (Home Page) -->
<?php include 'backend.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('background.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Blood Bank System</h3>
                    </div>
                    <div class="card-body">
                        <p>Welcome to the Blood Bank System.</p>
                        <a href="register.php" class="btn btn-primary">Register</a>
                        <a href="login.php" class="btn btn-secondary">Login</a>
                        <a href="available_blood.php" class="btn btn-info">Available Blood Samples</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>