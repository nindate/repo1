<html>

<body>



<?php



$new_firstname=$_POST['firstname'] ;

$new_lastname=$_POST['lastname'] ;

$new_contactno=$_POST['contactno'] ;

$new_comment=$_POST['comment'] ;

//echo "$new_firstname $new_lastname $new_age $new_comment"

// Create connection

$con=mysqli_connect("localhost","user1","password","test2");
// $con=mysqli_connect("127.3.104.2:3306","user1","password","php");
// $con=mysqli_connect("10.0.2.21","user1","openstack","test");
// $con=mysqli_connect("192.168.1.72","user1","openstack","test");



// Check connection

if (mysqli_connect_errno()) {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();

}



// Run query

 $sql="INSERT INTO Persons (FirstName, LastName, ContactNo, Comments) VALUES ('$new_firstname','$new_lastname','$new_contactno','$new_comment')";

 if (mysqli_query($con,$sql)) {

    echo "Entry updated successfully";

  } else {

    echo "Error running query: " . mysqli_error($con);

  }





// Close connection

mysqli_close($con);



?>





<?php

header('Location: contactsmenu.php');

?>



</body>

</html>


