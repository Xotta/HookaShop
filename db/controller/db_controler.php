<?php

$servername = "localhost:3306";
$username = "root";
$password = "admin";
// Create connection
$conn =  mysqli_connect(
    $servername,
    $username,
    $password,
    "hookars");

// Check connection
if (!$conn) {
  die("Connection failed: ");
}
echo "Connected successfully";
exit;
?>
