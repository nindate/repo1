<?php session_start(); ?>
<html>
<body>

<?php

echo "<b>Deleting records</b> <br><br>";
echo "Are you sure you want to delete the following entries: ?<br><br>";

// Create connection
$con=mysqli_connect("localhost","user1","password","test2");

// Check connection
if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Create connection
$con=mysqli_connect('localhost','user1','password','test2');

// Check connection
if (mysqli_connect_errno()) {
   echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}
$_SESSION['checkboxvar']=$_POST['checkboxvar'];

if (isset($_POST['checkboxvar']))
{
    echo "<table border='1'>";
    echo '<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Contact No</th><th>Comments</th></tr>';

    foreach ($_POST['checkboxvar'] as $checkvalue) {
        // Run query
        $sql="select ID,FirstName,LastName,ContactNo,Comments from Persons where ID = '$checkvalue';";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        echo '<tr>';
        echo '<td>' . $row['ID'] . '</td><td>' . $row['FirstName'] . '</td><td> ' . $row['LastName'] . '</td><td>' . $row['ContactNo'] . '</td><td>' . $row['Comments'] . '</td>';
        echo '</tr>';

    }
    echo '</table>';
}
mysqli_close($con);
echo "<br>";
$form="<form action='./deleterecords.php' method='post'><input type='submit' name='confirmdelete' value='Confirm deletion'/></form>";
echo $form;
// if (isset($confirmdelete)) {
// echo 'Confirmed deletion';
// }
// else
// echo 'Cancelled deletion';
?>

</body>
</html>
