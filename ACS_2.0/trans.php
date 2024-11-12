<?php

$Full_Name = filter_input(INPUT_POST, 'Full_Name');
$age = filter_input(INPUT_POST, 'age');
$pblood_type = filter_input(INPUT_POST, 'pblood_type');
$additional_info = filter_input(INPUT_POST, 'additional_info');

if (!empty($Full_Name)) {
    if (!empty($age) && !empty($pblood_type)) {
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "acs_bb";

        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

        if (mysqli_connect_error()) {
            die('Connect error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
        } else {
            $sql = "INSERT INTO p_details (Full_Name, age, pblood_type, additional_info) values ('$Full_Name', '$age', '$pblood_type', '$additional_info')";
            if ($conn->query($sql)) {
                header("Location: resultprss.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
    } else {
        echo "Age and Blood Type should not be empty";
    }
} else {
    echo "Full Name should not be empty";
    die();
}
?>
