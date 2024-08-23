<?php

include "./db.php";
include "./session_config.php";
include "./queries.php";

session_start();

//session_regenerate_id(true)
$lastActivity = $_SESSION["canLastActivity"] ?? 0;
$isCandidateLogged = $_SESSION["isCandidateLogged"] ?? false;

checkCanLastActivity($lastActivity, $isCandidateLogged);

// Getting candidate using session can_id:
$can_id = $_SESSION["can_id"];


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $updatePassword = $_POST["newpassword"];
  $current = $_POST["current"];

  $findUser = $pdo->prepare(FINDWITHID);
  $findUser->execute([$can_id]);
  $user = $findUser->fetch();

  if (password_verify($current, $user["pass"])) {
    if (!password_verify($updatePassword, $user["pass"])) {
      $hashPassword = password_hash($updatePassword, PASSWORD_DEFAULT);
      $changeStmt = $pdo->prepare(UPDATEPASSWORD);
      $changeStmt->execute([$hashPassword, $can_id]);
      if ($changeStmt->rowCount() > 0) {
        header("Content-Type: application/json");
        echo json_encode(["redirect" => "/"]);
        return;
      }
    } else {
      header("Content-Type: application/json");
      echo json_encode(["password" => "err"]);
      return;
    }
  } else {
    header("Content-Type: application/json");
    echo json_encode(["error" => "err"]);
    return;
  }
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ../index.php");
  exit();
}
