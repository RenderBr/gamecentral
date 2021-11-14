<?php
require_once "../vendor/autoload.php";
use ArtisansWeb\Optimizer;

$img = new Optimizer();

include_once('../cfg/conn.php');
$target_dir = "/var/www/html/gamecentral.online/userData/userBG/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$newName = bin2hex(random_bytes(5));
$target_file = $target_dir . $newName . "." . $imageFileType;
$uploadOk = 1;
session_start();
if(isset($_SESSION['username'])){
$user = $_SESSION['username'];
}else{
  header("Location: /login");
}

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    $img->optimize($target_file);


    $avatar = "https://data.gamecentral.online/userBG/" . $newName . "." .  $imageFileType;
    echo $avatar;

    $sql = "UPDATE users SET bg='$avatar' WHERE username = '$user'";

    if($conn->query($sql) === TRUE){
    	echo "User's avatar has been successfully changed!";
    	header("Location: /settings");
    }else{
    	echo "There was an error changing this user's avatar: " . $conn->error;
    	header("Location: /settings?e=1");
    }
    $conn->close();

  } else {
    echo "Sorry, there was an error uploading your file.";
    header("Location: /settings?e=1");
  }
}
?>
