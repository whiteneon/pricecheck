<?php
//Check for login info
if(!isset($_COOKIE['loggedin'])) {
	//Cookie is not set, redirect to login page.
	echo "<!-- Not logged in -->";
	include 'loginnew.php';
	die();
} else {
	echo "<!-- Logged in -->";
	$pricematrix = $_COOKIE['prices'][0];
	$name = $_COOKIE['name'];
}

$cookie_name = "setstore";
if(!isset($_COOKIE[$cookie_name])) {
	//Cookie is not set, set inital cookie value
	$cookie_value = "1";
	setcookie($cookie_name, $cookie_value,strtotime( '+120 days' ));
	$store = 1;
} else {
	$store = $_COOKIE[$cookie_name];
}
?><!DOCTYPE html>
<html>
<head>
<script>
function showHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "gethintdesc.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>
<!-- <?php echo "cookie store is set to: $store"; ?> -->
<a href="/pricecheck/"><img src="cox_small.jpg"></a>
<p><b><?php echo $name; ?>, Start typing a Description below, <BR>
press enter if you want details on a full SKU:</b></p>
<form action="showdetail.php"> 
Description: <input type="text" name="sku" autocomplete="off" onkeyup="showHint(this.value)">
<input type="hidden" name="store" value="<?php echo $store; ?>">
<input type="submit" value="Submit">
</form>
<form action="loginnew.php" method="post"><input type="submit" value="Logout">
<input type="hidden" name="username" value="logout"></form><BR>
<p>Suggestions: <BR><span id="txtHint"></span></p>
</body>
</html>