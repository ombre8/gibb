<?php
function fragen(){
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
		   $output = substr($zeile,2);
		   if (preg_match("/^[P|p]{1}asswor[d|t]{1}$/",substr($zeile,2,-2))){
			   $type = 'password';
		   }
		   else if (preg_match("/^[E|e]*[-]*[M|m]ail$/",substr($zeile,2,-2))){
			   $type = 'email';
		   }
		   else
		   {
			   $type = 'text';
		   }
		   $output .= ' <input type="'.$type.'" name="'.substr($zeile,2,-2).'" /><br />'; 
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
}

function speichern(){
	$antworten .= "\r\n";
	foreach ($_POST as $key => $value){
		$antworten .= $value."§";
	}
	//$datei = fopen("antworten.txt", 'a');
	//fwrite ($datei, $antworten);
	//fclose($datei);
	file_put_contents("antworten.txt", $antworten, FILE_APPEND);
}

function antworten(){
	$lines = file("antworten.txt");
//	$datei = fopen("antworten.txt", 'rb') or die("could not openfile");
	$i = 1;
//	while (!feof($datei)){ //feof fliegt auf die Fresse! scheisse mann
//	for ($i=0;$i<13; $i++){	
	//	$linie = fgets(datei);
	//	echo $linie;
	//	$antwort = explode("§",$linie);
	//	$answers[$i] = $antwort;
		//$i += 1;
	//	var_dump($answers);
	//}
//	$answers = explode("§",$lines);
	foreach ($lines as $line){
	//	echo $line;
		$antwort = explode("§",$line, -1);
		$answers[$i] = $antwort;
		$i += 1;
	//	var_dump($answers);
	}
	return $answers;
	//var_dump($answers);
}

function avg(){
	antworten();
	//länge bestimmen
	//
	$anzFragen = 0;
	$anzAntworten = 0;
	for ($i=$anzFragen; $i>0; $i--){
		for ($j=$anzAntworten; $j>0; $j--){
			$avg[$i] += $answers[$i][$j];
		}
		$avg[i] = $avg[i] / $anzAntworten;
	}	
	return $avg;
}

function output(){
	$answers = antworten();
	//var_dump($answers);
  //Einlesen der Fragen:
  $fragen = fopen("fragen.txt", 'r') or die("could not open file");
    //Variable Zeilennummer:
	  $zeilenNr = 0;
	  $last = count($answers);
	  // echo $last;
	  var_dump($answers[$last]);
  //Umfrage generieren
  while (!feof($fragen)){
	  $zeile = fgets($fragen, 999);
	 	//$form .= $answer[$i];
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
			 $output = substr($zeile,2);
			 if (preg_match("/^[P|p]{1}asswor[d|t]{1}$/",substr($zeile,2,-2))){
				 $type = 'password';
			 }
			 else if (preg_match("/^[E|e]*[-]*[M|m]ail$/",substr($zeile,2,-2))){
				 $type = 'email';
			 }
			 else
			 {
				 $type = 'text';
			 }
			 $output .= $answers[$last][$zeilenNr]; 
			 $zeilenNr += 1;
			  
		 }
		// Frage
		else {
			$output = "<p>";
			$output .= $zeile;
			$output .= "<br>";
			$output .= $answers[$last][$zeilenNr];
			$output .= "</p>";		
            $zeilenNr += 1;	
		}
	  	$i += 1;
	  //ausgeben
	  echo $output;
	  
	  //Variabeln aktuallisieren
	  $form = "";
  }
  //Datei schliessen
  fclose($fragen);
}


function title()
{
	//Einlesen der Fragen:
  $fragen = fopen("fragen.txt", 'r');
  
  //Umfrage generieren
  while (!feof($fragen)){
	  $zeile = fgets($fragen, 999);
		 if (substr($zeile,0,1) == "*"){
		  $title = substr($zeile,2);
		 }	
  }
  echo $title;
}
?>
