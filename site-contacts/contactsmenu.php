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
$loginuser=$_POST['loginuser'];
$_SESSION['loginuser']=$loginuser;

// define variables and set to empty values
$firstnameErr = $lastnameErr = $genderErr = $ageErr = "";
$firstname = $lastname = $gender = $comment = $age = "";

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    if (empty($_POST["firstname"])) {
//      $firstnameErr = "First Name is required";
//    } else {
//      $firstname = test_input($_POST["firstname"]);

     // check if name only contains letters and whitespace

     //if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {

      // $firstnameErr = "Only letters and white space allowed";

     //}

//    }



//    if (empty($_POST["lastname"])) {

//      $lastnameErr = "Last Name is required";

//    } else {

//      $lastname = test_input($_POST["lastname"]);

     // check if e-mail address syntax is valid

     //if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$lastname)) {

       //$lastnameErr = "Invalid lastname format";

     //}

//    }



//    if (empty($_POST["age"])) {

//      $age = "";

//    } else {

//      $age = test_input($_POST["age"]);

     // check if URL address syntax is valid (this regular expression also allows dashes in the URL)

     // if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$age)) {

     //  $ageErr = "Invalid age";

     //}

//    }



//    if (empty($_POST["comment"])) {

//      $comment = "";

//    } else {

//      $comment = test_input($_POST["comment"]);

//    }



//    if (empty($_POST["gender"])) {

//      $genderErr = "Gender is required";

//    } else {

//      $gender = test_input($_POST["gender"]);

//    }

// }



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
// $con=mysqli_connect("localhost","user1","password","test2");

// Check connection
// if (mysqli_connect_errno()) {
//    echo "Failed to connect to MySQL: " . mysqli_connect_error();
// }

// Create connection
require('connectdb.php');
$con=$_SESSION['$con'];

// Select database
mysqli_select_db($con,"test2");

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
echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Contact No</th><th>Comments</th><th></th></tr>";
while($row = mysqli_fetch_array($result)) {

  // echo "<li>";

  echo "<tr>";
  echo "<td>" . $row['ID'] . "</td><td>" . $row['FirstName'] . "</td><td> " . $row['LastName'] . "</td><td>" . $row['ContactNo'] . "</td><td>" . $row['Comments'] . "</td>";

  $thisid=$row['ID'];

  echo "<td><input type='checkbox' name='checkboxvar[]' value='$thisid'>Delete</td>";
  echo "</tr>";

  // echo "</li>";

}
echo "</table>";
  echo "</ul>";
  echo "<input type='submit' name='Delete' value='Delete selected entries'>";
echo "</form>";

?>

<hr>
<br>
<p> <h3> Add new contact </h3> </p>
<p><span class="error">* required field.</span></p>

<form method='post' action='updatedb.php'>
   First Name:  <span class="error">* </span> <input type="text" name="firstname" value="<?php echo $firstname;?>">
   <?php echo $firstnameErr;?>
   Last Name: <span class="error">* </span> <input type="text" name="lastname" value="<?php echo $lastname;?>">
   <?php echo $lastnameErr;?></span>
   Contact No:  <span class="error">* </span> <input type="text" name="contactno" value="<?php echo $contactno;?>">
   <?php echo $ageErr;?></span>
   <br><br>Comments: <textarea name="comment" rows="2" cols="60"><?php echo $comment;?></textarea>
   <br><br>
   <input type="submit" name="Update" value="Update">
</form>





</body>

</html>
