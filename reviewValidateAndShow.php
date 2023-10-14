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
        $rating=0;
        if (!isset($_POST["rating"])){
            $rating=0;
        }
        else{
            $rating = htmlspecialchars($_POST["rating"]);
        }
        //sanitise the form inputs and session variables
        $comment = htmlspecialchars($_POST["comment"]);
        $comment = trim($comment);
        $comment = stripslashes($comment);
        $date= htmlspecialchars($_POST['date']); 
        $name = htmlspecialchars($_SESSION['userName']);
        $name = trim($name);
        $name = stripslashes($name);
        $errors =[];
        $oldcomid = htmlspecialchars($_POST['oldcomid']);
        //check for empty comment
        if (empty($comment)){
            $errors["commentError"]="**A comment is required to submit a review";
        }
        if (!empty($errors)) {
            // Redirect with commentError
            $errorString = http_build_query(['errors' => $errors]);
            header("Location: ratingForm.php?$errorString");
            exit;
        }
        //use a prepared statement 
        $stmt = $conn->prepare("INSERT INTO reviews (resid, UserEmail, rating, comment, commentdate, username) 
        VALUES(?,?,?,?,?,?) ");
        $stmt->bind_param("ssssss",$resid,$email,$rating,$comment,$date,$name);

        //insert data into the db
        if(empty($errors)){
            //echo $name;
            //echo "<p> Is this working? </p>";
            if ($oldcomid==-1){
                //$eql ="INSERT INTO reviews (resid, UserEmail, rating, comment, commentdate, username) 
                //VALUES ($resid,'$email','$rating','$comment','$date','$name') ";
                $stmt->execute();

                if ($stmt==TRUE){
                    $stmt->close();
                    header("Location: ratingForm.php?success=true");
                    exit;
                }
                else{
                    $stmt->close();
                    header("Location: ratingForm.php?success=false"); //user is not logged in ---could not enter comment into table (should not actually be possible to get here, but just in case)
                }
            }
            else{
                $fql = "UPDATE reviews SET comment = '$comment', rating=$rating, commentdate='$date', edited=1  WHERE commentid = $oldcomid ";
                $res = $conn->query($fql);
                if ($res==TRUE){
                    header("Location: ratingForm.php?doneediting=true");
                    exit;
                }
                else{
                    header("Location: ratingForm.php?doneediting=false"); 
                }

            }
        }

    }
    

?>