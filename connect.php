<?php
$servername = "26.140.146.103";
$username = "admin";
$password = "admin1234$";
$dataBase= "world";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dataBase", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>