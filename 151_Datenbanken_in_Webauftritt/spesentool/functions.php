<?php

// Database Stuff

function dbConnect(){
	// get db-credentials
	require_once('dbconnection/connection.php');
	// Create connection
	$con=mysqli_connect($dbHost,$dbUsername,$dbPassword,$dbName);

	// Check connection
	if (mysqli_connect_errno($con))
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	return $con;
};

function queryDb($con, $query)
{
	return mysqli_query($con,$query);
}

// Close DB
function closeDb($con)
{
	mysqli_close($con);

}

// Action stuff

function chooseAction(){
	if (isset($_POST['action'])){
		$action = $_POST['action'];
	}
	else if (isset($_GET['site'])){
		$action = $_GET['site'];
	}
	else {
		$action = 'table';
	}
	switch($action)
	{
		
		case "table":
			head();
			table();
			footer();
			break;
		case "add":
			head();
			add();
			footer();
			break;
		case "postForm":
			head();
			save();
			footer();
			break;
		default:
			//should never happen
	}
}

// display / html Stuff
function head(){
	echo '<!DOCTYPE html>
			<html>
			<head>
			<title>Spesentool</title>
			<link rel="stylesheet" type="text/css" href="style.css" />
			<script type="text/javascript" src="script.js"></script>
			</head>
			<body>
			<h1>Spesentool</h1>
			<ul id="nav"><li><a href="?">&Uuml;bersicht</a></li><li><a href="?site=add">neuer Eintrag</a></li></ul>';
}

function footer(){
	echo "</body>
			</html>";
}

// funny Stuff

function table(){
	$con = dbConnect();
	$query = "SELECT * FROM gibb_spesen";
	$table=queryDb($con, $query);
	echo "<p>&Uuml;bersicht &uuml;ber alle Speseninformationen</p>
	<table>
		<tr>
			<td>Nummer</td>
			<td>Mitarbeiter</td>
			<td>Art</td>
			<td>Betrag</td>
			<td>W&auml;hrungskurs</td>
			<td>Datum Abrechnung</td>
			<td>Datum Genehmigung</td>
			<td>Genehmigt Durch</td>
			<td>Datum Auszahlung</td>
		</tr>";
	while ($row = mysqli_fetch_array($table)){
		$query = "SELECT * FROM gibb_mitarbeiter WHERE Id =". $query['id'];
		$mitarbeiter = queryDb($con, $query);
		$mitarbeiterName = $mitarbeiter['Vorname'] . " " . $mitarbeiter['Name'];
		echo "<tr><td>".$mitarbeiterName."</td>
		<td>".$query['mitarbeiterId']."</td>
		<td>".$query['spesenArt']."</td>
		<td>".$query['betrag']."</td>
		<td>".$query['waehrungskurs']."</td>
		<td>".$query['datumAbrechnung']."</td>
		<td>".$query['datumGenehmigung']."</td>
		<td>".$query['genehmigtDurch']."</td>
		<td>".$query['datumAuszahlung']."</td>
		</tr>";
	}
	echo "</table>";
}

function add(){
	$con = dbConnect();
	$query = "SELECT * FROM gibb_mitarbeiter";
	$mitarbeiter=queryDb($con, $query);
	$query2 = "SELECT * FROM gibb_spesenart";
	$spesenart = queryDb($con, $query2);
	echo '<form action="?" method="post" enctype="multipart/form-data">
	<p>Mitarbeiter: <select name="mitarbeiterId">';
	while ($row = mysqli_fetch_array($mitarbeiter)){
		echo "<option value'".$row['mitarbeiterId']."'>".$row['Name']." ".$row['Vorname']."</option>";
	};
	echo '</select></p>
	<p>Spesenart: <select name="spesenArt">';
	while ($row = mysqli_fetch_array($spesenart)){
		echo "<option value='".$row['id']."'>".$row['text']."</option>";
	};
	echo "</select></p>
	<p>Betrag: <input type='text' name='betrag' />
	<select name='waehrung' onchange='wechselkurs()'>";
	$XMLContent=file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
	foreach($XMLContent as $line){
		if(preg_match("/currency='([[:alpha:]]+)'/",$line,$currencyCode)){
			if(preg_match("/rate='([[:graph:]]+)'/",$line,$rate)){
				echo "<option value'".$currencyCode[1]."'>".$currencyCode[1]."</option>";
			}
		}
	};
	echo "</select>	</p>
	<p>W&auml;hrungkurs: <input type='text' value='1' name='waehrungskurs' disabled />Javascript übergabe des Kurs via Währung!!!</p> 
	<p>Datum:";
	DateDropDown(90, "DropDate");
	echo" </p>
	";
	echo '<input type="hidden" name="action" id="action" value="postForm">
	<input type="reset" value="Reset"> <input type="submit" value="Send">
	</form>';
}

function save(){
	var_dump($_POST);
	$mitarbeiterName = explode(" ", $_POST['mitarbeiterId']);
	$con = dbConnect();
	$query = "SELECT id FROM gibb_mitarbeiter WHERE Name='".$mitarbeiterName[0]."' AND Vorname='".$mitarbeiterName[1]."'";
	$mitarbeiterId=queryDb($con, $query);
	$mitarbeiterId=mysqli_stmt_fetch($mitarbeiterId);
	$spesenArt=$_POST["spesenArt"];
	$betrag=$_POST["betrag"];
	//$betrag=$betrag * $_POST["waehrungskurs"];
	$datumAbrechnung=$_POST['dropdate'];
	$datumAbrechnung=strtotime($datumAbrechnung);
	echo $mitarbeiterId." ".$spesenArt." ".$betrag." ".$datumAbrechnung;
}

function getCurrency(){
	// code from http://www.ecb.int/stats/exchange/eurofxref/html/index.en.html
	$XMLContent=file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
	foreach($XMLContent as $line){
		if(preg_match("/currency='([[:alpha:]]+)'/",$line,$currencyCode)){
			if(preg_match("/rate='([[:graph:]]+)'/",$line,$rate)){
				//Output the value of 1EUR for a currency code
				//echo'1&euro;='.$rate[1].' '.$currencyCode[1].'<br/>';
				//--------------------------------------------------
				//Here you can add your code for inserting
				//$rate[1] and $currencyCode[1] into your database
				//--------------------------------------------------
				//$currency[$i][$i] .= array($currencyCode[1],$rate[1]);
			}
		}
	}
}

function DateDropDown($size=90,$default="DropDate") {
   // $size = the number of days to display in the drop down
   // $default = Todays date in m:d:Y format (SEE DATE COMMAND ON WWW.PHP.NET)
   // $skip = if set then the program will skip Sundays and Saturdays
   $skip=0;
   echo "<select name=dropdate STYLE=\"font-family: monospace;\">\n";
   for ($i = 0; $i <= $size; $i++) {
      $theday = mktime (0,0,0,date("m") ,date("d")+$i ,date("Y"));
      $option=date("D M j, Y",$theday);
      $value=date("m:d:Y",$theday);
      $dow=date("D",$theday);
      if ($dow=="Mon") {
         echo "<option disabled>&nbsp;</option>\n";
      }
      if ($value == $default) {
         $selected="SELECTED";
      } else {
         $selected="";
      }
      if (($dow!="Sun" and $dow!="Sat") or !$skip) {
         echo "<option value=\"$value\" $selected>$option</option>\n";
      }
   }
   echo "</select>\n";
}

?>