<?php 
include 'dbconnect1.php'; 
global $conn;
//deletes comments from table
if (isset($_GET['ed'])) {
    $commentid = htmlspecialchars($_GET['ed']);
    //display the form with fields already populated with old data
    
    $rql = "SELECT * FROM reviews WHERE commentid= $commentid";
    $result = $conn->query($rql);
    if ($result == TRUE) {
        while ($row=$result->fetch_assoc()){
            $oldresid = $row['resid'];
            $oldrating= $row['rating'];
            $oldcomment= $row['comment'];
            header("Location: ratingform.php?editing=inprogress&oldrating=$oldrating&oldcomment=$oldcomment&commentid=$commentid");

        }
      
    } else {
      echo "<p>Error fetching old comment record: </p>" . $conn->error;
    }
    //collect the inputs
    //change the old comment
    

}
    $conn->close();
?>