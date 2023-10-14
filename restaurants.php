<?php 
//Start the session 
session_start();
//Set session variables 
if (!isset($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
    
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=shadow-multiple">
		<!-- This imports google fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Grahamstown Grub Stop</title>
        <link rel="stylesheet" href="stylish.css">
	<script src="Demo.js" ></script>
        <script defer src="ratescript.js"></script>
    </head>
    <body id="restaurantBody">
    <?php include 'Reusable\heading.php';?><!--heading-->
    <?php include 'calculateAverageRating.php';?>
        <h2>Independent restaurants of Grahamstown</h2>
        <a id="top"></a>

<?php  
echo "<section id='tablewrapper'>";  
    global $conn;
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
    $j=1;

    echo "<table id='restaurantTable'>";
    while ($j<=$numRestaurants){
        if ($j%4==1){
            echo "<tr class='restaurantRow'>";
        }
        echo "<td class='restaurantbloc'>";
        echo "<section class='restaurantSection'>"; 
                
                $sql = "SELECT * FROM restaurants WHERE resid = $j";
                $result = $conn->query($sql);
                $row=$result->fetch_assoc();
                $restaurantName = $row['resname'];
                echo "<h3>".$restaurantName."</h3>";
                $restaurantWebsite = $row['website'];
                $imgsrc='Media\\';
                $imgsrc .= $row['photoURL'];
                echo "<a href=".$restaurantWebsite.">";
                echo "<img src=".$imgsrc." class='restaurantimg'>";
                echo "</a>";
                echo "<p>".$row['resaddress']."</p>";
                $telno = $row['resphone'];
                echo "<p><a href='tel:".$telno."'>".$telno."</a></p>";
                $hours="Hours: ";
                //date("H:i", strtotime($mysqlTime))
                $hours.=date("H:i",strtotime($row['startTime']));
                $hours.="am - ";
                $hours.=date("H:i",strtotime($row['endTime']));
                $hours.="pm";
                echo "<p>".$hours."</p>";
                echo "<section class='general_stars'>";
                echo "<p><a href='ratingform.php?restaurant=$j' class='linkToPop'>Review</a></p>";
                    doStars($j); 
                echo"</section>"; //general stars section ends here
        echo "</section>"; //restaurant section ends here          
        echo"</td>"; //table bloc ends here
        if ($j%4==0){
            echo "<tr class='restaurantRow'>";
        }
        $j++;
    }
    if (($j - 1) % 4 !== 0) {
        echo "</tr>";
    }
    echo "</table>"; //table ends here 
    echo "</section>"; //tablewrapper ends here
?>
    <?php include 'Reusable\footer.php';?><!--footer-->
    </body>
</html>