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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $plateid = $_POST['plateid'];
    $Condition = $_POST['Condition'];
    $Brand = $_POST['Brand'];
    $Year = $_POST['Year'];
    $Model = $_POST['Model'];
    $Color = $_POST['Color'];
    $Type = $_POST['Type'];
    $Status = $_POST['Status'];
    $Location = $_POST['Location'];
    $Office_Id = $_POST['Office_Id'];
    $PricePerDay = $_POST['PricePerDay'];
    
    if (isset($_FILES["fileInput"]) && $_FILES["fileInput"]["error"] == 0) {
        // Get image data
        $image = $_FILES["fileInput"]["tmp_name"];
        }
    else {
        echo"error in image!";
    }   

    $checkDuplicateSql = "SELECT plate_id FROM car WHERE plate_id = '$plateid'";
    $result = $conn->query($checkDuplicateSql);

if ($result->num_rows > 0) {
    // Plate ID is already in the database
    echo "Error: Duplicate plate ID found. Car not inserted.";
    exit();
   } else {


    // Insert data into the database
    $sql = "INSERT INTO car (plate_id, Color, `Image`, `Status`, Transmission_Type, `condition`, `year`, price_per_Day, `Location`, Model, Brand, Office_Id ) VALUES
     ('$plateid', '$Color' , '$image' , '$Status' , '$Type' ,  '$Condition' , '$Year' , '$PricePerDay' , '$Location' , '$Model' , '$Brand' , '$Office_Id')";

    if ($conn->query($sql) === TRUE) {
        echo "Car inserted successfully";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Add New Car</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Tillana:wght@400&display=swap">
</head>
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
    h1{
        color:white;
        text-align:center;
        padding-top:30px;
    }
    .NewCarImage{
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        width: 40%;
    }
    .arrow{
        background-color: #D9D9D9;
    }
    .image{
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
    .PlateId{
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
    .PlateId p{
        color:white;
        font-size:20px;
        margin-right:30px;
    }
    .PlateId input{
        background-color:#D9D9D9;
        border-radius:15px;
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
<form method="POST" action="AddNewCar.php" enctype="multipart/form-data">    
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
<h1>Add New Car</h1>
<div class="image">
    <div class="arrow" id="leftArrow"><img src="./Assets/chevron-left.svg" onclick="changeImage(-1)" /></div>
    <img class="NewCarImage" name="carImage" id="carImage" src="./Assets/audiRed.svg" alt="Car" />
    <div class="arrow" id="rightArrow"><img src="./Assets/chevron-right.svg" onclick="changeImage(1)" /></div>
    <input type="file" name="fileInput" accept="image/*" onchange="displayImage(this)">
   
</div>

<div class="PlateId">
    <p>Plate Id:</p>
    <input class="input" type="text" name="plateid" id="plateid" placeholder="ABCD123" required><br><br>
</div>
<div class="container text-center">
  <div class="row">
    <div class="col">
    <div class="PlateId">
    <p>Brand:</p>
    <input class="input" type="text" name="Brand" id="Brand" placeholder="Audi" required><br><br>
</div>
<div class="PlateId">
    <p>Model:</p>
    <input class="input" type="text" name="Model" id="Model" placeholder="sedan" required><br><br>
</div>
    <div class="PlateId">
    <p>Year:</p>
    <input class="input" type="text" name="Year" id="Year" placeholder="2022" required><br><br>
</div>
    <div class="PlateId">
    <p>Color:</p>
    <input class="input" type="text" name="Color" id="Color" placeholder="Red" required><br><br>
</div>
    <div class="PlateId">
    <p>PricePerDay:</p>
    <input class="input" type="text" name="PricePerDay" id="PricePerDay" placeholder="200$" required><br><br>
</div>
    </div>


    <div class="col">
    <div class="PlateId">
    <p>Type:</p>
    <input class="input" type="text" name="Type" id="Type" placeholder="Automatic" required><br><br>
</div>
<div class="PlateId">
    <p>Status:</p>
    <input class="input" type="text" name="Status" id="Status" placeholder="Avaliable" required><br><br>
</div>
    <div class="PlateId">
    <p>Condition:</p>
    <input class="input" type="text" name="Condition" id="Condition" placeholder="Excellent" required><br><br>
</div>
    <div class="PlateId">
    <p>Location:</p>
    <input class="input" type="text" name="Location" id="Location" placeholder="New York" required><br><br>
</div>
    <div class="PlateId">
    <p>Office Id:</p>
    <input class="input" type="text" name="Office_Id" id="Office_Id" placeholder="1,2,3...." required><br><br>
</div>
    </div>
  </div>

  <div class="Add-btn">
    <button type="submit" class="login-btn" id="login-btn">
        <img class="bi bi-person-fill" src="./Assets/database-add.svg"/> Login
    </button>
</div>

<script>
     // JavaScript code for image switching
     var currentImageIndex = 0;
    var images = [
        "./Assets/audiRed.svg",
        "./Assets/bmw.png",
        "./Assets/toyotablack.png",
        "./Assets/mercedesGrey.png",
        "./Assets/porsche.png"
    ];

    function changeImage(direction) {
        currentImageIndex += direction;

        // Wrap around to the last image if going beyond the array bounds
        if (currentImageIndex < 0) {
            currentImageIndex = images.length - 1;
        } else if (currentImageIndex >= images.length) {
            currentImageIndex = 0;
        }

        // Update the src attribute of the carImage element
        document.getElementById('carImage').src = images[currentImageIndex];
    }

    function handleFileSelect(event) {
    const fileInput = document.getElementById('fileInput');
    const carImage = document.getElementById('carImage');

    if (fileInput.files && fileInput.files.length > 0) {
        // User selected a file, update the car image with the uploaded file
        const reader = new FileReader();
        reader.onload = function (e) {
            carImage.src = e.target.result;
        
        };
        reader.readAsDataURL(fileInput.files[0]);
    } else {
        // No file selected, revert to the default shown image
        carImage.src = images[currentImageIndex];
    }
}

function displayImage(input) {
    var fileInput = input;
    var imgElement = document.getElementById('carImage');

    if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            imgElement.src = e.target.result;
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
}
</script>
</form>
</body>
</html>
