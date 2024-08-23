<?php

/*
define("DBNAME", "mysql:host=127.0.0.1;dbname=unity_portal;");
define("USERNAME", "user1");
define("PASSWORD", "1234");
*/

define("DBNAME", "mysql:host=localhost;dbname=unity_portal;");
define("USERNAME", "root");
define("PASSWORD", "");

try {
  $pdo = new PDO(DBNAME, USERNAME, PASSWORD);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch (PDOException $e) {
  echo "Error occurred: " . $e->getMessage();
}
