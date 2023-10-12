<?php
include 'dbconnect1.php';

$sql = "SELECT * FROM reviews;
$result = $conn->query($sql);
while ($row=$result->fetch_assoc()){
      $rating=$row['rating'];
$sql = "SELECT AVG(rating) as av_rating FROM reviews WHERE resid = 1";
$result = $conn->query($sql);
if ($result){
    $row=$result->fetch_assoc();
    $ave=$row['av_rating'];
    echo $ave;
}
else{
    echo $conn->error;
}
?>