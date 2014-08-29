<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
?>

<html>
<body>


<?php
$tenant=$_POST['tenant'];
$user=$_POST['user'];
$pass=$_POST['pass'];
$_SESSION['s_user']=$user;


// Below has been commented out. This was method using command line login.
// $output = shell_exec("export OS_USERNAME=$user ; export OS_TENANT_NAME=$tenant ; export OS_PASSWORD=$pass ; export OS_AUTH_URL=http://192.168.5.101:5000/v2.0/ ; nova list >/dev/null 2>&1 ; echo $?");

$output = shell_exec("curl 'http://192.168.5.101:5000/v2.0/tokens' -X POST -H \"Content-Type: application/json\" -H \"Accept: application/json\"  -d '{\"auth\": {\"tenantName\": \"$tenant\", \"passwordCredentials\": {\"username\": \"$user\", \"password\": \"$pass\"}}}' | grep '{' ");
$tok_result=json_decode($output,true);
$tok=$tok_result["access"]["token"]["id"];
$tenantid=$tok_result["access"]["token"]["tenant"]["id"];
$_SESSION['s_tenantid']=$tenantid;
$_SESSION['s_tok']=$tok;

if($tok == ""){
	echo "You entered incorrect credentials. Please login again. $form";
} else {
 	if($user == 'admin') {
 		echo "<p>You have logged in successfully as <b>$user</b>. <a href='./home.php'>Click here to go to Main menu</a></p>";
 	}
 	else {
 		echo "<p>You have logged in successfully as <b>$user</b>. <a href='./user_mainmenu.php'>Click here to go to Main menu</a></p>";
 	}
}
	
?>


</body>
</html>
