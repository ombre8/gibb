<!DOCTYPE html>
<html>
<head>
<title>Project &pi;nux -- Konfiguration -- Output</title>
</head>
<body>
<h1>Auswertugn des Test Formular aka Hello World aka let's fetz a Preseed</h1>
<!-- hier Formular typen eintragen -->
<p>Example Text: <?php echo $_POST['text']; ?></p>
<p>Example Passwort: <?php echo $_POST['pwd']; ?></p>
<p>Example Radio Buttons: <br />
<?php echo $_POST['realy']; ?>
</p>
<p>Example Checkboxes<br />
<?php $checkbox = $_POST['usage'];
      $result = implode(', ', $checkbox);
      echo $result; ?>
</p>
<p>Example Textarea: <br />
<?php echo $_POST['textarea']; ?>
</p>
<p>Example Selection:
<?php $selection = $_POST['auswahl'];
      $result = implode(', ', $selection);
      echo $result; ?>
</p>
<p>Example Upload: 
<?php
if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
  }
else
  {
  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  echo "Type: " . $_FILES["file"]["type"] . "<br>";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["file"]["tmp_name"];
  }
  $allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 20000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      }
    }
  }
else
  {
  echo "Invalid file";
  }
?>
</p>
<p>Example hidden: <?php echo $_POST['hidden']; ?></p>
</body>
</html>