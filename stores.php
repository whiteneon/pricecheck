<?php 
$SURL = $_SERVER["SERVER_NAME"];
$RURL = $_SERVER["REQUEST_URI"];
$SELF  = $_SERVER["PHP_SELF"];
$page = "http://$SURL$RURL"; 
$cookie_name = "setstore";
setcookie($cookie_name, $_REQUEST["store"]);
?>
<!-- <?php echo "\n<BR>". $SELF . "\n<BR>http://" . $SURL . $RURL . "\n<BR>"; ?> -->
Change Store: 
<select name="selectstore" onchange="changeStore(this.value)">
	<option value="-" selected>-</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	<option value="9">9</option>
	<option value="A">A</option>
	<option value="D">D</option>
	<option value="E">E</option>
	<option value="J">J</option>
	<option value="L">L</option>
	<option value="M">M</option>
	<option value="R">R</option>
	<option value="U">U</option>
</select>
<script>
function changeStore(val) {
	location.href="http://<?php echo $SURL . $SELF; ?>?sku=<?php echo $sku; ?>&store=" + val;
	//location.href="http://whiteneon.com/pricecheck/showdetail.php?sku=<?php echo $sku; ?>&store=" + val;
    //alert("The input value has changed. The new value is: " + val);
}
</script>
<BR>