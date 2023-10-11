<?php 
//Start the session 
session_start();
//Set session variables 
if (!isset($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
    
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=shadow-multiple">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- This imports google fonts -->
    <link rel="stylesheet" href="stylish.css">
	<script defer src="Demo.js" ></script>
    <title>Grahamstown Grub Stop</title>
  </head>
  <body onload="initializePlayground()">

  <div>
    <?php include 'heading.php'; ?><!--heading-->
  </div>
	  
  <h4>Do you want to see some information?</h4>
  <button type="button" id="showAllButton" onclick="toggleView()" on>Show me</button>

  <!-- Navigator Object Properties -->
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

  <!-- Navigator Object Methods -->
  <p> Do you want to know what if Java is enabled?</p>
	<p id="javaMessage"></p>
	<button type="button" id="javaButton" onclick="isJavaEnabled()" on>Show me</button>

<!--This seems to be deprecated
  <p> Do you want to know what if Taint is enabled?</p> 
	<p id="taintMessage"></p>
	<button type="button" id="taintButton" onclick="isTaintEnabled()" on>Show me</button>
-->

<!-- Animations-->
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
<!--DOM methods and properties-->
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

	
    <?php include 'Reusable\footer.php';?><!--footer-->
  </body>
</html>