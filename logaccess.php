<?php
//This file logs all attempted logins and is included in the loginnew.php file
$log = mysqli_connect('localhost', 'workorder', 'workorder', 'workorder', '3306');

//Check username and password
if (!$log) {
	die('Could not connect to MySQL: ' . mysqli_connect_error());
}
//echo "<!-- connected ok -->";
$logaccessselect = "INSERT INTO  `workorder`.`access` (`time` ,`username` ,`sku`, `store`) VALUES (CURRENT_TIMESTAMP ,  '$un',  '$sku', '$store')";
if (mysqli_query($log, $logaccessselect)) {
	//echo "New record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($log);
}
$logcount = mysqli_num_rows($result);
echo "<!-- $logcount -->";
mysqli_close($log);
?>