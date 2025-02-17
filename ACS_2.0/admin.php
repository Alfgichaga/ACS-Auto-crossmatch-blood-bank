<?php
session_start();

$host = 'localhost';
$dbname = 'acs_bb';
$dbusername = 'root';
$dbpassword = '';

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die('Connect error(' . $conn->connect_errno . ')' . $conn->connect_error);
}

if (isset($_POST['add_donor'])) {
    $Full_Name = $_POST['Full_Name'];
    $age = $_POST['age'];
    $dblood_type = $_POST['dblood_type'];
    $additional_info = $_POST['additional_info'];

    $sql = "INSERT INTO b_donor (Full_Name, age, dblood_type, additional_info) 
            VALUES ('$Full_Name', '$age', '$dblood_type', '$additional_info')";

    if ($conn->query($sql)) {
        echo "New donor added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['add_patient'])) {
    $Full_Name = $_POST['Full_Name'];
    $age = $_POST['age'];
    $pblood_type = $_POST['pblood_type'];
    $additional_info = $_POST['additional_info'];

    $sql = "INSERT INTO p_details (Full_Name, age, pblood_type, additional_info) 
            VALUES ('$Full_Name', '$age', '$pblood_type', '$additional_info')";

    if ($conn->query($sql)) {
        echo "New patient added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['delete_donor_id'])) {
    $id = $_GET['delete_donor_id'];

    $sql = "DELETE FROM b_donor WHERE donor_id=$id";

    if ($conn->query($sql)) {
        echo "Donor deleted successfully!";
    } else {
        echo "Error deleting donor: " . $conn->error;
    }
}

if (isset($_GET['delete_patient_id'])) {
    $id = $_GET['delete_patient_id'];

    $sql = "DELETE FROM p_details WHERE patient_id=$id";

    if ($conn->query($sql)) {
        echo "Patient deleted successfully!";
    } else {
        echo "Error deleting patient: " . $conn->error;
    }
}

if (isset($_GET['logout'])) {
    session_destroy(); 
    header("Location: admin_login.html"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - ACS Blood Bank Management</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="navbar">
        <h1>Admin Panel - ACS Blood Bank Management</h1>
        <a href="?logout=true" class="logout-button">Logout</a>
    </div>

    <div class="content-container">
        <div class="card-list">
            <div class="card-item">
                <h2>Add New Donor</h2>
                <form method="POST" action="">
                    <label for="Full_Name">Donor Name:</label>
                    <input type="text" name="Full_Name" required>

                    <label for="dblood_type">Blood Type:</label>
                    <input type="text" name="dblood_type" required>

                    <label for="age">Age:</label>
                    <input type="text" name="age" required>

                    <label for="additional_info">Additional Information:</label>
                    <input type="text" name="additional_info" required>

                    <button type="submit" name="add_donor">Add Donor</button>
                </form>

                <h2>Add New Patient</h2>
                <form method="POST" action="">
                    <label for="Full_Name">Patient Name:</label>
                    <input type="text" name="Full_Name" required>

                    <label for="pblood_type">Blood Type:</label>
                    <input type="text" name="pblood_type" required>

                    <label for="age">Age:</label>
                    <input type="text" name="age" required>

                    <label for="additional_info">Additional Info:</label>
                    <input type="text" name="additional_info" required>

                    <button type="submit" name="add_patient">Add Patient</button>
                </form>
            </div>

            <h2>Existing Donors</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Donor Name</th>
                    <th>Age</th>
                    <th>Blood Type</th>
                    <th>Additional Info</th>
                    <th>Action</th>
                </tr>
                <?php
                $sql = "SELECT * FROM b_donor";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['donor_id'] . "</td>
                                <td>" . $row['Full_Name'] . "</td>
                                <td>" . $row['age'] . "</td>
                                <td>" . $row['dblood_type'] . "</td>
                                <td>" . $row['additional_info'] . "</td>
                                <td><a href='?delete_donor_id=" . $row['donor_id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No donors found</td></tr>";
                }
                ?>
            </table>

            <h2>Existing Patients</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Patient Name</th>
                    <th>Age</th>
                    <th>Blood Type</th>
                    <th>Additional Info</th>
                    <th>Action</th>
                </tr>
                <?php
                $sql = "SELECT * FROM p_details";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['patient_id'] . "</td>
                                <td>" . $row['Full_Name'] . "</td>
                                <td>" . $row['age'] . "</td>
                                <td>" . $row['pblood_type'] . "</td>
                                <td>" . $row['additional_info'] . "</td>
                                <td><a href='?delete_patient_id=" . $row['patient_id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No patients found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>