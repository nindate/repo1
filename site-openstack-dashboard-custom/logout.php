<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
?>

<html>
<body>


<?php
session_destroy();
echo "You have been logged out successfully";
echo "<a href='./login.php'>Click here</a> to goto login page";
?>

</body>
</html>
