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
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>
<!-- 
<?php 
echo "cookie store is set to: $store\n";
?>
 -->
<img src="cox_small.jpg">
<p><b><?php echo $name; ?>, Start typing a SKU below, <BR>
press enter if you want details on a full SKU:</b></p>
<form action="showdetail.php"> 
SKU: <input type="text" name="sku" autocomplete="off" onkeyup="showHint(this.value)">
<input type="hidden" name="store" value="<?php echo $store; ?>">
<input type="submit" value="Submit">
</form>
<form action="loginnew.php" method="post"><input type="submit" value="Logout">
<input type="hidden" name="username" value="logout"></form><BR>
<form action="indexdesc.php" method="post"><input type="submit" value="Search by Description"></form>
<p>Suggestions: <BR><span id="txtHint"></span></p>
</body>
</html>