<?php

include "./db.php";
include "./user.php";
include "./queries.php";
include "./session_config.php";

start_session();
//print_r($_SESSION);
$isAdminLogged = $_SESSION["isAdminLogged"] ?? false;
$adminLastActive = $_SESSION["adminLastActive"] ?? 0;
checkAdminLastAcitive($adminLastActive, $isAdminLogged);

$admin_id = $_SESSION["admin_id"];


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  
  $post = new Post($_POST);
  $post->uniqueImageName($_FILES);
  $post->validatePost();
  $errors = $post->getErrors();
  $data = $post->getPost();

  if (!array_filter($errors)) {
    $stmt = $pdo->prepare(POST);
    $stmt->execute([
      $data["title"],
      $data["body"],
      $data["feature_image"],
      1,
      date("Y:m:d H:i:s"),
    ]);
    if ($stmt->rowCount() > 0) {
      header("Content-Type: application/json");
      echo json_encode(["redirect" => "/"]);
      return;
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
