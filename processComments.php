<?php
    function setComments($conn){
        //sanitize the data
        if (isset($_POST['commentSubmit'])){
            $resid = htmlspecialchars($_POST['resid']);
            $UserEmail = htmlspecialchars($_POST['UserEmail']);
            $rating = intval(htmlspecialchars($_POST['rating']));
            $message = htmlspecialchars($_POST['message']);
            $date= htmlspecialchars($_POST['date']);  
            
            //error checking 
            $errors =[];
            if (empty($rating)){
                $errors["rating"]="Rating is required.";
            }
            if (empty($message)){
                $errors["comment"]="A comment is required.";
            }
            if (empty($errors)){
            //insert into database
                header("Location: commentTester.php?success=true");
                echo "<p>Thank you for your review</p>";
                $sql ="INSERT INTO comments (resid, rating, comment, commentdate) 
                VALUES ('$resid','$rating','$message','$date') ";
                $result = $conn->query($sql);
            }
            else{
                // Redirect with errors and field values as query parameters
                $errorString = http_build_query(['errors' => $errors, 'fields' => $_POST]);
                header("Location: commentTester.php?.$errorString");
                exit;
            }    
        }
        
    }
    function getComments($conn){
        $sql = "SELECT * FROM  comments";
        $result = $conn->query($sql);
        while ($row=$result->fetch_assoc()){
            echo $row['comment']."<br/>";
        }
    }
