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


//sql to create table
$sql = "CREATE TABLE messages(
  msgid INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  phone VARCHAR(11),
  email VARCHAR(50),
  message VARCHAR(255) NOT NULL,
  msgdate TIMESTAMP NOT NULL)";


if ($conn->query($sql) === TRUE){
    echo "Table MESSAGES created successfully";
}
else{
    echo "Error creating table: ".$conn->error;
}
$conn -> close();
?>



