<?php
$servername = "localhost";
$username = "n1607753_emalia";
$password = "emalia12345678";
$database = "n1607753_survei_nwas";
// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>