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

//script for creating the restaurant table
/*
$sql = "CREATE TABLE restaurants(
  resid INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  resname VARCHAR(50) NOT NULL,
  resaddress VARCHAR(255) NOT NULL,
  resemail VARCHAR(50),
  resphone VARCHAR(10) NOT NULL,
  startTime TIME NOT NULL,
  endTime TIME NOT NULL,
  averageRating INT NOT NULL,
  website VARCHAR(255))";

if ($conn->query($sql)==TRUE){
  echo "Table restaurants created successfully";
}
else{
  echo "Error creating table: ".$conn->error;
}
*/

//script for adding the column 'website'
//$sql = "ALTER TABLE restaurants ADD website VARCHAR(255)";   

//script for inserting values into the table

/*

$sql = "INSERT INTO restaurants(resname, resaddress, resemail, resphone, startTime, endTime, averageRating, website) 
VALUES ('Major Fraser','38 Somerset St','','0460040006','11:00:00','10:00:00','0','http://oppositethearch.co.za/major-frasers/?gclid=EAIaIQobChMI4dHT78LhgQMVRZNoCR0EygU-EAAYASAAEgIB1vD_BwE'),
('Rat and Parrot', '59 New St','', '0466225002','11:00:00','10:00:00','0','https://ratandparrot.co.za/'),
('La Cafe/Provost', '3232 University Rd','', '0764538811','8:00:00','17:00:00','0',''),
('Red Cafe', '127 High St','', '466228384','8:00:00','16:45:00','0','https://www.facebook.com/redcafemakhanda/'),
('Pothole and Donkey', '123 High St','marketing@afritemba.com', '0466222324','7:00:00','22:00:00','0','https://www.facebook.com/potholeanddonkey/'),
('Barista', '38 Somerset St','', '0460040006','6:30:00','16:00:00','0','https://oppositethearch.co.za/the-barista/'),
('House of Curry', '45 New St','', '0832714733','8:30:00','18:00:00','0','https://www.facebook.com/thehouseofcurry/'),
('Revelations', '22 African St','revelations@insightnet.co.za','0466362433','11:00:00','22:00:00','0','revelations@insightnet.co.za'),
('Panda', '112 High St','revelations@insightnet.co.za','0466362433','11:00:00','22:00:00','0',''),
('Gino', 'Hill St','info@hotelvictoria.co.za','0635425003','11:00:00','22:00:00','0',''),
('Fork and Dagger', '49 African St','office@theforkanddagger.co.za','0466223112','12:00:00','22:00:00','0','https://www.facebook.com/theforkanddagger/'),
('Theatre Cafe', 'Prince Alfred St','','0713505439','8:00:00','17:00:00','0','https://m.facebook.com/p/Theatre-Cafe-Rhodes-University-100054622591367/')";

*/
//$sql = "ALTER TABLE restaurants ADD photoURL VARCHAR(255)";
//$sql = "INSERT INTO restaurants (photoURL) VALUES ('Media\Major Frazors.jpeg', )";

//add image urls to tables

$sql = "UPDATE restaurants
SET photoURL = CASE
    WHEN resid = 1 THEN  'MajorFrazors.jpeg'
    WHEN resid = 2 THEN  'ratAndParrot.jpg'
    WHEN resid = 3 THEN 'provost.jpg'
    WHEN resid = 4 THEN 'redcafe.jpg'
    WHEN resid = 5 THEN 'pothole_and_donkey.jpg'
    WHEN resid = 6 THEN 'barista.jpg'
    WHEN resid = 7 THEN 'house_of_curry.jpg'
    WHEN resid = 8 THEN 'revelations.jpg'
    WHEN resid = 9 THEN 'panda.jpg'
    WHEN resid = 10 THEN 'ginos.jpg'
    WHEN resid = 11 THEN 'Fork&Dagger.jpg'
    WHEN resid = 12 THEN 'theatre cafe.jpg'
END";


if ($conn->query($sql)==TRUE){
  echo "query executed successfully";
}
else{
  echo "Error ".$sql ."<br>" .$conn->error;
}

//delete a record
/*
$dql = "DELETE FROM restaurants WHERE resname='Major Frazor'";
if ($conn->query($dql)==TRUE){
  echo "record successfully deleted";
}
else{
  echo "Error ".$dql ."<br>" .$conn->error;
}
*/
//output data of each row



/*

$sql = "SELECT userName, email FROM users";
$result = $conn->query($sql);
if($result->num_rows>0){
  //output data of each row
  while($row = $result->fetch_assoc()){
    echo "user name: ".$row["userName"]." - email".$row["email"]."<br>";
  }
}
else{
    echo "0 results";
}
*/
$conn->close();
