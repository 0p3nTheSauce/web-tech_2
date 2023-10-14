<?php 
//Start the session 
// session_start();
//Set session variables 
if (!isset($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
} 
if (!isset($_SESSION["isAdmin"])) {
  $_SESSION["isAdmin"] = false;
} 
echo '
  <header>
    <section id="topOfPage"></section>
    <a href="top"></a>
    <nav>
      <ul>
        <li id="logo">
          <h1 title="Hello there connoisseur">
            <a href="home.php" class="font-effect-shadow-multiple">Grahamstown Grub Stop</a>
        <!-- the class is used for the special effect -->
          </h1>
        </li>
        <li class="simplenavlink">
          <a href="home.php">Home</a>  
        </li>
        <li class="simplenavlink">
          <a href="about.php">About</a>  
        </li>
        <li class="simplenavlink">
          <a href="contact.php">Contact</a>  
        </li>
        <li class="simplenavlink">
          <a href="restaurants.php">Restaurants</a>  
        </li>';
        if ($_SESSION["loggedIn"]) {
          echo '<li class="simplenavlink">
                  <a href="loggedIn.php">Logout</a> 
                </li>';
        } else {
          echo  '<li class="simplenavlink">
                <a href="signin.php">Login</a> 
                </li>';
        }
        

echo 
        '<li class="hamburg">
        <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
        <a href="javascript:void(0);" class="icon" onclick="displayLinks()">
          <i class="fa fa-bars" ></i>
        </a>
        </li>
        <li class="simplenavlink">
        <div class="hiddenLinks">
          <a href="gallery.php">Gallery</a>
        </div>
        </li>';
        if ($_SESSION["isAdmin"]) { // only admins can view
          echo '<li class="simplenavlink">
          <div class="hiddenLinks">
            <a href="playground.php">Delete accounts</a>
          </div>
          </li>';
        }
echo 
        '</ul>
        </nav>
      </header>
        <section class="mobileonly">                          <!--a vertical navbar for mobile-sized screens-->
          <a href="home.php">Home</a>
          <a href="about.php">About</a> 
          <a href="contact.php" >Contact</a> 
          <a href="restaurants.php">Restaurants</a>
          <div class="hiddenLinks">
            <a href="signup.php">Login</a> 
          </div>'; 
          if ($_SESSION["isAdmin"]) { // only admins can view
            echo '<div class="hiddenLinks">
            <a href="playground.php">Delete accounts</a>
          </div>';
          }
echo '    <div class="hiddenLinks">
            <a href="gallery.php">Gallery</a>
          </div>
        </section>';

?>