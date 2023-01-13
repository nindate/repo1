<!DOCTYPE HTML>
<?php session_start(); ?>

<html>
<head>

<style>
.error {color: #FF0000;}
</style>

</head>
<body>


<?php
$loginuser=$_SESSION['loginuser'];

// define variables and set to empty values
$firstnameErr = $lastnameErr = $genderErr = $ageErr = "";
$firstname = $lastname = $gender = $comment = $age = "";


function test_input($data) {

   $data = trim($data);

   $data = stripslashes($data);

   $data = htmlspecialchars($data);

   return $data;

}

?>



<?php 
// $_SESSION['loginuser']=$_POST['loginuser'];
// $loginuser=$_SESSION['loginuser'];
echo "<h2>You are using My Contacts application on web server 1</h2>";
echo "<h3 style='color: blue'>Welcome " . $loginuser .  "</b></h3>" ;
?>


<?php

// Create connection
$con=mysqli_connect("dbhost","user1","password","test2");

// Check connection
if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


// Run query
$sql="select ID,FirstName,LastName,ContactNo,Comments from Persons;";
$result = mysqli_query($con,$sql);
if ($result) {
  echo "<br>";
} else {
  echo "Error running query: " . mysqli_error($con);
}


// Close connection
mysqli_close($con);

echo "<hr>";
echo "<h3>Current contacts: </h3>";
echo "<form method='post' action='confirmdelete.php'>";
echo "<ul>";

$numrows=mysqli_num_rows($result);
if ($numrows == '0') {
echo "<span class='error'>*Presently there are no entries in the database</span>";
}

echo "<table border='1'>";
echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Contact No</th><th>Comments</th></tr>";
while($row = mysqli_fetch_array($result)) {


  echo "<tr>";
  echo "<td>" . $row['ID'] . "</td><td>" . $row['FirstName'] . "</td><td> " . $row['LastName'] . "</td><td>" . $row['ContactNo'] . "</td><td>" . $row['Comments'] . "</td>";

  $thisid=$row['ID'];

  echo "</tr>";


}
echo "</table>";
echo "</form>";

?>




</body>

</html>
