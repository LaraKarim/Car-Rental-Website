<?php
session_start();
$customerId = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : "Not available";

// Include your database connection code here if not already included
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Car_Rental_System";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve securely stored information from the session
$secureCardNumber = isset($_SESSION['secure_cardNumber']) ? $_SESSION['secure_cardNumber'] : "Not available";
$secureCVV = isset($_SESSION['secure_cvv']) ? $_SESSION['secure_cvv'] : "Not available";

// Get other details from the query string
$cityname = $_GET['cityname'];
$plateId = $_GET['plateId'];
$carPrice = $_GET['price'];

$cardnumber = $_GET['cardNumber'];
$cvv = $_GET['cvv'];

// Insert data into the Reservation table
$sqlReservation = "INSERT INTO Reservation (customer_id, plate_id, Start_date, end_date,  city, Reservation_Date) 
                   VALUES ('$customerId','$plateId' ,'2024-01-01', '2024-01-07',  '$cityname', NOW())";
echo "at isset City: $customerId";

if ($conn->query($sqlReservation) === TRUE) {
    $reservationId = $conn->insert_id;


    // Update the status of the car to "Rented" in the Car table
    $sqlUpdateCarStatus = "UPDATE Car SET Status = 'Rented' WHERE plate_id = '$plateId'";
    $conn->query($sqlUpdateCarStatus);

    // Insert data into the Payment table
    $sqlPayment = "INSERT INTO Payment (cardNumber, CVV, TotalPrice, payment_Date, Reservation_id) 
                   VALUES ('$cardnumber', '$cvv', '$carPrice', NOW(), '$reservationId')";

    if ($conn->query($sqlPayment) === TRUE) {
        echo "<p>Payment and reservation successful. Thank you for your booking!</p>";
    } else {
        echo "Error: " . $sqlPayment . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $sqlReservation . "<br>" . $conn->error;
}

// Clear the session variables after use for added security
unset($_SESSION['secure_cardNumber']);
unset($_SESSION['secure_cvv']);

$conn->close();
?>
