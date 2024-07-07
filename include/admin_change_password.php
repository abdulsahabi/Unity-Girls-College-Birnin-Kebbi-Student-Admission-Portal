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
  $updatePassword = $_POST["newpassword"];
  $current = $_POST["current"];

  $findUser = $pdo->prepare(FINDWITHADMINID);
  $findUser->execute([$admin_id]);
  $user = $findUser->fetch();

  if (password_verify($current, $user["pass"])) {
    if (!password_verify($updatePassword, $user["pass"])) {
      $hashPassword = password_hash($updatePassword, PASSWORD_DEFAULT);
      $changeStmt = $pdo->prepare(UPDATEADMINPASSWORD);
      $changeStmt->execute([$hashPassword, $admin_id]);
      if ($changeStmt->rowCount() > 0) {
        header("Content-Type: application/json");
        echo json_encode(["redirect" => "/"]);
        return;
      }
    } else {
      header("Content-Type: application/json");
      echo json_encode([
        "password" => "Password cannot be the same with old one",
      ]);
      return;
    }
  } else {
    header("Content-Type: application/json");
    echo json_encode(["error" => "incorrect"]);
    return;
  }
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ../index.php");
  exit();
}

?>
