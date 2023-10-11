<?php 
//Start the session 
session_start();
//Set session variables 
if (!isset($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
    
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=shadow-multiple">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- This imports google fonts -->
    <link rel="stylesheet" href="stylish.css">
	<script src="Demo.js" ></script>
    <title>Grahamstown Grub Stop</title>
  </head>
  <body>
    <?php include 'Reusable\heading.php';?><!--heading-->
    <h2 title="We're so pleased to have you">
      Welcome to your ultimate guide to the culinary wonders of local restaurants, where we explore everything from the most luxurious dining experiences to the most
      budget-friendly gems in our area.
    </h2>
    <figure>
      <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3334.302843032574!2d26.52509347656545!3d-33.31089729038036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1srestaurant!5e0!3m2!1sen!2sza!4v1695228033465!5m2!1sen!2sza" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </figure>
    <p title="So pleased that you took the time to read" class="home">
      As you navigate the culinary landscape of our town, prepare to embark on a flavorful journey like no other. 
      From the upscale elegance of <b>Major Frazers</b> to the cozy charm of the <b>Pothole and Donkey</b>, our 
      comprehensive reviews will be your compass. Discover the delectable creations at the <b>Rat and Parrot</b>  
      or savor affordable yet delicious bites at the <b>House of Curry</b>. We're here to be your trusted source 
      for dining experiences, ensuring you find the perfect spot to satisfy your cravings, whether you're 
      seeking haute cuisine or wallet-friendly options.
    </p>
    
    <div class="clearfix" id="menu">
      <box class="box" >
        <div class="dropdown">
          <h4>
            Top 5 Rated restaurants
          </h4>
          <nav class="dropdown-content">
            <a href="restaurants.php#MJ">Major Frazor</a><br>
            <a href="restaurants.php#PHD">Pothole & Donkey</a><br>
            <a href="restaurants.php#RC">Red Cafe</a><br>
            <a href="restaurants.php#RP">Rat & Parrot</a><br>
            <a href="restaurants.php#P">Pandas</a><br>
          </nav>
        </div>
      </box>
      
      <box class="box">
        <div class="dropdown">
          <h4>
            Ongoing Specials
          </h4>
          <nav class="dropdown-content">
            <a href="restaurants.php#PHD">Monday Burger special: buy any burger and get a traditional burger for free at the Pothole & Donkey</a><br>
            <a href="restaurants.php#RP">Buy a pizza and get a free Fanta at The Rat</a><br>
            <a href="restaurants.php#FD">Three lasagnes for the price of two at Forke & Dagger</a><br>
          </nav>
        </div>
      </box>
    </div>
    
    <?php include 'Reusable\footer.php';?><!--footer-->
  </body>
</html>