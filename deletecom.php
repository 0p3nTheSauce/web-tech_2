<?php 
include 'dbconnect1.php'; 
global $conn;

if (isset($_GET['del'])) {
    $commentid = htmlspecialchars($_GET['del']);
    $rql = "DELETE FROM reviews WHERE commentid= $commentid";

    if ($conn->query($rql) === TRUE) {
        header("Location: ratingform.php?deletion=success");
      
    } else {
      echo "<p>Error deleting record: </p>" . $conn->error;
    }
}
    $conn->close();
?>