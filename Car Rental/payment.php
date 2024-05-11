<?php
// Include your database connection code here if not already included
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




// Get the selected car plate_id from the query string
$selectedCar = isset($_GET['plate_id']) ? $_GET['plate_id'] : "A!";
echo "<p>$selectedCar.</p>";

$reservation_id = isset($_GET['reservation_id']) ? $_GET['reservation_id'] : "B!";
echo "<p>$reservation_id.</p>";

// Check if the form has been submitted


// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect user input
    $cardNumber = $_POST['cardNumber'];
    $cvv = $_POST['cvv'];

    // Validate and store securely in the session
    if (!empty($cardNumber) && !empty($cvv)) {
        // Sanitize and store in the session
        echo "Form submitted!";



        $sqlReservationDetails = "SELECT Start_date, end_date FROM reservation WHERE Reservation_id = '$reservation_id'";
        $resultReservationDetails = $conn->query($sqlReservationDetails);
        echo "SQL Query: $sqlReservationDetails<br>";
        echo "Rows found: " . $resultReservationDetails->num_rows;

        $sqlPriceDetails = "SELECT price_per_day FROM car WHERE plate_id = '$selectedCar'";
        $resultPriceDetails = $conn->query($sqlPriceDetails);
        
        if ($resultReservationDetails === FALSE) {
            echo "Error fetching reservation details: " . $conn->error;
        } elseif ($resultPriceDetails === FALSE) {
            echo "Error fetching price details: " . $conn->error;
        } else {
            if ($resultReservationDetails->num_rows > 0) {
                $rowReservationDetails = $resultReservationDetails->fetch_assoc();
                $startDate = $rowReservationDetails['Start_date'];
                $endDate = $rowReservationDetails['end_date'];
        
                // Calculate the number of days
                $numberOfDays = (strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24);
        
                if ($resultPriceDetails->num_rows > 0) {
                    $rowPriceDetails = $resultPriceDetails->fetch_assoc();
                    $pricePerDay = $rowPriceDetails['price_per_day'];
        
                    // Calculate total payment amount
                    $totalPayment = $numberOfDays * $pricePerDay;
        
                    // Insert payment details into the payment table
                    $sqlInsertPayment = "INSERT INTO payment (reservation_id, cardNumber, TotalPrice, CVV, payment_date) 
                                        VALUES ('$reservation_id', '$cardNumber', '$totalPayment', '$cvv', NOW())";
        
                    if ($conn->query($sqlInsertPayment) === TRUE) {
                        echo "<p>Payment inserted successfully.</p>";
                    } else {
                        echo "Error inserting payment: " . $conn->error;
                    }
                } else {
                    echo "<p>No rows found in the car details for the given plate ID.</p>";
                }
            } else {
                echo "<p>No rows found in the reservation details for the given reservation ID.</p>";
            }
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
    <title>Payment</title>

    <!-- Include your CSS styles here -->
    <style>
        /* Add your additional styles here */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            margin-bottom: 15px;
        }

        .payment-form {
            width: 300px;
            text-align: left;
        }

        .payment-form label {
            display: block;
            margin-bottom: 10px;
        }

        .payment-form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
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
    function submitForm(plateId, price, cityname) {
        var cardNumber = document.getElementById('cardNumber').value;
            var cvv = document.getElementById('cvv').value;

            // Validate the card number and CVV here if needed

            // Redirect to confirmation page
            window.location.href = 'confirmation.php?plateId=' + encodeURIComponent(plateId) +
                '&price=' + encodeURIComponent(price) +
                '&cityname=' + encodeURIComponent(cityname) +
                '&cardNumber=' + encodeURIComponent(cardNumber) +
                '&cvv=' + encodeURIComponent(cvv);    }
</script>

</head>

<body>
    <h1>Payment</h1>
    <div class="payment-form">
        <form id="paymentForm" method="post" action="payment.php?reservation_id= <?php echo $reservation_id;?>&plate_id=<?php echo $selectedCar; ?> ">
            <label for="cardNumber">Card Number:</label>
            <input type="text" id="cardNumber" name="cardNumber" required>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" required>

            <!-- Add other payment input fields as needed -->

            <a href="#" class="payment-button" onclick="document.getElementById('paymentForm').submit();">Pay Now</a>

        </form>
    </div>
</body>

</html>
