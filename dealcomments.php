<?php 
    include 'deletecom.php';
    if (!isset($_SESSION["loggedIn"])) {
        $_SESSION["loggedIn"] = false;
        //echo '<p> User is not logged in</p>';
    } else if ($_SESSION["loggedIn"]) {
        //echo $_SESSION["userName"], "<p> Is logged in</p>";
    } else {
        //echo '<p> User is not logged in</p>';
    }
    include 'dbconnect1.php'; 
    global $conn;
    function getComments($conn, $clicked_id){
        $sql = "SELECT * FROM reviews WHERE resid = $clicked_id";
        $result = $conn->query($sql);
        while ($row=$result->fetch_assoc()){
            $comid=$row['commentid'];
            $starNo = $row['rating'];
            $stars="";
            for ($x=0; $x<$starNo;$x++){
                $stars.="<i class='fa fa-star'></i>";
            }
            $com="User: ";
            $com.=$row['username'];
            $com.="<br/>";
            $com.=$row['commentdate']."<br/>";
            $com.=$stars;
            $com.="<br/>";
            $com .= $row['comment'];
            echo "<div>";
            if ($_SESSION['loggedIn']==true){
                if ($_SESSION['userName']==$row['username']){
                    echo "<a id='delBut' href='deletecom.php?del=$comid'>Delete</a>";
                }
            }
            echo "<p>".$com."</p>";
            echo "</div>";
            echo "<br/>";
        }
    }
?>