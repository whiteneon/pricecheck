<?php 
require("database.php");

if (isset($_REQUEST['username'])) {
	$un = $_REQUEST['username'];
	$pw = $_REQUEST['password'];
	$md5pw = md5($pw);
	echo "<!-- $un -->\n";
	if ($un == "logout") {
		setcookie('loggedin','',1);
		echo "<!-- Logged Out-->";
		?>
		
		<HTML><HEAD>
		<style>
			h1 {
    			text-align: center;
			}
		</style>
		<TITLE>Cox Interior Login Page</TITLE></HEAD><BODY>
		<h1><img src="cox_small.jpg"></h1>
		<form action="loginnew.php" method="post">
		Username: <input type="text" name="username"><BR>
		Password: <input type="password" name="password"><BR>
		
		<input type="submit">
		</form>
		<?php
		die();
		
	}
	//Check username and password
	if (!$conn) {
		die('Could not connect to MySQL: ' . mysqli_connect_error());
	}
	//$select = "SELECT `username`, MD5(`password`), `name`, `email`, `stores` FROM  `users` WHERE  `username` LIKE  'gbell'";
	$select = "SELECT * FROM  `users` WHERE  `username` LIKE  '$un'";
	$result = mysqli_query($conn, $select);
	$rowcount = mysqli_num_rows($result);
	while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
		$dbun = $row['username'];
		$dbpw = $row['password'];
		$dbname = $row['name'];
		//echo "<!-- pw    = $md5pw -->\n";
		//echo "<!-- pw    = 098f6bcd4621d373cade4e832627b4f6 -->\n";
		//echo "<!-- $dbpw = $dbpw -->\n";
		if ($dbpw == $md5pw) {
			$setstores = $row['stores'];
			setcookie('loggedin', $setstores, strtotime( '+90 days'));
			setcookie('name', $dbname, strtotime( '+90 days'));
			header("Location: /pricecheck/index.php");
			die();
		}		
	}
	$auth = 0;

}
?>

<HTML><HEAD>
<style>
	h1 {
		text-align: center;
	}
</style><TITLE>Cox Interior Login Page</TITLE></HEAD><BODY>
<h1><img src="cox_small.jpg"></h1>
<form action="loginnew.php" method="post">
Username: <input type="text" name="username"><BR>
Password: <input type="password" name="password"><BR>

<input type="submit">
</form>
</BODY></HTML>
<?php

?>




