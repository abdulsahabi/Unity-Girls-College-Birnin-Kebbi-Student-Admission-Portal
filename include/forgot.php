<?php
include "./db.php";
include "./queries.php";
include "./session_config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = trim($_POST["email"]);

  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $findUser = $pdo->prepare(FORGOT);
    $findUser->execute([$email]);

    if ($findUser->rowCount() > 0) {
      $user = $findUser->fetch();
      $fullname = $user["fullname"];
      $verifyCode = $user["verify_digit"];
      $can_id = $user["can_id"];
      $verifyCode = mt_rand(666666, 999999);
      $randDigits = $pdo->prepare(UPDATEADDITIONALINFO);
      $randDigits->execute([$verifyCode, date("Y-m-d H:i:s"), $can_id]);
      $findUserAgain = $pdo->prepare(FORGOT);
      $findUserAgain->execute([$email]);
      if ($randDigits->rowCount() > 0 && $findUserAgain->rowCount() > 0) {
        $fname = explode(" ", $fullname);
        $username = array_pop($fname);
        ob_start();
        include "./email.php";
        $htmlContent = ob_get_clean();

        include "./email_config.php";

        try {
          $mail->isHTML(true);
          $mail->Body = $htmlContent;
          $mail->send();

          start_session();
          $_SESSION["canLastActivity"] = time();
          $_SESSION["isCandidateLogged"] = true;
          $_SESSION["can_id"] = $can_id;

          $user1 = $findUserAgain->fetch();
          $result = [
            "fullname" => $fullname,
            "email" => $email,
            "image" => $user1["display_image"],
            "admission_no" => $user1["admission_no"],
            "expiredAt" => $user1["expiredAt"],
            "redirect" => "/",
          ];
          header("Content-Type: application/json");
          echo json_encode($result);
          return;
        } catch (Exception $e) {
          header("Content-Type: application/json");
          echo json_encode(["network" => "error"]);
        }
      }
    } else {
      header("Content-Type: application/json");
      echo json_encode([
        "error" =>
          "That account is not exist. Please provide a correct detail.",
      ]);
    }
  } else {
    header("Content-Type: application/json");
    echo json_encode(["error" => "Invalid email"]);
  }
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ../index.php");
  exit();
}

?>
