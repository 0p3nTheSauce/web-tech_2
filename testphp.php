<?php
$servername = "cs3-dev.ict.ru.ac.za";
$username = "G21R7490";
$password = "G21R7490";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>