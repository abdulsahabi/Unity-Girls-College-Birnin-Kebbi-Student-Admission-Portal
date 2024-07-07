<?php
include "./db.php";
include "./queries.php";
if ($_SERVER["REQUEST_METHOD"] === "GET") {
  $stmt = $pdo->prepare(CANDIDATES);
  $stmt->execute();
  $users = $stmt->fetchAll();
  echo json_encode($users);
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ../index.php");
  exit();
}

?>
