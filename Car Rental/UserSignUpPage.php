<?php
$backgroundImage = "./assets/background.jpg";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Firstname = $_POST['FName'];
    $Lastname = $_POST['LName'];
    $phoneNumber = $_POST['phoneNumber'];
    $LicenseId = $_POST['LicenseId'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $sql = "SELECT * FROM customer WHERE email = ?";
    $stmt = $conn->prepare($sql);

    // Check for errors in the prepare statement
    if (!$stmt) {
        die("Error in prepare statement: " . $conn->error);
    }

    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Email Already Exists";
        echo $error;
        exit();
    } else {
       
        $hashedPassword = MD5($password);

        $sql = "INSERT INTO customer (Fname, Lname, phone_number, email, License_id, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Check for errors in the prepare statement
        if (!$stmt) {
            die("Error in prepare statement: " . $conn->error);
        }

     
        $stmt->bind_param('ssisss', $Firstname, $Lastname, $phoneNumber, $email, $LicenseId, $hashedPassword);

        if ($stmt->execute()) {
            session_start();
            $Firstname = $_POST['FName'];
            $Lastname = $_POST['LName'];
            $phoneNumber = $_POST['phoneNumber'];
            $LicenseId = $_POST['LicenseId'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            echo "success";
            exit();
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User SignUp-Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Tillana:wght@400&display=swap">
    <style>
        body {
            background-color: #120F0F;
            font-family: 'Tillana', sans-serif;
            overflow-x: hidden;
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
            background-image: url('./Assets/homepageimg.jpg'); 
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
        h2{
            position: absolute;
            top: 18%;
            left: 20%;
            transform: translate(-50%, -50%);
            color: #FB1818; 
        }
        form {
            max-height: 60vh;
            position: absolute;
            max-width: 600px; 
            width: 80%; 
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        label {
            font-size: 18px;
            display: block;
            text-align: left;
            color: white;
            margin-bottom: 5px;
        }

        .input {
            background-color: #E5E5E5;
            height: 40px;
            border-radius: 15px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 10px;
            padding: 10px;
        }

        .login-btn {
            margin-top: 20px; 
            background-color: #FB1818;
            width: 100%; 
            border-radius: 15px;
            height: 40px;
        }

        a {
            text-decoration: none;
            color: #FB1818;
        }
    </style>
</head>
<body>
    <div class="main-card">
        <h1>SignUp Now</h1>
        <h2>And Enjoy Browsing</h2>
        <form method="POST" action="UserSignUpPage.php">
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input class="form-control input" type="text" name="FName" id="firstName" placeholder="John" required>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input class="form-control input" type="text" name="LName" id="lastName" placeholder="Doe" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control input" type="text" name="email" id="email" placeholder="youremail@gmail.com" required>
            </div>

            <div class="form-group">
                <label for="phoneNumber">Phone Number</label>
                <input class="form-control input" type="tel" name="phoneNumber" id="phoneNumber" placeholder="123-456-7890" required>
            </div>

            <div class="form-group">
                <label for="Lisence_id">LicenseID</label>
                <input class="form-control input" type="text" name="LicenseId" id="Lisence_id" placeholder="YourID" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control input" type="password" name="password" id="password" placeholder="**********" required>
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input class="form-control input" type="password" name="confirmPassword" id="confirmPassword" placeholder="**********" required>
            </div>
            
            <input type="submit" class="btn btn-primary login-btn" id="login-btn" value="Sign-Up">

            <p>Already have an account? <a href="UserLoginPage.php">login Here</a>.</p>
        </form>
    </div>
</body>
</html>
