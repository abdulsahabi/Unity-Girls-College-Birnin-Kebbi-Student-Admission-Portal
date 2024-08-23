<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../vendor/autoload.php"; // Path to Composer autoloader

$mail = new PHPMailer(true);

require "vendor/autoload.php";

use Dotenv\Dotenv;

// Load the .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mail->isSMTP();
$mail->Host = "smtp.gmail.com"; // Gmail SMTP server
$mail->SMTPAuth = true;
$mail->Username = $_ENV["EMAIL"]; // Your Gmail address
$mail->Password = $_ENV["PASSWORD"]; // Your Gmail password
$mail->SMTPSecure = "ssl"; // Use 'tls' or 'ssl'
$mail->Port = 465; // Port for TLS, 465 for SSL

$mail->setFrom("tcstudio6542@gmail.com", "TcStudio Inc.");
$mail->addAddress($email, $fullname);
$mail->Subject = "Verify Your Account - Unity College";
/*
$mail->isHTML(true);
$mail->Body = file_get_contents("./email.php");
*/

$mail->SMTPDebug = 0; // 2 for debugging output
//$mail->Debugoutput = function ($str, $level) {
//  echo $str;
//};
