<?php

include "./db.php";
include "./session_config.php";
include "./queries.php";
include "./user.php";
session_start();

//session_regenerate_id(true)
$lastActivity = $_SESSION["canLastActivity"] ?? 0;
$isCandidateLogged = $_SESSION["isCandidateLogged"] ?? false;

checkCanLastActivity($lastActivity, $isCandidateLogged);

// Getting candidate using session can_id:
$can_id = $_SESSION["can_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $complain = new Complain($_POST);

  $complain->validatePost();
  $errors = $complain->getError();
  $data = $complain->getData();

  if (!array_filter($errors)) {
    $complainSql = $pdo->prepare(COMPLAIN);
    $complainSql->execute([
      $data["nature"],
      $data["body"],
      $can_id,
      $data["followUp"],
      date("Y:m:d h:i:s"),
    ]);
    if ($complainSql->rowCount() > 0) {
      echo json_encode(["redirect" => "/"]);
    }
  } else {
    header("Content-Type: application/json");
    echo json_encode($errors);
    return;
  }
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ../index.php");
  exit();
}
?>
