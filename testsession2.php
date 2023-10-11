<?php
if (isset($_GET['button'])) {
    echo "button";
    $clicked_button = $_GET['button'];
    echo $clicked_button;
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
        <title>Grahamstown Grub Stop</title>
        <link rel="stylesheet" href="stylish.css">
	<script src="Demo.js" ></script>
        <script defer src="ratescript.js"></script>
    </head>
    <body id="restaurantBody">
    <?php include 'Reusable\heading.php';?><!--heading-->
    </body>
</html>