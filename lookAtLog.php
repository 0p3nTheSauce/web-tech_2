<!DOCTYPE html>
    <html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylish.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=shadow-multiple">
    <!-- This imports google fonts -->
    <title>Grahamstown Grub Stop</title>
	<script src="Demo.js" ></script>
    <script defer src="ratingformscript.js"></script>
    </head>
    <body>
        <?php include 'Reusable\heading.php';?><!--heading-->
<?php

$logFile = 'loginAttemptsLog.log';  // Replace with the path to your log file
echo "<section id='logfilesection'>";
echo "<h1> Log of login and sign up activities </h1>";
if (file_exists($logFile) && is_readable($logFile)) {
    // Read the log file line by line and display it
    $fileHandler = fopen($logFile, 'r');
    if ($fileHandler) {
        echo "<table>";
        
        echo "<tr>";
        echo "<th></th>";
        echo "<th>ip</th>";
        echo "<th>user name</th>";
        echo "<th>email</th>";
        echo "<th>status</th>";
        echo "</tr>";
        
        while (($line = fgets($fileHandler)) !== false) {
            echo "<tr>";
            $logData = explode('|', $line);
            foreach ($logData as $value){
                echo "<td>";
                echo htmlspecialchars($value);
                echo"</td>";
            }
            echo "</tr>";
            //echo "<p>".htmlspecialchars($line)."</p>"; // Use htmlspecialchars to prevent HTML injection
        }
        echo "</table>";
        fclose($fileHandler);
    } else {
        echo "We could not open the log file.";
    }
} else {
    echo "Error in reading log file.";
}
echo "</section>";

?>
</body>
</html>