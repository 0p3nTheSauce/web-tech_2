<?php 
//Start the session 
session_start();

//user credentials
$nameUser = "";
$nameErrUser = "";
$nameOKUser = "";
$emailUser = "";
$isAdminUser = false;
//admin credentials
$passwordAdmin = "";
$passwordErrAdmin = "";
$passwordOKAdmin = true;
$emailAdmin = $_SESSION["email"];
//report
$reportSearch = "No users found";
//at least one user
$usersExist = false;
// check if search account button has been activated 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["passwordU"])) {
        $passwordErrAdmin = "Password required";
        $passwordOKAdmin = false;
    } else {
        //password rules checker 
        $passwordAdmin = clean_input($_POST["passwordU"]);
        if (strlen($passwordAdmin) < 8) {
            $passwordErrAdmin = "Password too short";
            $passwordOKAdmin = false;
        } else if (!preg_match("/[a-z]/", $passwordAdmin)) {
            $passwordErrAdmin = "Password must contain lowercase letters";
            $passwordOKAdmin = false;
        } else if (!preg_match("/[A-Z]/", $passwordAdmin)) {
            $passwordErrAdmin = "Password must contain uppercase letters";
            $passwordOKAdmin = false;
        } else if (!preg_match("/[0-9]/", $passwordAdmin)) {
            $passwordErrAdmin = "Password must contain a number";
            $passwordOKAdmin = false;
        } else if (!preg_match("/[~!*@%&^]/", $passwordAdmin)) {
            $passwordErrAdmin = "Password must contain a special character";
            $passwordOKAdmin = false;
        } else if (strlen($passwordAdmin) > 15) {
            $passwordErrAdmin = "Password is too long";
            $passwordOKAdmin = false;
        }
    }
    if (empty($_POST["nameUser"])) {
        // $nameErrUser = "Name is required"; empty name returns all entries
        $nameOKUser = false;
    } else {
        $nameUser = clean_input($_POST["nameUser"]);
        // check if name only contains letters and whitespace 
        if (!preg_match("/^[a-zA-Z-' ]*$/", $nameUser)) {
            $nameErrUser = "Only letters and white space allowed";
            $nameOKUser = false;
        } 
        if (strlen($nameUser) >50 ){
            $nameErrUser = "Name too long";
            $nameOKUser = false;
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
    $verified = password_verify($passwordAdmin, $passwordFromDatabase);  //check admin password
    if ($verified) {
        //get all users
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        //make array for each property
        $userNames = array("Names");
        $userEmails = array("Emails");
        $userAdmins = array("Admins");
        //regex
        $namePattern = "/".$nameUser."/i";
        


        while ($row=$result->fetch_assoc()) { // search for username 
            //get attributes
            $userEmail = $row['UserEmail'];
            $userName = $row['UserName'];
            $isAdmin = $row['IsAdmin'];
            if ($isAdmin) {
                $admin = "yes";
            } else {
                $admin = "no";
            }
            if (preg_match($namePattern, $userName)) {
                array_push($userNames, $userName);
                array_push($userEmails, $userEmail);
                array_push($userAdmins, $admin);
                $usersExist = true;
                $reportSearch = "User(s) found";
            }
        }
    } else {
        $passwordErrAdmin = "Incorrect password";
    }
    $conn->close();
}
//Admin 
$_SESSION["passwordU"] = $passwordAdmin;
$_SESSION["passwordErrAdmin"] = $passwordErrAdmin;
//User
$_SESSION["targetUserName"] = $nameUser;
$_SESSION["nameErr"] = $nameErrUser;
//report 
$_SESSION["reportSearch"] = $reportSearch;
$_SESSION["usersExist"] = $usersExist;
//arrays
$_SESSION["userEmails"] = $userEmails;
$_SESSION["userNames"] = $userNames;
$_SESSION["userAdmins"] =$userAdmins;

//return to page 
header('Location: playground.php');


?>