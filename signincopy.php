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

<?php
// The reason the validation php is in the file is so that the fields aren't cleared every time the user hits submit
// define variable and set to empty values 
$emailOK = $passwordOK = true;
$emailErr = $passwordErr = "";
$email = $passwordU = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SESSION["loggedIn"]) { // The user is logging out 
        // remove all session variables
        session_unset();
        $_SESSION["loggedIn"] = false;
    } else { // the user is loggin in 
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
            $emailOK = false;
        } else {
            $email = clean_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                $emailOK = false;
            }
            if (strlen($email) > 50) {
                $emailErr = "Email is too long";
                $emailOK = false;
            }
        }
        if (empty($_POST["passwordU"])) {
            $passwordErr = "Password is required"; 
            $passwordOK = false;
        } else {
            $passwordU = clean_input($_POST["passwordU"]);
            if (strlen($passwordU) < 8) {
                $passwordErr = "Password too short";
                $passwordOK = false;
            } else if (!preg_match("/[a-z]/", $passwordU)) {
                $passwordErr = "Password must contain lowercase letters";
                $passwordOK = false;
            } else if (!preg_match("/[A-Z]/", $passwordU)) {
                $passwordErr = "Password must contain uppercase letters";
                $passwordOK = false;
            } else if (!preg_match("/[0-9]/", $passwordU)) {
                $passwordErr = "Password must contain a number";
                $passwordOK = false;
            } else if (!preg_match("/[~!*@%&^]/", $passwordU)) {
                $passwordErr = "Password must contain a special character";
                $passwordOK = false;
            } else if (strlen($passwordU) > 15) {
                $passwordErr = "Password is too long";
                $passwordOK = false;
            }
        }

    }
    
    
} 
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}  


// if ($_SERVER["REQUEST_METHOD"] == "POST") {           for testing                        
//     if (!$emailOK | !$passwordOK) {               
//         echo $emailOK, $passwordOK, 
//         '<p>signup failed</P>',
//         '<p>Email: </p>', $emailErr,
//         '<p>Password: </p>', $passwordErr;
//     } else {
//         echo '<p>signup successful</p>',
//                 '<p>Email: </p>', $email,
//                 '<p>Password: </p>', $passwordU;
//     }
// }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($emailOK && $passwordOK) {
        $servername = "cs3-dev.ict.ru.ac.za";
        $username = "G21G8924";
        $password = "G21G8924";
        $database = "compKing";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        $userExists = false;
        while ($row=$result->fetch_assoc()) { // search to see if username is unique
            $userEmail = $row['UserEmail'];
            $userName = $row['UserName'];
            $isAdmin = $row['IsAdmin'];
            $userPassword = $row['UserPassword'];
            if ($userEmail == $email) {
                echo "Account found.";
                $userExists = true;
                break;
            }
        }
        if ($userExists) {
            if ($passwordU == $userPassword) {
                echo '<p>sign in successful</p>',
                '<p>Name: </p>', $userName, 
                '<p>Email: </p>', $userEmail,
                '<p>Password: </p>', $userPassword,
                '<p>User: </p>', $isAdmin;
                $_SESSION["loggedIn"] = true;
                $_SESSION["userName"] = $userName;
            } else {
                echo '<p>sign in unsuccesful</p>', 
                    '<p>Password incorrect</p>'; 
            }
            
                
        } else if ($email != ""){
            echo '<p>sign in unsuccesful</p>', 
            '<p>No account with that email exists. Consider registering</p>', $email; 
        }
        $conn->close();
    } else {
        echo '<p>sign in unsuccessful</p>';
    }
}
if ($_SESSION["loggedIn"]){
    $loggedIn = true;
    $title = "Logout";

} else {
   $title = "Login";
   $loggedIn = false;
}
?>
<section class="outer-form-container">
    <section class="form-box">
        <h1 id="form_title"><?php echo $title; ?></h1>
        <?php if (!$loggedIn){
            echo '<p><span class="errors">* required field</span></p>';
        }?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> <!--Validation done in in same  file-->
            <p id="error"></p>
            <section class="input-group">
            <?php if (!$loggedIn){
                echo 
                '<section class="input-field">
                    <i class="material-symbols-outlined">mail</i>
                    <input type="text" placeholder="Email" id="email" name="email" value=',$email,' >
                </section>
                <span class="errors">*',  $emailErr, '</span>
                <section class="input-field">
                    <i class="material-symbols-outlined">lock</i>
                    <input type="password" placeholder="Password" id="password1" name="passwordU" value=',$passwordU,'>
                </section>
                <span class="errors">*', $passwordErr, '</span>';
            }?>
                <!-- <p id="lostpassword">Lost password? Click <a href="#">here</a></p> -->
                <section class="btn-field">
            <?php if (!$loggedIn){
                echo '<button id="registerlnk" class="disable-btn" type="button" >Register</button>';
            } ?>     
                <button type = "submit" id="login_btn" class="submission"><?php echo $title;?></button>
                <!--<button class="disable-btn"><a id="login" href="signup.php">Register</a> </button>-->
                </section>
            </section><!--input-group-->
        </form>
        
    </section>
</section>

<?php include 'Reusable\footer.php';?>

    </body>
</html>