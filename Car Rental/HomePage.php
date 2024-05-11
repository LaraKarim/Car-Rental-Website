<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
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

.login-Link{
  left:60px;
 position: absolute;
  top: 10px; 
 color: #fff;
 text-decoration: none; 
 padding: 10px;
 font-size: 20px; 

}
.signup-link {
  position: absolute;
  top: 10px; 
  color: #fff;
  text-decoration: none;      
  padding: 10px;
  font-size: 20px;
  left:120px;
 
 }


 .image {
 display: block;
 width: 100%;
height: auto;
 }
 h1{
    color:white;
    text-align:center;
 }
 p{
    color:white;
    max-width: 800px;
    margin: 0 auto; 
    
 }
 .about-part{
    padding:70px
 }
 .about-us{
    padding-bottom:43px;
 }
 .Explore-part{
    background-color:#D9D9D9;
 }
 .explore-us{
    color:black;
    padding-top:63px;
    padding-bottom:63px;
 }
 .card-img-top {
    height: 200px; 
    object-fit: cover; 
}
.card-text{
    color:black;
}
.row{
    padding:30px;
    padding-bottom:50px;
}
.contact-part{
    padding:60px;
}
.contant-text{
    display: flex;
    justify-content: space-between;
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
}
.admin-Link{
  left:1390px;
 position: absolute;
  top: 10px; 
 color: #fff;
 text-decoration: none; 
 padding: 10px;
 font-size: 20px; 
}
.admin{
  left:1200px;
 position: absolute;
  top: 10px; 
 color: #fff;
 text-decoration: none; 
 padding: 10px;
 font-size: 20px; 
}
 </style>
<body>
    <div class="img-part">
    
    <a class= "login-Link" href="UserLoginPage.php">Login</a> 
 
   
    <a class="signup-link" href="UserSignUpPage.php">signup</a>
    <p class="admin">If You are an admin </p> <a class= "admin-Link" href="AdminLoginPage.php">Login Here</a>
    <div class="centered-text">
        <p >Welcome To Our Car Rental System</p>
    </div>
    <img class="image" src="./Assets/homepageimg.jpg" alt="car image">
    </div>


    <div class="about-part"  >
    <h1 class="about-us">About</h1>
    <p>At [Your Company Name], we are more than just a car rental service – we are your trusted travel companion. With a passion for delivering exceptional experiences, our journey began with a commitment to providing reliable, comfortable, and stylish vehicles for every adventure. Our dedicated team, comprised of industry experts and car enthusiasts, works tirelessly to ensure your satisfaction. We take pride in our unwavering commitment to safety, cleanliness, and customer service excellence. As advocates for responsible travel, we embrace sustainability in our operations. Whether you're embarking on a road trip, exploring the city, or simply need a reliable ride, we have the perfect vehicle for every occasion. Discover the joy of seamless travel with [Your Company Name]. Welcome to a world where the journey is as memorable as the destination.</p>
    </div>


   <div class="Explore-part">
   <h1 class="explore-us">Explore-Us</h1>
   <div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col">
    <div class="card h-100">
      <img src="./Assets/nissan-sunny-exterior-33.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Nissan Sunny</h5>
        <p class="card-text">is a compact sedan that effortlessly combines practicality with style. Known for its fuel efficiency and reliable performance, the Nissan Sunny is an ideal choice for those seeking a comfortable and affordable driving experience </br>

 <strong>Model:</strong> 2020 </br>
 <strong>Price/day:</strong> 1300LE</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img src="./Assets/Rectangle 21.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">JEEP</h5>
        <p class="card-text">is a compact sedan that effortlessly combines practicality with style. Known for its fuel efficiency and reliable performance, the Nissan Sunny is an ideal choice for those seeking a comfortable and affordable driving experience

</br> <strong>Model: </strong> 2018 </br>
<strong>Price/day: </strong>2500LE
</p>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card h-100">
      <img src="./Assets/Rectangle 22.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Kia</h5>
        <p class="card-text">is a compact sedan that effortlessly combines practicality with style. Known for its fuel efficiency and reliable performance, the Nissan Sunny is an ideal choice for those seeking a comfortable and affordable driving experience

</br> <strong>Model:</strong> 2020
</br> <strong>Price/day: </strong> 1300LE</p>
      </div>
    </div>
  </div>

</div>
</div>

<div class="contact-part">
<h1 class="contact-us">Contact Us</h1>
<p class="contant-text">
        <span>Telephone (+03)563813922</span>
        <span>Email CarRental@gmail.com</span>
</p>
<p class="contant-text">
        <span>Phone Number 01112232434</span>
        <span>Fax 272439</span>
</p>
</div>
</body>
</html>