<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
?>

<html>
<body>

<?php

	echo "<div>";
        echo "<a href='./user_mainmenu.php' style='padding-left: 740px'> Go back to Main menu </a>";
        echo "<a href='./change_login.php' style='padding-left: 10px'> Login as different user </a>";
        echo "<a href='./logout.php' style='padding-left: 10px'> <img src='./images/logout.jpg' width='200' alt='Logout'/> </a>";
	echo "</div>";

	echo "<hr><br>";
	echo "<div>";
	$selected_radio=$_POST['template_id']; 
	if($selected_radio == 1) {
		echo "Deploying template: Basic single VM in existing network";

	}
	else 
	{
		if($selected_radio == 2) {

			echo "Deploying template: Single VM with new network";
		
		}
		else
		{
			if($selected_radio == 3) {

				echo "Deploying template: Two tier architecture [1-web, 1-db]";
			
			}
		}
	}
	echo "</div>";

?>

</body>
</html>
