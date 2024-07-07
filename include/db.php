<?php

define("DBNAME", "mysql:host=127.0.0.1;dbname=unity_portal;");
define("USERNAME", "user1");
define("PASSWORD", "1234");

try {
  $pdo = new PDO(DBNAME, USERNAME, PASSWORD);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch (PDOException $e) {
  echo "Error occurred: " . $e->getMessage();
}


