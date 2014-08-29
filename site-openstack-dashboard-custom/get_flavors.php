<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
?>

<!DOCTYPE html>

<html>
<body>

<?php

$output = shell_exec("curl 'http://192.168.5.101:5000/v2.0/tokens' -X POST -H \"Content-Type: application/json\" -H \"Accept: application/json\"  -d '{\"auth\": {\"tenantName\": \"demo1\", \"passwordCredentials\": {\"username\": \"demo1\", \"password\": \"openstack\"}}}' | grep '{' ");
$tok_result=json_decode($output,true);
$tok=$tok_result["access"]["token"]["id"];

$flavors_output = shell_exec("curl -X GET http://192.168.5.101:8774/v2/e7034fa9d3c24364aa38426a10d66c1d/flavors -H \"X-Auth-Token: $tok\" |python -m json.tool ");
// echo "<pre>$flavors_output</pre>";
// echo "<hr>";
$flavors_result=json_decode($flavors_output,true);



// Populate array with Flavor details
function populate_tenant_flavor_details($flavors_result,$tok) {
        $row=0;
        foreach ( $flavors_result['flavors'] as $flavor) {
            $tenant_flavor_details[$row]['flavor_id']=$flavor['id'];
            $tenant_flavor_details[$row]['flavor_name']=$flavor['name'];
            foreach ( $flavor['links'] as $links) {
                if($links['rel'] == 'self'){           
                    $href=($links['href']);
                    // echo $href;
                    $per_flavors_output = shell_exec("curl -X GET $href -H \"X-Auth-Token: $tok\" |python -m json.tool ");
                    //echo "<pre>$per_flavors_output</pre>";
                    $per_flavors_result=json_decode($per_flavors_output,true);
                    $tenant_flavor_details[$row]['vcpus']=$per_flavors_result['flavor']['vcpus'];
                    $tenant_flavor_details[$row]['memory']=$per_flavors_result['flavor']['ram'];
                    $tenant_flavor_details[$row]['rootdisk']=$per_flavors_result['flavor']['disk'];   
                }      
            }
        $row++;
        }
    return $tenant_flavor_details;  
        
}
        
        
// Display populated details
function display_tenant_flavor_details($tenant_flavor_details) {
        echo "<table border='1'>";
        echo "<tr><th>Flavor id</th><th>Flavor name</th><th>vcpus</th><th>Memory (MB)</th><th>Root disk (GB)</th></tr>";
        foreach ( $tenant_flavor_details as $tenant_flavor) {
            echo "<tr>";
            echo "<td>";
            print_r($tenant_flavor['flavor_id']);
            echo "</td>";
            echo "<td>";
            print_r($tenant_flavor['flavor_name']);
            echo "</td>";
            echo "<td>";
            print_r($tenant_flavor['vcpus']);
            echo "</td>";
            echo "<td>";
            print_r($tenant_flavor['memory']);
            echo "</td>";
            echo "<td>";
            print_r($tenant_flavor['rootdisk']);
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<hr>";
}        
        
$tenant_flavor_details=populate_tenant_flavor_details($flavors_result,$tok);
display_tenant_flavor_details($tenant_flavor_details);
$_SESSION['s_tenant_flavor_details']=$tenant_flavor_details;


?>

</body>
</html>
