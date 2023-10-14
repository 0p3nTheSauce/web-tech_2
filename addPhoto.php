<?php
$target_dir = "uploadedMedia\\";
$target_file = $target_dir . basename($_FILES["file_upload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$image = $_FILES["file_upload"]["tmp_name"];

error_reporting(E_ERROR | E_PARSE);
// Check if image file is a actual image or fake image
if(isset($_POST["img_submit"])) {
  $check = getimagesize($_FILES["file_upload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".<br>";
    $uploadOk = 1;
  } else {
    echo "File is not an image.<br>";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.<br>";
  $uploadOk = 0;
}

// Check file size not 
$maxsize = 5242880; // 5MB
if ($_FILES["file_upload"]["size"] > $maxsize) {
  echo "Sorry, your file is too large. Please ensure file is smalled than 5MB<br>";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, youve enter an incompatible file. Only JPG, JPEG, PNG & GIF files are allowed.<br>";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.<br>";
// if everything is ok, try to upload file
} else {

  //converts image to binary
  $imgContent = addslashes(file_get_contents($image));
  $servername = "cs3-dev.ict.ru.ac.za";
  $username = "G19M8152";
  $password = "G19M8152";

  // Create connection
  $conn = new mysqli($servername, $username, $password);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";
  echo "<br>";

  $retval = mysqli_select_db($conn, "compking");
  if (!$retval){
    die("could not select database".mysqli_error($conn));
  }

  echo "database compking selected successfully";
  echo "<br>";

  //Insert image into table 
  $sql = "INSERT INTO images (resid,image,created)
          VALUES ('12','$imgContent',NOW())";
  */
  if ($conn->query($sql) === TRUE){
    echo "The file ". htmlspecialchars( basename( $_FILES["file_upload"]["name"])). " has been uploaded.";
    echo "Entered successfully";
  }
   else {
    echo "Sorry, there was an error uploading your file.";
  }
  //header("Location: gallery.php");
}

?>
