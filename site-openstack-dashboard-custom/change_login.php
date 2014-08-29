<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();
?>

<html>
<body>


<?php
session_destroy();
header ("location:./login.php");
?>

</body>
</html>
