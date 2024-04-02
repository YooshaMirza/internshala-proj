<!-- add_blood_sample.php -->
<?php include 'backend.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blood Sample</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Add Blood Sample</h3>
                    </div>
                    <div class="card-body">
                        <form action="backend.php" method="post">
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
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity">
                            </div>
                            <button type="submit" class="btn btn-primary" name="addBloodSample">Add Blood Sample</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
