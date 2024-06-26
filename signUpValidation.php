<?php 
//Start the session 
session_start();
include 'testlogging.php';
// define variable and set to empty values 
$_SESSION["loggedIn"] = false;
$_SESSION["userName"] = "";
$_SESSION["nameErr"] = "";
$_SESSION["passwordU"] = "";
$_SESSION["passwordErr"] = "";
$_SESSION["repPassword"] ="";
$_SESSION["repPasswordErr"] ="";
$_SESSION["email"] = "";
$_SESSION["emailErrSignup"] = "";

$createdSuccessfully = false;
$nameOK = $emailOK = $passwordOK = $repPasswordOK = true;
$nameErr = $emailErrSignup = $passwordErr = $repPasswordErr = "";
$name = $email = $passwordU = $repPassword = "";

$report = "Account creation unsuccessful.";
if ($_SERVER["REQUEST_METHOD"] == "POST") { // validation of user input
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
        $emailErrSignup = "Email is required";
        $emailOK = false;
    } else {
        $email = clean_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErrSignup = "Invalid email format";
            $emailOK = false;
        }
        if (strlen($email) > 50) {
            $emailErrSignup = "Email is too long";
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
    $sql = "SELECT * FROM users"; // this sql does not need to be parameterized as it takes no input from users 
    $result = $conn->query($sql);
    $userExists = false;
    while ($row=$result->fetch_assoc()) { // search to see if username is unique
        $userEmail = $row['UserEmail'];
        $userName = $row['UserName'];
        $isAdmin = $row['IsAdmin'];
        $userPassword = $row['UserPassword'];
        if ($userEmail == $email) {
            // echo ;
            $emailErrSignup = "There already exists an account with that email. If this is you, log in instead";
            $userExists = true;
            break;
        } else if ($userName == $name) {
            $userExists = true;
            $nameErr = "That username is already taken. If this is you, log in instead, otherwise use a different username";
        }
    }
    if (!$userExists) { //sign up successful 
        $hashedpassword = password_hash($passwordU, PASSWORD_DEFAULT);

        // $sql = "INSERT INTO users (UserEmail, UserName, IsAdmin, UserPassword)
        //         VALUES ('$email', '$name', 0, '$hashedpassword')";

        // prepare to bind 
        $stmt = $conn->prepare("INSERT INTO users (UserEmail, UserName, IsAdmin, UserPassword)
                                VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $email, $name, $notAdmin, $hashedpassword);
        $notAdmin = 0;
        //execute
        $stmt->execute();
                

        if ($stmt == TRUE) {
            $createdSuccessfully = true;
            $report = "Account created successully.";
            //Set session variables 
            $_SESSION["loggedIn"] = true;
            $_SESSION["isAdmin"] = $isAdmin;
        } else {
            $report =  "Error: " . $stmt . "<br>" . $stmt->error;
        }
        $stmt->close();
    }
    
    $conn->close();
} 
$_SESSION["userName"] = $name;
$_SESSION["nameErr"] = $nameErr;
$_SESSION["passwordU"] = $passwordU;
$_SESSION["passwordErr"] = $passwordErr;
$_SESSION["repPassword"] =$repPassword;
$_SESSION["repPasswordErr"] =$repPasswordErr;
$_SESSION["email"] = $email;
$_SESSION["emailErrSignup"] = $emailErrSignup;
$_SESSION["report"] = $report;

if ($createdSuccessfully) {
    logAttempt('successful_signup',$name,$email,$isAdmin);
    header('Location: loggedIn.php');
} else {
    logAttempt('unsuccessful_signup',$name,$email,'false');
    header('Location: signup.php');
}
?>