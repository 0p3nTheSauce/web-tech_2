<?php
    include 'dbconnect1.php'; 
    global $conn;
    //grab the data using the name value
    if ($_SERVER["REQUEST_METHOD"]=="POST"){ 
        $name = htmlspecialchars($_POST["reviewerName"]);
        $email = htmlspecialchars($_POST["reviewerEmail"]);
        $rating = htmlspecialchars($_POST["rating"]);
        $comment = htmlspecialchars($_POST["comment"]);
        $date= htmlspecialchars($_POST['date']); 
        $resid = htmlspecialchars($_POST['resid']);

        $errors =[];
        if (empty($name)){
            $errors["reviewerName"]="Name is required";
        }
        if (empty($email)){
            $errors["reviewerEmail"]="Email is required";
        }
        if (empty($comment)){
            $errors["comment"]="comment is required";
        }
        if(empty($rating)){
            $errors["rating"]="At least one star is required";
        }
        if(empty($errors)){
            $eql ="INSERT INTO reviews (resid, rating, comment, commentdate) 
            VALUES ('$resid','$rating','$comment','$date') ";
            $result = $conn->query($eql);
            header("Location: ratingForm.php?success=true");
            exit;
        }
         else {
            // Redirect with errors and field values as query parameters
            $errorString = http_build_query(['errors' => $errors, 'fields' => $_POST]);
            header("Location: ratingForm.php?.$errorString");
            exit;
        }
    }
    
    function getComments($conn){
        $sql = "SELECT * FROM  reviews";
        $result = $conn->query($sql);
        while ($row=$result->fetch_assoc()){
            echo $row['commentdate']."<br/>".$row['comment']."<br/>";
            echo "<br/";
            echo "<br/>";
            
        }
    }

?>