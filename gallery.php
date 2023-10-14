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
         
        
          <?php
          $servername = "cs3-dev.ict.ru.ac.za";
          $username = "G19M8152";
          $password = "G19M8152";
          $database = "compKing";

          // Create connection
          $connect = new mysqli($servername, $username, $password,$database);
      
          // Check connection
          if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
          }

          /*Get pictures from database and output to image carousel  */
          /*
          <section class="image-container active">
            <img id="Barista" src="Media/barista.jpg" onclick="descibeImage(this.id)">
            <div class="text">Barista</div>
          </section>
          placeholder images for image-->
*/    
          $arr_images = array("images");

          //SELECT all images from database
          $result = $connect->query("SELECT image FROM images ORDER BY imageid DESC");
          if($result){
            
            while($row = $result->fetch_assoc()){

              echo "<section id='slider-images'>";
                echo "<section class='image-container'>";
                  echo "<img src='data:image/jpg;charset=utf8;base64,", base64_encode($row['image']), "/>";
                  echo "<div class='text'>TEXT</div>";
                echo "</section>";
              echo "</section>";
            }} else{
              echo "<p class='status error'>Image(s) not found...</p>";
            }
          ?>
        
      </section>

      <br>
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
    // working php for upload function
    //echo "<p>" . $_SESSION['IsAdmin'] . "</p>"
    
    //if($_SESSION['IsAdmin'] == true){
      //developer button to upload files
        error_reporting(E_ERROR | E_PARSE);
        echo "<div id='admin_upload'>";
        echo "<p id='admin_photo_heading'>Admins add photos here</p>";
        echo "<form method='POST' action='addphoto.php' enctype='multipart/form-data'>";
        echo "    <input type='file' name='file_upload' />";
        echo "    <input type='submit' value='Upload' name='img_submit'>";
        echo "</form>";
        echo "</div>";
    //} 
    
    ?>
      
    <?php include 'Reusable\footer.php';?><!--footer-->
    </body>
    
</html>

