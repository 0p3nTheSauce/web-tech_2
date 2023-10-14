<!--need to put php if statement so only make the section with restaurant image if you are getting here via the actual restaurant, also restaurant review page should be accessible via a dropdown-->
<?php
    date_default_timezone_set('Africa/Johannesburg');
    include 'dbconnect1.php'; 
    include 'reviewValidateAndShow.php';    
    include 'dealcomments.php';
    //Set session variables 
    if (!isset($_SESSION["loggedIn"])) {
        $_SESSION["loggedIn"] = false;
        //echo '<p> User is not logged in</p>';
    } else if ($_SESSION["loggedIn"]) {
        //echo $_SESSION["userName"], "<p> Is logged in</p>";
    } else {
        //echo '<p> User is not logged in</p>';
    }
?>

<!DOCTYPE html>
    <html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylish.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=shadow-multiple">
    <!-- This imports google fonts -->
    <title>Grahamstown Grub Stop</title>
	<script src="Demo.js" ></script>
    <script defer src="ratingformscript.js"></script>
    </head>
    <body>
        <?php include 'Reusable\heading.php';?><!--heading-->
        <section id="form-restaurant-section"> 
            <?php if (isset($_GET['editing'])){ echo "<div id='editcom' style='background-color:white; text-align:center; color:red; padding:1%; margin:auto; width:60%;'><p>Edit your original comment in the <a href='#editer'>form</a></p></div>";} ?>
            <?php 
            if (isset($_GET['restaurant'])) {
                //echo "restaurant:";
                $clicked_id = $_GET['restaurant'];
                $_SESSION['resid']=$clicked_id;
            }
            else{
                if (isset($_SESSION['resid'])){
                    $clicked_id=$_SESSION['resid'];
                }
                else {
                    $clicked_id=1;
                }
            } ?>
                <?php echo "<section class='reviewPageRestaurantSection'>"; 
                global $conn;
                $sql = "SELECT * FROM restaurants WHERE resid = $clicked_id";
                $result = $conn->query($sql);
                $row=$result->fetch_assoc();
                $restaurantName = $row['resname'];
                echo "<h3>".$restaurantName."</h3>";
                $imgsrc='Media\\';
                $imgsrc .= $row['photoURL'];
                echo "<img src=".$imgsrc." class='restaurantimg'>";
                echo "<p>".$row['resaddress']."</p>";
                echo "<p>".$row['resphone']."</p>";
                $hours="Hours: ";
                //date("H:i", strtotime($mysqlTime))
                $hours.=date("H:i",strtotime($row['startTime']));
                $hours.="am - ";
                $hours.=date("H:i",strtotime($row['endTime']));
                $hours.="pm";
                echo "<p>".$hours."</p>";
                echo "</section>";           
            ?>
        <section class="restaurantReviewForm">
            <form action="reviewValidateAndShow.php" method="POST" >
                <h3 id="resto_title"></h3>
                <input type='hidden' name ='resid' value='<?php echo $clicked_id; ?>'>
                <input type= 'hidden' name='date' value= "<?php echo date('Y-m-d H:i:s'); ?>" >
                <?php if ($_SESSION["loggedIn"]) { echo "Hello, ". $_SESSION["userName"]."<br/><br/>"; } ?>
                <?php if (!($_SESSION["loggedIn"])){echo "<p> Please <a href='signin.php'>log in</a> first to leave a review. </p>";}?>
                <?php if (($_SESSION["loggedIn"])){ 
                    $originalComment='';
                    $originalRating=0;
                    $oldcomid=-1;
                    $checked1='';
                    $checked2='';
                    $checked3='';
                    $checked4='';
                    $checked5='';

                    if (isset($_GET['editing'])){
                        if ($_GET['editing']=="inprogress"){
                            echo "<p>*Edit your original comment </p>";
                            if (isset($_GET['commentid'])){
                                $oldcomid=$_GET['commentid'];
                                //echo "<p>".$oldcomid."</p>";
                            }
                            if (isset($_GET['oldrating'])){
                                $originalRating=$_GET['oldrating'];
                                echo "<p> *Would you like to change your rating from a ".$originalRating."?</p>"; 
                                switch($originalRating){
                                    case(1):
                                        $checked1='checked';
                                        break;
                                    case(2):
                                        $checked2='checked';
                                        break;
                                    case(3):
                                        $checked3='checked';
                                        break;
                                    case(4):
                                        $checked4='checked';
                                        break;
                                    case(5):
                                        $checked5='checked';
                                        break;
                                    case(0):
                                        break;

                                }
                            }
                            if (isset($_GET['oldcomment'])){
                                $originalComment=$_GET['oldcomment'];
                            }
                        }
                }
                    echo
                '<label><a id="editer">Rate the restaurant out of five:</a></label><br>
                <section class="star-rating-group">
                    <input type="radio" id="rating-1" name="rating" value="1" ' .$checked1 . '/>
                    <label for="rating-1" class="fa fa-star" id="star-1"></label>
                    <input type="radio" id="rating-2" name="rating" value="2" '. $checked2 .'/>
                    <label for="rating-2" class="fa fa-star" id="star-2"></label>
                    <input type="radio" id="rating-3" name="rating" value="3" '. $checked3  .'/>
                    <label for="rating-3" class="fa fa-star" id="star-3"></label>
                    <input type="radio" id="rating-4" name="rating" value="4" '. $checked4  .'/>
                    <label for="rating-4" class="fa fa-star" id="star-4"></label>
                    <input type="radio" id="rating-5" name="rating" value="5" '. $checked5  .'/>
                    <label for="rating-5" class="fa fa-star" id="star-5"></label>
                </section>
                <br>';} ?>

                <input type='hidden' name='oldcomid' value='<?php echo $oldcomid ?>'>

                <?php if (($_SESSION["loggedIn"])){ 
                       if(!empty($_GET['errors'])){
                            $errors=$_GET['errors'];
                        }
                    if (isset($errors['commentError'])){ echo "<p class='mandate'>".$errors['commentError']."</p>";}
                    echo 
                '<label for="comment">*Comments</label><section class="error"></section>
                <section class="comment-group">                    
                    <textarea id="comment" name="comment" placeholder="Share your experience of eating at the restaurant..." rows="20">'.$originalComment.'</textarea><br>
                </section>
                <button type="submit" id="submit_review_btn">Submit review</button>';} ?>
                <section><?php if (!empty($_GET['success'])&& $_GET['success']==true ){echo "<p class='success-mandate'>Your review was submitted successfully</p>";} ?></section>
            </form>   
        </section> <!--form container popup review-->   
        </section><!--contains restaurant image and review-->
        <section id='commentSection'>
            <?php 
            if (isset($_GET['deletion'])) {
                echo "<section id='successfulDel'>";
                if ($_GET['deletion']=='success'){
                    echo "<span>&#9989;</span> Your comment was deleted successfully";
                }
                else{
                    echo "Your mark will remain forever";
                }
                echo "</section>";
            }
            if(isset($_GET['doneediting'])){
                echo "<section id='successfulDel'>";
                if ($_GET['doneediting']=='true'){
                    echo "<span>&#9989;</span> Your comment was edited successfully";
                }
                else{
                    echo "Your original comment will remain forever";
                }
                echo "</section>";
            }
            getComments($conn, $clicked_id); ?>


        </section>
        
       
    </body>

</html>