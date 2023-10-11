<?php
    date_default_timezone_set('Africa/Johannesburg');
    include 'dbconnect1.php'; 
    include 'processComments.php';
    
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
        <title>Grahamstown Grub Stop</title>
    </head>
    <body>
        <div>This will contain the restaurant image</div>
    <?php echo 
        "<form method='POST' action='".setComments($conn)."'>
            <input type='hidden' name ='resid' value='1'>
            <input type= 'hidden' name='UserEmail' value='anonymous@gmail.com'>
            <input type='text' name='rating'><br>
            <textarea name='message'></textarea>
            <input type= 'hidden' name='date' value='".date('Y-m-d')."'>
            <br>
            <button name='commentSubmit' type='submit'>Submit</button>
        </form>";
    ?>
    <?php getComments($conn);
    ?>
        
    </body>
</html>

<section>
    <?php if(!empty($_GET['errors'])&& !empty($_GET['fields'])){
        $errors=$_GET['errors'];
        $fields =$_GET['fields'];
    }
    ?>
    <form action="processReview.php" method="post" >
    <h3 id="resto_title"></h3>
    <section class="personalDetails">
        <label>Restaurant Name</restaurant>
        <select id="restaurantReviewed" name="restaurantReviewed">
            <option value="1">Major Frazer</option>
            <option value="2">Rat and Parrot</option>
            <option value="3">La Cafe / Provost</option>
            <option value="4">Red Cafe</option>
            <option value="5">Pothole and Donkey</option>
            <option value="6">Barista</option>
            <option value="7">House of Curry</option>
            <option value="8">Revelations</option>
            <option value="9">Major Frazer</option>
            <option value="10">Panda</option>
            <option value="11">Gino's</option>
            <option value="12">Pothole and Donkey</option>
        </select><br>
        <label>*Name</label><section class="error"><?php if (isset($fields['reviewerName'])){ echo "<p>Name is mandatory!</p>";} ?></section>
        <section class="input-field">
            <input id="reviewerName" type="text" placeholder="Donald Duck" class="personalInput" name="reviewerName">
        </section>
        <label>*Email</label><section class="error"><?php if (isset($fields['reviewerEmail'])){ echo "<p>Email is mandatory!</p>";} ?></section>
        <section class="input-field">
            <input id="reviewerEmail" type="text" placeholder="donald@gmail.com" class="personalInput" name="reviewerEmail">
        </section>
    </section>
    <section id="rating">
        <input type="radio" id="onestar" value="onestar" name ="onestar" value="1">
        <input type="radio" id="twostar" value="twostar" name ="twostar" value="2">
        <input type="radio" id="threestar" value="threestar" name ="threestar" value="3">
        <input type="radio" id="fourstar" value="fourstar" name ="fourstar" value="4">
        <input type="radio" id="fivestar" value="fivestar" name ="fivestar" value="5">
    </section>
    <label for="comment">*Comments</label><section class="error"><?php if (isset($fields['comment'])){ echo "<p>A written comment is mandatory!</p>";} ?></section>
    <section class="comment-group">                    
        <textarea id="comment" name="comment" placeholder="Share your experience of eating at the restaurant..."></textarea><br>
    </section>
    <button type="submit" id="submit_review_btn">Submit review</button>
    <section><?php if (!empty($_GET['success'])){echo "<p>Your review was submitted successfully</p>";} ?></section>
    </form>
</section>    