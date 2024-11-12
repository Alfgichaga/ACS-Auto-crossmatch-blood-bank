<?php
session_start();
$error = '';

if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $error = "Email or Password is invalid";
    } else {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $conn = mysqli_connect("localhost", "root", "", "acs_bb");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT email, password FROM users WHERE email = ? AND password = ? LIMIT 1";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->bind_result($email, $password);
        $stmt->store_result();

        if ($stmt->fetch()) {
            $_SESSION['login_user'] = $email;
            header("location: home.php"); 
            exit(); 
        } else {
            $error = "Email or Password is invalid";
        }

        $stmt->close();
        mysqli_close($conn);
    }
}
?>
