<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Tillana:wght@400&display=swap">
    
</head>
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
    .image{
       width: 50%; 
       height: 80vh; 
       border-radius:15px;
       float: right; 
    }
    h1{
        color:white;
        margin-top:50px;
    }
    p{
        color:black;
        text-align:start;
        font-size:16px;
       
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
        width: 30%;
        height: 40px;
        background-color: #AFAFAF; 
        color: black; 
        border: 1px solid #AFAFAF; 
        border-radius: 15px;
        margin-top: 10px; 
        padding: 5px; 
        margin-right: 50%;
        
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
        .AddNewCar {
            height:103px;
    width: 70%;
    background-color: #D9D9D9;
    padding: 10px;
    border-radius: 15px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    text-decoration: none; 
    color: black;
margin-left:100px;
}
.row-buttons{
    margin-top:55px;
}
.btn-3 , .btn-4 , .btn-5{
    margin-top:40px;
}
.btn-5{
    margin-left:180px;
}

.calendar-form {
            margin-top: 30px;
            text-align: left;
            width: 50%;
            float: left; 
        }

.calendar-form label {
            color: white;
            margin-top: 20px;
            font-size: 18px;
            display: block;
            margin-right: 50%;
        }

.calendar-form input {
            margin-right: 50%;
            width: 20%;
            margin-top: 20px;
            height: 40px;
            background-color: #AFAFAF;
            border-radius: 15px;
            text-align: left;
        }
.error-message {
        color: #FF0000;
        font-size: 14px;
        margin-top: 5px;
    }
    </style>
<body>
<nav class="navbar bg-body-tertiary">
<form action="AdminReports.php" method="POST">
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
<label for="report_option">Select Report Option:</label>
            <select id="report_option" name="report_option" required>
                <option value="" disabled selected>Choose An option</option>
                <option value="1">Reservation of car & Customer</option>
                <option value="2">Reservation of any car</option>
                <option value="3">Status of the car</option>
                <option value="4">Reservation of Customer</option>
                <option value="5">Daily Payments</option>
            </select>
<div class="container text-center calendar-form">
       
        
        <label for="start_date">Start Date:</label>
        <input type="text" id="start_date" name="start_date" required placeholder="YYYY-MM-DD">
        <div id="start_date_error" class="error-message"></div>


        <label for="end_date">End Date:</label>
        <input type="text" id="end_date" name="end_date" required placeholder="YYYY-MM-DD">
        <div id="end_date_error" class="error-message"></div>

        <input type="submit" onclick="validateDates()" class="login-btn" value="Submit">
    </div>

  </div>
</div>
</div>
    <div class="col">
     <img class="image" src="./Assets/homepageimg.jpg"/>
    </div>
  </div>
  
</div>
<script>
        function validateDates() {
            var startDate = document.getElementById("start_date").value;
            var endDate = document.getElementById("end_date").value;

            if (!isValidDateFormat(startDate)) {
                document.getElementById("start_date_error").innerHTML = "Invalid date format. Please use YYYY-MM-DD.";
                return false;
            } else {
                document.getElementById("start_date_error").innerHTML = "";
            }

            if (!isValidDateFormat(endDate)) {
                document.getElementById("end_date_error").innerHTML = "Invalid date format. Please use YYYY-MM-DD.";
                return false;
            } else {
                document.getElementById("end_date_error").innerHTML = "";
            }

            // Continue with form submission if dates are valid
            document.forms[0].submit();
        }

        function isValidDateFormat(dateString) {
            var regex = /^\d{4}-\d{2}-\d{2}$/;
            return regex.test(dateString);
        }
    </script>
</form>
</body>
</html>