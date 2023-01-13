<?php
session_start();

// Create connection
$con=mysqli_connect("dbhost","user1","password");
$_SESSION['$con']=$con;
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>
