<?php

$Full_Name = filter_input(INPUT_POST, 'Full_Name');
$age = filter_input(INPUT_POST, 'age');
$dblood_type = filter_input(INPUT_POST, 'dblood_type');
$additional_info = filter_input(INPUT_POST, 'additional_info');

if (!empty($Full_Name)) {
    if (!empty($age) && !empty($dblood_type)) {
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "acs_bb";

        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

        if (mysqli_connect_error()) {
            die('Connect error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
        } else {
            $sql = "INSERT INTO b_donor (Full_Name, age, dblood_type, additional_info) values ('$Full_Name', '$age', '$dblood_type', '$additional_info')";
            if ($conn->query($sql)) {
                header("Location: pst_dnr.php");
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
