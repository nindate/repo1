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
		<p> <h3> Software as a Service [SaaS] </h3>  </p>

		<div class="content1-left">
		<p>Left section</p>
		<p>Line1</p>
		<p>Line2</p>
		<p>Line3</p>
		</div>

		<div class="content1-right">
		<p>Right section</p>
		<p>Line1</p>
		<p>Line2</p>
		<p>Line3</p>
		</div>

	</div>

	<div class="clear">   

	</div>


	<div id="footer">   
		<p> <h1> Footer </h1>  </p>

	</div>

</body>
</html>
