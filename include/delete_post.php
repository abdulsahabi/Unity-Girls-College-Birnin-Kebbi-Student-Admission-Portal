<?php
include "./db.php";
include "./queries.php";
include "./session_config.php";

start_session();
//print_r($_SESSION);
$isAdminLogged = $_SESSION["isAdminLogged"] ?? false;
$adminLastActive = $_SESSION["adminLastActive"] ?? 0;
checkAdminLastAcitive($adminLastActive, $isAdminLogged);

$admin_id = $_SESSION["admin_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // code...
  $post_id = $_POST["post_id"];
  $stmt = $pdo->prepare(DELETEPOST);
  $stmt->execute([$post_id]);
  if ($stmt->rowCount() > 0) {
    header("Content-Type: application/json");
    echo json_encode(["redirect" => "/"]);
  } else {
    header("Content-Type: application/json");
    echo json_encode(["error" => "err"]);
  }
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ../index.php");
  exit();
}

?>
