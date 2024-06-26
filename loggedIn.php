<?php 
//Start the session 
session_start();
//Set session variables 
if (!isset($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
    // echo '<p> User is not logged in</p>';                                        testing 
} else if ($_SESSION["loggedIn"]) {
    // echo $_SESSION["userName"], "<p> Is logged in</p>";
} else {
    // echo '<p> User is not logged in</p>';
}

if (!isset($_SESSION["passwordU"])){
    $_SESSION["passwordU"] = "";
}
if (!isset($_SESSION["passwordErr"])){
    $_SESSION["passwordErr"] = "";
}
if (!isset($_SESSION["isAdmin"])){
    $_SESSION["isAdmin"] = "";
}
if (!isset($_SESSION["report"])) {
    $_SESSION["report"] = "";
}

$passwordU = $_SESSION["passwordU"];
$passwordErr = $_SESSION["passwordErr"];
$report = $_SESSION["report"];
if ($_SESSION["isAdmin"]) {
    $usertype = "Admin";
} else {
    $usertype = "User";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=shadow-multiple">
		<!-- This imports google fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="stylish.css">
		<script src="Demo.js" ></script>
        <script defer src="formscript.js"></script>
        <script defer src="logingFunctionality.js"></script>
        <title>Grahamstown Grub Stop</title>
    </head>
    <body >
    <div>
        <?php include 'Reusable\heading.php';?>
    </div>

<section class="outer-form-container"> <!--Logout -->
    <section class="form-box">
        <?php 
            if ($_SESSION["loggedIn"]){
                echo '<h1 id="form_title">', $_SESSION["userName"], ' Is logged in as ',  $usertype;
            } else {
                header('Location: signin.php'); //unauthorized access
            }
        ?>
        <form method="post" action="signOut.php" onsubmit="return confirmSubmissionLogout()" > 
            <section class="input-group">
                <section class="btn-field"> 
                <button type = "submit" id="login_btn" class="submission">Logout</button>
                </section>
            </section><!--input-group-->
        </form>
        
    </section>
</section>

<section class="outer-form-container"> <!--Delete-->
    <section class="form-box">
        <h1 id="form_title">Delete account</h1>
        <p><span class="errors">* required field</span></p>
        <form method="post" action="deleteAccount.php" onsubmit="return confirmSubmissionDelete()"> <!--Pop up confirm delete account-->
        <?php if ($report != ""){
        echo "<script>alert('", $report, "')</script>";
        $_SESSION["report"] = ""; //only alert us once please
        }?>
        <p id="error"></p>
            <section class="input-field">
                <i class="material-symbols-outlined">lock</i>
                <input type="password" placeholder="Password" id="password1" name="passwordU" value="<?php echo $passwordU;?>">
            </section>
            <span class="errors">*<?php echo $passwordErr;  ?></span>
            <section class="btn-field"> 
                <button type = "submit" id="login_btn" class="submission">Delete</button>
                </section>
            </section><!--input-group-->
        </form>
        <p id="demo"></p>
        
    </section>
</section>

<?php include 'Reusable\footer.php';?>

    </body>
</html>