<!DOCTYPE HTML>
<html>
<link rel="stylesheet" href="css/style.css" type="text/css">
<body>

<?php
$form = "<form action='./sqldb3.php' method='post'>
	<div id='field1'>
			<table>
					<tr>
					<td>Username:</td>
					<td><input type='text' name='user' /></td>
					<td><input id='btn' type='submit' name='userbtn' value='Enter'/></td>
					</tr>
			
			</table>
	</div>";
echo $form
?>


</body>
</html>
