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

if ($_SERVER["REQUEST_METHOD"]) {
  if ($_POST["accept"] === "accept") {
    $acceptSql = $pdo->prepare(ACCEPTED);
    $acceptSql->execute([$can_id]);

    if ($acceptSql->rowCount() > 0) {
      header("Content-Type: application/json");
      echo json_encode(["accept" => "/"]);
    }
  } elseif ($_POST["declined"] === "declined") {
    $declinedSql = $pdo->prepare(DECLINED);
    $declinedSql->execute([$can_id]);

    if ($declinedSql->rowCount() > 0) {
      header("Content-Type: application/json");
      echo json_encode(["declined" => "/"]);
    }
  }
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ../index.php");
  exit();
}

?>
