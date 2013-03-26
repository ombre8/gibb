<!DOCTYPE html>
<html>
<head>
<title>Eine Umfrage</title>
</head>
<body>
<h1>Dies ist eine Umfrage f&uml;r das Modul 133 an der GIBB</h1>
<form action="magic.php" method="post">
<!-- hier Formular typen eintragen -->
<p>Benutzername: <input type="text" name="text"></p>
<p>Passwort: <input type="password" name="pwd"></p>
<p>Example Radio Buttons: <br />
<input type="radio" name="realy" value="yes"> Yarp <br />
<input type="radio" name="realy" value="no"> Nope <br />
</p>
<p>Example Checkboxes<br />
<input type="checkbox" name="usage" value="Ubuntu">Ubuntu<br />
<input type="checkbox" name="usage" value="Fedora">Fedora<br />
</p>
<p>Example Textarea: <br />
<textarea name="textarea" cols="50" rows="10">Hier kann ein Beispiel stehen, muss aber nicht...</textarea>
</p>
<p>Example Selection:
<select name="auswahl" size="2">
  <option value="bier">Beer</option>
  <option>Vodka</option>
  <option>Whiskey</option>
</select>
</p>
<p>Example Upload:  <input name="Datei" type="file" size="50" maxlength="100000" accept="text/*"> </p>
<p>Example hidden: <input type="hidden" name="hidden" value="Mich sieht man nicht, aber ich bin trotzdem da!"></p>
<input type="reset" value="Zurücksetzen"> <input type="submit" value="Senden">
</form>
</body>
</html>