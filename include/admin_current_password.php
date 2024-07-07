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
  $current = $_POST["current"];

  $findUser = $pdo->prepare(FINDWITHADMINID);
  $findUser->execute([$admin_id]);
  $user = $findUser->fetch();
 // print_r($user);

  if (password_verify($current, $user["pass"])) {
    header("Content-Type: application/json");
    echo json_encode(["redirect" => "/"]);
    return;
  } else {
    header("Content-Type: application/json");
    echo json_encode(["error" => "Incorrect password"]);
    return;
  }
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ../index.php");
  exit();
}

?>
