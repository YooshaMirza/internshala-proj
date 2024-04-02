<?php
error_reporting(E_ALL);

// Database connection details
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "blood_bank_system";

// Create a new MySQL connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Register a new user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $userType = $_POST["userType"];
    $name = $_POST["name"];
    $bloodGroup = $_POST["bloodGroup"];
    $hospitalName = $_POST["hospitalName"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($userType == "receiver") {
        $sql = "INSERT INTO receivers (name, blood_group, username, password) VALUES ('$name', '$bloodGroup', '$username', '$password')";
    } else {
        $sql = "INSERT INTO hospitals (name, username, password) VALUES ('$hospitalName', '$username', '$password')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// User login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM receivers WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful for a receiver
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["userType"] = "receiver";
        header("Location: available_blood.php");
        exit();
    }

    $sql = "SELECT * FROM hospitals WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful for a hospital
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["userType"] = "hospital";
        header("Location: add_blood_info.php");
        exit();
    } else {
        echo "Invalid username or password!";
    }
}

// Add blood info (for hospitals)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addBlood"])) {
    session_start();
    if (isset($_SESSION["userType"]) && $_SESSION["userType"] == "hospital") {
        $bloodGroup = $_POST["bloodGroup"];
        $quantity = $_POST["quantity"];

        $sql = "INSERT INTO blood_samples (hospital_id, blood_group, quantity) VALUES ((SELECT id FROM hospitals WHERE username = '{$_SESSION["username"]}'), '$bloodGroup', $quantity)";

        if ($conn->query($sql) === TRUE) {
            echo "Blood info added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Access denied! You must be logged in as a hospital to perform this action.";
    }
}

// View available blood samples
$sql = "SELECT bs.blood_group, h.name AS hospital_name, bs.quantity FROM blood_samples bs JOIN hospitals h ON bs.hospital_id = h.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Blood Group</th><th>Hospital</th><th>Quantity</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["blood_group"] . "</td><td>" . $row["hospital_name"] . "</td><td>" . $row["quantity"] . "</td><td><button>Request Sample</button></td></tr>";
    }
    echo "</table>";
} else {
    echo "No available blood samples found.";
}

// Request a blood sample (for receivers)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["requestSample"])) {
    session_start();
    if (isset($_SESSION["userType"]) && $_SESSION["userType"] == "receiver") {
        $bloodGroup = $_POST["bloodGroup"];
        $hospitalId = $_POST["hospitalId"];
        $receiverId = (int) $conn->query("SELECT id FROM receivers WHERE username = '{$_SESSION["username"]}'")->fetch_assoc()["id"];

        $sql = "INSERT INTO blood_requests (receiver_id, hospital_id, blood_group) VALUES ($receiverId, $hospitalId, '$bloodGroup')";

        if ($conn->query($sql) === TRUE) {
            echo "Blood sample requested successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Access denied! You must be logged in as a receiver to perform this action.";
    }
}

// View blood requests (for hospitals)
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["viewRequests"])) {
    session_start();
    if (isset($_SESSION["userType"]) && $_SESSION["userType"] == "hospital") {
        $hospitalId = (int) $conn->query("SELECT id FROM hospitals WHERE username = '{$_SESSION["username"]}'")->fetch_assoc()["id"];

        $sql = "SELECT r.name AS receiver_name, br.blood_group, br.request_date FROM blood_requests br JOIN receivers r ON br.receiver_id = r.id WHERE br.hospital_id = $hospitalId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>Receiver Name</th><th>Blood Group</th><th>Request Date</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["receiver_name"] . "</td><td>" . $row["blood_group"] . "</td><td>" . $row["request_date"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No blood requests found.";
        }
    } else {
        echo "Access denied! You must be logged in as a hospital to perform this action.";
    }
}
// Add blood sample (for hospitals)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addBloodSample"])) {
    session_start();
    if (isset($_SESSION["userType"]) && $_SESSION["userType"] == "hospital") {
        $bloodGroup = $_POST["bloodGroup"];
        $quantity = $_POST["quantity"];

        $sql = "INSERT INTO blood_samples (hospital_id, blood_group, quantity) VALUES ((SELECT id FROM hospitals WHERE username = '{$_SESSION["username"]}'), '$bloodGroup', $quantity)";

        if ($conn->query($sql) === TRUE) {
            echo "Blood sample added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Access denied! You must be logged in as a hospital to perform this action.";
    }
}

// Close the MySQL connection
$conn->close();
