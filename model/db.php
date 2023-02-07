<?php
$dsn = "mysql:host=localhost;dbname=final-project";
$username = "siddiq";
$password = "1234";

try {
  $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
  $error = "Database Error: " . $e->getMessage();
  include('view/error.php');
  exit;
}
