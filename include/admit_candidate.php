<?php
include "./db.php";
include "./queries.php";

include "./session_config.php";

start_session();
//print_r($_SESSION);
$isAdminLogged = $_SESSION["isAdminLogged"] ?? false;
$adminLastActive = $_SESSION["adminLastActive"] ?? 0;
checkAdminLastAcitive($adminLastActive, $isAdminLogged);
 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // code...
  $can_id = $_POST["can"];
  $stmt = $pdo->prepare(ADMIT);
  $stmt->execute([$can_id]);
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
