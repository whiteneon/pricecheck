<?php
setlocale(LC_MONETARY, 'en_US');
require 'database.php';
if (!$conn) {
	die('Could not connect to MySQL: ' . mysqli_connect_error());
}
$q = $_REQUEST["q"];
$len = strlen($q);
$hint = "";
$sep = "--------";
if ($len > 2) {
	$q = strtoupper($q);
	

	$select = "SELECT * FROM  `parts` WHERE  `SKU` LIKE  '$q%' AND `Store` = '1'";

	$result = mysqli_query($conn, $select);
	//$end_time = microtime();
	$rowcount = mysqli_num_rows($result);
	$hint = 'SKU'. $sep . '$KY' . $sep . '$OOS<BR>' . "\n";
	while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
		$hint .= $row['SKU'] . $sep . '$' . number_format($row['Price1'], 2, ".", ",") .
		$sep . '$' . number_format($row['Price5'], 2, ".", ",") . "<BR>\n";
	}
	//$hint = "$rowcount results found!\n";

	
} else {
	
}
echo $hint === "" ? "no suggestion" : $hint;
exit();

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "no suggestion" : $hint;
?>