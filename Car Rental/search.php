<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Car_Rental_System";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchInput = $_GET['q'];

// Use prepared statement to prevent SQL injection
$sql = "SELECT city FROM office WHERE city LIKE ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind the parameter
    $searchPattern = "%$searchInput%";
    $stmt->bind_param("s", $searchPattern);

    // Execute the statement
    $stmt->execute();

    // Bind the result variable
    $stmt->bind_result($city);

    $cities = array();

    // Fetch results
    while ($stmt->fetch()) {
        $cities[] = $city;
    }

    // Close the statement
    $stmt->close();
}

echo json_encode($cities);

$conn->close();
?>
