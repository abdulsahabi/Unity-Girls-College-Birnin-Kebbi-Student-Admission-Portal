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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $verifyCode = trim($_POST["digits"]);

  if (!empty($verifyCode)) {
    if ($user["verify_digit"] == $verifyCode) {
      // Checking if the verification code is not expired after 10 minutes
      $expiredAtTime = strtotime($user["expiredAt"]);
      $currentTime = time();
      $expireIn = $currentTime - $expiredAtTime;
      $expireMin = 60;

      if ($expireIn <= $expireMin) {
        header("Content-Type: application/json");
        echo json_encode(["redirect" => "/"]);
      } else {
        header("Content-Type: application/json");
        echo json_encode([
          "error" => "That code is expired, request another one please.",
        ]);
      }
    } else {
      header("Content-Type: application/json");
      echo json_encode([
        "error" => "Sorry, the verification code you entered doesn't match.",
      ]);
    }
  } else {
    header("Content-Type: application/json");
    echo json_encode([
      "error" => "Field cannot be left empty",
    ]);
  }
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ../index.php");
  exit();
}

?>
