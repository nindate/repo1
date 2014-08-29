<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
?>

<html>
<body>
	<div id="header">
		<p> <h2>Your Private Cloud setup</h2> <p><hr>
	</div>

	<div id="content">
		<?php
		// Login form
		$form  = "<form action='./login.php' method='post'>
		<table>
			<tr>
				<td>Tenant / Project name:<td>
				<td><input type='text' name='tenant' /></td>
			</tr>
			<tr>
				<td>Username:<td>
				<td><input type='text' name='user'/></td>
			</tr>
			<tr>
				<td>Password:<td>
				<td><input type='password' name='pass'/></td>
			</tr>
			<tr>
				<td><td>
				<td><input type='submit' name='submit' value='Submit'/></td>
			</tr>

		</table>
		</form>";

		if($_POST['submit']) {
			require("checklogin.php");
		}
		else
			echo $form;

		?>

	</div>



</body>
</html>
