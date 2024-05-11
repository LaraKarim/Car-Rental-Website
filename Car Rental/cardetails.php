<?php
// Connect to the database (replace these variables with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Car_Rental_System";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the "plateId" key is present in the $_GET array
$selectedCar = $_GET['plateId'];

// Fetch details for the selected car
$sql = "SELECT * FROM Car WHERE plate_id = '$selectedCar'";
$result = $conn->query($sql);

// Display the car details
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars Details</title>

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
    <script>
        function redirectToPayment(plateId, price,cityname) {
            // Redirect to the payment page with the selected car details
            window.location.href = 'payment.php?plateId=' + encodeURIComponent(plateId) + '&price=' + encodeURIComponent(price) +'&cityname=' + encodeURIComponent(cityname);
        }
    </script>
</head>

<body>
    <?php
    if ($selectedCar !== null) {
        // Check if the "plateId" parameter is present in the URL

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Display the car image using the fetched image data from the database
            echo '<img src="data:image/png;base64,' . base64_encode($row['Image']) . '" alt="Car Image">';
            // Display plate_id under the image
            echo "<h1>Plate ID: " . $row['plate_id'] . "</h1>";

            // Display car details in two columns
            echo "<div class='details-container'>";
            echo "<div class='left-column'>";
            echo "<p>Color: " . $row['Color'] . "</p>";
            echo "<p>Status: " . $row['Status'] . "</p>";
            echo "<p>Transmission Type: " . $row['Transmission_Type'] . "</p>";
            echo "<p>Year: " . $row['year'] . "</p>";
            echo "</div>";

            echo "<div class='right-column'>";
            echo "<p>Price per Day: $" . $row['price_per_Day'] . "</p>";
            echo "<p>Location: " . $row['Location'] . "</p>";
            echo "<p>Model: " . $row['Model'] . "</p>";
            echo "<p>Brand: " . $row['Brand'] . "</p>";
            echo "<p>Condition: " . $row['Condition'] . "</p>";
            echo "</div>";
            echo "</div>";


            echo "<button class='payment-button' onclick=\"redirectToPayment('" . $row['plate_id'] . "','" . $row['price_per_Day'] . "', '" . $row['Location'] . "' )\">Proceed to Payment</button>";
        } else {
            echo "<p class='no-details'>No details available for the selected car.</p>";
        }
    } else {
        echo "<p class='no-details'>No car selected. Please provide a valid car plate ID.</p>";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>

</html>

