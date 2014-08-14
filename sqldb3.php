<!DOCTYPE HTML>

<html>

<head>

<style>

.error {color: #FF0000;}

</style>

</head>

<body>



<?php

// define variables and set to empty values

$firstnameErr = $lastnameErr = $genderErr = $ageErr = "";

$firstname = $lastname = $gender = $comment = $age = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {

   if (empty($_POST["firstname"])) {

     $firstnameErr = "First Name is required";

   } else {

     $firstname = test_input($_POST["firstname"]);

     // check if name only contains letters and whitespace

     //if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {

      // $firstnameErr = "Only letters and white space allowed";

     //}

   }



   if (empty($_POST["lastname"])) {

     $lastnameErr = "Last Name is required";

   } else {

     $lastname = test_input($_POST["lastname"]);

     // check if e-mail address syntax is valid

     //if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$lastname)) {

       //$lastnameErr = "Invalid lastname format";

     //}

   }



   if (empty($_POST["age"])) {

     $age = "";

   } else {

     $age = test_input($_POST["age"]);

     // check if URL address syntax is valid (this regular expression also allows dashes in the URL)

     // if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$age)) {

     //  $ageErr = "Invalid age";

     //}

   }



   if (empty($_POST["comment"])) {

     $comment = "";

   } else {

     $comment = test_input($_POST["comment"]);

   }



   if (empty($_POST["gender"])) {

     $genderErr = "Gender is required";

   } else {

     $gender = test_input($_POST["gender"]);

   }

}



function test_input($data) {

   $data = trim($data);

   $data = stripslashes($data);

   $data = htmlspecialchars($data);

   return $data;

}

?>



<h2>You are using Person registration application on web server 1</h2>



<?php



// Create connection

$con=mysqli_connect("$OPENSHIFT_MYSQL_DB_HOST","user1","password","php");
// $con=mysqli_connect("127.3.104.2:3306","user1","password","php");
// $con=mysqli_connect("10.0.2.21","user1","openstack","test");
// $con=mysqli_connect("192.168.1.72","user1","openstack","test");



// Check connection

if (mysqli_connect_errno()) {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();

}



// Run query

$sql="select FirstName,LastName,Age,Comments from Persons;";

$result = mysqli_query($con,$sql);

if ($result) {

  echo "<br>";

} else {

  echo "Error running query: " . mysqli_error($con);

}



echo "<hr>";

echo "<h3>Current Entries are: </h3>";

echo "<form method='post' action='deletefromdb3.php'>";

echo "<ul>";

while($row = mysqli_fetch_array($result)) {

  echo "<li>";

  echo $row['FirstName'] . " " . $row['LastName'] . " (" . $row['Age'] . ") [" . $row['Comments'] . "]";

  $thisid=$row['ID'];

  echo "<input type='checkbox' name='$thisid' value='$thisid'>Delete";

  echo "</li>";

}

  echo "</ul>";

  echo "<input type='submit' name='Delete' value='Deleted selected entries'>";

echo "</form>";



// Close connection

mysqli_close($con);

?>



<hr>

<br>

<p> <h3> New Entry to be added </h3> </p>



<p><span class="error">* required field.</span></p>

<form method='post' action='updatedb3.php'>

   First Name:  <span class="error">* </span> <input type="text" name="firstname" value="<?php echo $firstname;?>">

   <?php echo $firstnameErr;?>

   Last Name: <span class="error">* </span> <input type="text" name="lastname" value="<?php echo $lastname;?>">

   <?php echo $lastnameErr;?></span>

   Age:  <span class="error">* </span> <input type="text" name="age" value="<?php echo $age;?>">

   <?php echo $ageErr;?></span>

   Comments: <textarea name="comment" rows="1" cols="60"><?php echo $comment;?></textarea>

   <br><br>

   <input type="submit" name="Update" value="Update">

</form>





</body>

</html>
