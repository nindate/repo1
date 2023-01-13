<?php session_start(); ?>
<?php
$checkboxvar=$_SESSION['checkboxvar'];

// Create connection
$con=mysqli_connect('dbhost','user1','password','test2');

// Check connection
if (mysqli_connect_errno()) {
   echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}
foreach ($checkboxvar as $checkvalue) {
    // Run query
    $sql="delete from Persons where ID = '$checkvalue';";
    $result = mysqli_query($con,$sql);
}
echo "<b>Selected contacts deleted</b><br><br>";
echo "<a href='contactsmenu.php'>Click here</a> to go to Contacts main menu";
?>
