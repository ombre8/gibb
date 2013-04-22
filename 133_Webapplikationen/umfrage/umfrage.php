<!DOCTYPE html>
<html>
<head>
<link href="script.js" type="text/javascript" />
<?php include_once ('functions.php'); ?>
<title><?php title() ?></title>
<meta charset="utf-8">
</head>
<body>
<form name="umfrage" action="auswertung.php" method="post">
<?php
fragen();
?>
<input type="reset" value="Zur&uuml;cksetzen" /> <input type="submit" value="Senden" onClick="check()">
</form>
</body>
</html>