<?php

include "./db.php";
include "./session_config.php";
include "./queries.php";

session_start();

//session_regenerate_id(true)
$lastActivity = $_SESSION["canLastActivity"] ?? 0;
$isCandidateLogged = $_SESSION["isCandidateLogged"] ?? false;

checkCanLastActivity($lastActivity, $isCandidateLogged);

// Getting candidate using session can_id:
$can_id = $_SESSION["can_id"];

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  logout();
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: " . URL);
  exit();
}
?>
