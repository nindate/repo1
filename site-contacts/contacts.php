<!DOCTYPE HTML>
<?php session_start(); ?>

<html>
<head>

<style>
.error {color: #FF0000;}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  table-layout: auto;
  font-size: 14px;
}
th, td {
  padding: 5px;
}
th {
  text-align: center;
}
</style>

</head>
<body>


<?php
$loginuser=$_SESSION['loginuser'];

// define variables and set to empty values
$firstnameErr = $lastnameErr = $genderErr = $ageErr = "";
$firstname = $lastname = $gender = $comment = $age = "";


function test_input($data) {

   $data = trim($data);

   $data = stripslashes($data);

   $data = htmlspecialchars($data);

   return $data;

}

?>




<?php
// $_SESSION['loginuser']=$_POST['loginuser'];
// $loginuser=$_SESSION['loginuser'];
echo "<h2>You are using My Contacts application</h2>";
//echo "<h3 style='color: blue'>Welcome " . $loginuser .  "</b></h3>" ;
//echo "<hr>";
?>


<?php
echo "<h4 align='left' style='color:blue;'>The current CPU, Memory configuration and utilization</h4>";
echo "<table style='margin-left: 40px'>";
//echo "<table align='left' style=>";
//echo "<table style='margin-left:auto; margin-right:auto;'>";
echo "<tr>";
echo "<th>CPU (#)</th>";
echo "<th>CPU Util (%)</th>";
echo "<th>Memory (GB)</th>";
echo "<th>Memory Util (%)</th>";
echo "</tr>";


function get_server_memory_usage(){

	$free = shell_exec('free');
	$free = (string)trim($free);
	$free_arr = explode("\n", $free);
	$mem = explode(" ", $free_arr[1]);
	$mem = array_filter($mem);
	$mem = array_merge($mem);
  //print_r($mem);
  //echo "<br>";
	$memory_usage = round($mem[2]/$mem[1]*100);
  $memory_total = round($mem[1]/1024/1024);
  $mem_details[0] = $memory_usage;
  $mem_details[1] = $memory_total;

	return $mem_details;
}


function get_server_cpu_usage(){
  if (is_file('/var/www/html/cpu_util.txt'))
  {
    $load = shell_exec('cat /var/www/html/cpu_util.txt');
    $util = $load + 0;
  }
  else {
          $load = shell_exec('vmstat 1 2 | tail -1 | awk \'{print $(NF-2)}\'');
          $util = 100 - $load;
  }
        return $util;
}

function num_cpus()
{
  $numCpus = 1;
  if (is_file('/proc/cpuinfo'))
  {
    $cpuinfo = file_get_contents('/proc/cpuinfo');
    preg_match_all('/^processor/m', $cpuinfo, $matches);
    $numCpus = count($matches[0]);
  }
	return $numCpus;
}


function get_memory(){
  if (is_file('/proc/meminfo'))
  {
    $meminfo = file_get_contents('/proc/meminfo');
    print($meminfo);
    preg_match('/MemTotal:/', $meminfo, $matches,PREG_OFFSET_CAPTURE);
    print_r($matches);
    $memKB = "16308640";
  }
  return $memKB;
}

echo "<tr>";
echo "<td align='center'>";
echo num_cpus();
echo "</td>";
echo "<td align='center'>";
echo get_server_cpu_usage();
echo "</td>";
echo "<td align='center'>";
$mem_details = get_server_memory_usage();
$mem_util = $mem_details[0];
$mem_total = $mem_details[1];
echo $mem_total;
echo "</td>";
echo "<td align='center'>";
echo $mem_util;
echo "</td>";
echo "</tr>";
echo "</table>";
?>

<?php

// Create connection
$con=mysqli_connect("localhost","user1","password","test2");

// Check connection
if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


// Run query
$sql="select ID,FirstName,LastName,ContactNo,Comments from Persons order by ID desc limit 10;";
$result = mysqli_query($con,$sql);
if ($result) {
  echo "<br>";
} else {
  echo "Error running query: " . mysqli_error($con);
}


// Close connection
mysqli_close($con);

echo "<hr>";
echo "<h3>Current contacts: </h3>";
echo "<b>Latest 10 entries</b>";
echo "<form method='post' action='confirmdelete.php'>";
echo "<ul>";

$numrows=mysqli_num_rows($result);
if ($numrows == '0') {
echo "<span class='error'>*Presently there are no entries in the database</span>";
}

echo "<table>";
echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Contact No</th><th>Comments</th><th></th></tr>";
while($row = mysqli_fetch_array($result)) {

  // echo "<li>";

  echo "<tr>";
  echo "<td>" . $row['ID'] . "</td><td>" . $row['FirstName'] . "</td><td> " . $row['LastName'] . "</td><td>" . $row['ContactNo'] . "</td><td>" . $row['Comments'] . "</td>";

  $thisid=$row['ID'];

  echo "<td><input type='checkbox' name='checkboxvar[]' value='$thisid'>Delete</td>";
  echo "</tr>";

  // echo "</li>";

}
echo "</table>";
  echo "</ul>";
  echo "<input type='submit' name='Delete' value='Delete selected entries'>";
echo "</form>";

?>

<hr>
<br>
<p> <h3> Add new contact </h3> </p>
<p><span class="error">* required field.</span></p>

<form method='post' action='updatedb.php'>
   First Name:  <span class="error">* </span> <input type="text" name="firstname" value="<?php echo $firstname;?>">
   <?php echo $firstnameErr;?>
   Last Name: <span class="error">* </span> <input type="text" name="lastname" value="<?php echo $lastname;?>">
   <?php echo $lastnameErr;?></span>
   Contact No:  <span class="error">* </span> <input type="text" name="contactno" value="<?php echo $contactno;?>">
   <?php echo $ageErr;?></span>
   <br><br>Comments: <textarea name="comment" rows="2" cols="60"><?php echo $comment;?></textarea>
   <br><br>
   <input type="submit" name="Update" value="Update">
</form>



</body>

</html>
