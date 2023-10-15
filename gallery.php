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
  <script defer src="gallery.js"></script>
    <title>Grahamstown Grub Stop</title>
  </head>
  <body onload="getImageCount()">
  <?php include 'Reusable\heading.php';
        include 'addPhoto.php';
  ?><!--heading-->
    <div class="slider_box">

      <div class="slider_controls">
        <button class="prev">&laquo</button>
      </div>
 
      <section id="slider-frame"> 
        <section id="slider-images">
          
          <section class="image-container active">
            <img id="Barista" src="Media/barista.jpg" onclick="descibeImage(this.id)">
            <div class="text">Barista</div>
          </section>

          <section class="image-container">
            <img src="Media\Major Frazors.jpeg">
            <div class="text">Majo Frazors</div>
          </section>

          <section class="image-container">
            <img src="Media\Fork&Dagger.jpg">
            <div class="text">Fork</div>
          </section>

          <section class="image-container">
            <img src="Media\revelations.jpg">
            <div class="text">revelations</div>
          </section>

          <section class="image-container">
            <img src="Media\pothole_and_donkey.jpg">
            <div class="text">Pothole and Donkey</div>
          </section>

          <section class="image-container">
            <img src="Media\panda.jpg">
            <div class="text">Panda</div>
          </section>

          <section class="image-container">
            <img src="Media\theatre cafe.jpg">
            <div class="text">Theatre Cafe</div>
          </section>

          <section class="image-container">
            <img src="Media\house_of_curry.jpg">
            <div class="text">House of Curry</div>
          </section>

          <section class="image-container">
            <img src="Media\ginos.jpg">
            <div class="text">Ginos</div>
          </section>
        </section>
      </section>
      
      <div class="slider_controls">
        <button class="next">&raquo</button>
      </div>
      <p id="imageCount" ></p>
      <br>
      <p id="lastModified"></p>
      <br>
      <p id="describer">3</p>
     
    </div>
    <?php
    
    if($_SESSION['IsAdmin'] == true){
      //developer button to upload files
        error_reporting(E_ERROR | E_PARSE);
        echo "<div id='admin_upload'>";
        echo "<p id='admin_photo_heading'>Admins add photos here</p>";
        echo "<form method='POST' action='addphoto.php' enctype='multipart/form-data'>";
        echo    "<input type='file' name='file_upload' />";
        echo    "<label for='Restaurantid'>Resid:</label>";
        echo      "<input type='text' name='Restaurantid' />";
        echo    "<input type='submit' value='Upload' name='img_submit'>";
        echo "</form>";
        echo "</div>";
    } 
    
    ?> 
    <?php include 'Reusable\footer.php';?><!--footer-->
    </body>
    
</html>

