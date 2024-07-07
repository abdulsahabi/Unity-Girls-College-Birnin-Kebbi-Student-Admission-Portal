<?php
// fetch the required data
$data = ["John", "Doe", "Alice", "Bob"];

// output the data in HTML format
echo "<ul>";
foreach ($data as $item) {
  echo "<li>" . $item . "</li>";
}
echo "</ul>";
?>
