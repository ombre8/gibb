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
	$datei = fopen("antworten.txt", 'a');
	foreach ($_POST as $antwort){
		$antworten .= $antwort;
		$antworten .= '§';
	}
	$antworten .= PHP_EOL;
	$f=file_put_content($datei,$antworten);
	fclose($datei);
}

function antworten(){
  
}


function title()
{
	//Einlesen der Fragen:
  $fragen = fopen("fragen.txt", 'r');
  
  //Variable Zeilennummer:
	  $zeilenNr = 1;
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