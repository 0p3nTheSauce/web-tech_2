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
      <?php echo
        "<button id='addPhoto' type='button'>&plus;
        </button>";
      ?>
    </div>
      
    <!-- The dots/circles 
    <div style="text-align:center">
      <span class="dot" onclick="currentSlide(0)"></span>
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      <span class="dot" onclick="currentSlide(3)"></span>
      <span class="dot" onclick="currentSlide(4)"></span>
      <span class="dot" onclick="currentSlide(5)"></span>
      <span class="dot" onclick="currentSlide(6)"></span>
      <span class="dot" onclick="currentSlide(7)"></span>
      <span class="dot" onclick="currentSlide(8)"></span>
    </div>
    -->
    
    <?php include 'Reusable\footer.php';?><!--footer-->
    </body>
    
</html>

