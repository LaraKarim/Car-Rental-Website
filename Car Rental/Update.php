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

function getStatusString() {
    // Check if the status is set in the POST data
    if (isset($_POST['status'])) {
        // Use the switch statement to set the status as a string
        switch ($_POST['status']) {
            case 'option1':
                $status = 'Rented';
                break;
            case 'option2':
                $status = 'Out Of Service';
                break;
            case 'option3':
                $status = 'Available';
                break;
            default:
                $status = 'Unknown';
        }
    } else {
        // Default value if "status" is not set
        $status = 'Not Set';
    }

    // Return the status string
    return $status;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $plateId = $_POST["plateid"];
    $status = $_POST["status"];
    $price = $_POST["Price"];


    if (empty($status) && empty($price)) {
        echo '<script>alert("Error: Please provide any argument to be update it : Status or Price");</script>';
        exit();
    }

    elseif(!empty($status) && !empty($price)){
    // Update the database
    $status = getStatusString();
    $sql = "UPDATE car SET `Status` ='$status', price_per_Day='$price' WHERE plate_id='$plateId'";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Record updated successfully");</script>';
       
    } else {
        echo "Error updating record: " . $conn->error;
        exit();
    }
}
elseif(!empty($status)){
    $status = getStatusString();
    $sql = "UPDATE car SET `Status` ='$status' WHERE plate_id='$plateId'";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Record updated successfully");</script>';
        
    } else {
        echo "Error updating record: " . $conn->error;
        exit();
    }

}
else{

    $sql = "UPDATE car SET price_per_Day='$price' WHERE plate_id='$plateId'";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Record updated successfully");</script>';
        
    } else {
        echo "Error updating record: " . $conn->error;
        exit();
    }
}


}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Tillana:wght@400&display=swap">
</head>
<body>
    <style>
    body {
        background-color: #120F0F;
        font-family: 'Tillana', sans-serif; 
        overflow-x: hidden;
    }
    nav {
        background-color: #D9D9D9;
    }
    .navbar-brand img {
        margin-right: 40px; 
    }
    .house{
        margin:0px;
    }
    .container{
        max-width:100%;
    }
    .image{
        width: 90%; 
       height: 80vh; 
       margin-top:40px;
       border-radius:15px;
    }
    h1{
        color:white;
        margin-top:50px;
    }
    p{
        color:white;
        text-align:start;
        margin-top:80px;
        font-size:18px;
        margin-left:80px;
    }
    .input{
        width: 80%;
            height:40px;
            background-color:#AFAFAF;
            border-radius:15px;
    }
    label{
        color:white;
        text-align:start;
        margin-top:40px;
        font-size:18px;
    }
    select {
        width: 50%;
        height: 40px;
        background-color: #AFAFAF; 
        color: black; 
        border: 1px solid #AFAFAF; 
        border-radius: 15px;
        margin-top: 10px; 
        padding: 5px; 
    }
    .status-part{
        text-align:start;
        margin-left:80px;
    }
    .price{
        width: 50%;
            height:40px;
            background-color:#AFAFAF;
            border-radius:15px;
            margin-top:80px;
    }
    .priceLabel{
        width:20%;
        color:white;
        text-align:start;
        margin-top:80px;
        font-size:18px;
        margin-left:80px;
    }
    .updatePrice{
        display:flex;
    }
    .login-btn {
        margin-top:50px;
            background-color: #FB1818;
            width: 20%; 
            border-radius:15px;
            height:40px;
            margin-bottom:30px;
            border:none;
            padding-left:10px;
        }
    </style>
<body>
<form method="post" action="Update.php">    
<nav class="navbar bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img class="house" src="./Assets/house.svg" alt="Bootstrap" width="30" height="24">
        </a>
        <div class="ml-auto">
            <img class="search" src="./Assets/search.svg" alt="Bootstrap" width="30" height="24">
            <img class="gear" src="./Assets/gear.svg" alt="Bootstrap" width="30" height="24">
            <img class="inbox" src="./Assets/inbox.svg" alt="Bootstrap" width="30" height="24">
        </div>
    </div>
</nav>
<div class="container text-center">
  <div class="row">
    <div class="col">
     <h1>Update Car</h1>
     <p>Enter the car’s plate Id you want to update:</p>
     <input class="input" type="text" name="plateid" id="plateid" placeholder="ABC123" required><br><br>
     <div class="status-part">
     <label>Status:</label>
     <select id="status" name="status">
        <option value="" disabled selected>Select Status</option>
        <option value="option1">Rented</option>
        <option value="option2">Out Of service</option>
        <option value="option3">Available</option>
     </select>
</div>
<div class="updatePrice">
    <p class="priceLabel">price/Day:</p>
     <input class="price" type="text" name="Price" id="Price" placeholder="1500LE" ><br><br></div>
     <div class="Add-btn">
    <button type="submit" class="login-btn" id="login-btn">
        <img class="bi bi-person-fill" src="./Assets/database-add.svg"/> Save
    </button>
</div>
    </div>
    <div class="col">
     <img class="image" src="./Assets/homepageimg.jpg"/>
    </div>
  </div>
  
</div>
</form>
</body>
</html>