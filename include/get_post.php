<?php
include "./db.php";
include "./queries.php";
///include "./db.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  $currentPage = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
  $postPerPage = isset($_GET["limit"]) ? intval($_GET["limit"]) : 5;

  
  // Calculate the page index of where to begin
  $offset = ($currentPage - 1) * $postPerPage;
  $stmt = $pdo->prepare(POSTS);

  $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
  $stmt->bindParam(":postPerPage", $postPerPage, PDO::PARAM_INT);
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
