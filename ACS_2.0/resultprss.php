<?php

$host = 'localhost';
$dbname = 'acs_bb';
$dbusername = 'root';
$dbpassword = '';

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()) {
    die('Connect error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
}


function findCompatibleDonors($patientBloodType, $conn) {
    $compatibleDonors = [];
    
    
    $sql = "SELECT * FROM b_donor WHERE dblood_type = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $patientBloodType);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $compatibleDonors[] = $row;
    }

    return $compatibleDonors;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matching Results</title>
    <link rel="stylesheet" href="result.css">
</head>
<body>
    <div class="container">
        <h1>Matching Results</h1>
        <?php
        $patientsResult = $conn->query("SELECT * FROM p_details");

        while ($patient = $patientsResult->fetch_assoc()) {
            
            $compatibleDonors = findCompatibleDonors($patient['pblood_type'], $conn);

            echo "<h1>Patient: " . htmlspecialchars($patient['Full_Name']) . " (Blood Type: " . htmlspecialchars($patient['pblood_type']) . ")</h1>";
            echo "<ul>";

            foreach ($compatibleDonors as $donor) {
                echo "<li>Donor: " . htmlspecialchars($donor['Full_Name']) . " (Blood Type: " . htmlspecialchars($donor['dblood_type']) . ")</li>";
            }

            echo "</ul>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
