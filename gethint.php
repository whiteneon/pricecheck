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
$price = $_COOKIE['prices'][0];
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
	//$hint = 'SKU'. $sep . '$KY' . $sep . '$OOS<BR>' . "\n";
	$hint = 'SKU' . $sep;
	switch($price) {
		case "1":
			$hint .= '$KY' . "<BR>\n";
			break;
		case "2":
			$hint .= '$DEALER' . "<BR>\n";
			break;
		case "3":
			$hint .= '$PA' . "<BR>\n";
			break;
		case "5":
			$hint .= '$OOS' . "<BR>\n";
			break;
	}
	/* Old Method statically showing KY and OOS hints
	while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
		$hint .= "<a href='$ref" . $row['SKU'] . "&store=$store'>" . $row['SKU'] . "</a>" . $sep . '$' . number_format($row['Price1'], 2, ".", ",") .
		$sep . '$' . number_format($row['Price5'], 2, ".", ",") . "<BR>\n";
	}
	*/
	while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
		$hint .= "<a href='$ref" . $row['SKU'] . "&store=$store'>" . $row['SKU'] . "</a>" . $sep . '$';
		switch ($price) {
			case "1":
				$hint .= number_format($row['Price1'], 2, ".", ",");
				break;
			case "2":
				$hint .= number_format($row['Price2'], 2, ".", ",");
				break;
			case "3":
				$hint .= number_format($row['Price3'], 2, ".", ",");
				break;
			case "5":
				$hint .= number_format($row['Price5'], 2, ".", ",");
				break;
		}
		$hint .= "<BR>\n";
	}
	//$hint = "$rowcount results found!\n";

	
} else {
	
}
echo $hint === "" ? "no suggestion" : $hint;
exit();
