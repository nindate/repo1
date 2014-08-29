<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
?>

<html>
<body>


<?php
	$tenant=$_SESSION['s_tenant'];
	$user=$_SESSION['s_user'];
	$pass=$_SESSION['s_pass'];

	echo "<a href='./logout.php'> <img src='./images/logout.jpg' width='200' alt='Logout' align='right'/> </a>";
	echo "<a href='./change_login.php' style='padding-left: 900px'> Login as different user </a>";
	echo "<h2>Main menu</h2>";
	echo "<br><p>List of servers for user <b>$user</b> : </p>";

	// require('./db_connect.php');
	$con=mysqli_connect("localhost", "root", "openstack");
        mysqli_select_db($con,"keystone");

	// $output = shell_exec("export OS_USERNAME=$user ; export OS_TENANT_NAME=$tenant ; export OS_PASSWORD=$pass ; export OS_AUTH_URL=http://192.168.5.101:5000/v2.0/ ; nova net-list");

	$query="select id from user where name='$user'";
        $result=mysqli_query($con,$query);

	// while($row=mysqli_fetch_array($result)) {
	// echo $row['id'];
        // echo "<br>";
	// }
	
        $row = mysqli_fetch_array($result);
	$userid = $row['id'];

	mysqli_select_db($con,"nova");
	$query= "select display_name from instances where deleted = '0' and user_id = '$userid'";
        $result=mysqli_query($con,$query);

        while($row=mysqli_fetch_array($result)) {
        echo $row['display_name'];
        echo "<br>";
        }

	mysqli_close($con);
?>


</body>
</html>
