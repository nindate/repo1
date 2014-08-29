<?php

$myfile = fopen("config.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  $entry=fgets($myfile);
  echo $entry . "<br>";
}
fclose($myfile);



?>
