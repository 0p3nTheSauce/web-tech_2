<?php
//Start the session 
session_start();
$deletedSuccessfully = false;
$email = $_SESSION["email"];
$emailErr = $passwordErr = "";
$passwordU = "";
$passwordOK = true;
$report = "Deletion unsuccessful";
// check if delete account button has been activated
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["passwordU"])) {
        $passwordErr = "Password is required";
        $passwordOK = false;
    } else {
        //password rules checker
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

//input sanitization
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($passwordOK) {
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

    // old  unsafe sql
    // $sql = "SELECT UserPassword FROM users WHERE UserEmail='$email'";
    // $result = $conn->query($sql);

    //prepare to bind 
    $stmt = $conn->prepare("SELECT UserPassword FROM users WHERE UserEmail = ?");
    $stmt->bind_param("s", $email);
    //execute
    // $result = $stmt->execute();
    $stmt->execute();

    //bind result variable
    $stmt->bind_result($passwordFromDatabase);

    //fetch value
    $stmt->fetch();

    //close prepare statement for password retrievel
    $stmt->close();
    
    $verified = password_verify($passwordU, $passwordFromDatabase);  // check User password
    //passwords are hashed when placed in the database
    if ($verified) {
        
        if ($stmt = $conn->prepare("DELETE FROM users WHERE UserEmail = ?")) {
            $stmt->bind_param("s", $email);
        
            if ($stmt->execute()) {
                $deletedSuccessfully = true;
                $report = "Deletion successful";
                // Unset session variables 
                session_unset();
                $_SESSION["loggedIn"] = false;
                $_SESSION["IsAdmin"] = false;
            } else {
                $report = "Error: " . $stmt->error;
            }
        
            $stmt->close(); // Close the prepared statement
        } else {
            $report = "Error: " . $conn->error;
        }
        

    } else {
        $passwordErr = "Incorrect password";
    }
    $conn->close();
}   
if ($_SESSION["loggedIn"]) { // make the password go away once user has deleted their account
    $_SESSION["passwordU"] = $passwordU;
}
$_SESSION["passwordErr"] = $passwordErr;
$_SESSION["emailErr"] = $emailErr;
$_SESSION["report"] = $report;
if ($deletedSuccessfully) {
    header('Location: signup.php');
} else {
    header('Location: loggedIn.php');
}
?>