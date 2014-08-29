<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
?>

<!DOCTYPE html>


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
		$tok=$_SESSION['s_tok'];
		$_SESSION['s_tok']=$tok;
		
		$form="<form action='./paas-app-arch.php' method='post'>
		<p>Select a deployment from below options and click Submit. <input type='submit' name='selecteddeployment'> </p>
		<table class='table-paas'>
			<tr>
				<th style='width: 5px;'>Architecture</th>
				<th style='width: 200px;'>Deployment</th>
				<th style='width: 5px;'>Summary</th>
				<th style='width: 5px;'>Select</th>

			</tr>
			<tr>
				<td>Two Tier<input type='hidden' name='arch' value='Two Tier'></td>
				<td>Web and DB on single OS instance (default)<input type='hidden' name='deploymentdesc' value='Web and DB on single OS instance (default)'></td>
				<td>Load Balancer: NA ; Web: Apache2 on CentOS 6.5 ; App: NA ; MsgBus: NA ; DB: MySQL on CentOS 6.5</td>
				<td><input type='radio' name='deployment' value='d1'></td>

			</tr>
			<tr class='alt'>
				<td>Two Tier<input type='hidden' name='arch' value='Two Tier'></td>
				<td>Web and DB on single OS instance (custom)<input type='hidden' name='deploymentdesc' value='Web and DB on single OS instance (custom)'></td>
				<td>Load Balancer: NA ; Web: Apache2/NGINX on CentOS 6.5/Ubuntu 14.04 ; App: NA ; MsgBus: NA ; DB: MySQL/PostgreSQL on same OS instance as Web</td>
				<td><input type='radio' name='deployment' value='d2'></td>
			</tr>
			<tr>
				<td>Two Tier<input type='hidden' name='arch' value='Two Tier'></td>
				<td>Web and DB on two separate OS instances (default)<input type='hidden' name='deploymentdesc' value='Web and DB on two separate OS instances (default)'></td>
				<td>Load Balancer: NA ; Web: Apache2 on CentOS 6.5 ; App: NA ; MsgBus: NA ; DB: MySQL on CentOS 6.5</td>
				<td><input type='radio' name='deployment' value='d3'></td>
			</tr>
			<tr class='alt'>
				<td>Two Tier<input type='hidden' name='arch' value='Two Tier'></td>
				<td>Web and DB on two separate OS instances (custom)<input type='hidden' name='deploymentdesc' value='Web and DB on two separate OS instances (custom)'></td>
				<td>Load Balancer: NA ; Web: Apache2/NGINX on CentOS 6.5/Ubuntu 14.04 ; App: NA ; MsgBus: NA ; DB: MySQL/PostgreSQL on CentOS 6.5/Ubuntu 14.04 </td>
				<td><input type='radio' name='deployment' value='d4'></td>
			</tr>
			<tr>
				<td>Two Tier<input type='hidden' name='arch' value='Two Tier'></td>
				<td>Two load balanced Web instances and one DB instance (default)<input type='hidden' name='deploymentdesc' value='Two load balanced Web instances and one DB instance (default)'></td>
				<td>Load Balancer: Openstack provided ; Web: Apache2 on CentOS 6.5 ; App: NA ; MsgBus: NA ; DB: MySQL on CentOS 6.5</td>				
				<td><input type='radio' name='deployment' value='d5'></td>
			</tr>
			<tr class='alt'>
				<td>Two Tier<input type='hidden' name='arch' value='Two Tier'></td>
				<td>Two load balanced Web instances and one DB instance (custom)<input type='hidden' name='deploymentdesc' value='Two load balanced Web instances and one DB instance (custom)'></td>
				<td>Load Balancer: Openstack/Dedicated NLB(on Apache2 on CentOS 6.5) ; Web: Apache2/NGINX on CentOS 6.5/Ubuntu 14.04 ; App: NA ; MsgBus: NA ; DB: MySQL/PostgreSQL on CentOS 6.5/Ubuntu 14.04 </td>
				<td><input type='radio' name='deployment' value='d6'></td>
			</tr>
			<tr>
				<td>Two Tier<input type='hidden' name='arch' value='Two Tier'></td>
				<td>Multiple Web and DB instances (custom)<input type='hidden' name='deploymentdesc' value='Multiple Web and DB instances (custom)'></td>
				<td>Load Balancer: Openstack/Dedicated NLB(on Apache2 on CentOS 6.5) ; Web: Single/Multiple instances of Apache2/NGINX on CentOS 6.5/Ubuntu 14.04 ; App: NA ; MsgBus: NA ; DB: Single/Clustered instances of MySQL/PostgreSQL on CentOS 6.5/Ubuntu 14.04 </td>
				<td><input type='radio' name='deployment' value='d7'></td>
			</tr>
			<tr class='alt'>
				<td>Three Tier<input type='hidden' name='arch' value='Three Tier'></td>
				<td>Web, App and DB on single OS instance (default)<input type='hidden' name='deploymentdesc' value='Web, App and DB on single OS instance (default)'></td>
				<td>Load Balancer: Openstack provided ; Web: Apache2 on CentOS 6.5 ; App: Tomcat on CentOS 6.5 ; MsgBus: NA ; DB: MySQL on CentOS 6.5</td>
				<td><input type='radio' name='deployment' value='d21'></td>
			</tr>
			<tr>
				<td>Three Tier<input type='hidden' name='arch' value='Three Tier'></td>
				<td>Web, App and DB on single OS instance (custom)<input type='hidden' name='deploymentdesc' value='Web, App and DB on single OS instance (custom)'></td>
				<td>Load Balancer: NA ; Web: Apache2/NGINX on CentOS 6.5/Ubuntu 14.04 ; App: Tomcat/JBoss on same OS instance as Web ; MsgBus: NA ; DB: MySQL/PostgreSQL on same OS instance as Web</td>
				<td><input type='radio' name='deployment' value='d22'></td>
			</tr>
		</table>
		</form>";
		if($_POST['selecteddeployment']) {
			if($_POST['deployment'] == ""){
				$error='You have not selected any option.';
				echo '<p style=\'color: red;\'>' . 'Error: ' . $error . '</p>';
				// $_SESSION['error']=$error;
				echo $form;
			} else {
				$_SESSION['deployment']=$_POST['deployment'];
				$_SESSION['arch']=$_POST['arch'];
				$_SESSION['deploymentdesc']=$_POST['deploymentdesc'];
				$_SESSION['lb']=$_POST['lb'];
				$_SESSION['web']=$_POST['web'];
				$_SESSION['app']=$_POST['app'];
				$_SESSION['msgbus']=$_POST['msgbus'];
				$_SESSION['db']=$_POST['db'];
				header("location: deployment_details.php");
			}
		}
		else
			echo $form;
		?>
	</div>

	<div class="clear">   

	</div>


	<div id="footer">   
		<p> <h1> Footer </h1>  </p>

	</div>

</body>
</html>
