<?php

$output = shell_exec("curl 'http://192.168.5.101:5000/v2.0/tokens' -X POST -H \"Content-Type: application/json\" -H \"Accept: application/json\"  -d '{\"auth\": {\"tenantName\": \"demo1\", \"passwordCredentials\": {\"username\": \"demo1\", \"password\": \"openstack\"}}}' | grep '{' ");
$tok_result=json_decode($output,true);
$tok=$tok_result["access"]["token"]["id"];

$images_output = shell_exec("curl -X GET http://192.168.5.101:9292/v2/images -H \"X-Auth-Token: $tok\" |python -m json.tool ");
echo "<pre>$images_output</pre>";
echo "<hr>";
$images_result=json_decode($images_output,true);

echo "<table border='1'>";
echo "<tr><th>Image id</th><th>Image name</th><th>Image size (MB)</th><th>Image format</th><th>Image type</th></tr>";

foreach ( $images_result['images'] as $image) {
    echo "<tr>";
    echo "<td>";
    print_r($image['id']);
    echo "</td>";
    echo "<td>";
    print_r($image['name']);
    echo "</td>";
    echo "<td>";
    echo (round(intval($image['size']) / 1048576))."\n";
    echo "</td>";
    echo "<td>";
    print_r($image['disk_format']);
    echo "</td>";
    echo "<td>";
    if($image['image_type'] == "snapshot"){
        print_r($image['image_type']);            
    } else echo "image";
    echo "</td>";
    echo "</tr>";
}

echo "</table>";
?>
