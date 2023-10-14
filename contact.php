<?php 
//Start the session 
//session_start();
//Set session variables 
include 'contactFormValidation.php';
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
		<link rel="stylesheet" href="stylish.css">
		<script src="Demo.js" ></script>
    <script defer src="contactformscript.js"></script>
    <title>Grahamstown Grub Stop</title>
    </head>
    <!--styles can be set inline e.g. <p style="font-size:16px;font-family:courier;text-align:center; -->
    <body >
    <?php include 'Reusable\heading.php';?><!--heading-->
        <h2>Contact the Grahamstown Grub Stop
        </h2>
            <section class="col">
              <?php 
                $emailError=$nameError=$phoneError=$msgError='';
                $formdata=$oldname=$oldno=$oldem=$oldmsg='';

                if (isset($_GET['msgsent'])){
                    if ($_GET['msgsent']==true){
                        echo "<p id='successfulMsg'><span>&#9989;</span> Your message was received. You will hear from us soon.</p>";
                    }
                }
                else{
                    //$formdata=[$fname, $pnum, $em, $msg];
                    if (isset($_SESSION['fdata'])){
                        $formdata = $_SESSION['fdata'];
                        $oldname = $formdata[0];
                        $oldno=$formdata[1];
                        $oldem=$formdata[2];
                        $oldmsg =$formdata[3];
                        
                    }
                    if (isset($_GET['emailError'])){
                        $emailError = $_GET['emailError'];
                    }
                    if (isset($_GET['nameError'])){
                        $nameError = $_GET['nameError'];
                    }
                    if (isset($_GET['phoneError'])){
                        $phoneError = $_GET['phoneError'];
                    }
                    if (isset($_GET['msgError'])){
                        $msgError = $_GET['msgError'];
                    }
                }
                
              ?>
              <form id="contactForm" method="post" action="contactFormValidation.php">
                  <h3>Get in touch</h3>
                  <p>Leave us a message and we will respond to your question or comment</p>
                  <p id="reqFieldErrorMsg"></p>
                  <section class="inputgroup">
                      <p class='contactFormErrorMsg'><?php echo $nameError;?></p>
                      <label for="fname">Name</label><br>
                      <input type="text" id="fname" name="fname" class="requiredField" value='<?php echo $oldname; ?>'><br>
                  </section>
                  <section class="inputgroup">
                    <p class='contactFormErrorMsg'><?php echo $phoneError;?></p>
                      <label for="pnum">Phone number</label><br>
                      <input type="text" id="pnum" name="pnum" class="requiredField" value='<?php echo $oldno; ?>' placeholder="+27"><br>
                  </section>
                  <section class="inputgroup">
                    <p class='contactFormErrorMsg'><?php echo $emailError;?></p>
                      <label for="em">Email</label><br>
                      <div id='emailNeeds'>An email requires an '@',<br>some letters<br>,and a period.</div>
                      <input type="text" id="em" name="em" class="requiredField" value='<?php echo $oldem; ?>'><br>
                  </section>
                  <section class="inputgroup">
                    <p class='contactFormErrorMsg'><?php echo $msgError;?></p>
                      <label for="msg">Message</label><br>
                      <textarea id="msg" name="msg"  rows="10" class="requiredField" value='<?php echo $oldno; ?>'></textarea><br>
                      <button type="submit">Send</button>  
                  </section>
              </form>
            </section><!--col sections-->
            <section id="contactDetails" class="col" >
                <h3>Our info</h3>
                <!--definition list used for contact details -->
                <p>Contact us to set up a meeting</p>
                <dl>
                    <dt>Email:</dt>
                    <dd><a href="mailto: grahamstowngrubstop@gmail.com">grahamstowngrubstop@gmail.com</a></dd>
                    <dt>Telephone:</dt>
                    <dd>0216898823</dd>
                    <dt>Address:</dt>
                    <dd>Hamilton Building,<br>Prince Alfred Street,<br>6139,<br>Rhodes University Campus,<br>Makhanda.</dd>
                    <dt>Contact Luke:</dt>
                    <dd><a href="mailto:ljgoodall2001@gmail.com">ljgoodall2001@gmail.com</a></dd>
                    <dt>Contact Litha:</dt>
                    <dd><a href="mailto:mphakzmabona@gmail.com">mphakzmabona@gmail.com</a></dd>
                    <dt>Contact Caron:</dt>
                    <dd><a href="mailto:rademancaron@gmail.com">rademancaron@gmail.com</a></dd>
                </dl>
            </section><!--col section-->
            <?php include 'Reusable\footer.php';?><!--footer-->
    </body>
</html>