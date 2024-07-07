<?php
include "./db.php";
include "./user.php";
include "./queries.php";
include "./session_config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $admin = new Admin($_POST);
  $admin->validateData();
  $errors = $admin->getError();
  $data = $admin->getData();

  if (!array_filter($errors)) {
    $findEmail = $pdo->prepare(EMAIL);
    $findEmail->execute([$data["email"]]);
    if (!$findEmail->rowCount()) {
      $stmt = $pdo->prepare(INSERTADMIN);
      $stmt->execute([$data["username"], $data["email"], $data["password"]]);

      if ($stmt->rowCount()) {
        $findAgain = $pdo->prepare(EMAIL);
        $findAgain->execute([$data["email"]]);
        $createdUser = $findAgain->fetch();

        start_session();
        $_SESSION["isAdminLogged"] = true;
        $_SESSION["admin_id"] = $createdUser["admin_id"];
        $_SESSION["adminLastActive"] = time();
        header("Content-Type: application/json");
        echo json_encode(["redirect" => "/"]);
      }
    } else {
      header("Content-Type: application/json");
      echo json_encode(["email" => "That email is in used."]);
    }
  } else {
    header("Content-Type: application/json");
    echo json_encode($errors);
  }
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ../index.php");
  exit();
}

?>
