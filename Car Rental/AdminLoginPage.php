<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $serialId = $_POST['password'];

    $sql = "SELECT * FROM `admin` WHERE Email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    
        if (isset($row['SerialNumber'])) {
            $storedPassword = $row['SerialNumber'];
            if ($serialId == $storedPassword) {
                session_start();
                $_SESSION['email'] = $email;
                header("Location: AdminHomePage.php");
                exit();
            } else {
                $error = "Invalid email or password";
                echo $error;
                exit();
            }
        } else {
            $error = "Invalid email or password";
            echo $error;
            exit();
        }
    } else {
        $error = "Invalid email or password";
        echo $error;
        exit();
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Tillana:wght@400&display=swap">
</head>
<style>
          body {
            background-color: #120F0F;
            font-family: 'Tillana', sans-serif;
            overflow-x: hidden;
            overflow-y: hidden;
            margin: 0; 
          }
          .Image{
            width: 100%; 
            height: 100vh; 
          }
          h1{
            margin-top:90px;
            color:white;
            font-size:60px;
          }
          .email{
            margin-top:90px;
            color:white;
            font-size:30px;
          }
          .input{
            width: 80%;
            height:40px;
            background-color:#AFAFAF;
            border-radius:15px;
          }
          .serialId{
            margin-top:40px;
            color:white;
            font-size:30px;
          }
          .login-btn {
            margin-top:50px;
            background-color: #FB1818;
            width: 25%; 
            border-radius:15px;
            height:40px;
            margin-left:200px;
            color:black;
            border:none;
        }

</style>
<body>
<div class="row">
    <div class="col-6">
       <img class="Image" src="./Assets/homepageimg.jpg" alt="car image"/>
    </div>
    <div class="col-6">
    <h1>Welcome Back!</h1>
        <form method="POST" action="AdminLoginPage.php">
            <label class="email">Email</label><br>
            <input class="input" type="text" name="email" id="email" placeholder="youremail@gmail.com" required><br><br>

            <label class="serialId">SerialId</label><br>
            <input class="input" type="password" name="password" id="password" placeholder="**********" required><br><br>

            <input type="submit" class="login-btn" id="login-btn" value="Login">
        </form>

   </div>
</div>
</body>
</html>