<?php 
    function getComments($conn, $clicked_id){
        $sql = "SELECT * FROM reviews WHERE resid = $clicked_id";
        $result = $conn->query($sql);
        while ($row=$result->fetch_assoc()){
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
            echo "<p>".$com."</p>";
            echo "<br/>";
        }
    }
?>