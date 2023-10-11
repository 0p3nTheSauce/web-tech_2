<?php 
//Start the session 
session_start();
//Set session variables 
$_SESSION["loggedIn"] = false;
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
$nameOK = $emailOK = $passwordOK = $repPasswordOK = true;
$nameErr = $emailErr = $passwordErr = $repPasswordErr = "";
$name = $email = $passwordU = $repPassword = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $nameOK = false;
    } else {
        $name = clean_input($_POST["name"]);
        // check if name only contains letters and whitespace 
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
            $nameOK = false;
        } 
        if (strlen($name) >50 ){
            $nameErr = "Name too long";
            $nameOK = false;
        }
    }
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
    if (empty($_POST["repPassword"])) {
        $repPasswordErr = "Password is required";
        $repPasswordOK = false;
    } else {
        $repPassword = clean_input($_POST["repPassword"]);
        if ($repPassword !== $passwordU) {
            $repPasswordErr = "Passwords do not match";
            $repPasswordOK = false;
        }
    }
} 
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}  



?>

<section class="outer-form-container">
    <section class="form-box">
        <?php 
        if ($_SESSION["loggedIn"]) {
            echo $name, "is logged in";
        } else {
            echo "not logged in";
        }
        
        if ($_SESSION["loggedIn"]) {
            $formTitle = "You are already logged in. Would you like to register another account?";
        } else {
            $formTitle = "Register";
        }
        echo "<h1 id='form_title'>" . $formTitle . "</h1>";
        ?>
        <!-- <h1 id="form_title">Register</h1> -->
        <p><span class="errors">* required field</span></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> <!--Validation done in in same  file-->
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
<?php 
// if ($_SERVER["REQUEST_METHOD"] == "POST") {                                    for testing
//     if (!$nameOK | !$emailOK | !$passwordOK | !$repPasswordOK ) {               
//         echo $nameOK, $emailOK, $passwordOK, $repPasswordOK,
//         '<p>signup failed</P>',
//         '<p>Name: </p>', $nameErr, 
//         '<p>Email: </p>', $emailErr,
//         '<p>Password: </p>', $passwordErr,
//         '<p>Repeated Password: </p>', $repPasswordErr;
//     } else {
//         echo '<p>signup successful</p>',
//                 '<p>Name: </p>', $name, 
//                 '<p>Email: </p>', $email,
//                 '<p>Password: </p>', $password,
//                 '<p>Repeated Password: </p>', $repPassword;
        
        
        
//     }
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($nameOK && $emailOK && $passwordOK && $repPasswordOK ) {
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
                echo "There already exists an account with that email.";
                $userExists = true;
                break;
            }
        }
        if (!$userExists) {
            $sql = "INSERT INTO users (UserEmail, UserName, IsAdmin, UserPassword)
                    VALUES ('$email', '$name', 0, '$passwordU')";
            echo '<p>signup successful</p>',
                '<p>Name: </p>', $name, 
                '<p>Email: </p>', $email,
                '<p>Password: </p>', $passwordU,
                '<p>Repeated Password: </p>', $repPassword;
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            //Set session variables 
            $_SESSION["loggedIn"] = true;
            $_SESSION["userName"] = $name;
        }
        
        $conn->close();
    } else {
        echo '<p>signup unsuccessful</p>';
    }
    if ($_SESSION["loggedIn"]) {
        echo $name, "is logged in";
    } else {
        echo "not logged in";
    }
}

?>
<?php include 'Reusable\footer.php';?>

    </body>
</html>