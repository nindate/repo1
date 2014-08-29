<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
?>

<!DOCTYPE html>
<?php

$tenant_network_details=$_SESSION['s_tenant_network_details'];
$tenant_flavor_details=$_SESSION['s_tenant_flavor_details'];
$_SESSION['s_tenant_network_details']=$tenant_network_details;
$_SESSION['s_tenant_flavor_details']=$tenant_flavor_details;

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
                $deployment=$_SESSION['deployment'];
                $arch=$_SESSION['arch'];
                $deploymentdesc=$_SESSION['deploymentdesc'];
		$lb=$_SESSION['lb'];
		$web=$_SESSION['web'];
		$app=$_SESSION['app'];
		$msgbus=$_SESSION['msgbus'];
		$db=$_SESSION['db'];
		$tok=$_SESSION['s_tok'];
		$_SESSION['s_tok']=$tok;
		
		$_SESSION['deployment']=$deployment;
		// require('./db_connect.php');
		// mysqli_select_db($con,"nova");
		// $sql='select id, flavorid, name, vcpus, memory_mb, root_gb, ephemeral_gb';
	
                if($deployment == 'd1') {
		    echo "<b>Selected deployment is as below: </b><br><br>";
		    echo "<form method='post' action='./deploy.php'>";
                    echo "Select further configuration details as desired and click Submit. <input type='submit' name='deploy'><br>";
		    echo "<table>";
                    echo "<tr><th>Field</th><th>Value</th><th>Flavor</th><th>Network</th></tr>";
                    echo "<tr><td>Architecture: </td><td>Two Tier</td><td>NA</td><td>NA</td></tr>";
                    echo "<tr><td>Deployment: </td><td>Web and DB on single OS instance (default)</td><td>NA</td><td>NA</td></tr>";
                    echo "<tr><td>Load Balancer: </td><td>NA</td><td>NA</td><td>NA</td></tr>";
                    echo "<tr><td>Web: </td><td>Apache2 on CentOS 6.5</td>";
						echo "<td> Select flavor: <select name='webflavor'>";
						foreach($tenant_flavor_details as $flavor){
							echo "<option value='" . $flavor['flavor_name'] . "'>" . $flavor['flavor_name'] . "</option>";							
						}
						echo "</select></td>";
						echo "<td> Select Network: <select name='networks'>";
						foreach($tenant_network_details as $net){
							echo "<option value='" . $net['network_id'] . "'>" . $net['network_name'] . ": " . $net['subnet_cidr'] . "</option>";
						}
						echo "</select></td>";
						echo "<td>Key: <input type='text' name='key'</td>";
						echo "<td>Image: <input type='text' name='image'</td>";
						echo "<td>Server Name: <input type='text' name='server_name'</td>";
						echo "</tr>";
                    echo "<tr><td>App: </td><td>NA</td><td>NA</td><td>NA</td></tr>";
		    echo "<tr><td>Msg_Bus: </td><td>NA</td><td>NA</td><td>NA</td></tr>";			
                    echo "<tr><td>DB: </td><td>MySQL on same OS instance as Web</td><td>NA</td><td>NA</td></tr>";
   		    echo "</table>";
		    echo "</form>";
                }
                
                if($deployment == 'd2') {
                    echo "<b>Selected deployment is as below: </b><br>";
                    echo "Select further configuration details as desired and click Submit. <input type='submit' name='deploymentdetails'><br>";
		    echo "<table>";
                    echo "<tr><th>Field</th><th>Value</th><th>Flavor</th></tr>";
                    echo "<tr><td>Architecture: </td><td>Two Tier</td><td></td></tr>";
                    echo "<tr><td>Deployment: </td><td>Web and DB on single OS instance (custom)</td><td></td></tr>";
                    echo "<tr><td>Load Balancer: </td><td>NA</td><td></td></tr>";
                    echo "<tr><td>Web: </td><td>$web</td><td> Select flavor: <select name='webflavor'>
						<option value='webflavor1'>m1.micro</option>
						<option value='webflavor2'>m1.tiny</option>
                                                <option value='webflavor3'>m2.tiny</option>
						</select> </td></tr>";
                    echo "<tr><td>App: </td><td>$app</td><td> Select flavor: <select name='appflavor'>
						<option value='appflavor1'>m1.micro</option>
						<option value='appflavor2'>m1.tiny</option>
                                                <option value='appflavor3'>m2.tiny</option>
						</select> </td></tr>";
		    echo "<tr><td>Msg_Bus: </td><td>$msgbus</td><td></td></tr>";			
                    echo "<tr><td>DB: </td><td>$db</td><td>  Select flavor: <select name='dbflavor'>
						<option value='dbflavor1'>m1.micro</option>
						<option value='dbflavor2'>m1.tiny</option>
                                                <option value='dbflavor3'>m2.tiny</option>
						</select> </td></tr>";
   		    echo "</table>";						
                }
                
                if($deployment == 'd3') {
                    echo "<b>Selected deployment is as below: </b><br>";
                    echo "Select further configuration details as desired and click Submit. <input type='submit' name='deploymentdetails'><br>";
		    echo "<table>";
                    echo "<tr><th>Field</th><th>Value</th><th>Flavor</th></tr>";
                    echo "<tr><td>Architecture: </td><td>Two Tier</td><td></td></tr>";
                    echo "<tr><td>Deployment: </td><td>Web and DB on two separate OS instances (default)</td><td></td></tr>";
                    echo "<tr><td>Load Balancer: </td><td>NA</td><td></td></tr>";
                    echo "<tr><td>Web: </td><td>$web</td><td> Select flavor: <select name='webflavor'>
						<option value='webflavor1'>m1.micro</option>
						<option value='webflavor2'>m1.tiny</option>
                                                <option value='webflavor3'>m2.tiny</option>
						</select> </td></tr>";
                    echo "<tr><td>App: </td><td>$app</td><td> Select flavor: <select name='appflavor'>
						<option value='appflavor1'>m1.micro</option>
						<option value='appflavor2'>m1.tiny</option>
                                                <option value='appflavor3'>m2.tiny</option>
						</select> </td></tr>";
		    echo "<tr><td>Msg_Bus: </td><td>$msgbus</td><td></td></tr>";			
                    echo "<tr><td>DB: </td><td>$db</td><td>  Select flavor: <select name='dbflavor'>
						<option value='dbflavor1'>m1.micro</option>
						<option value='dbflavor2'>m1.tiny</option>
                                                <option value='dbflavor3'>m2.tiny</option>
						</select> </td></tr>";
   		    echo "</table>";
                }
                
                if($deployment == 'd4') {
                    echo "<b>Selected deployment is as below: </b><br>";
                    echo "Select further configuration details as desired and click Submit. <input type='submit' name='deploymentdetails'><br>";
		    echo "<table>";
                    echo "<tr><th>Field</th><th>Value</th><th>Flavor</th></tr>";
                    echo "<tr><td>Architecture: </td><td>Two Tier</td><td></td></tr>";
                    echo "<tr><td>Deployment: </td><td>Web and DB on two separate OS instances (custom)</td><td></td></tr>";
                    echo "<tr><td>Load Balancer: </td><td>NA</td><td></td></tr>";
                    echo "<tr><td>Web: </td><td>$web</td><td> Select flavor: <select name='webflavor'>
						<option value='webflavor1'>m1.micro</option>
						<option value='webflavor2'>m1.tiny</option>
                                                <option value='webflavor3'>m2.tiny</option>
						</select> </td></tr>";
                    echo "<tr><td>App: </td><td>$app</td><td> Select flavor: <select name='appflavor'>
						<option value='appflavor1'>m1.micro</option>
						<option value='appflavor2'>m1.tiny</option>
                                                <option value='appflavor3'>m2.tiny</option>
						</select> </td></tr>";
		    echo "<tr><td>Msg_Bus: </td><td>$msgbus</td><td></td></tr>";			
                    echo "<tr><td>DB: </td><td>$db</td><td>  Select flavor: <select name='dbflavor'>
						<option value='dbflavor1'>m1.micro</option>
						<option value='dbflavor2'>m1.tiny</option>
                                                <option value='dbflavor3'>m2.tiny</option>
						</select> </td></tr>";
   		    echo "</table>";
                }
                
                if($deployment == 'd5') {
                    echo "<b>Selected deployment is as below: </b><br>";
                    echo "Select further configuration details as desired and click Submit. <input type='submit' name='deploymentdetails'><br>";
		    echo "<table>";
                    echo "<tr><th>Field</th><th>Value</th><th>Flavor</th></tr>";
                    echo "<tr><td>Architecture: </td><td>Two Tier</td><td></td></tr>";
                    echo "<tr><td>Deployment: </td><td>Two load balanced Web instances and one DB instance (default)</td><td></td></tr>";
                    echo "<tr><td>Load Balancer: </td><td>Openstack provided</td><td></td></tr>";
                    echo "<tr><td>Web: </td><td>$web</td><td> Select flavor: <select name='webflavor'>
						<option value='webflavor1'>m1.micro</option>
						<option value='webflavor2'>m1.tiny</option>
                                                <option value='webflavor3'>m2.tiny</option>
						</select> </td></tr>";
                    echo "<tr><td>App: </td><td>$app</td><td> Select flavor: <select name='appflavor'>
						<option value='appflavor1'>m1.micro</option>
						<option value='appflavor2'>m1.tiny</option>
                                                <option value='appflavor3'>m2.tiny</option>
						</select> </td></tr>";
		    echo "<tr><td>Msg_Bus: </td><td>$msgbus</td><td></td></tr>";			
                    echo "<tr><td>DB: </td><td>$db</td><td>  Select flavor: <select name='dbflavor'>
						<option value='dbflavor1'>m1.micro</option>
						<option value='dbflavor2'>m1.tiny</option>
                                                <option value='dbflavor3'>m2.tiny</option>
						</select> </td></tr>";
   		    echo "</table>";
                }
                
                if($deployment == 'd6') {
                    echo "<b>Selected deployment is as below: </b><br>";
                    echo "Select further configuration details as desired and click Submit. <input type='submit' name='deploymentdetails'><br>";
		    echo "<table>";
                    echo "<tr><th>Field</th><th>Value</th><th>Flavor</th></tr>";
                    echo "<tr><td>Architecture: </td><td>Two Tier</td><td></td></tr>";
                    echo "<tr><td>Deployment: </td><td>Two load balanced Web instances and one DB instance (custom)</td><td></td></tr>";
                    echo "<tr><td>Load Balancer: </td><td>Openstack/Dedicated NLB(on Apache2 on CentOS 6.5)</td><td></td></tr>";
                    echo "<tr><td>Web: </td><td>$web</td><td> Select flavor: <select name='webflavor'>
						<option value='webflavor1'>m1.micro</option>
						<option value='webflavor2'>m1.tiny</option>
                                                <option value='webflavor3'>m2.tiny</option>
						</select> </td></tr>";
                    echo "<tr><td>App: </td><td>$app</td><td> Select flavor: <select name='appflavor'>
						<option value='appflavor1'>m1.micro</option>
						<option value='appflavor2'>m1.tiny</option>
                                                <option value='appflavor3'>m2.tiny</option>
						</select> </td></tr>";
		    echo "<tr><td>Msg_Bus: </td><td>$msgbus</td><td></td></tr>";			
                    echo "<tr><td>DB: </td><td>$db</td><td>  Select flavor: <select name='dbflavor'>
						<option value='dbflavor1'>m1.micro</option>
						<option value='dbflavor2'>m1.tiny</option>
                                                <option value='dbflavor3'>m2.tiny</option>
						</select> </td></tr>";
   		    echo "</table>";
                }
                
                if($deployment == 'd7') {
                    echo "<b>Selected deployment is as below: </b><br>";
                    echo "Select further configuration details as desired and click Submit. <input type='submit' name='deploymentdetails'><br>";
		    echo "<table>";                    
		    echo "<tr><th>Field</th><th>Value</th><th>Flavor</th></tr>";
                    echo "<tr><td>Architecture: </td><td>Two Tier</td><td></td></tr>";
                    echo "<tr><td>Deployment: </td><td>Multiple Web and DB instances (custom)</td><td></td></tr>";
                    echo "<tr><td>Load Balancer: </td><td>Openstack/Dedicated NLB(on Apache2 on CentOS 6.5)</td><td></td></tr>";
                    echo "<tr><td>Web: </td><td>$web</td><td> Select flavor: <select name='webflavor'>
						<option value='webflavor1'>m1.micro</option>
						<option value='webflavor2'>m1.tiny</option>
                                                <option value='webflavor3'>m2.tiny</option>
						</select> </td></tr>";
                    echo "<tr><td>App: </td><td>$app</td><td> Select flavor: <select name='appflavor'>
						<option value='appflavor1'>m1.micro</option>
						<option value='appflavor2'>m1.tiny</option>
                                                <option value='appflavor3'>m2.tiny</option>
						</select> </td></tr>";
		    echo "<tr><td>Msg_Bus: </td><td>$msgbus</td><td></td></tr>";			
                    echo "<tr><td>DB: </td><td>$db</td><td>  Select flavor: <select name='dbflavor'>
						<option value='dbflavor1'>m1.micro</option>
						<option value='dbflavor2'>m1.tiny</option>
                                                <option value='dbflavor3'>m2.tiny</option>
						</select> </td></tr>";
   		    echo "</table>";
                }
                
                if($deployment == 'd21') {
                    echo "<b>Selected deployment is as below: </b><br>";
                    echo "Select further configuration details as desired and click Submit. <input type='submit' name='deploymentdetails'><br>";
		    echo "<table>";
                    echo "<tr><th>Field</th><th>Value</th><th>Flavor</th></tr>";
                    echo "<tr><td>Architecture: </td><td>Three Tier</td><td></td></tr>";
                    echo "<tr><td>Deployment: </td><td>Web, App and DB on single OS instance (default)</td><td></td></tr>";
                    echo "<tr><td>Load Balancer: </td><td>NA</td><td></td></tr>";
                    echo "<tr><td>Web: </td><td>$web</td><td> Select flavor: <select name='webflavor'>
						<option value='webflavor1'>m1.micro</option>
						<option value='webflavor2'>m1.tiny</option>
                                                <option value='webflavor3'>m2.tiny</option>
						</select> </td></tr>";
                    echo "<tr><td>App: </td><td>$app</td><td> Select flavor: <select name='appflavor'>
						<option value='appflavor1'>m1.micro</option>
						<option value='appflavor2'>m1.tiny</option>
                                                <option value='appflavor3'>m2.tiny</option>
						</select> </td></tr>";
		    echo "<tr><td>Msg_Bus: </td><td>$msgbus</td><td></td></tr>";			
                    echo "<tr><td>DB: </td><td>$db</td><td>  Select flavor: <select name='dbflavor'>
						<option value='dbflavor1'>m1.micro</option>
						<option value='dbflavor2'>m1.tiny</option>
                                                <option value='dbflavor3'>m2.tiny</option>
						</select> </td></tr>";
   		    echo "</table>";
                }
                
                if($deployment == 'd22') {
                    echo "<b>Selected deployment is as below: </b><br>";
                    echo "Select further configuration details as desired and click Submit. <input type='submit' name='deploymentdetails'><br>";
		    echo "<table>";
                    echo "<tr><th>Field</th><th>Value</th><th>Flavor</th></tr>";
                    echo "<tr><td>Architecture: </td><td>Three Tier</td><td></td></tr>";
                    echo "<tr><td>Deployment: </td><td>Web, App and DB on single OS instance (custom)</td><td></td></tr>";
                    echo "<tr><td>Load Balancer: </td><td>NA</td><td></td></tr>";
                    echo "<tr><td>Web: </td><td>$web</td><td> Select flavor: <select name='webflavor'>
						<option value='webflavor1'>m1.micro</option>
						<option value='webflavor2'>m1.tiny</option>
                                                <option value='webflavor3'>m2.tiny</option>
						</select> </td></tr>";
                    echo "<tr><td>App: </td><td>$app</td><td> Select flavor: <select name='appflavor'>
						<option value='appflavor1'>m1.micro</option>
						<option value='appflavor2'>m1.tiny</option>
                                                <option value='appflavor3'>m2.tiny</option>
						</select> </td></tr>";
		    echo "<tr><td>Msg_Bus: </td><td>$msgbus</td><td></td></tr>";			
                    echo "<tr><td>DB: </td><td>$db</td><td>  Select flavor: <select name='dbflavor'>
						<option value='dbflavor1'>m1.micro</option>
						<option value='dbflavor2'>m1.tiny</option>
                                                <option value='dbflavor3'>m2.tiny</option>
						</select> </td></tr>";
   		    echo "</table>";
                }
                
                ?>
        </div>
</body>
</html>        
