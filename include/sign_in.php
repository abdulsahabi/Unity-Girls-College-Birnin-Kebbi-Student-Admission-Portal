<?php
include "./db.php";
include "./queries.php";
include "./session_config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  if (empty($email)) {
    header("Content-Type: application/json");
    echo json_encode(["email" => "Email cannot be left blank."]);
  } elseif (empty($password)) {
    header("Content-Type: application/json");
    echo json_encode(["password" => "Password cannot be left blank."]);
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Content-Type: application/json");
    echo json_encode(["email" => "Invalid email address."]);
  } else {
    $findEmail = $pdo->prepare(EMAIL);
    $findEmail->execute([$email]);
    $admin = $findEmail->fetch();

    if ($findEmail->rowCount()) {
      if (password_verify($password, $admin["pass"])) {
          
          
        start_session();
        $_SESSION["isAdminLogged"] = true;
        $_SESSION["admin_id"] = $admin["admin_id"];
        $_SESSION["adminLastActive"] = time();
        header("Content-Type: application/json");
        echo json_encode(["redirect" => "/"]);
      } else {
        header("Content-Type: application/json");
        echo json_encode(["password" => "Incorrect password"]);
      }
    } else {
      header("Content-Type: application/json");
      echo json_encode(["email" => "That email is not found."]);
    }
  }
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ../index.php");
  exit();
}
?>
 