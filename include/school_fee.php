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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $amout = $_POST["amount"];
  $value = floatval($amout);

  if (floatval($amout)) {
    $findUser = $pdo->prepare(FINDUSERADS);
    $findUser->execute([$can_id]);
    $user = $findUser->fetch();

    if ($user) {
      if ($user["school_fee"] == $value) {
        $paySql = $pdo->prepare(PAID);
        $paySql->execute([$can_id]);
        if ($paySql->rowCount() > 0) {
          header("Content-Type: application/json");
          echo json_encode([
            "paid" => "Completed",
          ]);
          return;
        }
      } elseif ($value < $user["school_fee"]) {
        $expected_payable = $user["school_fee"];
        header("Content-Type: application/json");
        echo json_encode([
          "error" => "Payable amount must be at least  $expected_payable.",
        ]);
        return;
      } elseif ($value > $user["school_fee"]) {
        $expected_payable = $user["school_fee"];
        header("Content-Type: application/json");
        echo json_encode([
          "error" => "Payable amount cannot exceed $expected_payable.",
        ]);
        return;
      } else {
        header("Content-Type: application/json");
        echo json_encode(["error" => "Invalid"]);
        return;
      }
    }
  } else {
    header("Content-Type: application/json");
    echo json_encode([
      "error" => "Attention: Payable amount should be a number, not a stringid",
    ]);
    return;
  }
} else {
  http_response_code(301);
  hheader("Location: ../index.php");
}
?> 