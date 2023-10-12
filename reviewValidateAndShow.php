<?php
    session_start();
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
    //echo var_dump($_SERVER["REQUEST_METHOD"]);
    //grab the data using the name value
    if ($_SERVER["REQUEST_METHOD"]=="POST"){ 
        //review fields are commentid, resid, useremail, rating, comment, commentdate, username
        $resid = htmlspecialchars($_POST['resid']);
        $email = htmlspecialchars($_SESSION['email']);
        $rating = htmlspecialchars($_POST["rating"]);
        $comment = htmlspecialchars($_POST["comment"]);
        $comment = trim($comment);
        $comment = stripslashes($comment);
        $date= htmlspecialchars($_POST['date']); 
        $name = htmlspecialchars($_SESSION['userName']);
        $name = trim($name);
        $name = stripslashes($name);
        $errors =[];
        if ($resid==0 || $resid ==null){
            $errors['restaurant']="Restaurant must be selected for review";
        }
        if (empty($email)){
            $errors["reviewerEmail"]="Email is required";
        }
        if(empty($rating)){
            $errors["rating"]="At least one star is required";
        }
        if (empty($comment)){
            $errors["comment"]="comment is required";
        }
        if (empty($name)){
            $errors["reviewerName"]="Name is required";
        }

        if(empty($errors)){
            echo $name;
            echo "<p> Is this working? </p>";
            
            $eql ="INSERT INTO reviews (resid, UserEmail, rating, comment, commentdate, username) 
            VALUES ($resid,'$email','$rating','$comment','$date','$name') ";
            $result = $conn->query($eql);

            header("Location: ratingForm.php?success=true");
            exit;
        }
        else {
            // Redirect with errors and field values as query parameters
            $errorString = http_build_query(['errors' => $errors, 'fields' => $_POST]);
            header("Location: ratingForm.php?$errorString");
            exit;
        }
    }
    

?>