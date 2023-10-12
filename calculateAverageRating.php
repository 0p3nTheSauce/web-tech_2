<?php
include 'dbconnect1.php';
function calcAvs(){
    $i=1;
    $nql="SELECT COUNT(*) AS rescount FROM restaurants";
    $result = $conn->query($nql);
    if($result){
        $row=$result->fetch_assoc();
        $numRestaurants= $row['rescount'];


    while ($i<=$numRestaurants){
        $sql = "SELECT AVG(rating) as av_rating FROM reviews WHERE resid = $i";
        $result2 = $conn->query($sql);
        if ($result2){
            $row=$result2->fetch_assoc();
            $ave=$row['av_rating'];
            if($ave==0){
                $formattedAve=0;
            }
            else{
                $formattedAve = number_format($ave, 0);
            }
            echo $formattedAve;
            echo "<br/>";
            $pql = "UPDATE restaurants
            SET averageRating = $formattedAve
            WHERE resid = $i";
            $result3 = $conn-> query($pql);
            if($result3==true){
                //echo "update success";
            }
            else{
                //echo "not successful update";
            }
        }
        $i++;

        }
    }
    else{
        echo "error";
    }
}

?>

