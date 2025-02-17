<?php

$Full_Name = filter_input(INPUT_POST, 'Full_Name');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
if (!empty($password)) {
    if (!empty($email)) {
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "acs_bb";

        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

        if (mysqli_connect_error()) {
            die('Connect error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
        } else {
            $sql = "INSERT INTO admins (Full_Name, email, password) values ('$Full_Name','$email','$password')";
            if ($conn->query($sql)) {
                header("Location: admin.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
    } else {
        echo "Password should not be empty";
    }
} else {
    echo "Full Name should not be empty";
    die();
}
?>
