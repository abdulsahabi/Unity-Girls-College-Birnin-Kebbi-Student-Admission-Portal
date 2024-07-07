<?php
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    print_r($_GET);
} else {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ../index.php");
  exit();
}
?>
