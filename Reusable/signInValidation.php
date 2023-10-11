<?php
// The reason the validation php is in the file is so that the fields aren't cleared every time the user hits submit
// define variable and set to empty values 
$nameOK = $emailOK = $passwordOK = $repPasswordOK = true;
$nameErr = $emailErr = $passwordErr = $repPasswordErr = "";
$name = $email = $password = $repPassword = "";
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
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required"; 
        $passwordOK = false;
    } else {
        $password = clean_input($_POST["password"]);
        if (strlen($password) < 8) {
            $passwordErr = "Password too short";
            $passwordOK = false;
        } else if (!preg_match("/[a-z]/", $password)) {
            $passwordErr = "Password must contain lowercase letters";
            $passwordOK = false;
        } else if (!preg_match("/[A-Z]/", $password)) {
            $passwordErr = "Password must contain uppercase letters";
            $passwordOK = false;
        } else if (!preg_match("/[0-9]/", $password)) {
            $passwordErr = "Password must contain a number";
            $passwordOK = false;
        } else if (!preg_match("/[~!*@%&^]/", $password)) {
            $passwordErr = "Password must contain a special character";
            $passwordOK = false;
        } else if (strlen($password) > 15) {
            $passwordErr = "Password is too long";
            $passwordOK = false;
        }
    }
    if (empty($_POST["repPassword"])) {
        $repPasswordErr = "Password is required";
        $repPasswordOK = false;
    } else {
        $repPassword = clean_input($_POST["repPassword"]);
        if ($repPassword !== $password) {
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


// if (!$nameOK | !$emailOK | !$passwordOK | !$repPasswordOK ) {               basic output for testing 
//     echo $nameOK, $emailOK, $passwordOK, $repPasswordOK,
//     '<p>signup failed</P>',
//     '<p>Name: </p>', $nameErr, 
//     '<p>Email: </p>', $emailErr,
//     '<p>Password: </p>', $passwordErr,
//     '<p>Repeated Password: </p>', $repPasswordErr;
// } else {
//     header("Location: signup.php");
//     echo '<p>signup successful</p>',
//             '<p>Name: </p>', $name, 
//             '<p>Email: </p>', $email,
//             '<p>Password: </p>', $password,
//             '<p>Repeated Password: </p>', $repPassword;
    
    
    
// }
?>