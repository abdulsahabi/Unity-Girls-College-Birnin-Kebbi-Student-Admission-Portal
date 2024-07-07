<?php

include "./db.php";
include "./session_config.php";
include "./queries.php";

session_start();

start_session();
//print_r($_SESSION);
$isAdminLogged = $_SESSION["isAdminLogged"] ?? false;
$adminLastActive = $_SESSION["adminLastActive"] ?? 0;
checkAdminLastAcitive($adminLastActive, $isAdminLogged);

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  logout();
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: " . URL);
  exit();
}
?>
