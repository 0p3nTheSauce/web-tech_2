<?php
$servername = "cs3-dev.ict.ru.ac.za";
$username = "G21G8924";
$password = "G21G8924";

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
// $sql = "CREATE TABLE Users (..)";

/* For creating tables 
if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
*/
$conn->close();
?>   