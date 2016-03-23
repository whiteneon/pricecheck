<?php
//loggedin cookie is set to a numeral 1-5 to indicate which price matrix to show.
if(!isset($_COOKIE['loggedin'])) {
	//Cookie is not set, redirect to login page.
	echo "<!-- Not logged in -->";
	include 'login.php';
	die();
} else {
	echo "<!-- Logged in -->";
	$pricematrix = $_COOKIE['loggedin'];
	$name = $_COOKIE['name'];
}
setlocale(LC_MONETARY, 'en_US');
require("database.php");
if (!$conn) {
	die('Could not connect to MySQL: ' . mysqli_connect_error());
}
$sku = $_REQUEST["sku"];
$store = $_REQUEST["store"];
include "storename.php";
$len = strlen($sku);
$hint = "";
$sep = "---";
if ($len > 2) {
	$sku = strtoupper($sku);
	

	$select = "SELECT * FROM  `parts` WHERE  `SKU` LIKE  '$sku' AND `Store` = '$store'";

	$result = mysqli_query($conn, $select);
	//$end_time = microtime();
	$rowcount = mysqli_num_rows($result);
	//$hint = 'SKU'. $sep . 'Desc' . $sep . 'Dept' . $sep . '$KY' . $sep . '$OOS<BR>' . "\n";
	while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
		?><html><head><title>Cox Interior SKU Info</title></head><body><a href="/pricecheck/"
		><img src="cox_small.jpg"></a><BR><?php
		//$hint .= $row['SKU'] . $sep . $row['Description'] . $sep . 
		//$row['Dept'] . $sep . '$' . number_format($row['Price1'], 2, ".", ",") .
		//$sep . '$' . number_format($row['Price5'], 2, ".", ",") . "<BR>\n";
		$hint = '<font color="purple">Store: ' . $row['Store'] . ' - ' . $storename . '</font><BR>';
		$hint .= '<font color="red">' . $row['SKU'] . '</font>' . "<BR>\n" . $row['Description'] . "<BR>\n" ;
		$hint .= "Dept:" . $row['Dept'] . "<BR>\n";
		if (strpos($pricematrix, '1') !== false) {
			$hint .= "KY " . '$' . number_format($row['Price1'], 2, ".", ",") . "<BR>\n";
		}
		if (strpos($pricematrix, '2') !== false) {
			$hint .= "Dealer " . '$' . number_format($row['Price2'], 2, ".", ",") . "<BR>\n";
		}
		if (strpos($pricematrix, '5') !== false) {
			$hint .= "OOS " . '$' . number_format($row['Price5'], 2, ".", ",") . "<BR>\n";
		}
		$hint .= "Qty Avail." . $row['QtyAvail'] . "<BR>";
		$hint .= "Avg Mnthly Sales: " . $row['SalesAvg'] . "<BR>";
		include 'stores.php';
		?></body></html><?php
	}
	//$hint = "$rowcount results found!\n";

	
} else {
	
}
echo $hint === "" ? "Invalid SKU" : $hint;

?>