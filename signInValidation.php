<?php 
//Start the session 
session_start();

// define variable and set to empty values 
$loginSuccessful = false;
$_SESSION["loggedIn"] = false;
$_SESSION["userName"] = "";
$_SESSION["emailErr"] = "";
$_SESSION["passwordErr"] = "";
$_SESSION["email"] = "";
$_SESSION["passwordU"] = "";
$emailOK = $passwordOK = true;
$emailErr = $passwordErr = "";
$email = $passwordU = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}  

if ($emailOK && $passwordOK) { //                          logging in
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
            $userExists = true;
            break;
        }
    }
    if ($userExists) {
        if ($passwordU == $userPassword) {
            $loginSuccessful = true;
            $_SESSION["loggedIn"] = true;
            $_SESSION["userName"] = $userName;
            $_SESSION["isAdmin"] = $isAdmin;
        } else {; 
            $loginSuccessful = false;
            $passwordErr = "Incorrect password";
        }      
    } 
    $conn->close();
} 
$_SESSION["emailErr"] = $emailErr;
$_SESSION["passwordErr"] = $passwordErr;
$_SESSION["email"] = $email;
$_SESSION["passwordU"] = $passwordU;
if ($loginSuccessful) {
    header('Location: loggedIn.php');
} else {
    header('Location: signin.php');
}
?>