<?php


?>
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

<p><b>Start typing a SKU below, press enter if you want details on a full SKU:</b></p>
<form action="showdetail.php"> 
SKU: <input type="text" name="sku" onkeyup="showHint(this.value)">
<input type="submit" value="Submit">
</form>
<p>Suggestions: <BR><span id="txtHint"></span></p>
</body>
</html>