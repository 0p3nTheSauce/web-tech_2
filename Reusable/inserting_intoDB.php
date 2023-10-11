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
echo "<br>";

$retval = mysqli_select_db($conn, "compking");
if (!$retval){
  die("could not select database".mysqli_error($conn));
}

echo "database compking selected successfully";
echo "<br>";

// $sql = "INSERT INTO Users (UserEmail, UserName, IsAdmin, UserPassword)
//         VALUES ('ljgoodall2001@gmail.com', 'Luke Goodall', '1', 'Lizard1!'),
//                 ('rademancaron@gmail.com', 'Caron Rademan', '1', 'Penguin0!'),
//                 ('mphakzmabona@gmail.com', 'Litha Mabona', '1', 'Slime15!')";



if ($conn->query($sql) === TRUE) {
    echo "Entered successfully";
} else {
    echo "Error entring: " . $conn->error;
}
$conn->close();
?>   