<!DOCTYPE html>
<html>
<head>
<link href="script.js" type="text/javascript" />
<?php include_once ('functions.php'); ?>
<title><?php title() ?></title>
</head>
<body>
<form name="umfrage" action="#" method="post">
<?php
fragen();
?>
<input type="reset" value="Zur&uuml;cksetzen" /> <input type="submit" value="Senden" onClick="check()">
</form>
</body>
</html>