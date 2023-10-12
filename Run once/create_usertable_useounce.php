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
echo "test";

$retval = mysqli_select_db($conn, "compking");
if (!$retval){
  die("could not select database".mysqli_error($conn));
}

echo "database compking selected successfully";
echo "<br>";

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