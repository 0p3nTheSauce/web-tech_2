<?php
$servername = "cs3-dev.ict.ru.ac.za";
$username = "G19M8152";
$password = "G19M8152";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
echo "test";

$retval = mysqli_select_db($conn, "compking");
if (!$retval){
  die("could not select database".mysqli_error($conn));
}

echo "database compking selected successfully";
echo "<br>";
/*
//sql to create table
$sql = "CREATE TABLE `images` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `file_name` varchar(255) unique NULL,
    `uploaded_on` datetime NOT NULL,
    PRIMARY KEY (`id`)
  )";
*/
//ALTER TABLE compking.users ADD CONSTRAINT unique (UserName);
//sql to create table
/*
$sql = "CREATE TABLE Users (
    UserEmail VARCHAR(50) PRIMARY KEY,
    UserName VARCHAR(50) NOT NULL,
    IsAdmin BOOLEAN NOT NULL,
    UserPassword VARCHAR(15) NOT NULL)";


*/
// $sql = "ALTER TABLE Users 
// MODIFY UserPassword VARCHAR(100)";
if ($conn->query($sql) === TRUE) {
  echo "Table Users ALTERED successfully";
} else {
  echo "Error ALTERING table: " . $conn->error;
}
$conn->close();

?> 