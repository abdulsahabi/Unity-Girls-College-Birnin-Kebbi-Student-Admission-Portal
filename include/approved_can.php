<?php
include "./db.php";
include "./queries.php";
///include "./db.php";
include "./session_config.php";

start_session();
//print_r($_SESSION);
$isAdminLogged = $_SESSION["isAdminLogged"] ?? false;
$adminLastActive = $_SESSION["adminLastActive"] ?? 0;
checkAdminLastAcitive($adminLastActive, $isAdminLogged);

$admin_id = $_SESSION["admin_id"];


if ($_SERVER["REQUEST_METHOD"] === "GET") {
  $currentPage = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
  $itemsPerPage = isset($_GET["limit"]) ? intval($_GET["limit"]) : 4;

  // Calculate the page index of where to begin
  $offset = ($currentPage - 1) * $itemsPerPage;
  $stmt = $pdo->prepare(APPROVED);
  
  
  $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
  $stmt->bindParam(":itemsPerPage", $itemsPerPage, PDO::PARAM_INT);
  $stmt->execute();
  $data = $stmt->fetchAll();
  if ($stmt->rowCount() > 0) {
    echo json_encode($data);
  } else {
    echo json_encode(["limit" => true]);
  }
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ../index.php");
  exit();
}
?>
