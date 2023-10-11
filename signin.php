<?php 
//Start the session 
session_start();
//Set session variables 
function setter($arraykey) {
    if (!isset($arraykey)) {
        $arraykey = "";
    }
    return $arraykey;
}
if (!isset($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
    echo '<p> User is not logged in</p>';
} else if ($_SESSION["loggedIn"]) {
    echo $_SESSION["userName"], "<p> Is logged in</p>";
} else {
    echo '<p> User is not logged in</p>';
}

if (!isset($_SESSION["passwordU"])){
    $_SESSION["passwordU"] = "";
}
if (!isset($_SESSION["passwordErr"])){
    $_SESSION["passwordErr"] = "";
}
if (!isset( $_SESSION["email"])){
    $_SESSION["email"] = "";
}
if (!isset($_SESSION["emailErr"])){
    $_SESSION["emailErr"] = "";
}
$emailErr = setter($_SESSION["emailErr"]);
$passwordErr = setter($_SESSION["passwordErr"]);
$email = setter($_SESSION["email"]);
$passwordU = setter($_SESSION["passwordU"]);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=shadow-multiple">
		<!-- This imports google fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="stylish.css">
		<script src="Demo.js" ></script>
    <script defer src="formscript.js"></script>
        <title>Grahamstown Grub Stop</title>
    </head>
    <body >
    <div>
        <?php include 'Reusable\heading.php';?>
    </div>

<section class="outer-form-container">
    <section class="form-box">
        <h1 id="form_title">Login</h1>
        <p><span class="errors">* required field</span></p>
        <form method="post" action="signInValidation.php"> <!--Validation done in in same  file-->
            <p id="error"></p>
            <section class="input-group">
                <section class="input-field">
                    <i class="material-symbols-outlined">mail</i>
                    <input type="text" placeholder="Email" id="email" name="email" value="<?php echo $email; ?>" >
                </section>
                <span class="errors">*<?php echo $emailErr;?></span>
                <section class="input-field">
                    <i class="material-symbols-outlined">lock</i>
                    <input type="password" placeholder="Password" id="password1" name="passwordU" value="<?php echo $passwordU?>">
                </section>
                <span class="errors">*<?php echo $passwordErr;  ?></span>
                <!-- <p id="lostpassword">Lost password? Click <a href="#">here</a></p> -->
                <section class="btn-field"> 
                <button id="registerlnk" class="disable-btn" type="button" onclick="document.location='signup.php'">Register</button>
                <button type = "submit" id="login_btn" class="submission">Login</button>
                <!--<button class="disable-btn"><a id="login" href="signup.php">Register</a> </button>-->
                </section>
            </section><!--input-group-->
        </form>
        
    </section>
</section>

<?php include 'Reusable\footer.php';?>

    </body>
</html>