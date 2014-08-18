<!DOCTYPE HTML>
<?php session_start(); ?>
<html>
<link rel="stylesheet" href="css/style.css" type="text/css">
<body>

<?php
$form = "<form action='./contactsmenu.php' method='post'>
	<div id='field1'>
			<table>
					<tr>
					<td>Username:</td>
					<td><input type='text' name='loginuser'/></td>
					<td><input id='btn' type='submit' name='userbtn' value='Enter'/></td>
					</tr>
			</table>
	</div>";

echo $form;

?>


</body>
