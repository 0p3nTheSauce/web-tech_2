<?php 
    include 'deletecom.php';
    include 'editcom.php';
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
    
    //Gets comments for specified restuarant with star rating
    function getComments($conn, $clicked_id){
        $userN = $_SESSION['userName'];
        $sql = "SELECT * FROM reviews WHERE resid = $clicked_id ORDER BY commentdate DESC";
        $result = $conn->query($sql);
        while ($row=$result->fetch_assoc()){
            $comid=$row['commentid'];
            $starNo = $row['rating'];
            
            $stars="";
            if ($starNo==0){
                $stars="0 stars!";
            }
            else{
                for ($x=0; $x<$starNo;$x++){
                    $stars.="<i class='fa fa-star'></i>";
                }
            }
            $com="User: ";
            $com.=$row['username'];
            $com.="<br/>";
            if ($row['edited']){
                $com.="*last edited: ";
            }
            $com.=$row['commentdate']."<br/>";
            $com.=$stars;
            $com.="<br/>";
            $com .= $row['comment'];
            echo "<div>";

            //check if admin -- should be able to edit and delete comments (censorship)
            $aql = "SELECT * FROM users WHERE UserName = '$userN' ";
            $resad = $conn->query($aql);
            while ($r=$resad->fetch_assoc()){
                $isAdmin = $r['IsAdmin'];
            }
            if ($_SESSION['loggedIn']==true){
                if ($_SESSION['userName']==$row['username']){
                    echo "<a id='delBut' href='deletecom.php?del=$comid'>Delete</a>";
                    echo "<a id='editBut' href='editcom.php?ed=$comid'>Edit</a>";
                }
                else if ($isAdmin==true){
                    echo "<a id='delBut' href='deletecom.php?del=$comid'>Delete</a>";
                }
            }
            echo "<p>".$com."</p>";
            echo "</div>";
            echo "<br/>";
        }
    }
?>