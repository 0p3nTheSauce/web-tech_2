<?php
include dbconnect1;
$sql =  
"SELECT
    r.resid,
    r.resname,
    AVG(re.rating) AS averageRating
FROM
    restaurants r
LEFT JOIN
    reviews re ON r.resid = re.resid
GROUP BY
    r.resid, r.resname;
";

if ($conn->query($sql)==TRUE){
    echo "query executed successfully";
  }
  else{
    echo "Error ".$sql ."<br>" .$conn->error;
  }
$conn->close();  

?>