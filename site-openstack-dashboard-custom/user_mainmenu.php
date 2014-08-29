<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
?>

<html>
<body>

<div id="header">

<?php
	$tenant=$_SESSION['s_tenant'];
	$user=$_SESSION['s_user'];
	$pass=$_SESSION['s_pass'];

	echo "<a href='./change_login.php' style='padding-left: 900px'> Login as different user </a>";
	echo "<a href='./logout.php' style='padding-left: 10px'> <img src='./images/logout.jpg' width='200' alt='Logout'/> </a>";
	echo "<h2>Main menu</h2>";
	echo "<hr>";
	echo "<p>List of servers currently deployed by user <b>$user</b> : </p>";

	require('./db_connect.php');
        mysqli_select_db($con,"keystone");

	$query="select id from user where name='$user'";
        $result=mysqli_query($con,$query);

        $row = mysqli_fetch_array($result);
	$userid = $row['id'];

	mysqli_select_db($con,"nova");
	$query= "select display_name from instances where deleted = '0' and user_id = '$userid'";
        $result=mysqli_query($con,$query);

	echo "<table border='1'>";
	echo "<tr>	<th>Server Name</th>	</tr>";
        while($row=mysqli_fetch_array($result)) {
        echo "<tr>    <td>" . $row['display_name'] . "</td>    </tr>";
        }
        echo "</table>";

	mysqli_close($con);
?>

</div>

<hr>

<div id="os_templates">

	<p>Following templates are available to you for deployment </p>
	<form action='./get_details_template.php' method='post'>
	<table border='1' style='width: 800px'>
		<tr>
			<th>Template id</th>
			<th>Template Name</th>
			<th>Template description</th>
			<th>Select</th>
		</tr>
		<tr>
			<td>1.</td>
			<td>Basic single VM in existing network</td>
			<td>Deploys a single VM in an existing public network and assigns floating IP address</td>
			<td><input type='radio' name='template_id' value='1'></td>
		</tr>
		<tr>
			<td>2.</td>
			<td>Single VM with new network</td>
			<td>Deploys a single VM creating a new network</td>
			<td><input type='radio' name='template_id' value='2'></td>
		</tr>
		<tr>
			<td>3.</td>
			<td>Two tier architecture [1-web, 1-db]</td>
			<td>Deploys a two tiered system with one apache web server in public network and one mysql database server in private network</td>
			<td><input type='radio' name='template_id' value='3'></td>
		</tr>
	</table>
			<p style='padding-left: 650px'><input type='submit' name='btn2' value='Deploy template' style='font-size: 17px; border-width: 4px; border-color: grey grey black black; color: white; background-color: blue'/></p>
	
	</form>

</div>

</body>
</html>
