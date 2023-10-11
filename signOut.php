<?php 
session_start();

// remove all session variables
session_unset();
$_SESSION["loggedIn"] = false;
header('Location: signin.php');
?>