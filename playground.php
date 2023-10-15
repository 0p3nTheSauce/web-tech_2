<?php 
//This page should only be accessed by admins and affords them certain functionality

//Start the session 
session_start();
//Set session variables
$login_message ="User is not logged in";
$login_status = false;
$isAdmin = false;
$usertype = "User";

if (!isset($_SESSION["loggedIn"])) { // User log in information 
    $_SESSION["loggedIn"] = false;
    header('Location: signin.php'); // unauthorized access 
} else if ($_SESSION["loggedIn"]) {
    $login_message = "User is logged in";
    $login_status = true;
} else {
  header('Location: signin.php'); // unauthorized access 
}

if (!isset($_SESSION["isAdmin"])) {  // User type information
  header('Location: signin.php'); // unauthorized access 
} else if ($_SESSION["isAdmin"]){
  $isAdmin = true;
  $usertype = "Admin";
} else {
  header('Location: signin.php'); // unauthorized access 
}

if (!isset($_SESSION["userName"])){ 
    $_SESSION["userName"] = "";          //set userName 
}
if (!isset($_SESSION["passwordU"])){
    $_SESSION["passwordU"] = "";            //setPassword
}
if (!isset($_SESSION["passwordErrAdmin"])){
    $_SESSION["passwordErrAdmin"] = "";        //admin incorret password error message
}
if (!isset( $_SESSION["emailUser"])){
    $_SESSION["emailUser"] = "";                //set users email
}
if (!isset($_SESSION["emailErrUser"])){
    $_SESSION["emailErrUser"] = "";             // User email error message
}
if (!isset($_SESSION["report"])){
  $_SESSION["report"] = "";                       // set report 
}
if (!isset($_SESSION["reportSearch"])){
  $_SESSION["reportSearch"] = "";                       // set search report s 
}
if (!isset($_SESSION["targetUserName"])) { //when an admin is searching for another user
  $_SESSION["targetUserName"] = "";
}
if (!isset($_SESSION["nameErr"])) {
  $_SESSION["nameErr"] = "";
}
if (!isset($_SESSION["usersExist"])) {
  $_SESSION["usersExist"] = "";
}

//Admin credentials
$nameAdmin = $_SESSION["userName"];
$passwordU = $_SESSION["passwordU"];
$passwordErrAdmin = $_SESSION["passwordErrAdmin"];

//user credentials
$emailUser = $_SESSION["emailUser"];
$emailErrUser = $_SESSION["emailErrUser"];
$nameUser = $_SESSION["targetUserName"];
$nameErr = $_SESSION["nameErr"];

//report
$report = $_SESSION["report"];
$reportSearch = $_SESSION["reportSearch"];
$usersExist = $_SESSION["usersExist"];

//arrays
if (!isset($_SESSION["userEmails"])) {
  $_SESSION["userEmails"] = array("Emails");
}
if (!isset($_SESSION["userNames"])) {
  $_SESSION["userNames"] = array("Names");
}
if (!isset($_SESSION["userAdmins"])) {
  $_SESSION["userAdmins"] = array("Admins");
}
$userEmails = $_SESSION["userEmails"];
$userNames = $_SESSION["userNames"];
$userAdmins = $_SESSION["userAdmins"];
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
	  

<section class="login_information">
<h1><?php echo  $nameAdmin;?> is signed in as <?php echo  $usertype;?> </h1>
<h1>Look at <a href="lookAtLog.php">log</a></h1>
</section> 

<div class="two_column">
<!--column 1-->

  <section class="form-box-playground">               <!--Deleting accounts window-->
    <h1>Delete accounts</h1>
      <p><span class="errors">* required field</span></p>
      <form method="post" action="deleteAccountAdmin.php" onsubmit="return confirmSubmissionDeleteAdmin()"> 
      <?php if ($report != ""){
        echo "<script>alert('", $report, "')</script>";
        $_SESSION["report"] = ""; //only alert us once please
      }?>
          <section class="input-group">
              <p>Enter the user's email address</p>
              <section class="input-field">
                  <i class="material-symbols-outlined">mail</i>
                  <input type="email" placeholder="Email" id="email" name="emailUser" value="<?php echo $emailUser;?>">
              </section>
              <span class="errors">* <?php echo $emailErrUser?></span>
              <p>Enter your admin password</p>
              <section class="input-field">
                  <i class="material-symbols-outlined">lock</i>
                  <input type="password" placeholder="Password" id="password1" name="passwordU" value="<?php echo $passwordU;?>">
              </section>
              <span class="errors">* <?php echo $passwordErrAdmin?></span>
              <section class="btn-field">
              <button type = "submit" id="register_btn" class="submission">Delete</button>
              <!--<a id="login" href="signin.php">Login</a> -->
              </section>
          </section><!--input-group-->
      </form>
  </section>

<!--column 2-->

  <section class="form-box-playground">       <!--Search accounts window-->
    <h1>Search accounts</h1>
      <p><span class="errors">* required field</span></p>
      <form method="post" action="searchUsers.php" > 
          <section class="input-group">

              <p>Enter the user's username</p>
              <section class="input-field">
                  <i class="material-symbols-outlined">person</i>
                  <input type="text" placeholder="Name" id="name" name="nameUser" value="<?php echo $nameUser;?>">
              </section>
              <span class="errors"> <?php echo $nameErr?></span>

              <p>Enter your admin password</p>
              <section class="input-field">
                  <i class="material-symbols-outlined">lock</i>
                  <input type="password" placeholder="Password" id="password1" name="passwordU" value="<?php echo $passwordU;?>">
              </section>
              <span class="errors">* <?php echo $passwordErrAdmin?></span>

              <section class="btn-field">
              <button type = "submit" id="register_btn" class="submission">Search</button>
              <!--<a id="login" href="signin.php">Login</a> -->
              </section>
          </section><!--input-group-->
      </form>
  </section>
  </div> 

<?php 
echo "<h1>", $reportSearch, "</h1>";
if ($usersExist) {
  echo '
    <table>
      <tr>
        <th> ', $userNames[0] ,'</th>
        <th> ', $userEmails[0] ,'</th>
        <th> ', $userAdmins[0] ,'</th>
      </tr>';
  for ($i = 1; $i < count($userNames); $i++) {
    echo '
      <tr>
        <td>', $userNames[$i], '</td>
        <td>', $userEmails[$i], '</td>
        <td>', $userAdmins[$i], '</td>
      </tr>';
  }
  echo '</table>';
}
?>









  <!--
  <h4>Do you want to see some information?</h4>
  <button type="button" id="showAllButton" onclick="toggleView()" on>Show me</button>

  Navigator Object Properties 
	<p> Do you want to know if you have cookies enabled?</p>
	<p id="cookieMessage"></p>
	<button type="button" id="cookieButton" onclick="areCookiesEnabled()" on>Show me</button>
	
	<p> Do you want to see your app version information?</p>
	<p id="appMessage"></p>
	<button type="button" id="infoButton" onclick="appInformation()" on>Show me</button>

  <p> Do you want to know what operating system you are using?</p>
	<p id="platformMessage"></p>
	<button type="button" id="platformButton" onclick="platformInformation()" on>Show me</button>

  <p> Do you want to know what language you are using?</p>
	<p id="langMessage"></p>
	<button type="button" id="langButton" onclick="langInformation()" on>Show me</button>

  <p> Do you want to know what if your browser is online?</p>
	<p id="onlineMessage"></p>
	<button type="button" id="onlineButton" onclick="isBrowserOnline()" on>Show me</button>

  Navigator Object Methods
  <p> Do you want to know what if Java is enabled?</p>
	<p id="javaMessage"></p>
	<button type="button" id="javaButton" onclick="isJavaEnabled()" on>Show me</button>

This seems to be deprecated
  <p> Do you want to know what if Taint is enabled?</p> 
	<p id="taintMessage"></p>
	<button type="button" id="taintButton" onclick="isTaintEnabled()" on>Show me</button>


 Animations
<h4>Here are some animations</h4>
<p class="alwaysShow"><button id="animationButton" class="alwaysShow" onclick="myAnimation()">Show me</button></p> 
<div id ="animationContainer">
  <div id ="V_a" class="animate"></div>
  <div id ="V_b" class="animate"></div>
  <div id ="H_a" class="animate"></div>
  <div id ="H_b" class="animate"></div>
  <div id ="LR_a" class="animate"></div>
  <div id ="LR_b" class="animate"></div>
  <div id ="RL_a" class="animate"></div>
  <div id ="RL_b" class="animate"></div>
</div>

<h4>See a multi-column layout <a href="multicolumn.php">here</a> and a table that can lose its rows <a href="tablestuff.php">here</a></h4>
DOM methods and properties
<p id="basicp" class="alwaysShow">Make this basic paragraph look like a heading</p>
<p class="alwaysShow"><button id="attributeButton" class="alwaysShow" onclick="changeAttribute()">Show me</button></p> 

<div class="clearfix">
      <box class="box" >
        <object data="Media\burger-hungry.gif"></object>
      </box>
      <box class="box" >
        <object data="Media\martin-hungry.gif"></object>
      </box>
    </div>
-->
	
    <?php include 'Reusable\footer.php';?><!--footer-->
  </body>
</html>