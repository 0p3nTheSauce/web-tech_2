 <?php
    include 'dbconnect1.php'; 
    date_default_timezone_set('Africa/Johannesburg');
    global $conn;
    //echo var_dump($_SERVER["REQUEST_METHOD"]);
    //grab the data using the name value
    function sanitiseInput($x){
        $x = htmlspecialchars($x);
        $x = trim($x);
        $x = stripslashes($x);
        return $x;
    }

    if ($_SERVER["REQUEST_METHOD"]=="POST"){ 
        //names of fields in form are fname, pnum, em, msg
        //columns in the table are msgid, name, phone, email, msg, msgdate

        // prepared statements
        $stmt = $conn->prepare("INSERT INTO messages (name, phone, email, message, msgdate) VALUES (?,?,?,?,?)");
        $stmt->bind_param($fname, $pnum, $em, $msg, $date, $stmt);

        // setting values and executing prepared statement
        $fname = sanitiseInput($_POST['fname']);
        $pnum = sanitiseInput($_POST['pnum']);
        $em = sanitiseInput($_POST['em']);
        $msg = sanitiseInput($_POST['msg']);
        $date = date('Y-m-d H:i:s');
        $stmt->execute();
        
    }
    $stmt->close();
    $conn->close();
    
?>