<?php 
//Start the session 
session_start();
//Set session variables 

if (!isset($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
    echo '<p> User is not logged in</p>';
} else if ($_SESSION["loggedIn"]) {
    echo $_SESSION["userName"], "<p> Is logged in</p>";
} else {
    echo '<p> User is not logged in</p>';
}

if (!isset($_SESSION["userName"])){
    $_SESSION["userName"] = "";
}
if (!isset($_SESSION["nameErr"])){
    $_SESSION["nameErr"] = "";
}
if (!isset($_SESSION["passwordU"])){
    $_SESSION["passwordU"] = "";
}
if (!isset($_SESSION["passwordErr"])){
    $_SESSION["passwordErr"] = "";
}
if (!isset($_SESSION["repPassword"])){
    $_SESSION["repPassword"]= "";
}
if (!isset($_SESSION["repPasswordErr"])){
    $_SESSION["repPasswordErr"] = "";
}
if (!isset( $_SESSION["email"])){
    $_SESSION["email"] = "";
}
if (!isset($_SESSION["emailErr"])){
    $_SESSION["emailErr"] = "";
}
$name = $_SESSION["userName"];
$nameErr = $_SESSION["nameErr"];
$passwordU = $_SESSION["passwordU"];
$passwordErr = $_SESSION["passwordErr"];
$repPassword = $_SESSION["repPassword"];
$repPasswordErr = $_SESSION["repPasswordErr"];
$email = $_SESSION["email"];
$emailErr = $_SESSION["emailErr"];
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
        <h1>Register</h1>
        <!-- <h1 id="form_title">Register</h1> -->
        <p><span class="errors">* required field</span></p>
        <form method="post" action="signUpValidation.php"> <!--Validation done in in same  file-->
            <p id="error"></p>
            <section class="input-group">
                <section class="input-field" id="name_field">
                    <i class="material-symbols-outlined">person</i>
                    <input type="text" placeholder="Name" id="name" name="name" value="<?php echo $name;?>">
                    
                </section>
                <span class="errors">* <?php echo $nameErr?></span>
                <section class="input-field">
                    <i class="material-symbols-outlined">mail</i>
                    <input type="email" placeholder="Email" id="email" name="email" value="<?php echo $email;?>">
                </section>
                <span class="errors">* <?php echo $emailErr?></span>
                <section id ="pw">
                    <p>Password requirements</p>
                    <ul>
                        <li id="len">8 letters or characters</li>
                        <li id="number">A number</li>
                        <li id="specialcharacter">A special character</li>
                        <li id="lowerletter">A lowercase letter</li>
                        <li id="upperletter">An uppercase letter</li>
                    </ul>
                </section>
                <section class="input-field">
                    <i class="material-symbols-outlined">lock</i>
                    <input type="password" placeholder="Password" id="password1" name="passwordU" value="<?php echo $passwordU;?>">
                </section>
                <span class="errors">* <?php echo $passwordErr?></span>
                <section id ="rpw">
                    <p>Repeat password</p>    
                    <p id="repeatMessage"></p>
                </section>
                <section class="input-field" id="password_confirmation_field">
                    <i class="material-symbols-outlined">lock</i>
                    <input type="password" placeholder="Confirm password" id="password2" name="repPassword" value="<?php echo $repPassword;?>">
                </section>
                <span class="errors">* <?php echo $repPasswordErr?></span>
                <p id="lostpassword">Lost password? Click <a href="#">here</a></p>
                <section class="btn-field">
                <button type = "submit" id="register_btn" class="submission">Register</button>
                <button type="button" class="disable-btn" onclick="document.location='signin.php'">Login</button>
                <!--<a id="login" href="signin.php">Login</a> -->
                </section>
            </section><!--input-group-->
        </form>
        
    </section>
</section>

<?php include 'Reusable\footer.php';?>

    </body>
</html>