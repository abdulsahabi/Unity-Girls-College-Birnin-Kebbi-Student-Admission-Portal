<?php

include "./db.php";
include "./user.php";
include "./queries.php";
include "./session_config.php";

start_session();

//session_regenerate_id(true)
$lastActivity = $_SESSION["canLastActivity"] ?? 0;
$isCandidateLogged = $_SESSION["isCandidateLogged"] ?? false;

checkCanLastActivity($lastActivity, $isCandidateLogged);

// Getting candidate using session can_id:
$can_id = $_SESSION["can_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $user = new User($_POST);
  $user->uniqueImageName($_FILES);
  $data = $user->getData();

  $errors = $user->getError();
  if (!array_filter($errors)) {
    $stmt = $pdo->prepare(CANPROFILE);
    $stmt->execute([$data["display_image"], $can_id]);
    if ($stmt->rowCount() > 0) {
      header("Content-Type: application/json");
      echo json_encode(["image" => $data["display_image"]]);
    }
  } else {
    header("Content-Type: application/json");
    echo json_encode($errors);
  }
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ../index.php");
  exit();
}

?>
