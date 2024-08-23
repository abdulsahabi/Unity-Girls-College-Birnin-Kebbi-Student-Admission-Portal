<?php


include "./db.php";
include "./session_config.php";
include "./queries.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $updatePassword = $_POST["password"];
    $email = $_POST["email"];

    $hashPassword = password_hash($updatePassword, PASSWORD_DEFAULT);
    $changeStmt = $pdo->prepare(UPDATEPASSWORDWITHEMAIL);
    $changeStmt->execute([$hashPassword, $email]);
    if ($changeStmt->rowCount() > 0) {
        header("Content-Type: application/json");
        echo json_encode(["redirect" => "/"]);
        return;
    }
} else {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ../index.php");
    exit();
}
