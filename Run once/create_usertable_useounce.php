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
// $passwordU = "Spider1!";
// $hased_password = password_hash($passwordU, PASSWORD_DEFAULT);
// $sql = "INSERT INTO users (UserEmail, UserName, IsAdmin, UserPassword)
//                 VALUES ('g21g8924@campus.ru.ac.za', 'Luke Goodall', 1, '$hased_password')";

if ($conn->query($sql) === TRUE) {
  echo "Table Users ALTERED successfully";
} else {
  echo "Error ALTERING table: " . $conn->error;
}
$conn->close();

?>   