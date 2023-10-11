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
$sql = "CREATE TABLE comments(
  commentid INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  resid INT(3) UNSIGNED,
  UserEmail VARCHAR(50),
  rating INT(1) NOT NULL,
  comment VARCHAR(255) NOT NULL,
  commentdate DATE NOT NULL,
  FOREIGN KEY (resid) REFERENCES restaurants (resid),
  FOREIGN KEY (UserEmail) REFERENCES users (UserEmail))";
/*
$sql = "CREATE TABLE Comments(
    commentid INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    FOREIGN KEY (resid) REFERENCES restaurants(resid),
    FOREIGN KEY (UserEmail) REFERENCES users(UserEmail),
    starrating INT(1) NOT NULL,
    comment VARCHAR(255) NOT NULL,
    commentDATE DATE NOT NULL)";
*/

//ALTER TABLE compking.reviews
//ALTER username SET DEFAULT 'Human';

//ALTER TABLE compking.reviews add column username varchar(50) not null;
if ($conn->query($sql) === TRUE){
    echo "Table restaurants created successfully";
}
else{
    echo "Error creating table: ".$conn->error;
}
$conn -> close();
?>