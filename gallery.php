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

      <br>
      <p id="imageCount" >10</p>

      <div class="slider_controls">
        <button class="next">&raquo</button>
      </div>

      <br>
      <p id="lastModified"></p>
      <br>
      <p id="describer">3</p>
     
    </div> 
    <div id='plusPhoto'>
      <form method='post' action = 'addpho'> 
        <input type='button' value='Upload file' onclick="form_uplaod()"> 
      </form>

      <form method='post' action='addphoto.php' enctype='multipart/form-data'>
            <input type='file' name='file' />
            <input type='submit' value='Upload' name='btn_upload'>
      </form>
    </div>
<!--
      <script>
        function form_upload(){
          
        }
      </script> 
      -->
      <?php  
      
        /*
echo "<form method='post' action='' enctype='multipart/form-data'>
            <input type='file' name='file' />
            <input type='submit' value='Upload' name='btn_upload'>
          </form>"

        if(isset($_POST['btn_upload'])){
          $maxsize = 5242880; // 5MB
          if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ''){
              $name = $_FILES['file']['name'];
              $target_dir = "Media/";
              $target_file = $target_dir . $_FILES["file"]["name"];

              // Select file type
              $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

              // Valid file extensions
              $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

              // Check extension
              if( in_array($extension,$extensions_arr) ){
        
                  // Check file size
                  if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
                    $_SESSION['message'] = "File too large. File must be less than 5MB.";
                  }else{
                    // Upload
                    if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
                      // Insert record
                      $query = "INSERT INTO videos(name,location) VALUES('".$name."','".$target_file."')";

                      mysqli_query($con,$query);
                      $_SESSION['message'] = "Upload successfully.";
                    }
                  }

              }else{
                  $_SESSION['message'] = "Invalid file extension.";
              }
          }else{
              $_SESSION['message'] = "Please select a file.";
          }
          header('location: index.php');
          exit;
        }
        */
      ?>
    
    
    <?php include 'Reusable\footer.php';?><!--footer-->
    </body>
    
</html>

