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
  $can_id = $_POST["id"];
  $stmt = $pdo->prepare(CANDIDATE);
  $stmt->execute([$can_id]);
  $user = $stmt->fetch();
  echo json_encode(["data" => $user]);
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ../index.php");
  exit();
}

?>
