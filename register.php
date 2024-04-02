<!-- register.php (Registration Page) -->
<?php include 'backend.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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
                        <h3 class="mb-0">Registration</h3>
                    </div>
                    <div class="card-body">
                        <form action="add_blood_info.php" method="post">
                            <div class="form-group">
                                <label for="userType">User Type</label>
                                <select class="form-control" id="userType" name="userType">
                                    <option value="receiver">Receiver</option>
                                    <option value="hospital">Hospital</option>
                                </select>
                            </div>
                            <div id="receiverFields" style="display: none;">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="bloodGroup">Blood Group</label>
                                    <select class="form-control" id="bloodGroup" name="bloodGroup">
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                    </select>
                                </div>
                            </div>
                            <div id="hospitalFields" style="display: none;">
                                <div class="form-group">
                                    <label for="hospitalName">Hospital Name</label>
                                    <input type="text" class="form-control" id="hospitalName" placeholder="Enter hospital name" name="hospitalName">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const userTypeSelect = document.getElementById('userType');
        const receiverFields = document.getElementById('receiverFields');
        const hospitalFields = document.getElementById('hospitalFields');

        userTypeSelect.addEventListener('change', function() {
            if (this.value === 'receiver') {
                receiverFields.style.display = 'block';
                hospitalFields.style.display = 'none';
            } else {
                receiverFields.style.display = 'none';
                hospitalFields.style.display = 'block';
            }
        });
    </script>
</body>
</html>
