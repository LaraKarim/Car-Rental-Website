<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Tillana:wght@400&display=swap">
</head>
<style>
    body{
    background-color:#120F0F;
    font-family: 'Tillana', sans-serif; 
    overflow-x: hidden;
}
.img-part {
   position: relative;
}
.image {
 display: block;
 width: 100%;
height: 50vh;
}
.centered-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: white; 
    font-size:50px;
    width:80%;
    margin-top:180px;
}
.row{
    margin-top:140px;
}
.AddNewCar {
    width: 50%;
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
.addIcon{
    padding-bottom:3px;
    text-align:center;
}
.UpdateCar{
    width: 50%;
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
.Reports{
    width: 50%;
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
.updateCarIcon{
    padding-bottom:3px;
    text-align:center;
}
.repo{
    padding-bottom:3px;
    text-align:center;
}
</style>
<body>
<div class="img-part">
    <div class="centered-text">
        <p >Welcome Admin ! </br> What will you explore today?</p>
    </div>
    <img class="image" src="./Assets/homepageimg.jpg" alt="car image">
    </div>
    <div class="row">
    <div class="col">
     <a class="AddNewCar" href="AddNewCar.php">
        <img class="addIcon" src="./Assets/Vector.svg" alt="Add new car"/>
        <p>Add New Car</p>
</a>
    </div>
    <div class="col">
    <a class="UpdateCar" href="Update.php">
        <img class="updateCarIcon" src="./Assets/car-front-fill.svg" alt="Add new car"/>
        <p>Update A Car</p>
</a>
    </div>
    <div class="col">
    <a class="Reports" href="AdminReports.php">
        <img class="repo" src="./Assets/reports.svg" alt="Add new car"/>
        <p>Reports</p>
</a>
    </div>
  </div>
</div>
</body>
</html>