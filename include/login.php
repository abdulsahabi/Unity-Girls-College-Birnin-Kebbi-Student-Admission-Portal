<?php
include "./session_config.php";
include "./db.php";
include "./queries.php";
include "./user.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $login = new Login($_POST["email"], $_POST["password"]);
  $login->validateData();

  $errors = $login->getErrors();
  $data = $login->getLoginDetails();

  if (!array_filter($errors)) {
    if (filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
      $findUser = $pdo->prepare(FINDWITHEMAIL);
      $findUser->execute([$data["email"]]);
      $user = $findUser->fetch();

      if ($user) {
        if (password_verify($data["password"], $user["pass"])) {
          // Everything is clear at this stage
          start_session();
          $_SESSION["canLastActivity"] = time();
          $_SESSION["isCandidateLogged"] = true;
          $_SESSION["can_id"] = $user["can_id"];
          header("Content-Type: application/json");
          echo json_encode(["redirect" => "/"]);
          return;
        } else {
          header("Content-Type: application/json");
          echo json_encode([
            "password" =>
              "Your password is incorrect. Please try again or reset your password.",
          ]);
          return;
        }
      } else {
        header("Content-Type: application/json");
        echo json_encode([
          "email" =>
            "No account linked to this email address. Please verify and try again.",
        ]);
        return;
      }
    } else {
      $pattern = "/^(UNT)\/[20-24]{2}\/\d{4}$/";
      $admissionNo = strtoupper($data["email"]);
      if (preg_match($pattern, $admissionNo)) {
        $lastDigits = explode("/", $admissionNo);
        $pop = array_pop($lastDigits);

        $findUser = $pdo->prepare(FINDWITHADMISSION);
        $findUser->execute([$pop]);
        $user = $findUser->fetch();

        if ($user) {
          if (password_verify($data["password"], $user["pass"])) {
            // Everything is clear at this stage
            start_session();
            $_SESSION["canLastActivity"] = time();
            $_SESSION["isCandidateLogged"] = true;
            $_SESSION["can_id"] = $can_id;
            header("Content-Type: application/json");
            echo json_encode(["redirect" => "/"]);
            return;
          } else {
            header("Content-Type: application/json");
            echo json_encode([
              "password" =>
                "Your password is incorrect. Please try again or reset your password.",
            ]);
            return;
          }
        } else {
          header("Content-Type: application/json");
          echo json_encode([
            "email" =>
              "No record found for the provided admission number. Please ensure it is correct.",
          ]);
          return;
        }
      } else {
        header("Content-Type: application/json");
        echo json_encode([
          "email" =>
            "Invalid input format. Please enter a valid email address or admission number.",
        ]);
        return;
      }
    }
  } else {
    header("Content-Type: application/json");
    echo json_encode(["error" => $errors]);
    return;
  }
} else {
  http_response_code(405); // Method Not Allowed
  echo json_encode(["error" => "Method Not Allowed"]);
}
