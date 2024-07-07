<?php

include "../include/db.php";
include "../include/custom_functions.php";
include "../include/session_config.php";
include "../include/queries.php";
//start_session();
session_start();

//session_regenerate_id(true)
$lastActivity = $_SESSION["canLastActivity"] ?? 0;
$isCandidateLogged = $_SESSION["isCandidateLogged"] ?? false;

checkCanLastActivity($lastActivity, $isCandidateLogged);

// Updating candidates current session:
$_SESSION["canLastActivity"] = time();
$_SESSION["isCandidateLogged"] = true;

// Getting candidate using session can_id:
$can_id = $_SESSION["can_id"];
$stmt = $pdo->prepare(CANDIDATE);
$stmt->execute([$can_id]);
$user = $stmt->fetch();
$fullname = $user["fullname"];
$email = $user["email"];

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  $verifyCode = mt_rand(666666, 999999);
  $randDigits = $pdo->prepare(UPDATEADDITIONALINFO);
  $randDigits->execute([$verifyCode, date("Y-m-d H:i:s"), $can_id]);

  $findUserAgain = $pdo->prepare(FORGOT);
  $findUserAgain->execute([$email]);
  if ($randDigits->rowCount() > 0 && $findUserAgain->rowCount() > 0) {
    $fname = explode(" ", $fullname);
    $username = array_pop($fname);
    ob_start();
    include "./email.php";
    $htmlContent = ob_get_clean();

    include "./email_config.php";

    try {
      $mail->isHTML(true);
      $mail->Body = $htmlContent;
      $mail->send();

      
      $_SESSION["canLastActivity"] = time();
      $_SESSION["isCandidateLogged"] = true;
      $_SESSION["can_id"] = $can_id;

      $user1 = $findUserAgain->fetch();
      $result = [
        "expiredAt" => $user1["expiredAt"],
        "redirect" => "/",
      ];

      header("Content-Type: application/json");
      echo json_encode($result);

      return;
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  } else {
  }
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ../index.php");
  exit();
}

?>
