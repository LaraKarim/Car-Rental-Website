
<?php
session_start();



// Retrieve the customer ID from the session
$customerId = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : "Not available";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>userPage</title>
    <style>
        body {
            background-color: #120F0F;
            font-family: 'Tillana', sans-serif;
            overflow-x: hidden;
        }

        .image {
            width: 100%;
            height: 500px;
            overflow: hidden;
            position: relative;
            border-radius: 83px;
        }

        .image img {
            width: 100%;
            height: 45;
        }

        .centered-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            font-size: 50px;
            width: 80%;
            z-index: 2;
        }

        .section {
            background-color: rgba(18, 15, 15, 0.7);
            padding: 30px;
            margin-top: -200px;
            margin-bottom: 200px;
        }

        .section .title {
            font-weight: bold;
            margin-bottom: 20px;
            width: 543px;
            height: 131px;
        }

        .section .quote {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .section .search-bar {
            width: 70%;
            padding: 10px;
            margin-bottom: 20px;
        }

        .section .button {
            padding: 10px 20px;
            font-size: 20px;
            margin-right: 10px;
            cursor: pointer;
        }

        .cities-list {
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 5px;
            background-color: #120F0F;
        }

        .cities-list .city {
            margin-bottom: 5px;
        }

        .random-cars-section {
            background-color: #333333bb;
            padding: 30px;
            border-radius: 83px;
            color: white;
            display: flex;
            justify-content: space-between;
            width: 300px;
        }

        .random-cars-section h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .random-car {
            background-color: #FFFFFFCC;
            display: flex;
            border-radius: 83px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .random-car img {
            max-width: 200px;
            max-height: 160px;
            border-radius: 83px;
        }

        .random-car-info {
            flex: 1;
            padding: 20px;
        }

        .random-car-info .title {
            color: #120F0F;
            font-family: Tillana;
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .random-car-info .type {
            color: #FFFFFFCC;
            font-family: Tillana;
            font-size: 20px;
            font-weight: 500;
        }
    </style>
    <script>
        function redirectToPage(page) {
            window.location.href = page;
        }

        function searchLocations() {
            var searchInput = document.getElementById('searchLocation').value;
            var citiesList = document.getElementById('citiesList');

            // Clear previous results
            citiesList.innerHTML = '';

            // Perform AJAX request
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var cities = JSON.parse(xhr.responseText);

                    // Update the list of cities
                    cities.forEach(function (city) {
                        var cityElement = document.createElement('div');
                        cityElement.classList.add('city');
                        cityElement.innerText = city;
                        cityElement.onclick = function () {
                            selectCity(city);
                        };
                        citiesList.appendChild(cityElement);
                    });
                }
            };

            // Send the request
            xhr.open('GET', 'search.php?q=' + searchInput, true);
            xhr.send();
        }

        function selectCity(city) {
            // Redirect to a page showing cars in the selected city
            redirectToPage('car.php?city=' + encodeURIComponent(city));
        }
    </script>
</head>
<body>
    <div class="image">
        <img class="image" src="./Assets/userPage.jpg" alt="car image">
        <div class="section">
            <div class="centered-text">
                <h1>Car Rental</h1>
                <p class="quote">Drive Your Dreams, Rent Your Reality!</p>
                <p>Customer ID: <?php echo $customerId; ?></p>

                <input class="search-bar" type="text" placeholder="Search Location" id="searchLocation" oninput="searchLocations()">
                <div class="cities-list" id="citiesList"></div>
                <button class="button" onclick="redirectToPage('policy.html')">Policy</button>
                <button class="button" onclick="redirectToPage('carGuide.html')">Car Guide</button>
            </div>
        </div>
    </div>
<!-- ... previous code ... -->

<div class="random-cars-section">
    <div class="random-car">
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

        // Fetch the first random car from the database
        $sqlRandomCar = "SELECT * FROM Car ORDER BY RAND() LIMIT 3";
        $resultRandomCar = $conn->query($sqlRandomCar);

        // Display random car
        if ($resultRandomCar && $resultRandomCar->num_rows > 0) {
            $rowRandomCar = $resultRandomCar->fetch_assoc();

            // Decode the image data (assuming it's stored as BLOB)
            $imageData = base64_encode($rowRandomCar['Image']); // Assuming BLOB data
            $imageSrc = 'data:image/png;base64,' . $imageData;

            echo "<img src='" . $imageSrc . "' alt='Car Image'>";
            echo "<div class='random-car-info'>";
            echo "<div class='title'>" . $rowRandomCar['Brand'] . "</div>";
            echo "<div class='type'>" . $rowRandomCar['Model'] . "</div>";
            echo "</div>";
        } else {
            echo "<p>No random cars available.</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</div>

<!-- ... remaining code ... -->

</body>
</html>
