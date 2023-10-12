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
            <div class="text">Fork&Dagger</div>
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
          <?php
          
            /*
          $files = glob('uploadedMedia/*');
          foreach($files as $file){
            $file_name = $files['basename'];
            echo "<p>" . $file_name . "</p>";
          }
          */
          /*
          //extract all uploaded file's to display
          $files = glob('uploadedMedia/*');
          //loop through array for every file
          foreach($files as $file){
            $file_name = basename($files);
            $file_source = "uploadedMedia\\";
            $file_full = $file_source . $file_name;
            //adding uplaod files to image carousel
            echo "<section class='image-container'>";
            echo "<img src=" . $file_full . ">";
            echo "<div class='text'>$file_name</div>";
            echo "</section>";
          } */
          ?>
        </section>
      </section>

      <br>
      <div class="slider_controls">
        <button class="next">&raquo</button>
      </div>
          <div class="slider_info">
            <p id="imageCount" ></p>
            <br>
            <p id="lastModified"></p>
            <br>
            <p id="describer">3</p>
          </div>
    </div>
    <?php
    //upload section for admins ONLY!!
    if($_SESSION['isAdmin'] == true){
      //developer button to upload files
        error_reporting(E_ERROR | E_PARSE);
        echo "<div id='admin_upload'>";
        echo "<p id='admin_photo_heading'>Admins add photos here</p>";
        echo "<form method='POST' action='addphoto.php' enctype='multipart/form-data'>";
        echo "    <input type='file' name='file_upload' />";
        echo "    <input type='submit' value='Upload' name='img_submit'>";
        echo "</form>";
        $folder = 'uploadedMedia/'; //directory or folder to loop through
          $checkFiles = scandir($folder); //scan folder content
          $fileCount = count($checkFiles); //count number of files in the directory
          $i = 0; //set for iteration;
          while($i < $fileCount){
              $file = $checkFiles[$i]; //each file is stored in an array ... 
                if($file = '.' || $file = '..'){
                  //echo nothing
                }else{
                  echo "<p>". $file ."</p>"; // file names are printed out
                }
            }
        echo "</div>";
    }  
    ?>
      
    <?php include 'Reusable\footer.php';?><!--footer-->
    </body>
    
</html>

