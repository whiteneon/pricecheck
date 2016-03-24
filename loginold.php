<?php 

if (isset($_REQUEST['username'])) {
	$un = $_REQUEST['username'];
	$pw = $_REQUEST['password'];
	echo "<!-- username present -->";
	//Check username and password
	$auth = 0;
	switch($un) {
		case "gbell":
			if ($pw == 'lexmark') {
				setcookie('loggedin', '125',strtotime( '+90 days' ));
				setcookie('name', 'Gary',strtotime( '+90 days' ));
				header("Location: /pricecheck/index.php");
				die();
			}
		case "clif":
			if ($pw == 'maggie') {
				setcookie('loggedin', '1',strtotime( '+90 days' ));
				setcookie('name', 'Clif',strtotime( '+90 days' ));
				header("Location: /pricecheck/index.php");
				die();
			}
		case "casey":
				if ($pw == 'android') {
					setcookie('loggedin', '125',strtotime( '+90 days' ));
					setcookie('name', 'Casey',strtotime( '+90 days' ));
					header("Location: /pricecheck/index.php");
					die();
				}
		case "logout":
			setcookie('loggedin','',1);
			break;
		default:
			echo "Incorrect username/password<BR>\n";
			$auth = 0;
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
<form action="login.php" method="post">
Username: <input type="text" name="username"><BR>
Password: <input type="password" name="password"><BR>

<input type="submit">
</form>
<?php

?>



</BODY></HTML>
