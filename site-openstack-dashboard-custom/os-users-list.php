<html>
<body>
<?php

$con=mysqli_connect("localhost","root","openstack","keystone");
$sql="select id,name from user;";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)) {
echo $row['id'] . " " . $row['name'];
echo "<br>";
}
mysqli_close($con);
?>
</body>
</html>
