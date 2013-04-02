<!DOCTYPE html>
<html>
<head>
<title>Eine Umfrage</title>
<link href="script.js" type="text/javascript" />
</head>
<body>
<form name="umfrage" action="#" method="post">
<?php
include_once ('functions.php');
fragen();
?>
<input type="reset" value="Zur&uuml;cksetzen" /> <input type="submit" value="Senden" onClick="check()">
</form>
</body>
</html>