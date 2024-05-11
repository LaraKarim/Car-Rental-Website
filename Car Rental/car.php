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

// Get the selected city from the query string
$selectedCity = $_GET['city'];

// Fetch cars in the selected city
$sql = "SELECT * FROM Car
        WHERE Location IN (
            SELECT city FROM office WHERE city = '$selectedCity'
        )";
$result = $conn->query($sql);

// Display the cars
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars in <?php echo $selectedCity; ?></title>
    <style>
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

        a {
            text-decoration: none;
            color: inherit;
        }

        div {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            text-align: center;
            background-color: transparent;
            transition: box-shadow 0.3s; /* Add smooth transition for hover effect */
        }

        div:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Add hover effect */
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
        }

        p {
            color: #555;
            margin-bottom: 15px;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .no-cars {
            color: #555;
            text-align: center;
        }
    </style>
    <script>
        function selectCar(plateId) {
            // Redirect to the car-details page with the selected plateId
            window.location.href = 'cardetails.php?plateId=' + encodeURIComponent(plateId);
        }
    </script>
</head>

<body>
    <h1>Cars in <?php echo $selectedCity; ?></h1>

    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<a href='#' onclick='selectCar(\"" . $row['plate_id'] . "\")'>";
            echo "<div>";
            echo "<h2>Car Plate ID: " . $row['plate_id'] . "</h2>";
            echo "<p>Color: " . $row['Color'] . "</p>";
            // Display other car details as needed

            // Display the car image using base64 encoding
            $imageData = base64_encode($row['Image']);
            echo '<img src="data:image/png;base64,' . $imageData . '" alt="Car Image">';

            echo "</div>";
            echo "</a>";
        }
    } else {
        echo "<p class='no-cars'>No cars available in the selected city.</p>";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>

</html>
