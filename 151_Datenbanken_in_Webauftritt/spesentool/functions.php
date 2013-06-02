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
			head;
			add();
			footer();
			break;
		default:
			//should never happen
	}
}

// display / html Stuff
function head(){
	echo "<!DOCTYPE html>
			<html>
			<head>
			<title>Spesentool</title>
			<body>
			<h1>Spesentool</h1>
			<p>Übersicht über alle Speseninformationen</p>";
}

function footer(){
	echo "</body>
			</html>";
}

function table(){
	$con = dbConnect();
	$query = "SELECT * FROM gibb_spesen";
	queryDb($con, $query);
	echo "<table>
		<tr>
			<td>Nummer</td>
			<td>Mitarbeiter</td>
			<td>Art</td>
			<td>Betrag</td>
			<td>Währungskurs</td>
			<td>Datum Abrechnung</td>
			<td>Datum Genehmigung</td>
			<td>Genehmigt Durch</td>
			<td>Datum Auszahlung</td>
		</tr>";
	foreach($query as $key => $value){
		echo "<tr><td>".$query['id']."</td>
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
?>