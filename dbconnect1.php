
<?php
$servername = "cs3-dev.ict.ru.ac.za";
$username = "G21R7490";
$password = "G21R7490";
$database = "compKing";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully to database";
//echo "<br>";
