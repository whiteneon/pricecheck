<?php
//This file logs all attempted logins and is included in the loginnew.php file
$logconn = mysqli_connect('localhost', 'workorder', 'workorder', 'workorder', '3306');

//Check username and password
if (!$logconn) {
	die('Could not connect to MySQL: ' . mysqli_connect_error());
}

//$select = "SELECT `username`, MD5(`password`), `name`, `email`, `stores` FROM  `users` WHERE  `username` LIKE  'gbell'";
if ($authfail == 1) {
	$auth = 0;
} else {
	$auth = 1;
}
$select = "INSERT INTO  `workorder`.`logins` (`time` ,`username` ,`result`) VALUES (CURRENT_TIMESTAMP ,  '$un',  '$auth')";

if (mysqli_query($logconn, $select)) {
	//echo "New record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
//$rowcount = mysqli_num_rows($result);
mysqli_close($logconn);
?>