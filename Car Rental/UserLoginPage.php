<?php
$backgroundImage = "./assets/homepageimg.jpg";
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
    $password = $_POST['password'];

    $sql = "SELECT * FROM customer WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Use password_verify to check the entered password against the hashed password
        if (MD5($password) == ($hashedPassword)) {
            session_start();
            $_SESSION['customer_id'] = $row['customer_id'];
            echo "<script>alert('Customer ID: " . $row['customer_id'] . "');</script>";

            // Redirect to user.php with the customer ID
            header("Location: UserLandingPage.php");
            exit();;
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
    <title>User Login-Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Tillana:wght@400&display=swap">
    <style>
        body {
            background-color: #120F0F;
            font-family: 'Tillana', sans-serif;
            overflow-x: hidden;
            overflow-y: hidden;
            margin: 0; 
        }

        .main-card {
            position: relative; 
            text-align: center;
            color: white; 
            height: 95vh; 
            margin-top: 20px; 
        }

        .main-card::before {
            content: "";
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            background-image: url('<?php echo $backgroundImage; ?>');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            opacity: 0.6;
            z-index: -1;
            border-radius: 15px;
        }

        h1 {
            position: absolute;
            top: 10%;
            left: 20%;
            transform: translate(-50%, -50%);
            color: #FB1818;
        }

        form {
            position: absolute;
            width: 60%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        label {
            font-size: 30px;
            display: block;
            text-align: left;
            color: white;
            margin:0px;
        }

        .input {
            background-color: #E5E5E5;
            height: 40px;
            border-radius: 15px;
            width: 100%;
            box-sizing: border-box; 
            margin-bottom: 10px; 
        }

        .login-btn {
            margin-top:50px;
            background-color: #FB1818;
            width: 30%; 
            border-radius:15px;
            height:40px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            color: white;
            font-size: 18px;
        }

        a {
            text-decoration: none;
            color: #FB1818;
        }
        .remember-me a {
            margin-left: 500px;
            text-decoration: none;
            color: #FB1818;
        }
        .remember-me label{
            margin-left:10px;
            font-size:18px;
        }
    </style>
</head>
<body>
    <div class="main-card">
        <h1>Welcome Back!</h1>
        <form method="POST" action="UserLoginPage.php">
            <label>Email</label><br>
            <input class="input" type="text" name="email" id="email" placeholder="youremail@gmail.com" required><br><br>

            <label>Password</label><br>
            <input class="input" type="password" name="password" id="password" placeholder="**********" required><br><br>

            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
                <a href="#">Forgot your password?</a>
            </div>

            <input type="submit" class="login-btn" id="login-btn" value="Login">

            <p>Don't have an account? <a href="UserSignUpPage.php">Register Here</a>.</p>
        </form>
    </div>
</body>
</html>
