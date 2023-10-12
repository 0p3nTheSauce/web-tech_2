<?php
//Start the session 
session_start();
$deletedSuccessfully = false;
$email = $_SESSION["email"];
$passwordU = "";
$passwordErr = "";
$passwordOK = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $sql = "SELECT UserPassword FROM users WHERE UserEmail='$email'";
    $result = $conn->query($sql);

    if ($result) {
        // Check if the query was successful
        if ($result->num_rows > 0) {
            // Fetch the data from the result object
            $row = $result->fetch_assoc();
            $passwordFromDatabase = $row['UserPassword'];
        } else {
            echo "No results found for the given email.";
        }
    } else {
        echo "Query failed: " . $conn->error;
    }
    
    if ($passwordFromDatabase == $passwordU) {
        $sql = "DELETE FROM users WHERE UserEmail = '$email'";
        if ($conn->query($sql) === TRUE) {
            $deletedSuccessfully = true;
            //Unset session variables 
            session_unset();
            $_SESSION["loggedIn"] = false;
        }else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // $passwordErr = "Incorrect password";
    }
    $conn->close();
}  
$_SESSION["passwordU"] = $passwordU;
$_SESSION["passwordErr"] = $passwordErr;
if ($deletedSuccessfully) {
    header('Location: signup.php');
} else {
    header('Location: loggedIn.php');
}
?>