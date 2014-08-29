<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
?>

<!DOCTYPE html>
<?php

$tenant_network_details=$_SESSION['s_tenant_network_details'];
$tenant_flavor_details=$_SESSION['s_tenant_flavor_details'];
$tok=$_SESSION['s_tok'];
$_SESSION['s_tok']=$tok;
$heat_url="http://192.168.5.101:8004/v1/41f3cb58f6ba468bb4680a140153bb3a/stacks";


?>

<html>

<head>
	<title> My website </title>
	<link rel="stylesheet" type="text/css" href="n-style.css" />
</head>


<body>

	<div id="header">
		<?php $user=$_SESSION['s_user']; ?>
		<a style='margin-left: 800px'>User: <?php echo '<b>' . $user . '</b>'; ?></a>
		<a href='./change_login.php' style='margin-left: 10px'> Login as different user </a>
		<a href='./logout.php'> <img src='./images/logout.jpg' width='200' alt='Logout' align='right'/> </a>
		<p> <img class="headerimg" src="openstack-cloud-software-vertical-small.png" width="107" height="90"> <h1> <span style="color:#94928F;">open</span><span style="color:red;">stack</span><span style="color:black;"> dashboard </span></h1>  </p>
	</div>

	<div id="navbar">
		
		<ul> 
			<li class="navhome"><a href="home.php"><b> Home </b></a></li>
			<li class="naviaas"><a href="iaas.php"><b> IaaS </b><br>Infrastructure Architect view</a></li>  
			<li class="navpaas"><a href="paas-app-arch.php"><b> PaaS </b><br>Application Architect view</a></li>  
			<li class="navsaas"><a href="paas-dev.php"><b> PaaS </b><br>Developer view</a></li>  
			<li class="navcontact"><a href="contact.php"><b> Contact Us </b></a></li>
		</ul>
	</div>

	<div id="content1">   
		<p> <h3> Platform as a Service [PaaS] </h3>  </p>
                <?php
                
                $template_id=$_SESSION['s_template_id'];
                $deployment=$_SESSION['deployment'];
                $ext_net_id="d7d3d3a3-a601-4661-8d28-16f02f76ca21";
                $flavor=$_POST['webflavor'];
                $network=$_POST['networks'];
                $template_url='http://localhost/os/templates/basic_vm_deploy_template.yaml';
                $key=$_POST['key'];
                $image=$_POST['image'];
                $server_name=$_POST['server_name'];
		foreach($tenant_network_details as $net){
                    
                    if($network == $net['network_id']) {
			$private_subnet_id=$net['subnet_id'];							
                    }
		}                
                
                function display_request_details() {
                echo "User has given following inputs";
                echo "<br>";
                echo "Flavor selected: " . $flavor;
                echo "<br>";
                echo "Network selected: " . $network . "Subnet: " . $private_subnet_id;
                echo "<br>";
                echo "Deployment: " . $deployment;
                echo "<br>";
                echo "Key: " . $key;
                echo "<br>";
                echo "Image: " . $image;
                echo "<br>";
                echo "Server Name: " . $server_name;
                echo "<br>";
                echo "Token: " . $tok;
                echo "<br>";
                }
                
                $heat_request_details="'{
                \"stack_name\": \"admin_stack1\",
                \"template_url\": \"$template_url\",
                \"parameters\": {
                \"ext_net_id\": \"$ext_net_id\",
                \"server_name\": \"$server_name\",
                \"key_name\": \"$key\",
                \"image\": \"$image\",
                \"private_net_id\": \"$network\",
                \"flavor\": \"$flavor\",
                \"private_subnet_id\": \"$private_subnet_id\"
                },
                \"timeout_mins\": \"{30}\"
                }'";
                
                                $output = shell_exec("curl $heat_url -H \"Content-Type: application/json\" -H \"X-Auth-Token: $tok\" -d $heat_request_details");
                echo "<pre>$output</pre>";
                
                ?>

        </div>
</body>
</html>                        
