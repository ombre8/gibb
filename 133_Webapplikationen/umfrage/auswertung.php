<!DOCTYPE html>
<html>
<head>
<title>Eine Umfrage</title>
</head>
<body>
<?php
//Einlesen der Fragen:
$fragen = fopen("fragen.txt", 'r');

//Variable Zeilennummer:
	$zeilenNr = 1;
//Umfrage generieren
while (!feof($fragen)){
	$zeile = fgets($fragen, 999);
	//Formular Block
	for ($i = 1; $i <= 6; $i++){
		$form .= '<input type="radio" name="'.$zeilenNr.'" value="'.$i.'" />'.$i;
		switch ($i){
			case 1:
			$form .= ' - Schlecht <br />';
			break;
			case 6:
			$form .= ' - Super <br />';
			break;
			default:
			$form .= '<br />';
		}
	}
	// Format:
	// h1
	if (substr($zeile,0,1) == "*"){
		$output = "<h1>";
		$output .= substr($zeile,2);
		$output .= "</h1>";	
	}	
	// h2
	else if (substr($zeile,0,1) == "!"){
		$output = "<h2>";
		$output .= substr($zeile,2);
		$output .= "</h2>";
	}
	// Abschnitt
	else if (substr($zeile,0,1) == "/"){
		$output = "<p>";
		$output .= substr($zeile,2);
		$output .= "</p>";	
	}
	// Kommentar
	else if (substr($zeile,0,1) == "\\"){
		$output = "";
	}
	else if (substr($zeile,0,1) == "@"){
		if (strpos('asswor',$zeile) == true){ //check ain't working yet
			$output = substr($zeile,2);
			$output .= ' <input type="password" name="password" /><br />'; //ToDo: change Name to substr
		}
		else if (strpos('mail',$zeile) == true){
			$output = substr($zeile,2);
			$output .= ' <input type="email" name="email" /><br />'; //ToDo: change Name to substr
		}
		else {
			$output = substr($zeile,2);
			$output .= ' <input type="text" name="name" /><br />'; //ToDo: change Name to substr
		}
	}
	// Frage
	else {
		$output = "<p>";
		$output .= $zeile;
		$output .= "<br>";
		$output .= $form;
		$output .= "</p>";			
	}
	//ausgeben
	echo $output;
	
	//Variabeln aktuallisieren
	$form = "";
	$zeilenNr += 1;
}

//Datei schliessen
fclose($fragen);
?>
</body>
</html>