<?php 
    $i=1;
    $nql="SELECT COUNT(*) AS rescount FROM restaurants";
    $result = $conn->query($nql);
    if($result){
        $row=$result->fetch_assoc();
        $numRestaurants= $row['rescount'];
    }
    else{
        echo "erroneous stuff";
    }

function makeTable(){
    global $conn;
    $j=1;
    while ($j<=$numRestaurants){
        if ($j%4==1){
            echo "<tr class='restaurantRow'>";
        }
        echo "<td>";
        echo "<section class='reviewPageRestaurantSection'>"; 
                
                $sql = "SELECT * FROM restaurants WHERE resid = $j";
                $result = $conn->query($sql);
                $row=$result->fetch_assoc();
                $restaurantName = $row['resname'];
                echo "<h3>".$restaurantName."</h3>";
                $imgsrc='Media\\';
                $imgsrc .= $row['photoURL'];
                echo "<img src=".$imgsrc." class='restaurantimg'>";
                echo "<p>".$row['resaddress']."</p>";
                echo "<p>".$row['resphone']."</p>";
                $hours="Hours: ";
                //date("H:i", strtotime($mysqlTime))
                $hours.=date("H:i",strtotime($row['startTime']));
                $hours.="am - ";
                $hours.=date("H:i",strtotime($row['endTime']));
                $hours.="pm";
                echo "<p>".$hours."</p>";
                echo "</section>";           
        echo"</td>";
        if ($j%4==1){
            echo "<tr class='restaurantRow'>";
        }
        $j++;
    }

}
?>