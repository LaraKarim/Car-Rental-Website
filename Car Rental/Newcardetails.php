<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #312F2F;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #fff;
        }

        h1 {
            margin-bottom: 20px;
        }

        img {
            max-width: 50%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .details-container {
            display: flex;
            justify-content: space-between;
            width: 70%;
        }

        .left-column,
        .right-column {
            flex: 1;
            padding: 0 10px;
        }

        .no-details {
            text-align: center;
        }

        .payment-button {
            background-color: #ff0000; /* Red color */
            color: #fff; /* White text */
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
<body>
    
<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
} else {
    // Redirect to login page or handle the case where customer_id is not set
    header("Location: UserLoginPage.php");
    exit();
}
// Retrieve car ID from the URL
$plateId = isset($_GET['plate_id']) ? $_GET['plate_id'] : null;

if ($plateId) {
    // Fetch car details from the database based on the car ID
    $sqlCarDetails = "SELECT * FROM car WHERE plate_id = '$plateId'";
    $resultCarDetails = $conn->query($sqlCarDetails);

    if ($resultCarDetails) {
        if ($resultCarDetails->num_rows > 0) {
            $rowCarDetails = $resultCarDetails->fetch_assoc();

            echo '<img src="data:image/png;base64,' . base64_encode($rowCarDetails['Image']) . '" alt="Car Image">';
            // Display plate_id under the image
            echo "<h1>Plate ID: " . $rowCarDetails['plate_id'] . "</h1>";

            // Display car details in two columns
            echo "<div class='details-container'>";
            echo "<div class='left-column'>";
            echo "<p>Color: " . $rowCarDetails['Color'] . "</p>";
            echo "<p>Status: " . $rowCarDetails['Status'] . "</p>";
            echo "<p>Transmission Type: " . $rowCarDetails['Transmission_Type'] . "</p>";
            echo "<p>Year: " . $rowCarDetails['year'] . "</p>";
            echo "</div>";

            echo "<div class='right-column'>";
            echo "<p>Price per Day: $" . $rowCarDetails['price_per_Day'] . "</p>";
            echo "<p>Location: " . $rowCarDetails['Location'] . "</p>";
            echo "<p>Model: " . $rowCarDetails['Model'] . "</p>";
            echo "<p>Brand: " . $rowCarDetails['Brand'] . "</p>";
            echo "<p>Condition: " . $rowCarDetails['Condition'] . "</p>";
            echo "</div>";
            echo "</div>";

            echo "<a href='Reservation.php?plate_id=$plateId&customer_id=$customer_id' class='payment-button'>Reserve Now</a>";


        } else {
            echo "<p>No car details found for plate ID: $plateId.</p>";
        }
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "<p>Invalid plate ID.</p>";
}

// Close the database connection
$conn->close();
?>
</body>
</html>