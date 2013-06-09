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
			table();
			footer();
			break;
		case "updateForm":
			head();
			update();
			table();
			footer();
			break;
		case "ok":
			head();
			ok();
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
	if(isset($_GET['mitarbeiterId'])){ $filterMitarbeiter = $_GET['mitarbeiterId'];}
	if(isset($_GET['datumAbrechnung'])){ $filterDatum = $_GET['datumAbrechnung']; }
	if (isset ($filterMitarbeiter))
		$filter = "WHERE mitarbeiterId=".$filterMitarbeiter;
	if (isset($filterMitarbeiter) && isset($filterDatum))
		$filter .= "AND datumAbrechnung=".$filterDatum;
	else if (isset ($filterDatum))
		$filter = "WHERE datumAbrechnung=".$filterDatum;
	if (!(isset($filter))) $filter = "";
	if (isset($_GET['order'])){
		if(in_array($_GET['order'], array("id", "mitarbeiterId", "spesenArt", "betrag", "waehrungskurs", "datumAbrechnung", "datumGenehmigung", "genehmigtDurch", "datumAuszahlung")))
		$order = $_GET['order'];}
	else
		$order = 'id';
	if(isset($_GET['order2'])){
		if($_GET['order2'] == false || $_GET['order2'] == 'ASC'){
			$order_2 = 'DESC';
		}
		else{
			$order_2 = 'ASC';
		}
	}
	else $order_2 = 'ASC';
	$con = dbConnect();
	$query = "SELECT * FROM gibb_spesen ".$filter." ORDER BY ".$order.' '.$order_2;
	$table=queryDb($con, $query);
	echo "<p>&Uuml;bersicht &uuml;ber alle Speseninformationen</p>
	<table width='100%'>
		<tr>
			<td><a href='?order=id&order2=".$order_2."'>Nummer</a></td>
			<td><a href='?order=mitarbeiterId&order2=".$order_2."'>Mitarbeiter</a></td>
			<td><a href='?order=spesenArt&order2=".$order_2."'>Art</a></td>
			<td><a href='?order=betrag&order2=".$order_2."'>Betrag</a></td>
			<td><a href='?order=waehrungskurs&order2=".$order_2."'>W&auml;hrungskurs</a></td>
			<td><a href='?order=datumAbrechnung&order2=".$order_2."'>Datum Abrechnung</a></td>
			<td><a href='?order=datumGenehmigung&order2=".$order_2."'>Datum Genehmigung</a></td>
			<td><a href='?order=genehmigtDurch&order2=".$order_2."'>Genehmigt Durch</a></td>
			<td><a href='?order=datumAuszahlung&order2=".$order_2."'>Datum Auszahlung</a></td>
			<td>Genehmigen</td>
		</tr>";
	while ($row = mysqli_fetch_array($table)){
		$query2 = "SELECT * FROM gibb_mitarbeiter WHERE Id =". $row['mitarbeiterId'];
		$mitarbeiter = queryDb($con, $query2);
		$mitarbeiter = mysqli_fetch_array($mitarbeiter);
		$mitarbeiterName = $mitarbeiter['Vorname'] . " " . $mitarbeiter['Name'];
		$query3 = "SELECT * FROM gibb_spesenart WHERE id =". $row['spesenArt'];
		$spesenart = queryDb($con, $query3);
		$spesenart = mysqli_fetch_array($spesenart);
		echo "<tr><td>".$row['id']."</td>
		<td><a href=?mitarbeiterId='".$row['mitarbeiterId']."'>".$mitarbeiterName."</a></td>
		<td>".$spesenart['text']."</td>
		<td>".round($row['betrag']/$row['waehrungskurs'],2)." &euro;</td>
		<td>".$row['waehrungskurs']."</td>
		<td>".$row['datumAbrechnung']."</td>
		<td>".$row['datumGenehmigung']."</td>
		<td>".$row['genehmigtDurch']."</td>
		<td>".$row['datumAuszahlung']."</td>
		<td><a href='?site=ok&id=".$row['id']."' alt='ok'><img src='ok.png' /></a></td>
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
	<p>Betrag: <input type='text' id='betrag' name='betrag' />
	<select name='waehrung' id='wechsel' onchange='wechselkurs()'>";
	$XMLContent=file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
	foreach($XMLContent as $line){
		if(preg_match("/currency='([[:alpha:]]+)'/",$line,$currencyCode)){
			if(preg_match("/rate='([[:graph:]]+)'/",$line,$rate)){
				echo "<option value='".$rate[1]."'>".$currencyCode[1]."</option>";
			}
		}
	};
	echo "</select>	</p>
	<p>W&auml;hrungkurs: <input type='text' value='1' id='kurs' name='waehrungskurs' disabled /></p> 
	<p>Kosten: <input type='text' id='euro' name='preis' disabled /> &euro;</p>
	<p>Datum:";
	DateDropDown(90, "DropDate");
	echo" </p>";
	echo '<input type="hidden" name="action" id="action" value="postForm">
	<input type="reset" value="Reset"> <input type="submit" value="Send">
	</form>';
}

function ok(){
	$con = dbConnect();
	$query = "SELECT * FROM gibb_mitarbeiter";
	$mitarbeiter=queryDb($con, $query);
	$query1 = "SELECT * FROM gibb_spesen WHERE id=".$_GET['id'];
	$table=queryDb($con, $query1);
	$table = mysqli_fetch_array($table);
	$query3 = "SELECT * FROM gibb_mitarbeiter WHERE id=".$table['mitarbeiterId'];
	$mitarbeiter2=queryDb($con, $query3);
	$query2 = "SELECT * FROM gibb_spesenart WHERE id =".$table['spesenArt'];
	$spesenart = queryDb($con, $query2);
	$mitarbeiter2 = mysqli_fetch_array($mitarbeiter2);
	$mitarbeiterName = $mitarbeiter2['Vorname'] . " " . $mitarbeiter2['Name'];
	$spesenart = mysqli_fetch_array($spesenart); 
	echo '<form action="?site=table&id='.$_GET['id'].'" method="post" enctype="multipart/form-data">
	<p>Mitarbeiter: <input type="text" name="mitarbeiter" value="'.$mitarbeiterName.'" disabled></p>
	<p>Spesenart: <input type="text" name="spesenArt" value="'.$spesenart['text'].'" disabled></p>
	<p>Betrag: <input type="text" id="betrag" name="betrag" value="'.$table['betrag'].'" disabled /></p>
	<p>W&auml;hrungkurs: <input type="text" value="'.$table['waehrungskurs'].'" id="kurs" name="waehrungskurs" disabled /></p>
	<p>Kosten: <input type="text" id="euro" name="preis" disabled value="'.$table['betrag'] / $table['waehrungskurs'].'" /> &euro;</p>
	<p>Datum Abrechnung: <imput type="text" name="datum" value="'.$table['datumAbrechnung'].'"></p>
	<p>Datum Genehmigung:';
	DateDropDown(90, "datumGenehmigung");
	echo' </p>
	<p> Genehmigt durch:<select name="mitarbeiterId">';
	while ($row = mysqli_fetch_array($mitarbeiter)){
		echo "<option value'".$row['mitarbeiterId']."'>".$row['Name']." ".$row['Vorname']."</option>";
	};
	echo '</select></p>
	<p>Datum Genehmigung:';
	DateDropDown(90, "datumAuszahlung");
	echo' </p>
	<input type="hidden" name="action" id="action" value="updateForm">
	<input type="reset" value="Reset"> <input type="submit" value="Send">
	</form>';
}

function save(){
	var_dump($_POST);
	$mitarbeiterName = explode(" ", $_POST['mitarbeiterId']);
	$con = dbConnect();
	$query = "SELECT id FROM gibb_mitarbeiter WHERE Name='".$mitarbeiterName[0]."' AND Vorname='".$mitarbeiterName[1]."'";
	$mitarbeiterId=queryDb($con, $query);
	$mitarbeiterId=mysqli_fetch_array($mitarbeiterId);
	$spesenArt=$_POST["spesenArt"];
	$betrag=$_POST["betrag"];
	$waehrungskurs = $_POST["waehrung"];
	$datumAbrechnung=$_POST['DropDate'];
	//$datumAbrechnung=
	//echo $mitarbeiterId[0]." ".$spesenArt." ".$betrag." ".$datumAbrechnung;
	$query2 = 'INSERT INTO gibb_spesen (mitarbeiterId, spesenArt, betrag, waehrungskurs, datumAbrechnung)
				VALUES ("'.$mitarbeiterId[0].'","'.$spesenArt.'","'.$betrag.'","'.$waehrungskurs.'","'.$datumAbrechnung.'");';
	$result = queryDb($con, $query2);
}

function update(){
	//var_dump($_POST);
	$mitarbeiterName = explode(" ", $_POST['mitarbeiterId']);
	$con = dbConnect();
	$query = "SELECT id FROM gibb_mitarbeiter WHERE Name='".$mitarbeiterName[0]."' AND Vorname='".$mitarbeiterName[1]."'";
	$mitarbeiterId=queryDb($con, $query);
	$mitarbeiterId=mysqli_fetch_array($mitarbeiterId);
	$datumGenehmigung=$_POST['datumGenehmigung'];
	$datumAuszahlung=$_POST['datumAuszahlung'];
	$query2 = 'UPDATE gibb_spesen (datumGenehmigung, genehmigtDurch, datumAuszahlung)
	VALUES ("'.$datumGenehmigung.'","'.$mitarbeiterId[0].'","'.$datumAuszahlung.'") WHERE id ='.$_GET['id'].';';
	$result = queryDb($con, $query2);
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
   echo "<select name=".$default." STYLE=\"font-family: monospace;\">\n";
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
