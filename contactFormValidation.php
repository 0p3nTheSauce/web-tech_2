 <?php
    session_start();
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
        
        $stmt->bind_param("sssss",$fname, $pnum, $em, $msg, $date);
        $fname=$pnum=$em=$msg='';

        // setting values and executing prepared statement
        $fname = sanitiseInput($_POST['fname']);
        $pnum = sanitiseInput($_POST['pnum']);
        $em = sanitiseInput($_POST['em']);
        $msg = sanitiseInput($_POST['msg']);
        $date = date('Y-m-d H:i:s');
        $errors =[];
        $formdata=[$fname, $pnum, $em, $msg];

        //methods reused from sign in validation
        $emailOK=$phoneOK=$nameOK=$msgOK=true;

        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) { //email
            $errors['emailError'] = "*Invalid email format ";
            $emailOK = false;

        }

        if (strlen($em) > 50) {                      
            $errors['emailError'] = "*Email is too long";
            $emailOK = false;
        }
        if (strlen($em)==0){
            $errors['emailError'] = "*Email is required ";
            $emailOK = false;
        }
        if (!preg_match('/^[0-9]{9}+$/',(substr($pnum,3))) || ! $pnum[0]=='+' || ! $pnum[1]=='2' || !$pnum[2]='7'){ //phone number
            $errors['phoneError'] = "*Invalid phone number";
            $phoneOK=false;
        }

        if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) { //name
            $errors['nameError'] = "*Only letters and white space allowed";
            $nameOK = false;
        } 
        if(strlen($fname)==0){
            $nameOK=false;
            $errors['nameError'] = "*You must specify a name";
        }
        if (strlen($fname) >50 ){
            $errors['nameError'] =  "*Name too long";
            $nameOK = false;
        }
        if (strlen($msg) >255 ){
            $errors['msgError'] = "*Your message is too long.";
            $msgOK = false;
        }
        if (strlen($msg) <1 ){
            $errors['msgError'] = "*A message is compulsory.";
            $msgOK = false;
        }

        if ($phoneOK && $nameOK && $msgOK && $emailOK){
            $validMsg=true;
        }
        else{
            $validMsg=false;
        }
        
        if ($validMsg==true){
            if (isset($_SESSION['fdata'])) {
                unset($_SESSION['fdata']); // Destroy the specific session variable
            }
            $stmt->execute();
            if ($stmt==true){
                $stmt->close();
                header("Location: contact.php?msgsent=true");  
                exit;
            }
            else{
                $stmt->close();
                header("Location: contact.php?msgnotsenterror=$stmt->error");
                exit;
                
            }
        }
        
        $i=0;
        if($validMsg==false){
            $errorString="?";
            $_SESSION['fdata']=$formdata;
            foreach ($errors as $errorfield => $errormsg){
                if ($i!=0){
                    $errorString.='&';
                }
                $i++;
                $errorString.=$errorfield;
                $errorString.='=';
                $errorString.=$errormsg;
            }
            header("Location: contact.php$errorString");
            exit;
        }  
    }
    
    $conn->close();
    
?>