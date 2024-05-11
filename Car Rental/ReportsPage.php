<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tableData = array(); // Initialize $tableData
$columnTitles = array(); // Initialize $columnTitles


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reportOption = $_POST["report_option"];
    $startDate = $_POST["start_date"];
    $endDate = $_POST["end_date"];

    switch ($reportOption) {
        case "1":
            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("SELECT *
             FROM 
            reservation r
            NATURAL JOIN car ca 
            NATURAL JOIN customer cu 
        WHERE 
            r.Start_date >= ? AND r.end_date <= ?");


           
            break;

        case "2":
            $stmt = $conn->prepare("SELECT * FROM reservation r
            NATURAL JOIN car ca 
            WHERE r.Start_date >= ? AND r.end_date <= ?
            GROUP BY r.Reservation_id");
                break;
        case "3":
            $stmt = $conn->prepare("SELECT c.status ,c.plate_id FROM car c
            left JOIN reservation r on c.plate_id=r.plate_id
            WHERE r.Start_date >= ? AND r.end_date <= ?
            GROUP BY c.plate_id");
                break;
        case "4":
                // Logic for Report Option 4
                echo "Generating Report for Reservation of Customer";
                break;
        case "5":
                // Logic for Report Option 5
                echo "Generating Report for Daily Payments";
                break;
        default:
            // Handle any other cases or invalid values
            echo "Invalid Report Option";
            exit();
    }
     // Bind parameters
     $stmt->bind_param("ss", $startDate, $endDate);

     // Execute the statement
     $stmt->execute();

     // Get the result set
     $result = $stmt->get_result();

     if ($result) {
        // Get column titles
        while ($fieldInfo = $result->fetch_field()) {
            $columnTitles[] = $fieldInfo->name;
        }
    
        // Create an array to store rows
        $tableData = array();
    
        while ($row = $result->fetch_assoc()) {
            $rowData = array(); // Initialize $rowData for the current row
    
            foreach ($columnTitles as $column) {
                // Check if the current column is for the image
                if ($column === 'Image' && isset($row[$column])) {
                    // Assuming 'Image' is the column name for the image data
                    $imageData = base64_encode($row[$column]);
                    $rowData[$column] = "<img src='data:image/jpeg;base64,{$imageData}' alt='Image' style='max-width:100px; max-height:100px;'>";
                } else {
                    $rowData[$column] = $row[$column];
                }
            }
    
            // Add the current row data to the tableData array
            $tableData[] = $rowData;
        }
    }
    
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Tillana:wght@400&display=swap">

    <style>
        body {
            background-color: #120F0F;
            font-family: 'Tillana', sans-serif;
        
        }

        nav {
            background-color: #D9D9D9;
            width:100%;
        }

        .navbar-brand img {
            margin-right: 40px;
        }

        .container {
            max-width: 100%;
        }

        h2 {
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <form action="ReportsPage.php" method="POST">
            <div class="container">
                <a class="navbar-brand" href="ReportsPage.php">
                    <img class="house" src="./Assets/house.svg" alt="Bootstrap" width="30" height="24">
                </a>
                <div class="ml-auto">
                    <img class="search" src="./Assets/search.svg" alt="Bootstrap" width="30" height="24">
                    <img class="gear" src="./Assets/gear.svg" alt="Bootstrap" width="30" height="24">
                    <img class="inbox" src="./Assets/inbox.svg" alt="Bootstrap" width="30" height="24">
                </div>
            </div>
        </form>
    </nav>

    <div class="container mt-4">
        <h2>Car Rental Information</h2>
        <table class="table table-bordered" id="carTable"></table>
    </div>
    <script>
    // Initialize tableData and columnTitles as empty arrays
    var tableData = <?php echo json_encode($tableData); ?>;
    var columnTitles = <?php echo json_encode($columnTitles); ?>;

    function generateTable(data) {
        var table = document.getElementById("carTable");
        table.innerHTML = "";

        // Check if data is an array and has length
        if (Array.isArray(data) && data.length > 0) {
            // Create table header
            var thead = table.createTHead();
            var row = thead.insertRow();

            // Use the dynamically fetched column titles as header titles
            for (var i = 0; i < columnTitles.length; i++) {
                var th = document.createElement("th");
                th.innerHTML = columnTitles[i];
                th.style.backgroundColor = "#007BFF";
                row.appendChild(th);
            }

            // Create table body
            var tbody = table.createTBody();
            for (var i = 0; i < data.length; i++) {
                var row = tbody.insertRow();
                for (var j = 0; j < columnTitles.length; j++) {
                    var cell = row.insertCell(j);
                    cell.innerHTML = data[i][columnTitles[j]];
                    cell.style.backgroundColor = "#D9D9D9";
                }
            }
        } else {
            // Display a message or take appropriate action when there is no data
            console.log("No data available");
        }
    }

    // Call the function after the page is loaded
    document.addEventListener("DOMContentLoaded", function () {
        // Call generateTable with the initialized tableData
        generateTable(tableData);
    });
</script>


</body>

</html>
