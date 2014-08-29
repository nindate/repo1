<?php

$output = shell_exec("curl -i 'http://192.168.5.101:5000/v2.0/tokens' -X POST -H \"Content-Type: application/json\" -H \"Accept: application/json\"  -d '{\"auth\": {\"tenantName\": \"admin\", \"passwordCredentials\": {\"username\": \"admin\", \"password\": \"openstack\"}}}' | grep '{' ");
// echo "<pre>$output</pre>";
$result=json_decode($output,true);
// print_r($result);
// var_dump($result);
// var_dump($result["access"]["token"]["id"]);
$tok=$result["access"]["token"]["id"];
// echo "<pre>$tok</pre>";

?>