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
		<!-- This imports google fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet"  href="stylish.css">
		<script src="Demo.js" ></script>
        <title>Grahamstown Grub Stop</title>
    </head>
    <body>
    <?php include 'Reusable\heading.php';?><!--heading-->
        <h2 title="Our trustworthy group members" class="center">
            Meet the organisation!
        </h2>
        <table>
        <tr class="aboutrow">
            <td class="column" id="column1">
            <!-- About Luke -->
                <h3 title="Master of disaster">
                    Luke Goodall
                </h3>
                <img src="Media\Luke_photo.jpg" alt="A picture of Luke" class="center" width:200px height:200px>
                <p title= "Sir">
                    Majoring in Biochemistry and <br> 
                    Computer Science. <br>
                    Can cook a pretty good spaghetti.<br>
                    Enjoys the finer things in life,<br>
                    such as external styling and scripts.<br>
                    Teller of the occasional bad pun.<br>
                </p>
            </td>
            <td class="column" class="center" id="column2">
                <!-- About Litha -->
                <h3 title="L">
                    Litha Mabona
                </h3>
                <img src="Media\Litha_photo.jpg" alt="A picture of Litha" class="center" width:200px height:200px>
                <p  title= "Sir">
                    Is an Anime nerd and  <br> 
                    Cyber Security enthusiast. <br>
                    Learned how to make a pizza<br>
                    over the holiday that wouldn't<br>
                    impress an Italian<br>
                    majoring in Computer Science and<br>
                    Information Systems<br>
                </p>
            </td>
            <td class="column" class="center" id="column3">
            <!-- about Caron -->
                <h3 title="c">
                Caron Rademan
                </h3>
                <img src="Media\caronavatar.jpg" alt="A cartoon representation of Caron" class="center" width:200px height:200px>
                <p  title= "Ms">
                Has sampled coffee from all of<br> 
                Grahamstown's cafes.<br> 
                Studying computer science,<br> 
                biochemistry, and microbiology.<br>
                Fan of cats, chess, and <br>
                rock climbing.<br>
                </p>
            </td>
        </tr>
        </table>
        <?php include 'Reusable\footer.php';?><!--footer-->
    </body>
</html>