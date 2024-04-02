<!-- available_blood.php (Available Blood Samples Page) -->
<?php include 'backend.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Blood Samples</title>
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Available Blood Samples</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Blood Group</th>
                                    <th>Hospital</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>A+</td>
                                    <td>General Hospital</td>
                                    <td>
                                        <button class="btn btn-primary request-sample-btn">Request Sample</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>B-</td>
                                    <td>City Hospital</td>
                                    <td>
                                        <button class="btn btn-primary request-sample-btn">Request Sample</button>
                                    </td>
                                </tr>
                                <!-- Add more rows for available blood samples -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const requestSampleBtns = document.querySelectorAll('.request-sample-btn');

        requestSampleBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Check if the user is logged in as a receiver
                const isLoggedIn = false; // Replace with your logic to check if the user is logged in as a receiver
                const isEligible = true; // Replace with your logic to check if the user is eligible for the blood sample

                if (isLoggedIn && isEligible) {
                    // Handle the request sample logic
                    console.log('Request sample logic');
                } else if (!isLoggedIn) {
                    // Redirect to the login page
                    window.location.href = 'login.php';
                } else {
                    // Show an error message or perform any other action
                    console.log('You are not eligible to request this blood sample');
                }
            });
        });
    </script>
</body>
</html>