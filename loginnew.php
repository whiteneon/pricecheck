<?php 
require("database.php");
$authfail = 0;
if (isset($_REQUEST['username'])) {
	$un = $_REQUEST['username'];
	$pw = $_REQUEST['password'];
	$md5pw = md5($pw);
	echo "<!-- $un -->\n";
	if ($un == "logout") {
		setcookie('loggedin','',1);
		setcookie('prices','',1);
		echo "<!-- Logged Out-->";
		?>
		
		<HTML><HEAD>
		<style>
			h1 {
    			text-align: center;
			}
		</style>
		<TITLE>Cox Interior Login Page</TITLE></HEAD><BODY>
		<h1><img src="cox_small.jpg"></h1><BR>Logged out successfully<BR><?php //echo getcwd(); ?>
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
	echo "<!-- rowcount=$rowcount -->";
	if ($rowcount == 0) {
		//Username not found in DB
		$myfile = fopen(getcwd() . "/logins.txt", "a");
		fwrite($myfile, date(DATE_ATOM) . ",$un,FAILED,$pw\n");
		fclose($myfile);
		$authfail = 1;
	}
	while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
		$dbun = $row['username'];
		$dbpw = $row['password'];
		$dbprice = $row['prices'];
		$dbname = $row['name'];
		//echo "<!-- pw    = $md5pw -->\n";
		//echo "<!-- pw    = 098f6bcd4621d373cade4e832627b4f6 -->\n";
		//echo "<!-- $dbpw = $dbpw -->\n";
		if ($dbpw == $md5pw) {
			$setstores = $row['stores'];
			setcookie('loggedin', $setstores, strtotime( '+90 days'));
			setcookie('name', $dbname, strtotime( '+90 days'));
			setcookie('prices', $dbprice,strtotime( '+90 days'));
			header("Location: /pricecheck/index.php");
			$myfile = fopen(getcwd() . "/logins.txt", "a");
			fwrite($myfile, date(DATE_ATOM) . ",$dbun,PASSED,CorrectPassword\n");
			fclose($myfile);
			die();
		} else {
			$myfile = fopen(getcwd() . "/logins.txt", "a");
			fwrite($myfile, date(DATE_ATOM) . ",$dbun,FAILED,$pw\n");
			fclose($myfile);
			$authfail = 1;
		}
	}

}
?>

<HTML><HEAD>
<style>
	h1 {
		text-align: center;
	}
</style><TITLE>Cox Interior Login Page</TITLE></HEAD><BODY>
<h1><img src="cox_small.jpg"></h1>
<?php 
if ($authfail == 1) { echo "Incorrect username/password<BR>\n"; }
?>
<form action="loginnew.php" method="post">
Username: <input type="text" name="username"><BR>
Password: <input type="password" name="password"><BR>

<input type="submit">
</form>
</BODY></HTML>
<?php

?>




