<?php
include("conn.php");

$db = "CREATE TABLE patient(id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(50), age INT)";

$stmt = $conn -> prepare ($db);
$stmt  -> execute();

 if ($stmt) {
  echo "Created successfully";
 }

?>