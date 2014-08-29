<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
?>

<?php

$user="admin";
$tenant="admin";
$pass="openstack";
$_SESSION['s_tenant']=$tenant;
$_SESSION['s_user']=$user;
$_SESSION['s_pass']=$pass;

$output = shell_exec("curl 'http://192.168.5.101:5000/v2.0/tokens' -X POST -H \"Content-Type: application/json\" -H \"Accept: application/json\"  -d '{\"auth\": {\"tenantName\": \"$tenant\", \"passwordCredentials\": {\"username\": \"$user\", \"password\": \"$pass\"}}}' | grep '{' ");

echo "<pre>$output</pre>";
echo "<hr>";

$tok_result=json_decode($output,true);

$tok=$tok_result["access"]["token"]["id"];
if($tok == ""){
	echo "You entered incorrect details. Login again";
} else {
	echo "<br>Token received is " . $tok;
        echo "<br>Tenant id is : " . $tok_result["access"]["token"]["tenant"]["id"];
}
$_SESSION['s_tok']=$tok;

?>
