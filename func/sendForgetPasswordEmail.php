<?php
set_include_path('/usr/local/var/www/gamecentral');
include_once('../cfg/conn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$email = $_POST['email'];

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $userEmail = $row['email'];
    $userName = $row['username'];
  }
}else{
  header("Location: /login");
}

$gennedToken = password_hash($userEmail, PASSWORD_DEFAULT);


$sql = "INSERT INTO forgetPasswordTokens (forUser, token, expiry_date)
VALUES ('$userName', '$gennedToken', NOW() + INTERVAL 2 DAY)";

if ($conn->query($sql) === TRUE) {
  header("Location: /fPD");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.privateemail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'julian@gamecentral.online';                     //SMTP username
    $mail->Password   = 'admin420';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('julian@gamecentral.online', 'GameCentral Official');
    $mail->addAddress($userEmail, $userName);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset your GameCentral account password!';
    $mail->Body    = '<a>Please click here: <a href="localhost/forgotPassword?token=' . $gennedToken . '">to reset your password!</a>';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



$conn->close();
?>
