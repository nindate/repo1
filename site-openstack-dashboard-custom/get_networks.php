<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
?>

<!DOCTYPE html>

<html>
<body>

<?php

$tok=$_SESSION['s_tok'];
$tenantid=$_SESSION['s_tenantid'];

$networks_output = shell_exec("curl -X GET http://192.168.5.101:9696/v2.0/networks -H \"X-Auth-Token: $tok\" |python -m json.tool ");
// echo "<pre>$networks_output</pre>";
// echo "<hr>";
$networks_result=json_decode($networks_output,true);

$subnets_output = shell_exec("curl -X GET http://192.168.5.101:9696/v2.0/subnets -H \"X-Auth-Token: $tok\" |python -m json.tool ");
// echo "<pre>$subnets_output</pre>";
// echo "<hr>";
$subnets_result=json_decode($subnets_output,true);

// Display Network details
function display_network_details($networks_result,$tenantid,$subnets_result) {
        echo "<table border='1'>";
        echo "<tr><th>Network id</th><th>Network name</th><th>Subnets</th></tr>";
        foreach ( $networks_result['networks'] as $net) {
            if($tenantid == $net['tenant_id']) {
                echo "<tr>";
                echo "<td>";
                print_r($net['id']);
                echo "</td>";
                echo "<td>";
                print_r($net['name']);
                echo "</td>";
                echo "<td>";
                    echo "<table border='1' style='border-collapse: collapse'>";
                        foreach ( $subnets_result['subnets'] as $subnet) { 
                                if($subnet['network_id'] == $net['id']) {
                                    echo "<tr><td>";
                                    print_r($subnet['id']);
                                    echo "</td><td>";                        
                                    print_r($subnet['name']);
                                    echo "</td><td>";
                                    print_r($subnet['cidr']);
                                    echo "</td></tr>";
                                }
                            }
                    echo "</table>";
                echo "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        echo "<hr>";

}



// Populate array with Network details
function populate_tenant_network_details($networks_result,$tenantid,$subnets_result) {
        $row=0;
        foreach ( $networks_result['networks'] as $net) {
            if($tenantid == $net['tenant_id']) {
                $tenant_network_details[$row]['network_id']=$net['id'];
                $tenant_network_details[$row]['network_name']=$net['name'];
                        foreach ( $subnets_result['subnets'] as $subnet) { 
                                if($subnet['network_id'] == $net['id']) {
                                    $tenant_network_details[$row]['subnet_id']=$subnet['id'];
                                    $tenant_network_details[$row]['subnet_name']=$subnet['name'];
                                    $tenant_network_details[$row]['subnet_cidr']=$subnet['cidr'];
                                }
                            }
                $row++;
            }
        }
    return $tenant_network_details;
}

// Display populated details
function display_tenant_network_details($tenant_network_details) {
        echo "<table border='1'>";
        echo "<tr><th>Network id</th><th>Network name</th><th>Subnet id</th><th>Subnet name</th><th>Subnet cidr</th></tr>";
        foreach ( $tenant_network_details as $tenant_net) {
            echo "<tr>";
            echo "<td>";
            print_r($tenant_net['network_id']);
            echo "</td>";
            echo "<td>";
            print_r($tenant_net['network_name']);
            echo "</td>";
            echo "<td>";
            print_r($tenant_net['subnet_id']);
            echo "</td>";
            echo "<td>";
            print_r($tenant_net['subnet_name']);
            echo "</td>";
            echo "<td>";
            print_r($tenant_net['subnet_cidr']);
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<hr>";
}

// display_network_details($networks_result,$tenantid,$subnets_result);
$tenant_network_details=populate_tenant_network_details($networks_result,$tenantid,$subnets_result);
display_tenant_network_details($tenant_network_details);
$_SESSION['s_tenant_network_details']=$tenant_network_details;

?>

</body>
</html>
