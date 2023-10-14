<?php
//Start the session 
session_start();
$deletedSuccessfully = false;
//user credentials
$emailUser = "";
$emailErrUser = "";
$emailOKUser = true;
//admin credentials
$passwordU = "";
$passwordErrAdmin = "";
$passwordOKAdmin = true;
$emailAdmin = $_SESSION["email"];
//
$report = "";

// check if delete account button has been activated
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["passwordU"])) {
        $passwordErr = "Password is required";
        $passwordOK = false;
    } else {
        //password rules checker
        $passwordU = clean_input($_POST["passwordU"]);
        if (strlen($passwordU) < 8) {
            $passwordErrAdmin = "Password too short";
            $passwordOKAdmin = false;
        } else if (!preg_match("/[a-z]/", $passwordU)) {
            $passwordErrAdmin = "Password must contain lowercase letters";
            $passwordOKAdmin = false;
        } else if (!preg_match("/[A-Z]/", $passwordU)) {
            $passwordErrAdmin = "Password must contain uppercase letters";
            $passwordOKAdmin = false;
        } else if (!preg_match("/[0-9]/", $passwordU)) {
            $passwordErrAdmin = "Password must contain a number";
            $passwordOKAdmin = false;
        } else if (!preg_match("/[~!*@%&^]/", $passwordU)) {
            $passwordErrAdmin = "Password must contain a special character";
            $passwordOKAdmin = false;
        } else if (strlen($passwordU) > 15) {
            $passwordErrAdmin = "Password is too long";
            $passwordOKAdmin = false;
        }
    }
    if (empty($_POST["emailUser"])) {
        $emailErrUser = "Email is required";
        $emailOKUser = false;
    } else {
        $emailUser = clean_input($_POST["emailUser"]);
        // check if e-mail address is well-formed
        if (!filter_var($emailUser, FILTER_VALIDATE_EMAIL)) {
            $emailErrUser = "Invalid email format";
            $emailOKUser = false;
        }
        if (strlen($email) > 50) {
            $emailErrUser = "Email is too long";
            $emailOKUser = false;
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
if ($passwordOKAdmin) {
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

    $sql = "SELECT UserPassword FROM users WHERE UserEmail='$emailAdmin'";
    $result = $conn->query($sql);

    if ($result) {
        // Check if the query was successful
        if ($result->num_rows > 0) {
            // Fetch the data from the result object
            $row = $result->fetch_assoc();
            $passwordFromDatabase = $row['UserPassword'];
        } else {
            $emailErrUser =  "No results found for the given Admin email.";
        }
    } else {
        echo "Query failed: " . $conn->error;
    }
    $verified = password_verify($passwordU, $passwordFromDatabase);  //            check admin password
    if ($verified) {
        $sql = "SELECT UserEmail FROM users WHERE UserEmail='$emailUser'";
        $result = $conn->query($sql);

        if ($result) {
            // Check if the query was successful
            if (!$result->num_rows > 0) {                            // check if the user exists
                $emailErrUser =  "No results found for the given User email.";
                $emailOKUser = false;
            } 
        } else {
            echo "Query failed: " . $conn->error;
        }

        if ($emailOKUser) {
            $sql = "DELETE FROM users WHERE UserEmail = '$emailUser'";
            if ($conn->query($sql) === TRUE) {
                $deletedSuccessfully = true;
                
            }else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

    } else {
         $passwordErrAdmin = "Incorrect password";
    }
    $conn->close();
}  
$_SESSION["passwordU"] = $passwordU;
$_SESSION["passwordErrAdmin"] = $passwordErrAdmin;
$_SESSION["emailErrUser"] = $emailErrUser;
$_SESSION["emailUser"] = $emailUser;
if ($deletedSuccessfully) {
    $report = "Deleted successfully";
    
} else {
    $report = "Deletion unsuccesful";
}
$_SESSION["report"] = $report;
header('Location: playground.php');
?>