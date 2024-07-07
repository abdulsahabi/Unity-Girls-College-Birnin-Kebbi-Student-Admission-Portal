<?php

include "./db.php";
include "./user.php";
include "./queries.php";
include "./session_config.php";

start_session();

$isAdminLogged = $_SESSION["isAdminLogged"] ?? false;
$adminLastActive = $_SESSION["adminLastActive"] ?? 0;
checkAdminLastAcitive($adminLastActive, $isAdminLogged);

$admin_id = $_SESSION["admin_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $admin = new Admin($_POST);
  $admin->uniqueImageName($_FILES);
  $data = $admin->getData();

  $errors = $admin->getError();
  if (!array_filter($errors)) {
    $stmt = $pdo->prepare(ADMINPROFILE);
   $stmt->execute([$data["display_image"], $admin_id]);
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
