<?php
setlocale(LC_MONETARY, 'en_US');
require 'database.php';
if (!$conn) {
	die('Could not connect to MySQL: ' . mysqli_connect_error());
}
$SURL = $_SERVER["SERVER_NAME"];
$RURL = $_SERVER["REQUEST_URI"];
$page = "http://$SURL$RURL";
$store = $_COOKIE['setstore'];
$q = $_REQUEST["q"];
$len = strlen($q);
$hint = "";
$sep = "--------";
if ($len > 2) {
	$q = strtoupper($q);
	//$ref = 'http://wo.coxinterior.com/pricecheck/showdetail.php?sku=';
	//$ref = "$SURL/pricecheck/showdetail.php?sku=";
	$ref = "http://$SURL/pricecheck/showdetail.php?sku=";
	$select = "SELECT * FROM  `parts` WHERE  `SKU` LIKE  '$q%' AND `Store` = '1'";

	$result = mysqli_query($conn, $select);
	//$end_time = microtime();
	$rowcount = mysqli_num_rows($result);
	$hint = 'SKU'. $sep . '$KY' . $sep . '$OOS<BR>' . "\n";
	while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
		$hint .= "<a href='$ref" . $row['SKU'] . "&store=$store'>" . $row['SKU'] . "</a>" . $sep . '$' . number_format($row['Price1'], 2, ".", ",") .
		$sep . '$' . number_format($row['Price5'], 2, ".", ",") . "<BR>\n";
	}
	//$hint = "$rowcount results found!\n";

	
} else {
	
}
echo $hint === "" ? "no suggestion" : $hint;
exit();
